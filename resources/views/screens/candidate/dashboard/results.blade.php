@extends('layouts.candidate.app')
@section('content')
    <main class="container py-4">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="summary-card">
                    <i class="ri-file-text-line summary-card-icon"></i>
                    <div>
                        <div class="summary-card-title">Total Exams</div>
                        <div class="summary-card-value">{{ $totalExams }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="summary-card">
                    <i class="ri-check-double-line summary-card-icon" style="color: #28a745"></i>
                    <div>
                        <div class="summary-card-title">Completed</div>
                        <div class="summary-card-value"> {{ $completedExams }} </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="summary-card">
                    <i class="ri-line-chart-line summary-card-icon" style="color: #ffc107"></i>
                    <div>
                        <div class="summary-card-title">Average Score</div>
                        <div class="summary-card-value">{{ $averageScore }} </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="summary-card">
                    <i class="ri-trophy-line summary-card-icon" style="color: #6f42c1"></i>
                    <div>
                        <div class="summary-card-title">Best Score</div>
                        <div class="summary-card-value"> {{ $bestScore }} </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="exam-results-card">
                    <h3 class="card-title-main">All Exam Results</h3>

                    {{-- Loop through all public exams and check for user's attempt --}}
                    @forelse ($exams as $exam)
                        @php
                            // Check if the user has an attempt for this specific exam
                            $exam_attempt = $examAttempts->get($exam->id);
                        @endphp

                        @if ($exam_attempt)
                            {{-- Display completed exam details --}}
                            <a href="{{ route('candidate.exam.result', $exam->id) }}">
                                <div class="exam-result-item">
                                    <div class="exam-result-info">
                                        <i class="ri-check-line"></i>
                                        <div class="exam-result-text">
                                            <div class="exam-name">{{ $exam->title }}</div>
                                            <div class="exam-date" data-timestamp="{{ $exam_attempt->created_at->timestamp }}"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $percentage = 0;
                                            if ($exam->total_marks > 0) {
                                                $percentage = number_format(($exam_attempt->total_marks / $exam->total_marks) * 100, 2);
                                            }
                                        @endphp
                                        <span class="exam-score me-2">{{ $percentage }}%</span>
                                        <span class="exam-status">Completed</span>
                                    </div>
                                </div>
                            </a>
                        @else
                            {{-- Display not attempted exam details --}}
                            <div class="exam-result-item">
                                <div class="exam-result-info">
                                    <i class="ri-close-fill" style="color: red"></i>
                                    <div class="exam-result-text">
                                        <div class="exam-name">{{ $exam->title }}</div>
                                        <div class="exam-date"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="exam-score me-2 color-secondary" style="color:grey">N/A</span>
                                    <span class="exam-status">Not Attempted</span>
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

            <div class="col-lg-4">
                </div>
        </div>
    </main>

    @include('includes.candidate.bottomnav')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.exam-date').each(function() {
                var timestamp = parseInt($(this).attr('data-timestamp'));

                if (!isNaN(timestamp)) {
                    var date = new Date(timestamp * 1000);
                    var formattedDate = date.toDateString();

                    $(this).text(formattedDate);
                } else {
                    console.error("Invalid timestamp:", $(this).attr('data-timestamp'));
                }
            });
        });
    </script>
@endpush    
