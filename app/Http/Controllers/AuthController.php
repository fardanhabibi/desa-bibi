<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Mail\ResetPasswordMail;
use App\Mail\SendOtpMail;


use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email_or_nik' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $input = $request->input('email_or_nik');
        $password = $request->input('password');
        $remember = $request->has('remember');
        // Determine whether input is NIK or email and attempt to find the user
        $user = null;
        if (preg_match('/^[0-9]{16}$/', $input)) {
            $user = User::where('nik', $input)->first();
        } else {
            $user = User::where('email', $input)->first();
        }

        if (!$user) {
            return back()->withErrors([
                'email_or_nik' => 'User tidak ditemukan dengan email atau NIK tersebut.'
            ])->withInput($request->only('email_or_nik'));
        }

        // If password is null or empty, disallow login
        if (empty($user->password)) {
            return back()->withErrors([
                'email_or_nik' => 'Akun ini belum memiliki password. Silakan reset password.'
            ])->withInput($request->only('email_or_nik'));
        }

        // Verify password
        if (!Hash::check($password, $user->password)) {
            return back()->withErrors([
                'email_or_nik' => 'Password salah.'
            ])->withInput($request->only('email_or_nik'));
        }

        // Login the user and regenerate session
        Auth::login($user, $remember);
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:users,nik',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date|before:today',
            'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'nullable|string|max:100',
            'nomor_telpon' => 'nullable|string|min:10|max:13',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create the user with biodata
        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'nomor_telpon' => $request->nomor_telpon,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'user',
        ]);

        // Map human-readable marital status to DB enum values used in penduduk table
        $statusMapping = [
            'Belum Kawin' => 'belum_kawin',
            'Kawin' => 'kawin',
            'Cerai Hidup' => 'cerai_hidup',
            'Cerai Mati' => 'cerai_mati',
        ];

        $statusKawin = null;
        if ($request->filled('status_perkawinan')) {
            $statusKawin = $statusMapping[$request->status_perkawinan] ?? null;
        }

        // Also create Penduduk record for admin data
        \App\Models\Penduduk::create([
            'nik' => $request->nik,
            'nama' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'email' => $request->email,
            'no_hp' => $request->nomor_telpon,
            'status_kawin' => $statusKawin,
            // Tambahkan field lain jika ada di form dan model
        ]);

        // Set session with the registered email
        $request->session()->flash('registered_email', $request->email);

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function sendOtp($user = null, $fromRegister = false)
    {
        if (!$user) {
            if (Auth::check()) {
                $user = Auth::user();
            } elseif (session('verify_email')) {
                $user = User::where('email', session('verify_email'))->firstOrFail();
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Email tidak ditemukan.']);
            }
        }


        $setResendOtp = 60; // dalam ms / detik


        if (session('last_otp_sent') && abs((int)now()->diffInSeconds(session('last_otp_sent'))) <   $setResendOtp) {
            return back()->withErrors(['otp' => 'Tunggu ' .  $setResendOtp . ' detik sebelum mengirim ulang OTP.']);
        }

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->otp_code = bcrypt($otp);
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Mail::raw("Kode OTP kamu adalah: $otp (berlaku 5 menit)", function ($message) use ($user) {
        //     $message->to($user->email)
        //         ->subject('Verifikasi Email - PPDB SMK');
        // });

        // Kirim email
        $subject = 'OTP Verifikasi Email';
        Mail::to($user->email)->send(new SendOtpMail(
            $subject,
            $user->name,
            $otp,
            $user->otp_expires_at->format('d M Y H:i:s')
        ));

        session([
            'verify_email' => $user->email,
            'last_otp_sent' => now(),
        ]);

        // Jika dari register, tampilkan alert success dan countdown
        if ($fromRegister) {
            return redirect()->route('verify.form')->with('success', 'Kode OTP telah dikirim ke ' . $user->email);
        }
        // Jika dari resend, tampilkan alert success
        return back()->with('success', 'Kode OTP baru telah dikirim ke ' . $user->email);
    }




    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Ambil user dari session (bukan dari Auth, karena user belum login)
        $user = null;
        if (session('verify_email')) {
            $user = User::where('email', session('verify_email'))->first();
        }

        // Pastikan user ditemukan dan instance model
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Data verifikasi tidak ditemukan.']);
        }

        // Cek OTP dan expired
        if (!Hash::check($request->otp, $user->otp_code)) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }
        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        // Sukses verifikasi
        $user->is_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Hapus session verifikasi
        session()->forget(['verify_email', 'last_otp_sent']);

        // Set session with the registered email
        $request->session()->flash('registered_email', $request->email);

        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi!');
    }
    // Tampilkan form verifikasi email
    public function showVerifyForm()
    {


        // Jika tidak ada session verify_email dan belum login, redirect ke login
        if (!session('verify_email') || !Auth::check()) {
            if (Auth::check()) {

                // Jika sudah login, set session verify_email jika belum ada
                // maka bisa asumsikan , user ini sedang memverifikasi email dari halaman dashboard
                $user = Auth::user();
                return $this->sendOtp($user, true);
            }

            return redirect()->route('login');
        }


        // Tidak mengubah session apapun, hanya hitung cooldown dari session
        $cooldown = 0;
        $setResendOtp = 60;
        if (session('last_otp_sent')) {
            $diff = (int)now()->diffInSeconds(session('last_otp_sent'));
            $cooldown = abs($diff);
        }
        // dd((session('last_otp_sent')));
        // session()->forget('last_otp_sent');
        // dd($cooldown);
        // session()->forget(['verify_email', 'last_otp_sent']);


        // dd(session('last_otp_sent') && abs((int)now()->diffInSeconds(session('last_otp_sent'))) < 60);
        return view('auth.verify-email', [
            'cooldown' => $cooldown,
            'timeResendOtp' => $setResendOtp
        ]);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        // ambil URL full sekarang
        $currentUrl = request()->fullUrl();

        // cek apakah mengandung 'localhost'
        if (str_contains($currentUrl, 'localhost')) {
            // ganti localhost -> 127.0.0.1
            $newUrl = str_replace('localhost', '127.0.0.1', $currentUrl);

            // redirect ke URL baru
            return redirect()->to($newUrl);
        }
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $socialUser->email,
        ], [
            'name' => $socialUser->name ?? $socialUser->getNickname(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
            'is_verified' => true
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }


    // Form untuk request reset
    public function showRequestForm()
    {
        return view('auth.forgot-password.email');
    }

    // Kirim email reset
    public function sendResetLink(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        // cek apakah email ada di db

        $user  = User::whereEmail($request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem kami']);
        }

        $token = Str::random(64);


        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        $resetLink = route('password.reset',  ['token' => $token]);

        // Kirim email
        Mail::to($request->email)->send(new ResetPasswordMail(
            $user->name,   // nama user jika ada
            $resetLink,
            now()->addMinutes(5)->format('d M Y H:i:s')
        ));

        return redirect()->route('login')->with('success', 'Bila email ada, maka email untuk mengubah password akan dikirim ke email yang Anda masukkan');
    }

    // Form untuk reset password
    public function showResetForm($token)
    {
        $getEmail = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->firstOrFail();
        $user = User::whereEmail($getEmail->email)->firstOrFail();

        return view('auth.forgot-password.reset', compact('token', 'user'));
    }

    // Update password user
    public function resetPassword(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();


        if (!$reset) {
            return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Token tidak valid.']);
        }

        // Cek apakah token expired (lebih dari 5 menit)
        $createdAt =  abs((int) now()->diffInMinutes($reset->created_at));

        if ($createdAt > 5) {
            return redirect()->route('forgot_password.email_form')->withErrors(['email' => 'Token sudah kadaluarsa, silakan request ulang.']);
        }

        // Update password user
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus token biar sekali pakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        // Set session with the registered email
        $request->session()->flash('registered_email', $request->email);
        return redirect('/login')->with('success', 'Password berhasil direset!, Silahkan Login menggunakan password baru Anda');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
