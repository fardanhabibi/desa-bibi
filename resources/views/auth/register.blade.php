@extends('layouts.auth')

@section('title', 'Register Page')

@section('content')
    <div class="card my-5">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Sign up</b></h3>
                    <a href="/login" class="link-primary">Already have an account?</a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>

                @endif
                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm" required name="name" placeholder="Nama Lengkap"
                                value="{{ old('name') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">NIK (16 digit)</label>
                            <input type="text" class="form-control form-control-sm @error('nik') is-invalid @enderror" required name="nik" 
                                placeholder="Nomor Induk Kependudukan" value="{{ old('nik') }}" maxlength="16" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            @error('nik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control form-control-sm" name="tempat_lahir" placeholder="Tempat Lahir"
                                value="{{ old('tempat_lahir') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Status Perkawinan</label>
                            <select class="form-select form-select-sm" name="status_perkawinan">
                                <option value="">Pilih Status</option>
                                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control form-control-sm" name="pekerjaan" placeholder="Pekerjaan"
                                value="{{ old('pekerjaan') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control form-control-sm @error('nomor_telpon') is-invalid @enderror" name="nomor_telpon" 
                                placeholder="08xx atau +628xx" value="{{ old('nomor_telpon') }}" autocomplete="off"
                                onkeypress="return event.charCode == 43 || (event.charCode >= 48 && event.charCode <= 57)"
                                oninput="this.value = this.value.replace(/[^0-9+]/g, '')"
                                onpaste="setTimeout(() => { this.value = this.value.replace(/[^0-9+]/g, '') }, 0)">
                            @error('nomor_telpon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Email Address*</label>
                            <input type="email" class="form-control form-control-sm" required name="email" placeholder="Email Address"
                                value="{{ old('email') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm" required name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control form-control-sm" required name="password_confirmation"
                                placeholder="Password Confirmation">
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary">
                        Terms
                        of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
                <div class="saprator mt-3">
                    <span>Sign up with</span>
                </div>
                @include('auth.sso')

            </div>

        </form>
    </div>
@endsection
