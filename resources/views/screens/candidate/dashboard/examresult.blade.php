@extends('layouts.candidate.app')
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
            background-color: #f8f9fa;
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
    </head>

    <body>

        <div class="main-container">
            <!-- Back Button -->
            <a href="#" onclick="history.back()" class="btn btn-secondary mb-4">
                <i class="ri-arrow-left-line"></i> Back
            </a>

            <div class="exam-header">
                <h1 class="mb-0">Exam Results</h1>
            </div>

            <div class="score-card">
                <div class="score-item">
                    <h4>TOTAL SCORE</h4>
                    <h3>{{ $examAttempt->total_marks ?? 'N/A' }} / {{ $exam->total_marks ?? 'N/A' }}</h3>
                </div>
                <div class="score-item">
                    <h4>PERCENTAGE</h4>
                    @php
                        $percentage = 0;
                        if ($exam->total_marks > 0) {
                            $percentage = number_format(($examAttempt->total_marks / $exam->total_marks) * 100, 2);
                        }
                    @endphp
                    <h3>{{ $percentage }}%</h3>
                </div>
            </div>

            @forelse($exam->sections as $section)
                <div class="section-card">
                    <h5>{{ $section->title }}</h5>
                    <div class="accordion" id="accordion-{{ $section->id }}">
                        @forelse ($section->questions as $question)
                            @php
                                // Find the user's answer for this specific question
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
            ? 'Correct (' . $question->marks . ' Marks)'
            : 'Incorrect (0 Marks)';
        $iconClass = $isCorrect ? 'ri-check-line' : 'ri-close-line';
    } else {
        // For short/long answer questions
        if ($userAnswer->marks !== null) {
            $questionStatusClass = $userAnswer->marks > 0 ? 'correct' : 'incorrect';
            $statusText =
                'Graded (' . $userAnswer->marks . ' / ' . $question->marks . ' Marks)';
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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ $question->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $question->id }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $question->id }}">
                                        <div>
                                            <h6>{{ $loop->iteration }}. {{ $question->question_text }}</h6>
                                            {{-- <span class="text-muted">{{ $userAnswerText }}</span> --}}
                                        </div>
                                        <div class="question-status {{ $questionStatusClass }}">
                                            <i class="{{ $iconClass }}"></i>
                                            {{ $statusText }}
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse-{{ $question->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading-{{ $question->id }}"
                                    data-bs-parent="#accordion-{{ $section->id }}">
                                    <div class="accordion-body">
                                        @if ($question->type === 'multiple-choice')
                                            <p><strong>Your Answer:</strong></p>
                                            <ul class="options-list">
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
                                        @else
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
                                                        <p class="mb-2">{{ $correctAnswerText }}</p>
                                                        <p class="mb-0"><strong>Feedback:</strong></p>
                                                        <p class="mb-0">
                                                            {{ $userAnswer->feedback ?? 'No feedback available.' }}</p>
                                                    </div>
                                                </div>
                                            @endif
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
    @endsection
