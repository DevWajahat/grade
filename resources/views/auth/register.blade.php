<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Grade Genius</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/register.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar" style="background-color:#fff;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <i class="fas fa-graduation-cap me-2"></i>
                <span class="brand-text">Grade Genius</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('index') }}" class="btn btn-outline-primary btn-sm">Back to Home</a>
                <a class="btn btn-primary btn-sm" href="{{ route('login') }}" >Login</a>
            </div>
        </div>
    </nav>

    <section class="signup-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="signup-container">
                        <div class="signup-header text-center">
                            <h1>Join Grade Genius</h1>
                            <p>Create your account and start grading smarter today</p>
                        </div>

                        <div class="progress-container">
                            <div class="progress-bar-custom">
                                <div class="progress-step active" data-step="1">
                                    <div class="step-circle">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span class="step-label">Personal Info</span>
                                </div>
                                <div class="progress-step" data-step="2">
                                    <div class="step-circle">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <span class="step-label">Account Details</span>
                                </div>
                                <div class="progress-step" data-step="3">
                                    <div class="step-circle">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="step-label">Additional Info</span>
                                </div>
                            </div>
                        </div>

                        <form id="signupForm" class="signup-form" method="POST" action="{{ route('register') }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-step active" id="step1">
                                <h3 class="step-title">Personal Information</h3>
                                <p class="step-description">Let's start with your basic information</p>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="firstName" name="firstname"
                                            required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" name="lastname"
                                            required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">
                                        Next Step <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-step" id="step2">
                                <h3 class="step-title">Account Details</h3>
                                <p class="step-description">Set up your login credentials and role</p>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password *</label>
                                    <div class="password-input-container">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <button type="button" class="password-toggle" style="margin-right: 20px"
                                            onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength">
                                        <div class="strength-bar">
                                            <div class="strength-fill"></div>
                                        </div>
                                        <span class="strength-text">Password strength</span>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password *</label>
                                    <div class="password-input-container">
                                        <input type="password" class="form-control" id="confirmPassword"
                                            name="password_confirmation" required>
                                        <button type="button" class="password-toggle" style="margin-right: 20px"
                                            onclick="togglePassword('confirmPassword')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Role *</label>
                                    <div class="role-selection">
                                        <div class="role-option">
                                            <input type="radio" class="form-check-input" id="candidate"
                                                name="role" value="candidate" required>
                                            <label class="role-label" for="candidate">
                                                <div class="role-icon">
                                                    <i class="fas fa-user-graduate"></i>
                                                </div>
                                                <div class="role-info">
                                                    <h5>Candidate</h5>
                                                    <p>Student taking exams</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="role-option">
                                            <input type="radio" class="form-check-input" id="examiner"
                                                name="role" value="examiner" required>
                                            <label class="role-label" for="examiner">
                                                <div class="role-icon">
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                </div>
                                                <div class="role-info">
                                                    <h5>Examiner</h5>
                                                    <p>Teacher or educator</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="btn btn-outline-primary" onclick="prevStep()">
                                        <i class="fas fa-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">
                                        Next Step <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-step" id="step3">
                                <h3 class="step-title">Additional Information</h3>
                                <p class="step-description">Complete your profile setup</p>

                                <div id="candidateFields" class="conditional-fields">
                                    <div class="mb-3">
                                        <label for="guardianName" class="form-label">Guardian Name *</label>
                                        <input type="text" class="form-control" id="guardianName"
                                            name="guardian_name">
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="guardianPhone" class="form-label">Guardian Phone *</label>
                                        <input type="tel" class="form-control" id="guardianPhone"
                                            name="guardian_phone">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div id="examinerFields" class="conditional-fields">
                                    <div class="mb-3">
                                        <label for="instituteName" class="form-label">Institute Name *</label>
                                        <input type="text" class="form-control" id="instituteName"
                                            name="institute_name">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms"
                                        name="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and
                                        <a href="#" class="text-primary">Privacy Policy</a> *
                                    </label>
                                    <div class="invalid-feedback"></div>
                                </div>


                                <div class="form-navigation">
                                    <button type="button" class="btn btn-outline-primary" onclick="prevStep()">
                                        <i class="fas fa-arrow-left me-2"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-user-plus me-2"></i> Create Account
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="login-link text-center">
                            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login to Grade Genius</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" class="text-muted">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script src="{{ asset('assets/web/js/register.js') }}"></script>
</body>

</html>

<script>
    // Signup Form Management
    class SignupForm {
        constructor() {
            this.currentStep = 1
            this.totalSteps = 3
            this.formData = {}
            this.init()
        }

        init() {
            this.bindEvents()
            this.updateProgressBar()
        }

        bindEvents() {
            // Role selection change
            document.querySelectorAll('input[name="role"]').forEach((radio) => {
                radio.addEventListener("change", this.handleRoleChange.bind(this))
            })

            // Password strength checker
            document.getElementById("password").addEventListener("input", this.checkPasswordStrength.bind(this))

            // Confirm password validation
            document.getElementById("confirmPassword").addEventListener("input", this.validatePasswordMatch.bind(
                this))

            // Form submission
            document.getElementById("signupForm").addEventListener("submit", this.handleSubmit.bind(this))

            // Real-time validation
            this.setupRealTimeValidation()
        }

        setupRealTimeValidation() {
            const inputs = document.querySelectorAll("input[required], select[required], textarea[required]")
            inputs.forEach((input) => {
                input.addEventListener("blur", () => this.validateField(input))
                input.addEventListener("input", () => {
                    if (input.classList.contains("is-invalid")) {
                        this.validateField(input)
                    }
                })
            })
        }

        validateField(field) {
            let isValid = true
            let errorMessage = ""
            const value = field.value.trim()

            // Special handling for the checkbox
            if (field.type === "checkbox") {
                if (!field.checked) {
                    isValid = false
                    errorMessage = "You must agree to the terms and conditions"
                }
            } else if (field.hasAttribute("required") && !value) {
                // Check if the field is required and empty
                isValid = false
                errorMessage = "This field is required"
            }

            // Specific field validations
            if (isValid) {
                switch (field.id) {
                    case "firstName":
                    case "lastName":
                    case "guardianName":
                        if (!this.isValidName(value)) {
                            isValid = false;
                            errorMessage = "Name must contain only letters and can't start with a number or special character.";
                        }
                        break;
                    case "phone":
                    case "guardianPhone":
                        if (value && !this.isValidPhone(value)) {
                            isValid = false;
                            errorMessage = "Please enter a valid Pakistani phone number (e.g., +923xxxxxxx).";
                        }
                        break;
                    case "email":
                        if (value && !this.isValidEmail(value)) {
                            isValid = false;
                            errorMessage = "Please enter a valid email address.";
                        }
                        break;
                    case "password":
                        if (value && value.length < 8) {
                            isValid = false;
                            errorMessage = "Password must be at least 8 characters long.";
                        }
                        break;
                    case "confirmPassword":
                        if (value && value !== document.getElementById("password").value) {
                            isValid = false;
                            errorMessage = "Passwords do not match.";
                        }
                        break;
                }
            }


            // Update field appearance
            if (isValid) {
                field.classList.remove("is-invalid")
                field.classList.add("is-valid")
            } else {
                field.classList.remove("is-valid")
                field.classList.add("is-invalid")
            }

            // Update error message
            const feedback = field.type === "checkbox" ? field.parentElement.querySelector('.invalid-feedback') :
                field.nextElementSibling
            if (feedback && feedback.classList.contains("invalid-feedback")) {
                feedback.textContent = errorMessage
            }

            return isValid
        }

        isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            return emailRegex.test(email)
        }

        isValidPhone(phone) {
            // Updated regex for common Pakistani phone formats: 03xx-xxxxxxx or +923xx-xxxxxxx
            const phoneRegex = /^((\+92)|(0092))?-?3\d{2}-?\d{7}$/;
            const normalizedPhone = phone.replace(/[\s\-\(\)]/g, ""); // Remove spaces, hyphens, and parentheses
            return phoneRegex.test(normalizedPhone);
        }

        isValidName(name) {
            // Regex for names: must start with a letter and can include letters, spaces, hyphens, and apostrophes
            const nameRegex = /^[A-Za-z][A-Za-z\s'-]{1,}$/
            return nameRegex.test(name)
        }

        checkPasswordStrength(event) {
            const password = event.target.value
            const strengthFill = document.querySelector(".strength-fill")
            const strengthText = document.querySelector(".strength-text")

            let strength = 0
            let strengthLabel = ""

            if (password.length >= 8) strength++
            if (/[a-z]/.test(password)) strength++
            if (/[A-Z]/.test(password)) strength++
            if (/[0-9]/.test(password)) strength++
            if (/[^A-Za-z0-9]/.test(password)) strength++

            // Remove all strength classes
            strengthFill.classList.remove("weak", "fair", "good", "strong")

            switch (strength) {
                case 0:
                case 1:
                    strengthFill.classList.add("weak")
                    strengthLabel = "Weak"
                    break
                case 2:
                    strengthFill.classList.add("fair")
                    strengthLabel = "Fair"
                    break
                case 3:
                case 4:
                    strengthFill.classList.add("good")
                    strengthLabel = "Good"
                    break
                case 5:
                    strengthFill.classList.add("strong")
                    strengthLabel = "Strong"
                    break
            }

            strengthText.textContent = password ? `Password strength: ${strengthLabel}` : "Password strength"
        }

        validatePasswordMatch() {
            const password = document.getElementById("password").value
            const confirmPassword = document.getElementById("confirmPassword").value
            const confirmPasswordField = document.getElementById("confirmPassword")
            const feedback = confirmPasswordField.nextElementSibling
            if (confirmPassword && password !== confirmPassword) {
                confirmPasswordField.classList.add("is-invalid")
                confirmPasswordField.classList.remove("is-valid")
                feedback.textContent = "Passwords do not match"
            } else if (confirmPassword) {
                confirmPasswordField.classList.remove("is-invalid")
                confirmPasswordField.classList.add("is-valid")
                feedback.textContent = ""
            }
        }

        handleRoleChange(event) {
            const role = event.target.value
            const candidateFields = document.getElementById("candidateFields")
            const examinerFields = document.getElementById("examinerFields")

            // Hide all conditional fields first
            candidateFields.classList.remove("show")
            examinerFields.classList.remove("show")

            // Show relevant fields based on role
            if (role === "candidate") {
                candidateFields.classList.add("show")
                // Make candidate fields required
                document.getElementById("guardianName").setAttribute("required", "")
                document.getElementById("guardianPhone").setAttribute("required", "")
                // Remove examiner field requirements
                document.getElementById("instituteName").removeAttribute("required")
            } else if (role === "examiner") {
                examinerFields.classList.add("show")
                // Make examiner fields required
                document.getElementById("instituteName").setAttribute("required", "")
                // Remove candidate field requirements
                document.getElementById("guardianName").removeAttribute("required")
                document.getElementById("guardianPhone").removeAttribute("required")
            }
        }

        validateStep(step) {
            const stepElement = document.getElementById(`step${step}`)
            const inputs = stepElement.querySelectorAll('input[required], select[required], textarea[required]')
            let isValid = true

            // Validate all inputs on the current step
            inputs.forEach((input) => {
                if (!this.validateField(input)) {
                    isValid = false
                }
            })

            // Special validation for radio buttons (role selection) on step 2
            if (step === 2) {
                const roleSelected = document.querySelector('input[name="role"]:checked')
                const roleErrorDiv = document.querySelector(".role-selection + .invalid-feedback")
                if (!roleSelected) {
                    isValid = false
                    if (roleErrorDiv) {
                        roleErrorDiv.textContent = "Please select a role"
                        roleErrorDiv.style.display = "block"
                    }
                } else {
                    if (roleErrorDiv) {
                        roleErrorDiv.style.display = "none"
                    }
                }
            }

            return isValid
        }


        updateProgressBar() {
            const progressBar = document.querySelector(".progress-bar-custom")
            const steps = document.querySelectorAll(".progress-step")

            // Update progress bar class
            progressBar.className = `progress-bar-custom step-${this.currentStep}`

            // Update step states
            steps.forEach((step, index) => {
                const stepNumber = index + 1
                step.classList.remove("active", "completed")

                if (stepNumber < this.currentStep) {
                    step.classList.add("completed")
                } else if (stepNumber === this.currentStep) {
                    step.classList.add("active")
                }
            })
        }

        showStep(step) {
            // Hide all steps
            document.querySelectorAll(".form-step").forEach((stepEl) => {
                stepEl.classList.remove("active")
            })

            // Show current step
            document.getElementById(`step${step}`).classList.add("active")

            this.currentStep = step
            this.updateProgressBar()

            // Scroll to top of form
            document.querySelector(".signup-container").scrollIntoView({
                behavior: "smooth",
                block: "start",
            })
        }


        handleSubmit(event) {
            // Validate the final step before submission
            if (!this.validateStep(3)) {
                event.preventDefault()
                const firstInvalidField = document.querySelector(".is-invalid")
                if (firstInvalidField) {
                    firstInvalidField.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    })
                    firstInvalidField.focus()
                }
            }
        }
    }

    // Utility Functions
    function nextStep() {
        const form = window.signupForm

        if (!form) {
            console.error("SignupForm instance not found")
            return
        }

        if (form.validateStep(form.currentStep)) {
            if (form.currentStep < form.totalSteps) {
                form.showStep(form.currentStep + 1)

                setTimeout(() => {
                    const nextStepElement = document.getElementById(`step${form.currentStep}`)
                    const firstInput = nextStepElement.querySelector('input:not([type="hidden"])')
                    if (firstInput) {
                        firstInput.focus()
                    }
                }, 300)
            }
        } else {
            const currentStepElement = document.getElementById(`step${form.currentStep}`)
            const firstInvalidField = currentStepElement.querySelector(".is-invalid")
            if (firstInvalidField) {
                firstInvalidField.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                })
                firstInvalidField.focus()
            }
        }
    }

    function prevStep() {
        const form = window.signupForm

        if (!form) {
            console.error("SignupForm instance not found")
            return
        }

        if (form.currentStep > 1) {
            form.showStep(form.currentStep - 1)
        }
    }

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId)
        const toggle = field.nextElementSibling
        const icon = toggle.querySelector("i")

        if (field.type === "password") {
            field.type = "text"
            icon.classList.remove("fa-eye")
            icon.classList.add("fa-eye-slash")
        } else {
            field.type = "password"
            icon.classList.remove("fa-eye-slash")
            icon.classList.add("fa-eye")
        }
    }

    function showLoginModal() {
        const modal = new bootstrap.Modal(document.getElementById("loginModal"))
        modal.show()
    }

    // Initialize form when DOM is loaded
    document.addEventListener("DOMContentLoaded", () => {
        try {
            window.signupForm = new SignupForm()
            console.log("Signup form initialized successfully")

            // Add scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px",
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("animate")
                    }
                })
            }, observerOptions)

            // Observe elements for animation
            document.querySelectorAll(".signup-container").forEach((el) => {
                el.classList.add("scroll-animate")
                observer.observe(el)
            })

            document.addEventListener("keydown", (e) => {
                if (e.key === "Enter" && e.target.tagName === "INPUT") {
                    e.preventDefault()
                    const form = window.signupForm
                    if (form.currentStep < form.totalSteps) {
                        nextStep()
                    }
                }
            })
        } catch (error) {
            console.error("Failed to initialize signup form:", error)
            const container = document.querySelector(".signup-container")
            if (container) {
                container.innerHTML = `
        <div class="alert alert-danger text-center">
          <h4>Initialization Error</h4>
          <p>There was an error loading the signup form. Please refresh the page and try again.</p>
          <button class="btn btn-primary" onclick="window.location.reload()">Refresh Page</button>
        </div>
      `
            }
        }
    })
</script>
