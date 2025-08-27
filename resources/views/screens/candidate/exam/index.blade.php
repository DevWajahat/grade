<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Lindy - Bootstrap 5 UI Kit</title>
        @laravelPWA

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.svg" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/bootstrap-5.0.0-alpha-2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/style.css') }}" />
    <link href="{{ asset('assets/candidate/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/candidate/css/lindy-uikit.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
        integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<div id="loader-overlay" class="loader-overlay">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<main class="container py-4">
    <div class="exam-header-info">
        <h1 class="exam-title-display">{{ $exam->title }}</h1>
        <div class="timer-display">
            <i class="ri-time-line"></i>
            <span id="examTimer"></span>
        </div>
    </div>

    <form id="examForm" method="post" enctype="multipart/form-data">
        @forelse ($exam->sections as $section)
            <div class="question-section-card">
                <h2 class="section-heading">{{ $section->title }}</h2>

                @php
                    $i = 1;
                @endphp
                @forelse ($section->questions as $question)
                    <div class="question-card">
                        <p class="question-number">
                            Question {{ $i }} <span class="float-end text-muted">Marks:
                                {{ $question->marks }}</span>
                        </p>
                        <p class="question-text">
                            {{ $question->question_text }}
                        </p>

                        @if ($question->type == 'multiple-choice')
                            @php
                                $j = 1;
                            @endphp
                            @forelse ($question->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input" data-question="{{ $question->id }}" type="radio" name="q{{ $i }}"
                                        id="q{{ $i }}_option{{ $j }}"
                                        value="{{ $option->option_text }}" />
                                    <label class="form-check-label"
                                        for="q{{ $i }}_option{{ $j }}">
                                        {{ $option->option_text }}
                                    </label>
                                </div>
                                @php
                                    ++$j;
                                @endphp
                            @empty
                            @endforelse
                        @endif

                        @if ($question->type == 'short-answer' || $question->type == 'long-answer' )
                            <div class="mb-3">
                                <textarea class="form-control" name="q{{ $i }}" data-question="{{ $question->id }}"
                                    id="q{{ $i }}_answer" rows="3" placeholder="Type your answer here..."></textarea>
                                <a href="{{ route('candidate.camera', ['index' => $question->id, 'id' => $id]) }}"
                                    class="btn btn-outline-primary btn-sm capture-btn mt-2"
                                    data-target-textarea="q{{ $i }}_answer">
                                    <i class="ri-camera-line me-2"></i> Capture Handwritten Answer
                                </a>
                            </div>
                        @endif

                    </div>
                    @php
                        $i++;
                    @endphp

                @empty
                @endforelse

            </div>
        @empty
        @endforelse

    </form>
</main>

<footer class="exam-footer">
    <button type="button" class="btn btn-secondary" id="prevSectionBtn">
        <i class="ri-arrow-left-line me-2"></i> Previous Section
    </button>
    <button type="button" class="btn btn-primary" id="nextSectionBtn">
        Next Section <i class="ri-arrow-right-line ms-2"></i>
    </button>
    <button type="button" class="btn btn-success" id="submitExamBtn" data-bs-toggle="modal"
        data-bs-target="#submitConfirmModal">
        Submit Exam <i class="ri-check-line ms-2"></i>
    </button>
</footer>

<div class="modal fade" id="submitConfirmModal" tabindex="-1" aria-labelledby="submitConfirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitConfirmModalLabel">
                    Confirm Submission
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit your exam? You will not be able to
                make changes after submission.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-success" id="confirmSubmitBtn">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1051; /* Higher than the modal (1050) */
    }

    /* Make the spinner larger */
    .loader-overlay .spinner-border {
        width: 4rem;
        height: 4rem;
        border-width: 0.4em;
    }
</style>

<script src="{{ asset('assets/candidate/js/autosave.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.onload = () => {
        const sections = $('.question-section-card');
        const prevSectionBtn = $('#prevSectionBtn');
        const nextSectionBtn = $('#nextSectionBtn');
        const submitExamBtn = $('#submitExamBtn');
        const timerDisplay = $('#examTimer');
        const loaderOverlay = $('#loader-overlay');
        let timeRemaining;
        let currentSectionIndex;
        const savedState = JSON.parse(sessionStorage.getItem("examState"));
        if (savedState) {
            timeRemaining = savedState.timeRemaining;
            currentSectionIndex = savedState.currentSectionIndex;
        } else {
            timeRemaining = {{ $exam->duration_minutes }} * 60;
            currentSectionIndex = 0;
        }
        window.timeRemaining = timeRemaining;
        window.currentSectionIndex = currentSectionIndex;
        const timerInterval = setInterval(() => {
            window.timeRemaining--;
            const minutes = Math.floor(window.timeRemaining / 60);
            const seconds = window.timeRemaining % 60;
            timerDisplay.text(`${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`);

            if (window.timeRemaining <= 0) {
                clearInterval(timerInterval);
                submitExam();
            }
        }, 1000);
        const updateNavigationButtons = () => {
            prevSectionBtn.prop('disabled', window.currentSectionIndex === 0);
            nextSectionBtn.prop('disabled', window.currentSectionIndex === sections.length - 1);
            submitExamBtn.toggle(window.currentSectionIndex === sections.length - 1);
        };
        const showSection = index => {
            sections.hide().eq(index).show();
            updateNavigationButtons();
        };
        prevSectionBtn.on('click', () => {
            if (window.currentSectionIndex > 0) {
                window.currentSectionIndex--;
                showSection(window.currentSectionIndex);
            }
        });
        nextSectionBtn.on('click', () => {
            if (window.currentSectionIndex < sections.length - 1) {
                window.currentSectionIndex++;
                showSection(window.currentSectionIndex);
            }
        });
        const submitExam = () => {
            const formData = {};
            $('#examForm').find('input[type="radio"]:checked, textarea').each(function() {
                const questionId = $(this).data('question');
                const answerContent = $(this).val();
                if (questionId) {
                    formData[questionId] = answerContent;
                }
            });
            clearInterval(timerInterval);
            window.onbeforeunload = null;
            loaderOverlay.show();
            $.ajax({
                url: `{{ route('candidate.submitexam',$id) }}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    finished_at: window.timeRemaining,
                    answers: formData
                },
                success: function(response) {
                    loaderOverlay.hide();
                    if (response.success) {
                        sessionStorage.removeItem("examState");
                        sessionStorage.removeItem("ocrquestion");
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            timer: 1000,
                            timerProgressBar: true,
                            didClose: () => {
                                window.location.href = response.redirect;
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr) {
                    loaderOverlay.hide();
                    const errorMsg = xhr.responseJSON ? xhr.responseJSON.message : 'An unexpected error occurred.';
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error submitting exam: ' + errorMsg,
                        icon: 'error'
                    });
                }
            });
        };
        $(document).on("click", ".capture-btn", (e) => {
            window.onbeforeunload = null;
            window.saveStateBeforeRedirect(window.timeRemaining, window.currentSectionIndex);
        });
        $('#confirmSubmitBtn').on('click', () => {
            submitExam();
        });
        showSection(window.currentSectionIndex);
        if (sessionStorage.getItem("ocrquestion")) {
            let [questionId, answer] = JSON.parse(sessionStorage.getItem("ocrquestion"));
            $(`textarea[data-question='${questionId}']`).val(answer);
            sessionStorage.removeItem("ocrquestion");
            window.saveStateBeforeRedirect(window.timeRemaining, window.currentSectionIndex);
        }
    };
    window.onbeforeunload = () => "Are you sure you want to leave? Changes you made may not be saved.";
</script>
