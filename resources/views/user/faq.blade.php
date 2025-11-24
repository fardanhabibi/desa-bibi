@extends('layouts.dashboard')
@section('title', 'FAQ')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-help-circle me-2"></i>Pertanyaan Sering Diajukan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="accordion accordion-flush" id="faqAccordion">
                @forelse ($faq as $index => $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqBody{{ $item->id }}">
                            {{ $item->pertanyaan }}
                        </button>
                    </h2>
                    <div id="faqBody{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $item->jawaban }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info">Tidak ada FAQ</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            {{ $faq->links() }}
        </div>
    </div>
</div>
@endsection
