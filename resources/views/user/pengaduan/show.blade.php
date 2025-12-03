@extends('layouts.dashboard')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.pengaduan.index') }}">Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Detail Pengaduan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $pengaduan->nomor_pengaduan }}</h5>
                            <span class="badge {{ $pengaduan->status_badge }}">{{ $pengaduan->status }}</span>
                        </div>
                        <a href="{{ route('user.pengaduan.index') }}" class="btn btn-light">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Informasi Pengaduan -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td width="150"><strong>Judul</strong></td>
                                    <td>: {{ $pengaduan->judul }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori</strong></td>
                                    <td>: <span class="badge bg-light-secondary">{{ $pengaduan->kategori }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Dibuat</strong></td>
                                    <td>: {{ $pengaduan->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td width="150"><strong>Status</strong></td>
                                    <td>: <span class="badge {{ $pengaduan->status_badge }}">{{ $pengaduan->status }}</span></td>
                                </tr>
                                @if($pengaduan->file_lampiran)
                                    <tr>
                                        <td><strong>Lampiran</strong></td>
                                        <td>:
                                            @php
                                                $files = is_array($pengaduan->file_lampiran) ? $pengaduan->file_lampiran : (json_decode($pengaduan->file_lampiran, true) ?: []);
                                            @endphp
                                            @if(empty($files) && is_string($pengaduan->file_lampiran))
                                                {{-- fallback single file string --}}
                                                <a href="{{ asset('storage/pengaduan/' . $pengaduan->file_lampiran) }}" target="_blank" class="btn btn-sm btn-light-primary">
                                                    <i class="ti ti-download me-1"></i> Lihat File
                                                </a>
                                            @else
                                                @foreach($files as $f)
                                                    @if($f)
                                                        <a href="{{ asset('storage/pengaduan/' . $f) }}" target="_blank" class="btn btn-sm btn-light-primary me-1 mb-1">
                                                            <i class="ti ti-download me-1"></i> {{ $loop->iteration }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <hr>

                    <!-- Isi Pengaduan -->
                    <div class="mb-4">
                        <h6 class="mb-3">Isi Pengaduan:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($pengaduan->isi_pengaduan)) !!}
                        </div>
                    </div>

                    <!-- Tanggapan -->
                    @if($pengaduan->tanggapan)
                        <hr>
                        <div class="alert alert-success">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="mb-0"><i class="ti ti-message-circle me-2"></i>Tanggapan Admin</h6>
                                <small class="text-muted">
                                    {{ $pengaduan->tanggal_tanggapan->format('d F Y, H:i') }}
                                    @if($pengaduan->admin)
                                        <br>oleh {{ $pengaduan->admin->name }}
                                    @endif
                                </small>
                            </div>
                            <div class="p-3 bg-white rounded">
                                {!! nl2br(e($pengaduan->tanggapan)) !!}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="ti ti-clock me-2"></i>
                            Pengaduan Anda sedang menunggu tanggapan dari admin.
                        </div>
                    @endif

                    <!-- Tombol Aksi -->
                    @if($pengaduan->status === 'Pending')
                        <div class="mt-4 text-end">
                            <form action="{{ route('user.pengaduan.destroy', $pengaduan) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit
                                  onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash me-1"></i> Hapus Pengaduan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection