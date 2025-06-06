@extends('layouts.new-client')
@section('page-title')
    {{ __('Support') }}
@endsection
@section('title')
    <div class="mb-4">
        <h3 class="page-title">
            {{ __('Support') }}
        </h3>
    </div>
@endsection
@section('content')
    <div class="card p-4">
        <div class="section-title mb-1">Contact us</div>
        <p class="section-subtitle">Our team of experts is available to provide support through email</p>
        <div class="p-4 border rounded">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('support.send') }}" enctype="multipart/form-data">
                        @csrf
                        <p>Let us know how we can assist you.</p>
                        <div class="mb-3">
                            <label>Subject <x-required></x-required></label>
                            <input type="text" name="subject" class="form-control bg-secondary" required>
                        </div>
                        <div class="mb-3">
                            <label>Message <x-required></x-required></label>
                            <textarea name="message" class="form-control bg-secondary" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Attachment</label>
                            <input type="file" name="attachment" class="form-control bg-secondary">
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ url()->previous() }}" class="btn btn-white">Cancel</a>
                            <button type="submit" class="btn btn-primary">Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3"></div>
    <div class="card p-4">
        <div class="section-title">FAQ</div>
        <div class="accordion" id="faqAccordion">
            @foreach ($faqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed fw-normal" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                aria-controls="collapse{{ $index }}">
                            {!! $faq['title'] !!}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! $faq['content'] !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
