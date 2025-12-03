@extends('layouts.dashboard')
@section('title', 'Ajukan Surat Baru')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ajukan Surat Baru</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Ajukan Surat Baru</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.surat.store') }}" method="POST" enctype="multipart/form-data" id="pengajuanForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenis_surat" class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                    <select class="form-select @error('jenis_surat') is-invalid @enderror" 
                                            id="jenis_surat" 
                                            name="jenis_surat" 
                                            required>
                                        <option value="">Pilih Jenis Surat</option>
                                        @foreach($jenisSurat as $jenis)
                                            @if(is_object($jenis))
                                                <option value="{{ $jenis->id }}" data-label="{{ strtolower(str_replace(' ', '-', $jenis->nama_surat)) }}" {{ old('jenis_surat') == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_surat }}
                                                </option>
                                            @else
                                                <option value="{{ $jenis }}" data-label="{{ strtolower(str_replace(' ', '-', $jenis)) }}" {{ old('jenis_surat') == $jenis ? 'selected' : '' }}>
                                                    {{ $jenis }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('jenis_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Form sections dinamis untuk setiap jenis surat -->
                            <div class="col-12 mt-3">
                                <div class="alert alert-info">
                                    <i class="ti ti-info-circle me-2"></i>
                                    Silakan isi form detail sesuai dengan jenis surat yang dipilih.
                                </div>
                            </div>

                            <!-- Include all form partials -->
                            @include('user.pengajuan.forms._domisili')
                            @include('user.pengajuan.forms._usaha')
                            @include('user.pengajuan.forms._tidak_mampu')
                            @include('user.pengajuan.forms._kelahiran')
                            @include('user.pengajuan.forms._kematian')
                            @include('user.pengajuan.forms._pengantar')
                            @include('user.pengajuan.forms._beda_nama')
                            @include('user.pengajuan.forms._migrasi')
                            @include('user.pengajuan.forms._lainnya')

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="keperluan" class="form-label">Keperluan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('keperluan') is-invalid @enderror" 
                                              id="keperluan" 
                                              name="keperluan" 
                                              rows="3" 
                                              placeholder="Jelaskan keperluan pembuatan surat..." 
                                              required>{{ old('keperluan') }}</textarea>
                                    @error('keperluan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 500 karakter</div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                              id="keterangan" 
                                              name="keterangan" 
                                              rows="4" 
                                              placeholder="Tambahkan keterangan lain jika diperlukan...">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 1000 karakter</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="file_lampiran" class="form-label">Lampiran (Opsional)</label>
                                    <input type="file" 
                                           class="form-control @error('file_lampiran') is-invalid @enderror" 
                                           id="file_lampiran" 
                                           name="file_lampiran"
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('file_lampiran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Tipe file: PDF, JPG, JPEG, PNG (Maks 2MB)</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send me-1"></i> Ajukan Surat
                            </button>
                            <a href="{{ route('user.surat.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisSuratSelect = document.getElementById('jenis_surat');
    
    // Function to toggle form sections
    function toggleFormSections() {
        const selectedOption = jenisSuratSelect.options[jenisSuratSelect.selectedIndex];
        const selectedLabel = selectedOption.getAttribute('data-label');
        
        // Hide all form sections
        document.querySelectorAll('.form-section').forEach(section => {
            section.style.display = 'none';
        });
        
        // Show selected form section
        if (selectedLabel) {
            const sectionClass = 'form-' + selectedLabel;
            const section = document.querySelector('.' + sectionClass);
            if (section) {
                section.style.display = 'block';
            }
        }
    }
    
    // Initial toggle on page load
    toggleFormSections();
    
    // Toggle on change
    jenisSuratSelect.addEventListener('change', toggleFormSections);
});
</script>
@endsection
