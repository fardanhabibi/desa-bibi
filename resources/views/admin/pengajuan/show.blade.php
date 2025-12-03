@extends('layouts.dashboard')
@section('title', 'Proses Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.surat.index') }}">Kelola Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Proses</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Proses Pengajuan Surat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Header Card -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2">{{ $surat->nomor_pengajuan }}</h5>
                            <span class="badge {{ $surat->status_badge }} me-2">
                                <i class="ti {{ $surat->status_icon }} me-1"></i>
                                {{ $surat->status }}
                            </span>
                            <span class="badge bg-light-primary">{{ $surat->jenis_surat }}</span>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ route('admin.surat.index') }}" class="btn btn-light">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pemohon -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="ti ti-user me-2"></i>Informasi Pemohon</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Nama</label>
                            <p class="mb-0 fw-bold">{{ $surat->user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0">{{ $surat->user->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Nomor Telpon</label>
                            <p class="mb-0">{{ $surat->user->nomor_telpon ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Pekerjaan</label>
                            <p class="mb-0">{{ $surat->user->pekerjaan ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Tanggal Pengajuan</label>
                            <p class="mb-0">{{ $surat->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Status Verifikasi</label>
                            <p class="mb-0">
                                @if($surat->user->is_verified)
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning">Belum Terverifikasi</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pengajuan -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="ti ti-file-text me-2"></i>Detail Pengajuan Surat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Jenis Surat</label>
                            <p class="mb-0">
                                <span class="badge bg-light-primary">{{ $surat->jenis_surat }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Keperluan</label>
                            <p class="mb-0">{{ $surat->keperluan }}</p>
                        </div>
                        @if($surat->file_pendukung)
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">File Pendukung</label>
                                <p class="mb-0">
                                    <a href="{{ asset('storage/surat/pendukung/' . $surat->file_pendukung) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-light-primary">
                                        <i class="ti ti-paperclip me-1"></i> Lihat File
                                    </a>
                                </p>
                            </div>
                        @endif
                        @if($surat->file_lampiran)
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Lampiran dari Pemohon</label>
                                <p class="mb-0">
                                    <a href="{{ asset('storage/pengajuan_surat/' . $surat->file_lampiran) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-light-warning">
                                        <i class="ti ti-download me-1"></i> Lihat Lampiran
                                    </a>
                                </p>
                            </div>
                        @endif
                        @if($surat->admin)
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Diproses Oleh</label>
                                <p class="mb-0">{{ $surat->admin->name }}</p>
                            </div>
                        @endif

                        @if($surat->file_surat)
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">File Surat (Final)</label>
                                <p class="mb-0">
                                    <span class="badge bg-success">
                                        <i class="ti ti-check me-1"></i>File final tersedia
                                    </span>
                                    <a href="{{ route('admin.surat.download', $surat) }}" 
                                       class="btn btn-sm btn-light-primary ms-2">
                                        <i class="ti ti-download"></i> Download
                                    </a>
                                </p>
                            </div>
                        @endif
                    </div>

                    @if($surat->keterangan)
                        <hr>
                        <div>
                            <label class="text-muted small">Keterangan Tambahan dari Pemohon</label>
                            <div class="p-3 bg-light rounded mt-2">
                                {!! nl2br(e($surat->keterangan)) !!}
                            </div>
                        </div>
                    @endif

                    @php
                        $detail = [];
                        if (is_array($surat->detail)) {
                            $detail = $surat->detail;
                        } elseif (is_string($surat->detail) && !empty($surat->detail)) {
                            $detail = json_decode($surat->detail, true) ?: [];
                        }
                    @endphp

                    @if(!empty($detail) && is_array($detail))
                        <hr>
                        <div>
                            <label class="text-muted small">Isi Form Pengajuan</label>
                            <div class="p-3 bg-white rounded mt-2">
                                @php
                                    $labels = [
                                        'alamat' => 'Alamat',
                                        'lama_tinggal' => 'Lama Tinggal (tahun)',
                                        'nama_usaha' => 'Nama Usaha',
                                        'alamat_usaha' => 'Alamat Usaha',
                                        'kondisi_ekonomi' => 'Keterangan Kondisi Ekonomi',
                                        'jumlah_tanggungan' => 'Jumlah Tanggungan',
                                        'nama_bayi' => 'Nama Bayi',
                                        'tanggal_lahir' => 'Tanggal Lahir',
                                        'tempat_lahir' => 'Tempat Lahir',
                                        'nama_almarhum' => 'Nama Almarhum',
                                        'tanggal_meninggal' => 'Tanggal Meninggal',
                                        'sebab' => 'Sebab Kematian',
                                        'tujuan' => 'Tujuan Pengantar',
                                        'keterangan_pengantar' => 'Keterangan Pengantar',
                                        'nama_lama' => 'Nama Lama',
                                        'nama_baru' => 'Nama Baru',
                                        'alasan_perubahan' => 'Alasan Perubahan Nama',
                                        'alamat_tujuan' => 'Alamat Tujuan Migrasi',
                                        'alasan_migrasi' => 'Alasan Migrasi',
                                        'judul' => 'Judul / Perihal',
                                        'rincian' => 'Rincian',
                                    ];
                                @endphp

                                <div class="row">
                                    @foreach($detail as $k => $v)
                                        @continue($v === null || $v === '')
                                        @php
                                            $label = $labels[$k] ?? ucwords(str_replace(['_','-'], [' ',' '], $k));
                                            $value = $v;
                                            if(str_contains(strtolower($k), 'tanggal') && !empty($v)){
                                                try{ $value = \Carbon\Carbon::parse($v)->format('d F Y'); } catch(\Exception $e) { }
                                            }
                                        @endphp
                                        <div class="col-md-6 mb-2">
                                            <div class="text-muted small">{{ $label }}</div>
                                            <div class="fw-bold">{{ $value }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Timeline Proses removed per request --}}

            <!-- Form Proses Pengajuan -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="ti ti-edit me-2"></i>Form Proses Pengajuan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.surat.update', $surat) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="status">
                                    Status Pengajuan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Pending" {{ old('status', $surat->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diproses" {{ old('status', $surat->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Disetujui" {{ old('status', $surat->status) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Ditolak" {{ old('status', $surat->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="file_surat">
                                        Upload File Surat (PDF)
                                    </label>
                                    <input type="file" 
                                           class="form-control @error('file_surat') is-invalid @enderror" 
                                           id="file_surat" 
                                           name="file_surat"
                                           accept=".pdf">
                                    <small class="text-muted d-block mt-1">Format: PDF. Maksimal 5MB. Upload saat status Disetujui.</small>
                                    @error('file_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            <!-- Upload removed: admin now manages final surat files elsewhere -->

                            @if($surat->status === 'Disetujui')
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cetak/Preview Surat</label>
                                        <p class="mb-0">
                                            <a href="{{ route('admin.pengajuan.print', $surat) }}" 
                                               target="_blank"
                                               class="btn btn-success">
                                                <i class="ti ti-printer me-1"></i> Cetak Surat
                                            </a>
                                            <a href="{{ route('admin.pengajuan.downloadPdf', $surat) }}" 
                                               class="btn btn-primary ms-2">
                                                <i class="ti ti-download me-1"></i> Download PDF
                                            </a>
                                        </p>
                                    </div>
                                @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="catatan_admin">Catatan Admin</label>
                            <textarea class="form-control @error('catatan_admin') is-invalid @enderror" 
                                      id="catatan_admin" 
                                      name="catatan_admin" 
                                      rows="4" 
                                      placeholder="Tulis catatan untuk pemohon (opsional tapi disarankan untuk status Disetujui/Ditolak)">{{ old('catatan_admin', $surat->catatan_admin) }}</textarea>
                            @error('catatan_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="ti ti-info-circle me-2"></i>
                            <strong>Panduan:</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                <li><strong>Pending:</strong> Pengajuan belum diproses</li>
                                <li><strong>Diproses:</strong> Surat sedang dalam proses pembuatan</li>
                                <li><strong>Disetujui:</strong> Surat sudah selesai, upload file surat untuk didownload pemohon</li>
                                <li><strong>Ditolak:</strong> Pengajuan ditolak, wajib isi alasan penolakan di catatan</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                            <a href="{{ route('admin.surat.index') }}" class="btn btn-light order-2 order-md-1">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary order-1 order-md-2">
                                <i class="ti ti-check me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection