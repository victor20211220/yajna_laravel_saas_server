@php
    use App\Models\Utility;
@endphp
@props([
    'is_on_form_preview' => false,
    'id',
])
<div class="modal {{ $is_on_form_preview ? "position-sticky": "fade vcard-modal"}}" id="{{ $id }}" tabindex="-1"
     aria-labelledby="shareContactModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold mx-auto" id="shareContactModalLabel">Share Contact</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($business->shareContactField)
                    <form method="POST"
                          action="{{ route('contacts.store') }}" {!! $is_on_form_preview ? "onsubmit=\"return false;\"": ""  !!}>
                        @csrf
                        <div class="d-grid gap-3 mb-4">
                            @php
                                $is_name_enabled = $business->shareContactField->is_name_enabled;
                            @endphp
                            @if ($is_name_enabled || $is_on_form_preview)
                                <input type="text" name="name"
                                       class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                       placeholder="Name" {!! Utility::hideEmptyCardElement([$is_on_form_preview, !$is_name_enabled], "and") !!}
                                @if($business->shareContactField->is_name_required)
                                    required
                                @endif>
                            @endif

                            @php
                                $is_phone_enabled = $business->shareContactField->is_phone_enabled;
                            @endphp
                            @if ($is_phone_enabled || $is_on_form_preview)
                                <input type="tel" pattern="[0-9]{10,15}" name="phone"
                                       class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                       placeholder="Phone number" {!! Utility::hideEmptyCardElement([$is_on_form_preview, !$is_phone_enabled], "and") !!}
                                       @if($business->shareContactField->is_phone_required) required @endif>
                            @endif

                            @php
                                $is_email_enabled = $business->shareContactField->is_email_enabled;
                            @endphp
                            @if ($is_email_enabled || $is_on_form_preview)
                                <input type="email" name="email"
                                       class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                       placeholder="Email" {!! Utility::hideEmptyCardElement([$is_on_form_preview, !$is_email_enabled], "and") !!}
                                       @if($business->shareContactField->is_email_required) required @endif>
                            @endif

                            @php
                                $is_company_enabled = $business->shareContactField->is_company_enabled;
                            @endphp
                            @if ($is_company_enabled || $is_on_form_preview)
                                <input type="text" name="company"
                                       class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                       placeholder="Company" {!! Utility::hideEmptyCardElement([$is_on_form_preview, !$is_company_enabled], "and") !!}
                                       @if($business->shareContactField->is_company_required) required @endif>
                            @endif

                            @php
                                $is_job_title_enabled = $business->shareContactField->is_job_title_enabled;
                            @endphp
                            @if ($is_job_title_enabled || $is_on_form_preview)
                                <input type="text" name="job_title"
                                       class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                       placeholder="Job Title" {!! Utility::hideEmptyCardElement([$is_on_form_preview, !$is_job_title_enabled], "and") !!}
                                       @if($business->shareContactField->is_job_title_required) required @endif>
                            @endif

                            @php
                                $is_notes_enabled = $business->shareContactField->is_notes_enabled;
                            @endphp
                            @if ($is_notes_enabled || $is_on_form_preview)
                                <textarea name="message"
                                          class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                          rows="3" placeholder="Notes" {!! Utility::hideEmptyCardElement([$is_on_form_preview, !$is_notes_enabled], "and") !!}
                                          @if($business->shareContactField->is_notes_required) required @endif></textarea>
                            @endif

                            <input type="hidden" name="business_id" value="{{ $business->id }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-primary rounded-3 py-2 d-flex justify-content-center align-items-center gap-2">
                                <i class="bi bi-arrow-repeat"></i>
                                <span>Share Contact</span>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
