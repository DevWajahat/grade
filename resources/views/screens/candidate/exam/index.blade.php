@include('includes.candidate.head')
<main class="container py-4">
    <div class="exam-header-info">
        <h1 class="exam-title-display">{{ $exam->title }}</h1>
        <div class="timer-display">
            <i class="ri-time-line"></i>
            <span id="examTimer"></span>
        </div>
    </div>

    <form id="examForm" method="post" enctype="multipart/form-data">
        <!-- Section A: Multiple Choice Questions -->
        @forelse ($exam->sections as $section)
            <div class="question-section-card">
                <h2 class="section-heading">{{ $section->title }}</h2>

                <!-- Question 1 -->
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

                        @if ($question->type == 'short-answer')
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

<!-- Submit Confirmation Modal -->
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



<script src="{{ asset('assets/candidate/js/autosave.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    window.onload = () => {
        const sections = $('.question-section-card');
        const prevSectionBtn = $('#prevSectionBtn');
        const nextSectionBtn = $('#nextSectionBtn');
        const submitExamBtn = $('#submitExamBtn');
        const timerDisplay = $('#examTimer');

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
                alert("Time's up! Your exam has been automatically submitted.");
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
            clearInterval(timerInterval);
            console.log("Exam submitted!");
            sessionStorage.removeItem("examState");
            alert("Your exam has been submitted successfully!");
        };

        $(document).on("click", ".capture-btn", (e) => {
            window.onbeforeunload = null;
            window.saveStateBeforeRedirect(window.timeRemaining, window.currentSectionIndex);
            // This is where you would handle the redirect to the OCR page
        });

        $('#confirmSubmitBtn').on('click', () => {
            window.onbeforeunload = null;
            submitExam();
        });

        showSection(window.currentSectionIndex);

        if (sessionStorage.getItem("ocrquestion")) {
            let [questionNo, answer] = JSON.parse(sessionStorage.getItem("ocrquestion"));
            $(`textarea[data-question='${questionNo}']`).val(answer);
            sessionStorage.removeItem("ocrquestion");
            window.saveStateBeforeRedirect(window.timeRemaining, window.currentSectionIndex);
        }
    };

    window.onbeforeunload = () => "Are you sure you want to leave? Changes you made may not be saved.";
</script>

