<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 25px;
        padding: 4rem 2.5rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 70px rgba(30, 60, 114, 0.35);
        margin-bottom: 3rem;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: rgba(255, 215, 0, 0.08);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 450px;
        height: 450px;
        background: rgba(255, 237, 78, 0.05);
        border-radius: 50%;
        animation: float 10s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(40px) rotate(180deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .hero-greeting {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        text-shadow: 0 3px 15px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #fff, #ffd700);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        opacity: 0.95;
        font-weight: 400;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-hero {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(255, 215, 0, 0.4);
        color: white;
        padding: 0.9rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 1rem;
    }

    .btn-hero:hover {
        background: rgba(255, 215, 0, 0.25);
        border-color: rgba(255, 215, 0, 0.8);
        transform: translateY(-4px);
        color: #ffd700;
        box-shadow: 0 15px 40px rgba(255, 215, 0, 0.25);
    }

    .btn-hero i {
        font-size: 1.2rem;
    }

    .alert-verification {
        background: linear-gradient(135deg, #fef5e7 0%, #fdebd0 100%);
        border: 2px solid #f39c12;
        border-radius: 18px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 12px 35px rgba(243, 156, 18, 0.15);
        animation: slideInDown 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-verification .alert-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .alert-verification .icon {
        font-size: 2.5rem;
        color: #f39c12;
        flex-shrink: 0;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .alert-verification .text {
        flex: 1;
    }

    .alert-verification .text strong {
        display: block;
        color: #d68910;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
        font-weight: 800;
    }

    .alert-verification .text small {
        color: #e67e22;
        opacity: 0.9;
        font-size: 0.95rem;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #1e3c72, #2a5298, #ffd700);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-16px) scale(1.03);
        box-shadow: 0 30px 70px rgba(30, 60, 114, 0.2);
        border-color: #1e3c72;
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: iconBounce 2.5s ease-in-out infinite;
    }

    @keyframes iconBounce {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-12px) scale(1.08); }
    }

    .feature-card:nth-child(1) .feature-icon { animation-delay: 0s; }
    .feature-card:nth-child(2) .feature-icon { animation-delay: 0.3s; }
    .feature-card:nth-child(3) .feature-icon { animation-delay: 0.6s; }

    .feature-title {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: #1e3c72;
    }

    .feature-description {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .success-message {
        background: linear-gradient(135deg, #e8f8f5 0%, #d5f4e6 100%);
        border: 2px solid #27ae60;
        border-radius: 18px;
        padding: 1.8rem;
        color: #16a085;
        margin-bottom: 3rem;
        animation: slideInDown 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.05rem;
    }

    .success-message i {
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .verify-btn {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        border: none;
        border-radius: 50px;
        padding: 0.85rem 1.8rem;
        color: #1e3c72;
        font-weight: 800;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        white-space: nowrap;
        flex-shrink: 0;
        font-size: 1rem;
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
    }

    .verify-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 215, 0, 0.4);
        color: #1e3c72;
    }

    .verify-btn:disabled,
    .verify-btn.disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .hero-greeting {
            font-size: 2.3rem;
        }

        .hero-subtitle {
            font-size: 1.05rem;
        }

        .dashboard-hero {
            padding: 2.5rem 1.5rem;
            margin-bottom: 2rem;
        }

        .feature-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .alert-verification .alert-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .verify-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="dashboard-hero">
    <div class="hero-content">
        <h1 class="hero-greeting">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="hero-subtitle">Nikmati berbagai layanan dan informasi desa yang transparan dan mudah diakses. Bersama kita membangun desa yang lebih maju.</p>
        <div class="hero-actions">
            <a href="{{ route('user.pengajuan.index') }}" class="btn-hero">
                <i class="bi bi-file-earmark-text"></i>
                Pengajuan Surat
            </a>
            <a href="{{ route('user.pengaduan.index') }}" class="btn-hero">
                <i class="bi bi-chat-dots"></i>
                Pengaduan & Masukan
            </a>
        </div>
    </div>
</div>

@if (!$user->is_verified)
    <div class="alert-verification">
        <div class="alert-content">
            <div class="icon">
                <i class="bi bi-shield-exclamation"></i>
            </div>
            <div class="text">
                <strong>📧 Verifikasi Email Diperlukan</strong>
                <small>Lengkapi verifikasi email Anda untuk mengakses semua fitur dan layanan desa</small>
            </div>
            <div style="flex-shrink: 0;">
                <a href="{{ route('verify.form') }}" id="verify-button" class="verify-btn">
                    <i class="bi bi-check-circle"></i> Verifikasi Sekarang
                </a>
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="success-message">
        <i class="bi bi-check-circle-fill"></i>
        <strong>{{ session('success') }}</strong>
    </div>
@endif

<div class="feature-grid">
    <div class="feature-card">
        <div class="feature-icon">
            <i class="bi bi-file-text"></i>
        </div>
        <h3 class="feature-title">Pengajuan Layanan</h3>
        <p class="feature-description">Ajukan berbagai kebutuhan administratif seperti surat pengantar, surat keterangan, dan layanan desa lainnya dengan mudah dan cepat.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
            <i class="bi bi-chat-left-dots"></i>
        </div>
        <h3 class="feature-title">Layanan Aduan</h3>
        <p class="feature-description">Laporkan keluhan atau masalah di desa kami. Masukan Anda sangat penting untuk meningkatkan kualitas pelayanan.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
            <i class="bi bi-info-circle"></i>
        </div>
        <h3 class="feature-title">Informasi Desa</h3>
        <p class="feature-description">Dapatkan informasi terbaru tentang pengumuman, berita desa, dan program-program yang sedang berjalan di desa kami.</p>
    </div>
</div>

<script>
    // Enhanced verification button with better UX
    const verifyButton = document.getElementById('verify-button');

    if (verifyButton) {
        verifyButton.addEventListener('click', function(e) {
            // Add loading state
            this.setAttribute('aria-disabled', 'true');
            this.classList.add('disabled');
            this.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Memproses...
            `;
        });
    }

    // Add smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
