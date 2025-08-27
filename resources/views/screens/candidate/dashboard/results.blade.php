@extends('layouts.candidate.app')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400;600&display=swap');

        .main-content {
            font-family: 'Poppins', sans-serif;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        .card-title {
            font-family: 'Merriweather', serif;
            font-weight: 700;
        }

        .instruction-item strong,
        .exam-sections h6 {
            font-weight: 600;
        }

        .exam-meta .badge,
        .alert {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <!-- Main Content -->
    <main class="main-content" style="margin-top:15vh !important; margin-bottom: 8vh;">
        <div class="top-nav d-none d-lg-block mb-5">
            <div class="container-fluid">
                <ul class="nav nav-tabs border-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidate.examination', $code) }}" data-tab="stream">Exams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('candidate.results', $code) }}"
                            data-tab="classwork">Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidate.people', $code) }}" data-tab="people">People</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="summary-card">
                        <div class="card-icon total">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-content">
                            <h3>{{ $totalExams }}</h3>
                            <p>Total<br>Exams</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="summary-card">
                        <div class="card-icon completed">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-content">
                            <h3>{{ $completedExams }}</h3>
                            <p>Completed</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="summary-card">
                        <div class="card-icon average">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-content">
                            <h3>{{ $averageScore }}</h3>
                            <p>Average<br>Score</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="summary-card">
                        <div class="card-icon best">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="card-content">
                            <h3>{{ $bestScore }}</h3>
                            <p>Best<br>Score</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exam Results List -->
            <div class="results-section">
                <h4 class="section-title">All Exam Results</h4>
                <div class="exam-results-list">
                    {{-- Loop through all public exams and check for user's attempt --}}
                    @forelse ($exams as $exam)
                        @php
                            // Check if the user has an attempt for this specific exam
                            $exam_attempt = $examAttempts->get($exam->id);
                        @endphp
                        @if ($exam_attempt)
                            {{-- Display completed exam details --}}
                            <a href="{{ route('candidate.exam.result', $exam->id) }}" style="text-decoration: none">
                                <div class="exam-result-item">
                                    <div class="exam-info">
                                        <div class="exam-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="exam-details">
                                            <h6>{{ $exam->title }}</h6>
                                            <small
                                                class="text-muted">{{ date('D M d Y', strtotime($exam_attempt->created_at)) }}</small>
                                        </div>
                                    </div>
                                    <div class="exam-score">
                                        <span
                                            class="score">{{ number_format(($exam_attempt->total_score / $exam->total_marks) * 100, 2) }}%</span>
                                        <span class="status completed">Completed</span>
                                    </div>
                                </div>
                            </a>
                        @else
                            {{-- Display not attempted exam details --}}
                            <div class="exam-result-item not-attempted">
                                <div class="exam-info">
                                    <div class="exam-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="exam-details">
                                        <h6>{{ $exam->title }}</h6>
                                        <small class="text-muted">N/A</small>
                                    </div>
                                </div>
                                <div class="exam-score">
                                    <span class="score">N/A</span>
                                    <span class="status not-attempted">Not Attempted</span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-4">
                            <p>No exams are available in this exam hall yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <div class="bottom-nav d-flex d-lg-none"
        style="position:fixed; bottom:0; width:100%; background-color:#fff; box-shadow:0 -2px 5px rgba(0,0,0,0.1); padding:0.5rem 0; justify-content:space-around; align-items:center;">
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <a href="{{ route('candidate.examination', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif; ">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                    style="fill:#6c757d; margin-bottom:0.25rem;">
                    <path
                        d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                </svg>
                Exams
            </a>
        </div>
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <a href="{{ route('candidate.results', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                    style="fill:#0d6efd; margin-bottom:0.25rem;">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-9h-1V7h2V6h-2V5h-1v2h-1v2h2v1h-1v2h1v1h-1v2h1v-1h2v-1h-2v-1z" />
                </svg>
                Results
            </a>
        </div>
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <a href="{{ route('candidate.people', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                    style="fill:#6c757d;  margin-bottom:0.25rem;">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                People</a>
        </div>
    </div>
@endsection
