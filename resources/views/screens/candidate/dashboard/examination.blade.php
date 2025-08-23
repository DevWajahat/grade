@extends('layouts.candidate.app')

@section('content')
    <main class="container py-4">
        <div class="row">
            <div class="col-lg-4">
                <!-- Exam Instructions Card -->
                <div class="instructions-card sticky-top mb-5" style="top: 20px;">
                    <h3 class="instructions-title">Exam Instructions</h3>
                    <div class="instruction-item">
                        <i class="ri-book-open-line"></i>
                        <p>Review all questions before answering</p>
                    </div>
                    <div class="instruction-item">
                        <i class="ri-time-line"></i>
                        <p>Time Management<br>Keep track of remaining time</p>
                    </div>
                    <div class="instruction-item">
                        <i class="ri-save-line"></i>
                        <p>Save Progress<br>Your answers are automatically saved</p>
                    </div>

                    <p class="academic-integrity-text">By starting the exam, you agree to the academic integrity policy
                    </p>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Mathematics Final Exam Card -->
                @forelse ($exams as $exam)
                    <div class="exam-card">
                        <div class="exam-card-header">
                            <h2 class="exam-title">{{ $exam->title }}</h2>

                        </div>
                        <p class="text-secondary mb-3"></p>
                        <div class="d-flex flex-wrap mb-3">
                            <div class="exam-info me-4">
                                <i class="ri-time-line"></i>
                                <span>{{ $exam->duration_minutes }} minutes</span>
                            </div>
                            <div class="exam-info">
                                <i class="ri-question-fill"></i>
                                <span>{{ $exam->questions_count }} questions</span>
                            </div>
                        </div>
                        <p class="exam-sections-title">Exam Sections:</p>
                        <div>
                            @forelse ($exam->sections as  $section)
                                <span class="exam-section-badge">{{ $section->title }} (Q{{ count($section->questions) }})
                                    (Marks: {{ $section->total_marks }})
                                </span>
                            @empty
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <button {{ auth()->user()->user_exam_attempts->where('exam_id',$exam->id)->first() ? 'disabled' : '' }} onclick="window.location.href='{{ route('candidate.exam.index',$exam->id) }}'" class="btn btn-primary">Start Exams</button>
                        </div>
                    </div>

                @empty
                @endforelse

            </div>


        </div>
    </main>

    @include('includes.candidate.bottomnav')
    {{-- <nav class="navbar navbar-light bg-white border navbar-expand fixed-bottom" style="height: 50px;">
        <ul class="navbar-nav nav-justified w-100">

            <li class="nav-item"><a class="nav-link position-relative active" href="examination-hall.html">
                    <div class="nav-icon"><i class="ri-graduation-cap-fill"></i></div>Exams
                </a></li>

            <li class="nav-item"><a class="nav-link position-relative" href="results.html">
                    <div class="nav-icon"><i class="ri-line-chart-line"></i></div>Results
                </a></li>

            <li class="nav-item"><a class="nav-link position-relative" href="profile.html">
                    <div class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg></div>Profile
                </a></li>
        </ul>
    </nav> --}}
@endsection
<!-- Bootstrap JS CDN -->
