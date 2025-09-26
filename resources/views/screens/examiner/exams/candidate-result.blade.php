@extends('layouts.examiner.app')
@section('content')
    <style>
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
                <button id="checkWithAiBtn" class="btn btn-primary">Check with AI</button>
            </div>
        </div>
        <div class="exam-header">
            <h1 class="mb-0">Exam Results</h1>
        </div>
        <div class="score-card">
            <div class="score-item">
                <h4>TOTAL SCORE</h4>
                <h3 id="totalScore">{{ $examAttempt->total_marks ?? '0' }} / {{ $exam->total_marks ?? 'N/A' }}</h3>
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
                                        : 'Incorrect (0/' . $question->marks . ')';
                                    $iconClass = $isCorrect ? 'ri-check-line' : 'ri-close-line';
                                } else {
                                    if ($userAnswer->marks !== null) {
                                        $questionStatusClass = $userAnswer->marks > 0 ? 'correct' : 'incorrect';
                                        $statusText = ' (' . $userAnswer->marks . '/' . $question->marks . ')';
                                        $iconClass = $userAnswer->marks > 0 ? 'ri-check-line' : 'ri-close-line';
                                    } else {
                                        $questionStatusClass = 'graded';
                                        $statusText = 'To be graded (' . $question->marks . ' Marks)';
                                        $iconClass = 'ri-edit-line';
                                    }
                                }
                            } else {
                                $questionStatusClass = 'incorrect';
                                $statusText = 'Not Answered (0/' . $question->marks . ')';
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
                                            <div class="answer-box">{{ $userAnswerText }}</div>
                                            <div class="mcq-display-mode">
                                                <p><strong>Options:</strong></p>
                                                <ul class="options-list">
                                                    @foreach ($question->options as $option)
                                                        <li class="option-item
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
                                            </div>
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
                                                            <label class="form-check-label" for="option-{{ $option->id }}">
                                                                {{ $option->option_text }}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <p class="mt-3"><strong>Feedback:</strong></p>
                                                <textarea class="form-control" rows="2" id="mcq-feedback-text-{{ $question->id }}">{{ $userAnswer->feedback ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="manual-grading-area">
                                            <p><strong>Your Answer:</strong></p>
                                            <div class="answer-box">{{ $userAnswerText }}</div>
                                            <div class="correct-answer-feedback-toggle collapse show" id="feedback-{{ $question->id }}">
                                                <div class="feedback-box">
                                                    <p><strong>Correct Answer:</strong></p>
                                                    <div class="correct-answer-display">
                                                        <p class="mb-2">{{ $correctAnswerText }}</p>
                                                    </div>
                                                    <div class="correct-answer-edit d-none">
                                                        <textarea class="form-control" rows="2" id="correctAnswer-{{ $question->id }}">{{ $correctAnswerText }}</textarea>
                                                    </div>
                                                    <p class="mb-0"><strong>Feedback:</strong></p>
                                                    <div class="feedback-display">
                                                        <p class="mb-0">{{ $userAnswer->feedback ?? 'No feedback available.' }}</p>
                                                    </div>
                                                    <div class="feedback-edit d-none">
                                                        <textarea class="form-control" rows="2" id="feedback-text-{{ $question->id }}">{{ $userAnswer->feedback ?? '' }}</textarea>
                                                    </div>
                                                    <p class="mb-0 mt-3"><strong>Marks:</strong></p>
                                                    <div class="marks-display">
                                                        <p class="mb-0">{{ $userAnswer->marks ?? 0 }} / {{ $question->marks }}</p>
                                                    </div>
                                                    <div class="marks-edit d-none">
                                                        <input type="number" class="form-control w-25"
                                                            id="marks-{{ $question->id }}"
                                                            value="{{ $userAnswer->marks ?? 0 }}"
                                                            min="0" max="{{ $question->marks }}">
                                                    </div>
                                                </div>
                                            </div>
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
                    checkWithAiBtn.classList.remove('d-none');
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
                    const displays = area.querySelectorAll('.correct-answer-display, .feedback-display, .marks-display');
                    const edits = area.querySelectorAll('.correct-answer-edit, .feedback-edit, .marks-edit');
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
                let totalMarks = 0;

                accordionItems.forEach(item => {
                    const questionId = item.getAttribute('data-question-id');
                    const questionData = {
                        question_id: questionId
                    };
                    const isMcq = item.querySelector('.mcq-manual-grading-area') !== null;
                    const questionMaxMarksElement = item.querySelector('.question-status .status-text');
                    const questionMaxMarks = questionMaxMarksElement.textContent.match(/\/(\d+)/)?.[1] || 0;

                    if (isMcq) {
                        const feedbackInput = item.querySelector(`#mcq-feedback-text-${questionId}`);
                        const selectedOption = item.querySelector(`input[name="correct-answer-${questionId}"]:checked`);
                        const userAnswerText = item.querySelector('.answer-box')?.textContent?.trim() || 'Not answered';
                        if (selectedOption) {
                            questionData.correct_answer_content = selectedOption.value;
                            questionData.marks = (userAnswerText === selectedOption.value) ? parseInt(questionMaxMarks) : 0;
                        }
                        if (feedbackInput) {
                            questionData.feedback = feedbackInput.value;
                        }
                    } else {
                        const marksInput = item.querySelector(`#marks-${questionId}`);
                        const feedbackInput = item.querySelector(`#feedback-text-${questionId}`);
                        const correctAnswerInput = item.querySelector(`#correctAnswer-${questionId}`);
                        if (marksInput) {
                            const marks = parseInt(marksInput.value);
                            questionData.marks = isNaN(marks) ? 0 : Math.max(0, Math.min(marks, parseInt(questionMaxMarks)));
                        }
                        if (feedbackInput) {
                            questionData.feedback = feedbackInput.value;
                        }
                        if (correctAnswerInput) {
                            questionData.correct_answer_content = correctAnswerInput.value;
                        }
                    }
                    totalMarks += questionData.marks || 0;
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
                        document.getElementById('totalScore').textContent = `${totalMarks} / {{ $exam->total_marks ?? 'N/A' }}`;
                        document.getElementById('percentageScore').textContent = {{ $exam->total_marks }} > 0 ? `${((totalMarks / {{ $exam->total_marks }}) * 100).toFixed(2)}%` : '0%';
                        manualMode = false;
                        checkManualBtn.textContent = 'Check Manually';
                        checkManualBtn.classList.remove('btn-warning');
                        checkManualBtn.classList.add('btn-success');
                        checkWithAiBtn.classList.add('d-none');
                        toggleManualInputs(false);
                        updateDisplayAfterSave(updatedData.grades);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Grades saved successfully.',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error saving grades. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                    loadingOverlay.classList.add('d-none');
                })
                .catch(error => {
                    loadingOverlay.classList.add('d-none');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.',
                        confirmButtonText: 'OK'
                    });
                    console.error('Error:', error);
                });
            }

            function updateDisplayAfterSave(grades) {
                grades.forEach(grade => {
                    const questionItem = document.querySelector(`.accordion-item[data-question-id="${grade.question_id}"]`);
                    if (questionItem) {
                        const isMcq = questionItem.querySelector('.mcq-manual-grading-area') !== null;
                        const statusElement = questionItem.querySelector('.question-status');
                        const statusTextElement = statusElement.querySelector('.status-text');
                        const iconElement = statusElement.querySelector('i');
                        const questionMaxMarks = statusTextElement.textContent.match(/\/(\d+)/)?.[1] || 0;

                        if (isMcq) {
                            const userAnswerText = questionItem.querySelector('.answer-box')?.textContent?.trim() || 'Not answered';
                            const correctAnswerText = grade.correct_answer_content || 'Not available';
                            const isCorrect = userAnswerText === correctAnswerText;
                            statusElement.classList.remove('correct', 'incorrect', 'graded');
                            statusTextElement.textContent = isCorrect
                                ? `Correct (${questionMaxMarks}/${questionMaxMarks})`
                                : `Incorrect (0/${questionMaxMarks})`;
                            iconElement.className = isCorrect ? 'ri-check-line' : 'ri-close-line';
                            statusElement.classList.add(isCorrect ? 'correct' : 'incorrect');
                            const optionsList = questionItem.querySelector('.mcq-display-mode .options-list');
                            optionsList.innerHTML = '';
                            @foreach ($question->options as $option)
                                optionsList.innerHTML += `
                                    <li class="option-item
                                        @if ($option->option_text === '${grade.correct_answer_content}') is-correct @endif
                                        @if ($option->option_text === '${userAnswerText}' && $option->option_text !== '${grade.correct_answer_content}') is-incorrect @endif">
                                        {{ $option->option_text }}
                                        @if ($option->option_text === '${grade.correct_answer_content}')
                                            <span class="ms-auto">✅ Correct Answer</span>
                                        @endif
                                        @if ($option->option_text === '${userAnswerText}' && $option->option_text !== '${grade.correct_answer_content}')
                                            <span class="ms-auto">❌ Your Selection</span>
                                        @endif
                                    </li>`;
                            @endforeach
                            const feedbackDisplay = questionItem.querySelector('.feedback-display');
                            if (feedbackDisplay) {
                                feedbackDisplay.innerHTML = `<p class="mb-0">${grade.feedback || 'No feedback available.'}</p>`;
                            }
                        } else {
                            statusElement.classList.remove('correct', 'incorrect', 'graded');
                            statusTextElement.textContent = ` (${grade.marks || 0}/${questionMaxMarks})`;
                            iconElement.className = (grade.marks || 0) > 0 ? 'ri-check-line' : 'ri-close-line';
                            statusElement.classList.add((grade.marks || 0) > 0 ? 'correct' : 'incorrect');
                            const correctAnswerDisplay = questionItem.querySelector('.correct-answer-display');
                            const feedbackDisplay = questionItem.querySelector('.feedback-display');
                            const marksDisplay = questionItem.querySelector('.marks-display');
                            if (correctAnswerDisplay) {
                                correctAnswerDisplay.innerHTML = `<p class="mb-2">${grade.correct_answer_content || 'Not available'}</p>`;
                            }
                            if (feedbackDisplay) {
                                feedbackDisplay.innerHTML = `<p class="mb-0">${grade.feedback || 'No feedback available.'}</p>`;
                            }
                            if (marksDisplay) {
                                marksDisplay.innerHTML = `<p class="mb-0">${grade.marks || 0} / ${questionMaxMarks}</p>`;
                            }
                        }
                    }
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
                    if (data.success && data.ai_grades) {
                        let aiGrades;
                        try {
                            // Handle different possible response structures
                            if (typeof data.ai_grades === 'string') {
                                aiGrades = JSON.parse(data.ai_grades);
                            } else if (data.ai_grades.candidates && data.ai_grades.candidates[0]?.content?.parts?.[0]?.text) {
                                aiGrades = JSON.parse(data.ai_grades.candidates[0].content.parts[0].text);
                            } else {
                                aiGrades = data.ai_grades;
                            }

                            updateFormValues(aiGrades);
                            manualMode = true;
                            checkManualBtn.textContent = 'Save Manual Grades';
                            checkManualBtn.classList.remove('btn-success');
                            checkManualBtn.classList.add('btn-warning');
                            checkWithAiBtn.classList.add('d-none');
                            toggleManualInputs(true);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'AI grading completed. Review and save the grades.',
                                confirmButtonText: 'OK'
                            });
                        } catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to parse AI grades. Please check the API response.',
                                confirmButtonText: 'OK'
                            });
                            console.error('Parsing Error:', error);
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'AI grading failed. Please try again.',
                            confirmButtonText: 'OK'
                        });
                        console.error('Unexpected API response:', data);
                    }
                    loadingOverlay.classList.add('d-none');
                })
                .catch(error => {
                    loadingOverlay.classList.add('d-none');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during AI grading. Please check your network connection.',
                        confirmButtonText: 'OK'
                    });
                    console.error('Network or Server Error:', error);
                });
            }

            function updateFormValues(aiGrades) {
                let totalMarks = 0;
                aiGrades.forEach(grade => {
                    const questionItem = document.querySelector(`.accordion-item[data-question-id="${grade.question_id}"]`);
                    if (questionItem) {
                        const isMcq = questionItem.querySelector('.mcq-manual-grading-area') !== null;
                        const marksInput = questionItem.querySelector(`#marks-${grade.question_id}`);
                        const feedbackInput = questionItem.querySelector(`#feedback-text-${grade.question_id}`) || questionItem.querySelector(`#mcq-feedback-text-${grade.question_id}`);
                        const correctAnswerInput = questionItem.querySelector(`#correctAnswer-${grade.question_id}`);
                        const statusElement = questionItem.querySelector('.question-status');
                        const statusTextElement = statusElement.querySelector('.status-text');
                        const iconElement = statusElement.querySelector('i');
                        const questionMaxMarks = statusTextElement.textContent.match(/\/(\d+)/)?.[1] || grade.total_marks || 0;

                        if (isMcq) {
                            const radioInputs = questionItem.querySelectorAll(`input[name="correct-answer-${grade.question_id}"]`);
                            radioInputs.forEach(radio => {
                                radio.checked = radio.value === grade.correct_answer_content;
                            });
                            const userAnswerText = questionItem.querySelector('.answer-box')?.textContent?.trim() || 'Not answered';
                            const isCorrect = userAnswerText === grade.correct_answer_content;
                            statusElement.classList.remove('correct', 'incorrect', 'graded');
                            statusTextElement.textContent = isCorrect
                                ? `Correct (${questionMaxMarks}/${questionMaxMarks})`
                                : `Incorrect (0/${questionMaxMarks})`;
                            iconElement.className = isCorrect ? 'ri-check-line' : 'ri-close-line';
                            statusElement.classList.add(isCorrect ? 'correct' : 'incorrect');
                        } else {
                            if (marksInput) {
                                const marks = Math.max(0, Math.min(grade.obtained_marks || 0, parseInt(questionMaxMarks)));
                                marksInput.value = marks;
                                totalMarks += marks;
                            }
                            statusElement.classList.remove('correct', 'incorrect', 'graded');
                            statusTextElement.textContent = ` (${grade.obtained_marks || 0}/${questionMaxMarks})`;
                            iconElement.className = (grade.obtained_marks || 0) > 0 ? 'ri-check-line' : 'ri-close-line';
                            statusElement.classList.add((grade.obtained_marks || 0) > 0 ? 'correct' : 'incorrect');
                        }

                        if (feedbackInput && grade.feedback) {
                            feedbackInput.value = grade.feedback;
                        }
                        if (correctAnswerInput && grade.correct_answer_content) {
                            correctAnswerInput.value = grade.correct_answer_content;
                        }
                    }
                });
                document.getElementById('totalScore').textContent = `${totalMarks} / {{ $exam->total_marks ?? 'N/A' }}`;
                document.getElementById('percentageScore').textContent = {{ $exam->total_marks }} > 0 ? `${((totalMarks / {{ $exam->total_marks }}) * 100).toFixed(2)}%` : '0%';
            }

            // Remove the mcq-check-btn event listener as it's redundant with saveManualGrades
        });
    </script>
@endsection