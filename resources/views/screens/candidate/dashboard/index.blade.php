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
                {{-- @dd($examHalls) --}}
                @forelse ($examHalls as $hall)
                    <a href="{{ route('candidate.examination', $hall->hall_code) }}" class="col-lg-4 col-md-6 mb-4"
                        style="text-decoration: none">
                        <div class="col-12">
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

                    <!-- Ensure you have Bootstrap 5 and jQuery UI loaded in your project -->
                    <div class="container d-flex justify-content-center align-items-center" style="">
                        <div id="noHallsCard" class="card shadow-lg border-0" style="animation: fadeInDown 0.8s;">
                            <div class="card-body text-center">
                                <i class="bi bi-building-exclamation" style="font-size: 3rem; color: #0d6efd;"></i>
                                <h3 class="mt-3 mb-2 text-primary fw-bold">No Examination Halls Found</h3>
                                <p class="text-muted mb-0">Please add examination halls to continue.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Extra CSS for fadeInDown animation -->
    <style>
        @keyframes fadeInDown {
          0% {
            opacity: 0;
            transform: translateY(-20px);
          }
          100% {
            opacity: 1;
            transform: translateY(0);
          }
        }
        </style>
@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        // Animate card with jQuery UI
        $("#noHallsCard").fadeIn(700);
    });
    </script>

    <script>
        $(document).ready(function() {
            $('#joinHallForm').on('submit', function(e) {
                e.preventDefault();
            })
            $('#joinHallSubmit').on('click', function() {
                $.LoadingOverlay("show");
                $.ajax({
                    type: 'POST',
                    url: "{{ route('candidate.join.hall') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: $('#hallCode').val()
                    },
                    success: function(response) {
                        console.log(response);
                        $.LoadingOverlay("hide");

                        if (response.status === false) {
                            Swal.fire({
                                title: "Error!",
                                text: response.message,
                                icon: "error",
                            });
                        } else {
                            Swal.fire({
                                title: "Hall Added Successfully.",
                                icon: "success",
                            });
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        $.LoadingOverlay("hide");
                        Swal.fire({
                            title: "Error!",
                            text: "An unexpected error occurred.",
                            icon: "error",
                        });
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
