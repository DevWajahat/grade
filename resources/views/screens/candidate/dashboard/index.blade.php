@extends('layouts.candidate.app')

@section('content')
    <!-- ================================= join class modal starts ======================================== -->

    <div class="fixed-bottom-right">
        <button class="btn round-button btn-light" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="ri-add-line"></i>
        </button>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-flex justify-content-center align-items-center flex-column join-exam-modal"
                    style="gap: 50px;">
                    <h3 class="display-6 ">Join Examintion Hall</h3>

                    <div class="hall-form w-100 ">

                        <p class="fw-bold">Ask your institute for the class code, then enter it here</p>

                        <form id="joinHall ">
                            <div class="mt-3">
                                <label for="form-label ">Hall Code: </label>
                                <input type="text" class="form-control" name="hall_code" id="hallCode">
                            </div>
                        </form>
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="button" class="btn text-secondary" data-bs-dismiss="modal">Back</button>
                            <button type="button" class="btn btn-primary">Join Hall</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================= join class modal ends ======================================== -->


    <!-- ================================ Examination Hall cards start ================================== -->
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center g-4">
            <!-- Examination Hall Card 1 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <a href="examination-hall.html" class="card-link">
                    <div class="card card-custom w-100">
                        <div class="card-header-custom" data-gradient-index="0">
                            <div class="text-small font-semibold-custom mb-1-custom">Hall A</div>
                            <h3 class="text-medium font-bold-custom text-light">Mathematics Exam</h3>
                            <div class="overlay-opacity-10"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center text-secondary text-small">
                                <svg class="me-2" style="width: 1rem; height: 1rem; color: #6c757d;" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-weight-medium text-dark">Mr. John Doe</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Examination Hall Card 2 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <a href="examination-hall.html" class="card-link">
                    <div class="card card-custom w-100">
                        <div class="card-header-custom" data-gradient-index="1">
                            <div class="text-small font-semibold-custom mb-1-custom">Hall B</div>
                            <h3 class="text-medium font-bold-custom text-light">Physics Exam</h3>
                            <div class="overlay-opacity-10"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center text-secondary text-small">
                                <svg class="me-2" style="width: 1rem; height: 1rem; color: #6c757d;" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-weight-medium text-dark">Ms. Jane Smith</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Examination Hall Card 3 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <a href="examination-hall-C.html" class="card-link">
                    <div class="card card-custom w-100">
                        <div class="card-header-custom" data-gradient-index="2">
                            <div class="text-small font-semibold-custom mb-1-custom">Hall C</div>
                            <h3 class="text-medium font-bold-custom text-light">Chemistry Exam</h3>
                            <div class="overlay-opacity-10"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center text-secondary text-small">
                                <svg class="me-2" style="width: 1rem; height: 1rem; color: #6c757d;" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-weight-medium text-dark">Dr. Robert Brown</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Example: Hall with no current exam -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <a href="examination-hall.html" class="card-link">
                    <div class="card card-custom w-100">
                        <div class="card-header-custom" data-gradient-index="6">
                            <div class="text-small font-semibold-custom mb-1-custom">Hall D</div>
                            <h3 class="text-medium font-bold-custom text-light">No Current Exam</h3>
                            <div class="overlay-opacity-10"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center text-secondary text-small">
                                <svg class="me-2" style="width: 1rem; height: 1rem; color: #6c757d;"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-weight-medium text-dark">Ms. Emily White</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- ================================ Examination Hall cards ends ================================== -->
@endsection
