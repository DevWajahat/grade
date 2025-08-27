@extends('layouts.candidate.app')
@section('content')
    <!-- Floating Add Button -->
    <button class="floating-add-btn" id="joinHallBtn" data-bs-toggle="modal" data-bs-target="#joinHallModal">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Join Hall Modal -->
    <div class="modal fade" id="joinHallModal" tabindex="-1" aria-labelledby="joinHallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinHallModalLabel">Join Examination Hall</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Ask your institute for the class code, then enter it here</p>
                    <form id="joinHallForm">
                        <div class="mb-3">
                            <label for="hallCode" class="form-label">Hall Code:</label>
                            <input type="text" class="form-control" id="hallCode" placeholder="Enter hall code"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary" id="joinHallSubmit">Join Hall</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-content">
        <div class="container-fluid">
            <div class="row">
                @forelse ($examHalls as $hall)
                    <a href="{{ route('candidate.examination', $hall->hall_code) }}" style="text-decoration: none">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="exam-hall-card gradient-blue">
                                <div class="card-body">
                                    <h4>{{ $hall->title }}</h4>
                                    <div class="instructor-info">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $hall->user->first_name . ' ' . $hall->user->last_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
