@extends('layouts.candidate.app')
@section('content')

<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="text-center mb-4">
            <div class="profile-avatar mb-3">
                <svg width="60" height="60" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <h6 class="mb-1">John Doe</h6>
            <small class="text-muted">View Profile</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="dashboard.html">Dashboard</a>
            <a class="nav-link" href="#" onclick="logout()">Logout</a>
        </nav>
    </div>
</div>

<!-- Styles for the new fonts -->
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
<main class="main-content pt-5" style="margin-top:9.5vh !important; margin-bottom: 8vh;">
    <!-- Top Navigation for Desktop -->
    <div class="top-nav d-none d-lg-block">
        <div class="container-fluid">
            <ul class="nav nav-tabs border-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('candidate.examination', $code) }}"
                        data-tab="stream">Exams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('candidate.results', $code) }}" data-tab="classwork">Results</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('candidate.people', $code) }}" data-tab="people">People</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid p-4">
        <!-- Stream Tab Content -->
        <div id="stream-content" class="tab-content active">
            <div class="row">
                <div class="col-12">
                    <!-- Exam Instructions Card -->
                    <div class="card mb-4 instruction-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Exam Instructions</h5>
                            <div class="instruction-item">
                                <div class="instruction-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                    </svg>
                                </div>
                                <div>
                                    <strong style="font-weight: 600;">Review all questions before answering</strong>
                                </div>
                            </div>
                            <div class="instruction-item">
                                <div class="instruction-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <strong style="font-weight: 600;">Time Management</strong>
                                    <br><small style="color: #6c757d;">Keep track of remaining time</small>
                                </div>
                            </div>
                            <div class="instruction-item">
                                <div class="instruction-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V7h10v2z" />
                                    </svg>
                                </div>
                                <div>
                                    <strong style="font-weight: 600;">Save Progress</strong>
                                    <br><small style="color: #6c757d;">Your answers are automatically saved</small>
                                </div>
                            </div>
                            <div class="mt-3">
                                <small style="color: #6c757d;">By starting the exam, you agree to the <a href="#"
                                        class="text-primary" style="color: #0d6efd;">academic integrity
                                        policy</a></small>
                            </div>
                        </div>
                    </div>

                    <!-- Exam Card -->
                    @forelse ($exams as $exam)
                        <div class="card exam-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $exam->title }}</h5>
                                <div class="exam-meta mb-3">
                                    <span class="badge bg-light text-dark me-2"
                                        style="background-color: #f8f9fa !important; color: #212529 !important;">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"
                                            class="me-1">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                        {{ $exam->duration_minutes }} minutes
                                    </span>
                                    <span class="badge bg-light text-dark"
                                        style="background-color: #f8f9fa !important; color: #212529 !important;">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"
                                            class="me-1">
                                            <path
                                                d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                        </svg>
                                        {{ $exam->questions_count }} questions
                                    </span>
                                </div>
                                <div class="exam-sections mb-3">
                                    <h6>Exam Sections:</h6>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @forelse ($exam->sections as $section)
                                            <span class="badge bg-primary"
                                                style="background-color: #0d6efd !important;">{{ $section->title }}
                                                (Q{{ count($section->questions) }})
                                                (Marks:
                                                {{ $section->total_marks }})</span>
                                        @empty
                                            <span class="badge bg-secondary"
                                                style="background-color: #6c757d !important;">No sections
                                                available</span>
                                        @endforelse
                                    </div>
                                </div>
                                <button
                                    {{ auth()->user()->user_exam_attempts->where('exam_id', $exam->id)->first() ? 'disabled' : '' }}
                                    onclick="window.location.href='{{ route('candidate.exam.index', $exam->id) }}'"
                                    class="btn btn-primary btn-lg"
                                    style="background-color: #0d6efd; border-color: #0d6efd;">Start Exams</button>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-info" role="alert"
                                style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb;">
                                <i class="fas fa-info-circle me-2"></i>
                                No exams are currently available.
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

    </main>
    <!-- Bottom Navigation for Mobile -->
    <!-- Bottom Navigation for Mobile -->
    <div class="bottom-nav d-flex d-lg-none"
        style="position:fixed; bottom:0; width:100%; background-color:#fff; box-shadow:0 -2px 5px rgba(0,0,0,0.1); padding:0.5rem 0; justify-content:space-around; align-items:center;">
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                style="fill:#0d6efd; margin-bottom:0.25rem;">
                <path
                    d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
            </svg>
            <a href="{{ route('candidate.examination', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">Exams</a>
        </div>
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                style="fill:#6c757d; margin-bottom:0.25rem;">
                <path
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-9h-1V7h2V6h-2V5h-1v2h-1v2h2v1h-1v2h1v1h-1v2h1v-1h2v-1h-2v-1z" />
            </svg>
            <a href="{{ route('candidate.results', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">Results</a>
        </div>
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                style="fill:#6c757d; margin-bottom:0.25rem;">
                <path
                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
            </svg>
            <a href="{{ route('candidate.people', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">People</a>
        </div>
    </div>
@endsection
