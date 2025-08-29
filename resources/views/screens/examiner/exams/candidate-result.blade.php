@extends('layouts.examiner.app')
@section('content')
    <style>
        /* Your existing CSS styles remain unchanged */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5 !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .exam-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .score-card {
            background-color: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            margin-bottom: 30px;
        }

        .score-item {
            text-align: center;
        }

        .score-item h4 {
            font-size: 1.25rem;
            font-weight: 500;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .score-item h3 {
            font-size: 2.25rem;
            font-weight: 700;
            color: #333;
        }

        .section-card {
            background-color: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
            padding: 20px;
        }

        .section-card h5 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .accordion-item {
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            margin-bottom: 10px;
        }

        .accordion-button {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e9ecef;
            box-shadow: none;
        }

        .accordion-body {
            font-size: 0.95rem;
        }

        .answer-box {
            background-color: #f0f2f5;
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            padding: 10px;
            margin-bottom: 15px;
        }

        .feedback-box {
            border-left: 3px solid #0d6efd;
            padding-left: 15px;
        }

        .correct-answer-feedback-toggle {
            color: #0d6efd;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            display: block;
            margin-top: 10px;
        }

        .question-status {
            font-weight: 600;
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .question-status.correct {
            color: #198754;
        }

        .question-status.incorrect {
            color: #dc3545;
        }

        .question-status.graded {
            color: #ffc107;
        }

        .question-status .ri-check-line,
        .ri-close-line,
        .ri-edit-line {
            font-size: 1.2rem;
            margin-right: 5px;
        }

        .options-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .option-item {
            padding: 8px 12px;
            border-radius: 0.5rem;
            margin-bottom: 5px;
            background-color: #f0f2f5;
            position: relative;
        }

        .option-item.is-correct {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .option-item.is-incorrect {
            background-color: #f8d7da;
            color: #58151c;
        }

        .accordion-button h6 {
            font-weight: 600;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 20px auto;
                padding: 10px;
            }

            .score-card {
                padding: 15px;
                flex-direction: column;
            }

            .score-item {
                margin-bottom: 10px;
            }
        }
    </style>
    <div id="loadingOverlay" class="loading-overlay d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="#" onclick="history.back()" class="btn btn-secondary">
                <i class="ri-arrow-left-line"></i> Back
            </a>
            <div>
                <button id="checkManualBtn" class="btn btn-success me-2">Check Manually</button>
                <button id="checkWithAiBtn" class="btn btn-primary d-none">Check with AI</button>
            </div>
        </div>
        <div class="exam-header">
            <h1 class="mb-0">Exam Results</h1>
        </div>
        <div class="score-card">
            <div class="score-item">
                <h4>TOTAL SCORE</h4>
                <h3 id="totalScore">{{ $examAttempt->total_marks ?? 'N/A' }} / {{ $exam->total_marks ?? 'N/A' }}</h3>
            </div>
            <div class="score-item">
                <h4>PERCENTAGE</h4>
                @php
                    $percentage = 0;
                    if ($exam->total_marks > 0) {
                        $percentage = number_format(($examAttempt->total_marks / $exam->total_marks) * 100, 2);
                    }
                @endphp
                <h3 id="percentageScore">{{ $percentage }}%</h3>
            </div>
        </div>
        @forelse($exam->sections as $section)
            <div class="section-card">
                <h5>{{ $section->title }}</h5>
                <div class="accordion" id="accordion-{{ $section->id }}">
                    @forelse ($section->questions as $question)
                        @php
                            $userAnswer = $examAttempt->userAnswers->firstWhere('question_id', $question->id);
                            $userAnswerText = $userAnswer->answer_content ?? 'Not answered';
                            $correctAnswerText = $question->correctAnswer->answer_content ?? 'Not available';
                            $questionStatusClass = '';
                            $statusText = '';
                            $iconClass = '';
                            if ($userAnswer) {
                                if ($question->type === 'multiple-choice') {
                                    $isCorrect = $userAnswerText === $correctAnswerText;
                                    $questionStatusClass = $isCorrect ? 'correct' : 'incorrect';
                                    $statusText = $isCorrect
                                        ? 'Correct (' . $question->marks . '/' . $question->marks . ')'
                                        : 'Incorrect (0 Marks)';
                                    $iconClass = $isCorrect ? 'ri-check-line' : 'ri-close-line';
                                } else {
                                    if ($userAnswer->marks !== null) {
                                        $questionStatusClass = $userAnswer->marks > 0 ? 'correct' : 'incorrect';
                                        $statusText = ' (' . $userAnswer->marks . ' / ' . $question->marks . ')';
                                        $iconClass = $userAnswer->marks > 0 ? 'ri-check-line' : 'ri-close-line';
                                    } else {
                                        $questionStatusClass = 'graded';
                                        $statusText = 'To be graded (' . $question->marks . ' Marks)';
                                        $iconClass = 'ri-edit-line';
                                    }
                                }
                            } else {
                                $questionStatusClass = 'incorrect';
                                $statusText = 'Not Answered';
                                $iconClass = 'ri-close-line';
                            }
                        @endphp
                        <div class="accordion-item" data-question-id="{{ $question->id }}">
                            <h2 class="accordion-header" id="heading-{{ $question->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $question->id }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $question->id }}">
                                    <div>
                                        <h6>{{ $loop->iteration }}. {{ $question->question_text }}</h6>
                                    </div>
                                    <div class="question-status {{ $questionStatusClass }}">
                                        <i class="{{ $iconClass }}"></i>
                                        <span class="status-text">{{ $statusText }}</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse-{{ $question->id }}" class="accordion-collapse collapse"
                                aria-labelledby="heading-{{ $question->id }}"
                                data-bs-parent="#accordion-{{ $section->id }}">
                                <div class="accordion-body">
                                    @if ($question->type === 'multiple-choice')
                                        <div class="mcq-manual-grading-area">
                                            <p><strong>Your Answer:</strong></p>
                                            <ul class="options-list mcq-display-mode">
                                                @foreach ($question->options as $option)
                                                    <li
                                                        class="option-item
                                    @if ($option->option_text === $correctAnswerText) is-correct @endif
                                    @if ($option->option_text === $userAnswerText && $option->option_text !== $correctAnswerText) is-incorrect @endif">
                                                        {{ $option->option_text }}
                                                        @if ($option->option_text === $correctAnswerText)
                                                            <span class="ms-auto">✅ Correct Answer</span>
                                                        @endif
                                                        @if ($option->option_text === $userAnswerText && $option->option_text !== $correctAnswerText)
                                                            <span class="ms-auto">❌ Your Selection</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="mcq-edit-mode d-none">
                                                <p><strong>Select Correct Answer:</strong></p>
                                                <ul class="options-list">
                                                    @foreach ($question->options as $option)
                                                        <li class="option-item form-check">
                                                            <input class="form-check-input correct-answer-radio"
                                                                type="radio" name="correct-answer-{{ $question->id }}"
                                                                id="option-{{ $option->id }}"
                                                                value="{{ $option->option_text }}"
                                                                @if ($option->option_text === $correctAnswerText) checked @endif>
                                                            <label class="form-check-label"
                                                                for="option-{{ $option->id }}">
                                                                {{ $option->option_text }}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <p class="mt-3"><strong>Feedback:</strong></p>
                                                <textarea class="form-control" rows="2" id="mcq-feedback-text-{{ $question->id }}">{{ $userAnswer->feedback ?? '' }}</textarea>
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary mcq-check-btn" type="button"
                                                        data-question-id="{{ $question->id }}">Update Score</button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="manual-grading-area">
                                            <p><strong>Your Answer:</strong></p>
                                            <div class="answer-box">
                                                {{ $userAnswerText }}
                                            </div>
                                            @if ($correctAnswerText !== 'Not available')
                                                <a class="correct-answer-feedback-toggle collapsed"
                                                    data-bs-toggle="collapse" href="#feedback-{{ $question->id }}"
                                                    aria-expanded="false" aria-controls="feedback-{{ $question->id }}">
                                                    <i class="ri-arrow-right-s-fill me-1"></i> View Correct Answer &
                                                    Feedback
                                                </a>
                                                <div class="collapse mt-3" id="feedback-{{ $question->id }}">
                                                    <div class="feedback-box">
                                                        <p><strong>Correct Answer:</strong></p>
                                                        <div class="correct-answer-display">
                                                            <p class="mb-2">{{ $correctAnswerText }}</p>
                                                        </div>
                                                        <div class="correct-answer-edit d-none">
                                                            <div class="input-group">
                                                                <textarea class="form-control" rows="2" id="correctAnswer-{{ $question->id }}">{{ $correctAnswerText }}</textarea>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0"><strong>Feedback:</strong></p>
                                                        <div class="feedback-display">
                                                            <p class="mb-0">
                                                                {{ $userAnswer->feedback ?? 'No feedback available.' }}
                                                            </p>
                                                        </div>
                                                        <div class="feedback-edit d-none">
                                                            <textarea class="form-control" rows="2" id="feedback-text-{{ $question->id }}">{{ $userAnswer->feedback ?? '' }}</textarea>
                                                        </div>
                                                        <p class="mb-0 mt-3"><strong>Marks:</strong></p>
                                                        <div class="marks-display">
                                                            <p class="mb-0">
                                                                {{ $userAnswer->marks ?? 0 }} / {{ $question->marks }}
                                                            </p>
                                                        </div>
                                                        <div class="marks-edit d-none">
                                                            <input type="number" class="form-control w-25"
                                                                id="marks-{{ $question->id }}"
                                                                value="{{ $userAnswer->marks ?? 0 }}" min="0"
                                                                max="{{ $question->marks }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No questions found for this section.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p>No sections found for this exam.</p>
        @endforelse
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkManualBtn = document.getElementById('checkManualBtn');
            const checkWithAiBtn = document.getElementById('checkWithAiBtn');
            const loadingOverlay = document.getElementById('loadingOverlay');
            let manualMode = false;

            checkManualBtn.addEventListener('click', function() {
                manualMode = !manualMode;
                if (manualMode) {
                    this.textContent = 'Save Manual Grades';
                    this.classList.remove('btn-success');
                    this.classList.add('btn-warning');
                    checkWithAiBtn.classList.remove('d-none'); // Show AI button
                    toggleManualInputs(true);
                } else {
                    saveManualGrades();
                }
            });

            checkWithAiBtn.addEventListener('click', function() {
                gradeWithAi();
            });

            function toggleManualInputs(enable) {
                const gradingAreas = document.querySelectorAll('.manual-grading-area');
                gradingAreas.forEach(area => {
                    const displays = area.querySelectorAll(
                        '.correct-answer-display, .feedback-display, .marks-display');
                    const edits = area.querySelectorAll(
                    '.correct-answer-edit, .feedback-edit, .marks-edit');
                    displays.forEach(el => el.classList.toggle('d-none', enable));
                    edits.forEach(el => el.classList.toggle('d-none', !enable));
                });
                const mcqGradingAreas = document.querySelectorAll('.mcq-manual-grading-area');
                mcqGradingAreas.forEach(area => {
                    const displayMode = area.querySelector('.mcq-display-mode');
                    const editMode = area.querySelector('.mcq-edit-mode');
                    if (displayMode && editMode) {
                        displayMode.classList.toggle('d-none', enable);
                        editMode.classList.toggle('d-none', !enable);
                    }
                });
            }

            function saveManualGrades() {
                loadingOverlay.classList.remove('d-none');
                const updatedData = {
                    grades: []
                };
                const accordionItems = document.querySelectorAll('.accordion-item');
                accordionItems.forEach(item => {
                    const questionId = item.getAttribute('data-question-id');
                    const questionData = {
                        question_id: questionId
                    };
                    const isMcq = item.querySelector('.mcq-manual-grading-area') !== null;
                    if (isMcq) {
                        const feedbackInput = item.querySelector(`#mcq-feedback-text-${questionId}`);
                        const selectedOption = item.querySelector(
                            `input[name="correct-answer-${questionId}"]:checked`);
                        if (selectedOption) {
                            questionData.correct_answer_content = selectedOption.value;
                        }
                        if (feedbackInput) {
                            questionData.feedback = feedbackInput.value;
                        }
                    } else {
                        const marksInput = item.querySelector(`#marks-${questionId}`);
                        const feedbackInput = item.querySelector(`#feedback-text-${questionId}`);
                        const correctAnswerInput = item.querySelector(`#correctAnswer-${questionId}`);
                        if (marksInput) {
                            questionData.marks = marksInput.value;
                        }
                        if (feedbackInput) {
                            questionData.feedback = feedbackInput.value;
                        }
                        if (correctAnswerInput) {
                            questionData.correct_answer_content = correctAnswerInput.value;
                        }
                    }
                    updatedData.grades.push(questionData);
                });

                fetch('{{ route('examiner.exams.update-grades', $examAttempt->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(updatedData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            loadingOverlay.classList.add('d-none');
                            alert('Error saving grades. Please try again.');
                        }
                    })
                    .catch(error => {
                        loadingOverlay.classList.add('d-none');
                        alert('An error occurred. Please try again.');
                        console.error('Error:', error);
                    });
            }

            function gradeWithAi() {
                loadingOverlay.classList.remove('d-none');
                fetch('{{ route('examiner.exams.grade-ai', $examAttempt->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            exam_attempt_id: '{{ $examAttempt->id }}'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.ai_grades && data.ai_grades.candidates && data.ai_grades
                            .candidates[0] && data.ai_grades.candidates[0].content && data.ai_grades.candidates[
                                0].content.parts && data.ai_grades.candidates[0].content.parts[0]) {
                            try {
                                // Correctly access the nested text field from the API response
                                const responseText = data.ai_grades.candidates[0].content.parts[0].text;

                                // Directly parse the JSON string into an array
                                const aiGrades = JSON.parse(responseText);

                                updateFormValues(aiGrades);

                                manualMode = true;
                                checkManualBtn.textContent = 'Save Manual Grades';
                                checkManualBtn.classList.remove('btn-success');
                                checkManualBtn.classList.add('btn-warning');
                                checkWithAiBtn.classList.add('d-none');
                                toggleManualInputs(true);
                                loadingOverlay.classList.add('d-none');
                            } catch (error) {
                                loadingOverlay.classList.add('d-none');
                                alert(
                                    'An error occurred while parsing the AI grades. Please check the API response format.');
                                console.error('Parsing Error:', error);
                            }
                        } else {
                            loadingOverlay.classList.add('d-none');
                            alert('AI grading failed. The response was not in the expected format.');
                            console.error('Unexpected API response:', data);
                        }
                    })
                    .catch(error => {
                        loadingOverlay.classList.add('d-none');
                        alert(
                            'An error occurred during AI grading. Please check your network connection and server logs.');
                        console.error('Network or Server Error:', error);
                    });
            }

            function updateFormValues(aiGrades) {
                aiGrades.forEach(grade => {
                    const questionItem = document.querySelector(
                        `.accordion-item[data-question-id="${grade.question_id}"]`);
                    if (questionItem) {
                        // Get new values from the Gemini response
                        const obtainedMarks = grade.obtained_marks;
                        const totalMarks = grade.total_marks;
                        const feedbackText = grade.feedback;
                        const correctAnswerContent = grade.correct_answer_content;

                        const marksInput = questionItem.querySelector(`#marks-${grade.question_id}`);
                        const feedbackInput = questionItem.querySelector(
                            `#feedback-text-${grade.question_id}`);
                        const correctAnswerInput = questionItem.querySelector(
                            `#correctAnswer-${grade.question_id}`);
                        const statusElement = questionItem.querySelector('.question-status');
                        const statusTextElement = statusElement.querySelector('.status-text');
                        const iconElement = statusElement.querySelector('i');

                        // Update input fields
                        if (marksInput && obtainedMarks !== undefined) {
                            marksInput.value = obtainedMarks;
                        }
                        if (feedbackInput && feedbackText !== undefined) {
                            feedbackInput.value = feedbackText;
                        }
                        if (correctAnswerInput && correctAnswerContent !== undefined) {
                            correctAnswerInput.value = correctAnswerContent;
                        }

                        // Update display status and marks
                        if (statusElement && statusTextElement && iconElement) {
                            statusElement.classList.remove('correct', 'incorrect', 'graded');
                            if (obtainedMarks > 0) {
                                statusElement.classList.add('correct');
                                statusTextElement.textContent =
                                `Correct (${obtainedMarks} / ${totalMarks})`;
                                iconElement.className = 'ri-check-line';
                            } else {
                                statusElement.classList.add('incorrect');
                                statusTextElement.textContent = `Incorrect (0 / ${totalMarks})`;
                                iconElement.className = 'ri-close-line';
                            }
                        }
                    }
                });
            }

            document.querySelectorAll('.mcq-check-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const questionId = this.getAttribute('data-question-id');
                    const questionItem = document.querySelector(
                        `.accordion-item[data-question-id="${questionId}"]`);
                    const selectedOption = questionItem.querySelector(
                        `input[name="correct-answer-${questionId}"]:checked`);
                    const feedbackText = questionItem.querySelector(
                        `#mcq-feedback-text-${questionId}`).value;
                    const questionMaxMarksElement = questionItem.querySelector(
                        '.question-status .status-text');
                    const questionMaxMarks = parseInt(questionMaxMarksElement.textContent.match(
                        /\d+/)[0]);
                    if (selectedOption) {
                        const newCorrectAnswer = selectedOption.value;
                        const userAnswerText = questionItem.querySelector('.answer-box')
                            ?.textContent?.trim() || 'Not answered';
                        const isCorrect = (userAnswerText === newCorrectAnswer);
                        const statusElement = questionItem.querySelector('.question-status');
                        const statusTextElement = statusElement.querySelector('.status-text');
                        const iconElement = statusElement.querySelector('i');
                        const newMarks = isCorrect ? questionMaxMarks : 0;
                        if (isCorrect) {
                            statusElement.classList.remove('incorrect', 'graded');
                            statusElement.classList.add('correct');
                            statusTextElement.textContent =
                                `Correct (${newMarks} / ${questionMaxMarks})`;
                            iconElement.className = 'ri-check-line';
                        } else {
                            statusElement.classList.remove('correct', 'graded');
                            statusElement.classList.add('incorrect');
                            statusTextElement.textContent = `Incorrect (0 Marks)`;
                            iconElement.className = 'ri-close-line';
                        }
                    }
                });
            });
        });
    </script>
@endsection
