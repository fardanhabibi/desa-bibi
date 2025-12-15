@extends('layouts.dashboard')

@section('title', 'Profil Desa')

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Profil Desa</li>
                        </ul>
                    </div>
                        <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Profil Desa Urangagung</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="ti ti-home me-2"></i>Informasi Desa
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ti ti-edit me-2"></i>Edit Profil
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Tab 1: Informasi Desa -->
                            <div class="tab-pane active show" id="profile-1" role="tabpanel"
                                aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="col-lg-4 col-xxl-3">
                                        <div class="card">
                                            <div class="card-body position-relative text-center">
                                                <div class="position-absolute end-0 top-0 p-3">
                                                    <span class="badge bg-success">Aktif</span>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <i class="ti ti-home text-primary" style="font-size: 3rem;"></i>
                                                </div>
                                                <h5 class="mb-0">Desa Urangagung</h5>
                                                <p class="text-muted text-sm mb-3">Urangaung, Sidoarjo, Jawa Timur</p>
                                                <hr class="my-3">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">Penduduk</small>
                                                            <h6 class="mb-0">{{ \App\Models\Penduduk::count() }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">Kepala Keluarga</small>
                                                            <h6 class="mb-0">{{ \App\Models\KartuKeluarga::count() }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">Status</small>
                                                            <span class="badge bg-light-success">Berkembang</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-xxl-9">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Tentang Desa</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-3">Urangagung terletak di Kecamatan Sidoarjo, Kabupaten Sidoarjo, Jawa Timur, Indonesia. Kelurahan ini memiliki kantor kelurahan yang melayani masyarakat dalam berbagai kebutuhan administrasi, termasuk perizinan dan layanan kependudukan.</p>
                                                <p class="mb-0">Dengan memanfaatkan teknologi informasi dan sistem terintegrasi, Desa Urangagung terus berinovasi untuk memberikan pelayanan terbaik kepada masyarakat dalam berbagai aspek administrasi, pembangunan, dan layanan publik.</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Statistik Desa</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Surat Dikeluarkan</p>
                                                                <p class="mb-0 h6">{{ \App\Models\Surat::count() }} Surat</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Pengaduan Diterima</p>
                                                                <p class="mb-0 h6">{{ \App\Models\Pengaduan::count() }} Pengaduan</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Agenda Kegiatan</p>
                                                                <p class="mb-0 h6">{{ \App\Models\Agenda::count() }} Acara</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">User Terdaftar</p>
                                                                <p class="mb-0 h6">{{ \App\Models\User::count() }} User</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <p class="mb-1 text-muted">Wilayah Administratif</p>
                                                        <p class="mb-0 h6">~ 2.5 km²</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab 2: Edit Profil -->
                            <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Edit Informasi Desa</h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <h6 class="mb-2"><i class="ti ti-alert-circle me-2"></i>Ada Kesalahan</h6>
                                                        <ul class="mb-0">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <i class="ti ti-check me-2"></i>{{ session('success') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <form method="POST" action="{{ route('myprofile.update') }}" id="editForm">
                                                    @csrf
                                                    <div class="row mb-3">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Nama Desa</label>
                                                                <input type="text" class="form-control" name="nama_desa" value="{{ old('nama_desa', auth()->user()->name) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Nomor Telepon</label>
                                                                <input type="text" class="form-control" name="telepon" placeholder="+62..." value="{{ old('telepon', auth()->user()->nomor_telpon) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" class="form-control" name="email" placeholder="info@desaurangagung.go.id" value="{{ old('email', auth()->user()->email) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Deskripsi Desa</label>
                                                                <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-sm-12 text-end">
                                                            <button type="reset" class="btn btn-outline-secondary me-2">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Informasi</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 py-2">
                                                        <p class="text-muted mb-1">Format Telepon:</p>
                                                        <p class="text-sm mb-0">Gunakan format: +62...</p>
                                                    </li>
                                                    <li class="list-group-item px-0 py-2">
                                                        <p class="text-muted mb-1">Status:</p>
                                                        <span class="badge bg-success">Aktif & Terverifikasi</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    @endsection