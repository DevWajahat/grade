<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Examination Results</title>
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/img/favicon.svg"
    />
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets//css/style.css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/lindy-uikit.css" />
    <!-- <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" /> -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
      integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header
      class="container-fluid d-flex justify-content-between align-items-center app-bar"
    >
      <div class="right-side">
        <h6 class="text-primary mb-0">Grade Genius</h6>
      </div>
      <div class="left-side">
        <button
          class="btn"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasExample"
          aria-controls="offcanvasExample"
        >
          <i class="ri-menu-line"></i>
        </button>
      </div>
      <div
        class="offcanvas offcanvas-start"
        tabindex="-1"
        id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel"
      >
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>
        <div class="offcanvas-body">
          <div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <a href="candidate-dashboard.html" class="text-decoration-none text-dark">Dashboard</a>
              </li>
              <li class="list-group-item">
                <a href="results.html" class="text-decoration-none text-dark">Results</a>
              </li>
              <li class="list-group-item">
                <a href="" class="text-decoration-none text-dark">Settings</a>
              </li>
              <li class="list-group-item">
                <a href="#" class="text-decoration-none text-dark">Help</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <main class="container py-4">
      <div class="row">
        <!-- Summary Cards -->
        <div class="col-6 col-md-3">
          <div class="summary-card">
            <i class="ri-file-text-line summary-card-icon"></i>
            <div>
              <div class="summary-card-title">Total Exams</div>
              <div class="summary-card-value">12</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="summary-card">
            <i
              class="ri-check-double-line summary-card-icon"
              style="color: #28a745"
            ></i>
            <div>
              <div class="summary-card-title">Completed</div>
              <div class="summary-card-value">8</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="summary-card">
            <i
              class="ri-line-chart-line summary-card-icon"
              style="color: #ffc107"
            ></i>
            <div>
              <div class="summary-card-title">Average Score</div>
              <div class="summary-card-value">85%</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="summary-card">
            <i
              class="ri-trophy-line summary-card-icon"
              style="color: #6f42c1"
            ></i>
            <div>
              <div class="summary-card-title">Best Score</div>
              <div class="summary-card-value">96%</div>
            </div>
          </div>
        </div>

        <!-- All Exam Results -->
        <div class="col-lg-8">
          <div class="exam-results-card">
            <h3 class="card-title-main">All Exam Results</h3>
            <div class="exam-result-item">
              <div class="exam-result-info">
                <i class="ri-check-line"></i>
                <div class="exam-result-text">
                  <div class="exam-name">Mathematics Final</div>
                  <div class="exam-date">2025-01-15</div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <span class="exam-score me-2">85%</span>
                <span class="exam-status">Completed</span>
              </div>
            </div>
            <div class="exam-result-item">
              <div class="exam-result-info">
                <i class="ri-check-line"></i>
                <div class="exam-result-text">
                  <div class="exam-name">Physics Midterm</div>
                  <div class="exam-date">2025-01-12</div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <span class="exam-score me-2">92%</span>
                <span class="exam-status">Completed</span>
              </div>
            </div>
            <div class="exam-result-item">
              <div class="exam-result-info">
                <i class="ri-check-line"></i>
                <div class="exam-result-text">
                  <div class="exam-name">Chemistry Quiz</div>
                  <div class="exam-date">2025-01-10</div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <span class="exam-score me-2">78%</span>
                <span class="exam-status">Completed</span>
              </div>
            </div>
            <div class="exam-result-item">
              <div class="exam-result-info">
                <i class="ri-check-line"></i>
                <div class="exam-result-text">
                  <div class="exam-name">History Final</div>
                  <div class="exam-date">2024-12-01</div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <span class="exam-score me-2">88%</span>
                <span class="exam-status">Completed</span>
              </div>
            </div>
            <div class="exam-result-item">
              <div class="exam-result-info">
                <i class="ri-check-line"></i>
                <div class="exam-result-text">
                  <div class="exam-name">Biology Midterm</div>
                  <div class="exam-date">2024-11-20</div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <span class="exam-score me-2">75%</span>
                <span class="exam-status">Completed</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <nav
      class="navbar navbar-light bg-white border navbar-expand fixed-bottom"
      style="height: 50px"
    >
      <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
          <a
            class="nav-link position-relative active"
            href="examination-hall.html"
          >
            <div class="nav-icon"><i class="ri-graduation-cap-fill"></i></div>
            Exams
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link position-relative" href="results.html">
            <div class="nav-icon"><i class="ri-line-chart-line"></i></div>
            Results
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link position-relative" href="profile.html">
            <div class="nav-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            Profile
          </a>
        </li>
      </ul>
    </nav>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
