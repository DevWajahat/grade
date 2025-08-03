<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Hall Details</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Remixicon CDN for icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="container-fluid d-flex justify-content-between align-items-center app-bar">
        <div class="right-side">
            <h6 class="text-primary mb-0">Grade Genius</h6>
        </div>
        <div class="left-side">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="ri-menu-line"></i>
            </button>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Dashboard</a>
                        </li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">My Exams</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Settings</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Help</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

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
                <div class="exam-card">
                    <div class="exam-card-header">
                        <h2 class="exam-title">Mathematics Final Exam</h2>

                    </div>
                    <p class="text-secondary mb-3">Comprehensive final examination covering calculus, algebra, and
                        statistics.</p>
                    <div class="d-flex flex-wrap mb-3">
                        <div class="exam-info me-4">
                            <i class="ri-time-line"></i>
                            <span>120 minutes</span>
                        </div>
                        <div class="exam-info">
                            <i class="ri-question-fill"></i>
                            <span>50 questions</span>
                        </div>
                    </div>
                    <p class="exam-sections-title">Exam Sections:</p>
                    <div>
                        <span class="exam-section-badge">Multiple Choice (20)</span>
                        <span class="exam-section-badge">Short Answer (15)</span>
                        <span class="exam-section-badge">Long Answer (15)</span>
                    </div>
                    <div class="mt-4">
                        <a href="exam.html" class="btn btn-primary">Start Exams</a>
                    </div>
                </div>

                <!-- Physics Midterm Card -->
                <div class="exam-card">
                    <div class="exam-card-header">
                        <h2 class="exam-title">Physics Midterm</h2>

                    </div>
                    <p class="text-secondary mb-3">Midterm examination covering mechanics, thermodynamics, and
                        electromagnetism.</p>
                    <div class="d-flex flex-wrap mb-3">
                        <div class="exam-info me-4">
                            <i class="ri-time-line"></i>
                            <span>90 minutes</span>
                        </div>
                        <div class="exam-info">
                            <i class="ri-question-fill"></i>
                            <span>35 questions</span>
                        </div>

                    </div>
                    <p class="exam-sections-title">Exam Sections:</p>
                    <div>
                        <span class="exam-section-badge">Multiple Choice (15)</span>
                        <span class="exam-section-badge">Short Answer (10)</span>
                        <span class="exam-section-badge">Long Answer (10)</span>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary">Start Exams</button>
                    </div>
                </div>

                <!-- Chemistry Quiz Card -->
                <div class="exam-card">
                    <div class="exam-card-header">
                        <h2 class="exam-title">Chemistry Quiz</h2>

                    </div>
                    <p class="text-secondary mb-3">Quiz on organic chemistry fundamentals and molecular structures.</p>
                    <div class="d-flex flex-wrap mb-3">
                        <div class="exam-info me-4">
                            <i class="ri-time-line"></i>
                            <span>60 minutes</span>
                        </div>
                        <div class="exam-info">
                            <i class="ri-question-fill"></i>
                            <span>25 questions</span>
                        </div>
                    </div>
                    <p class="exam-sections-title">Exam Sections:</p>
                    <div>
                        <span class="exam-section-badge">Multiple Choice (15)</span>
                        <span class="exam-section-badge">Short Answer (10)</span>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary">Start Exams</button>
                    </div>
                </div>
            </div>


        </div>
    </main>

    <nav class="navbar navbar-light bg-white border navbar-expand fixed-bottom" style="height: 50px;">
        <ul class="navbar-nav nav-justified w-100">

            <li class="nav-item"><a class="nav-link position-relative active" href="examination-hall.html">
                    <div class="nav-icon"><i class="ri-graduation-cap-fill"></i></div>Exams
                </a></li>
           
            <li class="nav-item"><a class="nav-link position-relative" href="results.html">
                    <div class="nav-icon"><i class="ri-line-chart-line"></i></div>Results
                </a></li>
          
            <li class="nav-item"><a class="nav-link position-relative" href="profile.html">
                    <div class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg></div>Profile
                </a></li>
        </ul>
    </nav>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>