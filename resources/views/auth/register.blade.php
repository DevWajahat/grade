<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Lindy - Bootstrap 5 UI Kit</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.svg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css"
        integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap-5.0.0-alpha-2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web/css/lindy-uikit.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .progress {
            height: 10px;
            margin-bottom: 20px;
            background-color: #e9ecef;
            border-radius: 0.25rem;
        }

        .progress-bar {
            transition: width 0.3s ease-in-out;
            background-color: #0d6efd;
            /* Bootstrap primary blue */
        }

        .signup-form-wrapper {
            max-width: 500px;
            margin: auto;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .is-invalid~.invalid-feedback {
            display: block;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vw-100" style="min-height: 100vh; padding-top: 100px;">

    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="signup signup-style-3 mb-80">
        <div class="container">
            <div class="signup-wrapper">
                <div class="shape">
                    <img src="{{ asset('assets/web/images/register/shape.svg') }}" alt="">
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="signup-form-wrapper">

                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <form action="{{ route('register') }}" method="post" class="signup-form" novalidate>
                                @csrf
                                <div class="form-step active" id="step-1">
                                    <div class="single-input">
                                        <label for="firstName">First Name</label>
                                        <input type="text" id="firstName" value="{{ old('firstname') }}"
                                            name="firstname" placeholder="Your First Name">
                                        {{-- Display Laravel validation error --}}
                                        @error('firstname')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="single-input">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" id="lastName" value="{{ old('lastname') }}"
                                            name="lastname" placeholder="Your Last Name">
                                        @error('lastname')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="single-input">
                                        <label for="phone">Phone</label>
                                        <input type="tel" id="phone" value="{{ old('phone') }}" name="phone"
                                            placeholder="Your Phone Number">
                                        @error('phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="signup-button mb-25">
                                        {{-- Removed client-side validation from nextStep --}}
                                        <button type="button" class="button button-lg radius-10 btn-block"
                                            onclick="nextStep(2)">Next</button>
                                    </div>
                                </div>
                                <div class="form-step" id="step-2">
                                    <div class="single-input">
                                        <label for="signup-email">Email</label>
                                        <input type="email" id="signup-email" name="email"
                                            value="{{ old('email') }}" placeholder="Your Email">
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="single-input">
                                        <label for="signup-password">Password</label>
                                        <input type="password" id="signup-password" name="password"
                                            placeholder="Choose password">
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="single-input">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm password">
                                        {{-- Laravel's 'confirmed' rule handles this, but if you want a specific message for this field --}}
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="single-input">
                                        <label for="role">Role</label>
                                        <select id="role" name="role" class="form-control"
                                            onchange="toggleRoleFields()">
                                            <option value="candidate"
                                                {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate</option>
                                            <option value="examiner"
                                                {{ old('role') == 'examiner' ? 'selected' : '' }}>Examiner</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="signup-button mb-25 d-flex justify-content-between">
                                        <button type="button" class="button button-lg radius-10"
                                            onclick="prevStep(1)">Previous</button>
                                        {{-- Removed client-side validation from nextStep --}}
                                        <button type="button" class="button button-lg radius-10"
                                            onclick="nextStep(3)">Next</button>
                                    </div>
                                </div>
                                <div class="form-step" id="step-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div id="candidate-fields" style="display: none;">
                                        <div class="single-input">
                                            <label for="guardian_name">Guardian Name</label>
                                            <input type="text" id="guardian_name" name="guardian_name"
                                                value="{{ old('guardian_name') }}" placeholder="Guardian's Name">
                                            @error('guardian_name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="single-input">
                                            <label for="guardian_phone">Guardian Phone</label>
                                            <input type="tel" id="guardian_phone" name="guardian_phone"
                                                value="{{ old('guardian_phone') }}"
                                                placeholder="Guardian's Phone Number">
                                            @error('guardian_phone')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="examiner-fields" style="display: none;">
                                        <div class="single-input">
                                            <label for="institute_name">Institute Name</label>
                                            <input type="text" id="institute_name" name="institute_name"
                                                value="{{ old('institute_name') }}"
                                                placeholder="Your Institute Name">
                                            @error('institute_name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="signup-button mb-25 d-flex justify-content-between">
                                        <button type="button" class="button button-lg radius-10"
                                            onclick="prevStep(2)">Previous</button>
                                        {{-- This button will now directly submit the form --}}
                                        <button type="submit" class="button button-lg radius-10">Sign up</button>
                                    </div>
                                </div>
                                <p>Already have an account? <a href="login.html">Log In</a></p>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 offset-xl-1 order-first order-lg-last">
                        <div class="signup-content-wrapper">
                            <div class="section-title mb-30">
                                <h3 class="mb-20" style="text-align: center;">Sign Up</h3>
                                <p>Morbi et sagittis dui, sed fermentum ante. Pellentesque molestie sit amet dolor vel
                                    euismod.</p>
                            </div>
                            <div class="action-button">
                                <p>Sign up With</p>
                                <a href="#0" class="button border-button button-lg radius-10 w-100"> <i
                                        class="ri-google-fill"></i> Google </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/web/js/bootstrap.5.0.0.alpha-2-min.js') }}"></script>
    <script src="{{ asset('assets/web/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/web/js/count-up.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script>
        let currentStep = 1;
        const totalSteps = 3;

        document.addEventListener('DOMContentLoaded', function() {
            updateProgrestogglesBar();
            // Call RoleFields initially to set correct visibility based on old('role')
            toggleRoleFields();

            // Set the selected option for the role dropdown based on old('role')
            const roleSelect = document.getElementById('role');
            const oldRole = "{{ old('role') }}"; // Get the old role value from Blade
            if (oldRole) {
                roleSelect.value = oldRole;
                toggleRoleFields(); // Ensure fields are shown based on re-selected role
            }
        });

        function nextStep(step) {
            // No client-side validation here, just navigate
            document.getElementById(`step-${currentStep}`).classList.remove('active');
            document.getElementById(`step-${step}`).classList.add('active');
            currentStep = step;
            updateProgressBar();
        }

        function prevStep(step) {
            document.getElementById(`step-${currentStep}`).classList.remove('active');
            document.getElementById(`step-${step}`).classList.add('active');
            currentStep = step;
            updateProgressBar();
        }

        function updateProgressBar() {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
            }
        }

        function toggleRoleFields() {
            const roleSelect = document.getElementById('role');
            const role = roleSelect.value;
            const candidateFields = document.getElementById('candidate-fields');
            const examinerFields = document.getElementById('examiner-fields');

            candidateFields.style.display = 'none';
            examinerFields.style.display = 'none';

            // Clear validation state (important for when user changes role after an error)
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback.d-block').forEach(el => el.classList.remove('d-block'));

            if (role === 'candidate') {
                candidateFields.style.display = 'block';
            } else if (role === 'examiner') {
                examinerFields.style.display = 'block';
            }
        }

        // Removed the submit event listener that prevented default
        // The form will now naturally submit when the submit button is clicked.


        // Ensure the role dropdown re-selects the old value on page load after validation failure
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const oldRole = "{{ old('role') }}";
            if (oldRole) {
                roleSelect.value = oldRole;
                toggleRoleFields(); // Ensure correct fields are displayed
            } else {
                // If no old role, ensure default (no fields shown) on initial load
                toggleRoleFields();
            }
        });
    </script>
</body>

</html>
