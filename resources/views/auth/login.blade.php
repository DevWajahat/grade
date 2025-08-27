<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grade Genius</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/login.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-graduation-cap me-2"></i>
                <span class="brand-text">Grade Genius</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('index') }}" class="btn btn-outline-primary btn-sm">Back to Home</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
            </div>
        </div>
    </nav>

    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-5 col-md-7 col-sm-9">
                    <div class="login-container">
                        <div class="login-header text-center">
                            <div class="login-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h1>Welcome Back</h1>
                            <p>Sign in to your Grade Genius account</p>
                        </div>

                        <form id="loginForm" class="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        required>
                                    <button type="button" class="input-group-text password-toggle"
                                        onclick="togglePassword()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 login-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Sign In
                            </button>
                        </form>

                        <div class="signup-link text-center mt-4">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign up here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/web/js/login.js') }}"></script>
</body>

</html>
<script>
    // Login Form Handler
    class LoginForm {
        constructor() {
            this.form = document.getElementById("loginForm")
            this.emailInput = document.getElementById("email")
            this.passwordInput = document.getElementById("password")

            this.init()
        }

        init() {
            this.setupEventListeners()
            this.setupRealTimeValidation()
        }

        setupEventListeners() {
            this.form.addEventListener("submit", (e) => this.handleSubmit(e))
        }

        setupRealTimeValidation() {
            this.emailInput.addEventListener("blur", () => this.validateField(this.emailInput))
            this.emailInput.addEventListener("input", () => {
                if (this.emailInput.classList.contains("is-invalid")) {
                    this.validateField(this.emailInput)
                }
            })
            this.passwordInput.addEventListener("blur", () => this.validateField(this.passwordInput))
            this.passwordInput.addEventListener("input", () => {
                if (this.passwordInput.classList.contains("is-invalid")) {
                    this.validateField(this.passwordInput)
                }
            })
        }

        validateField(field) {
            let isValid = true
            let errorMessage = ""
            const value = field.value.trim()

            if (field.hasAttribute("required") && !value) {
                isValid = false
                errorMessage = "This field is required"
            }

            switch (field.type) {
                case "email":
                    if (value && !this.isValidEmail(value)) {
                        isValid = false
                        errorMessage = "Please enter a valid email address"
                    }
                    break
                case "password":
                    if (value && value.length < 6) {
                        isValid = false
                        errorMessage = "Password must be at least 6 characters long"
                    }
                    break
            }

            if (isValid) {
                field.classList.remove("is-invalid")
                field.classList.add("is-valid")
                this.showFeedback(field, "")
            } else {
                field.classList.remove("is-valid")
                field.classList.add("is-invalid")
                this.showFeedback(field, errorMessage)
            }

            return isValid
        }

        isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            return emailRegex.test(email)
        }

        showFeedback(field, message) {
            const feedback = field.closest('.mb-3, .mb-4').querySelector('.invalid-feedback:not(.d-block)')
            if (feedback) {
                feedback.textContent = message
            }
        }

        handleSubmit(e) {
            e.preventDefault()

            const isEmailValid = this.validateField(this.emailInput)
            const isPasswordValid = this.validateField(this.passwordInput)
            const isValid = isEmailValid && isPasswordValid

            if (isValid) {
                this.form.submit();
            } else {
                const firstInvalidField = this.form.querySelector(".is-invalid")
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

    function togglePassword() {
        const passwordInput = document.getElementById("password")
        const toggleBtn = document.querySelector(".password-toggle i")

        if (passwordInput.type === "password") {
            passwordInput.type = "text"
            toggleBtn.classList.remove("fa-eye")
            toggleBtn.classList.add("fa-eye-slash")
        } else {
            passwordInput.type = "password"
            toggleBtn.classList.remove("fa-eye-slash")
            toggleBtn.classList.add("fa-eye")
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        window.loginForm = new LoginForm()
    })
</script>
