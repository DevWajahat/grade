<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
    <!-- Bootstrap CSS CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Inter Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- Remixicon CDN for icons -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css">
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
                <a href="#" class="text-decoration-none text-dark">Dashboard</a>
              </li>
              <li class="list-group-item">
                <a href="#" class="text-decoration-none text-dark">My Exams</a>
              </li>
              <li class="list-group-item">
                <a href="#" class="text-decoration-none text-dark">Settings</a>
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
      <div class="profile-header">
        <div class="profile-avatar-container">
          <i class="ri-user-fill"></i>
          <div class="profile-avatar-camera">
            <i class="ri-camera-fill"></i>
          </div>
        </div>
        <div class="profile-info">
          <h4>John Doe</h4>
          <p><i class="ri-mail-line"></i> john.doe@example.com</p>
          <p><i class="ri-map-pin-line"></i> New York, NY</p>
        </div>
      </div>

      <!-- Personal Information Section -->
      <div class="profile-section-card">
        <div class="section-header-flex">
          <h3 class="section-title">Personal Information</h3>
          <button class="btn btn-primary btn-sm">
            <i class="ri-edit-line me-1"></i> Edit Profile
          </button>
        </div>
        <div class="row">
          <div class="col-md-6 info-item">
            <p class="info-label">First Name</p>
            <p class="info-value">John</p>
          </div>
          <div class="col-md-6 info-item">
            <p class="info-label">Last Name</p>
            <p class="info-value">Doe</p>
          </div>
          <div class="col-md-6 info-item">
            <p class="info-label"><i class="ri-mail-line"></i> Email Address</p>
            <p class="info-value">john.doe@example.com</p>
          </div>
          <div class="col-md-6 info-item">
            <p class="info-label"><i class="ri-phone-line"></i> Phone Number</p>
            <p class="info-value">+1 (555) 123-4567</p>
          </div>
          <div class="col-md-6 info-item">
            <p class="info-label"><i class="ri-map-pin-line"></i> Location</p>
            <p class="info-value">New York, NY</p>
          </div>
          <div class="col-md-6 info-item">
            <p class="info-label">
              <i class="ri-calendar-line"></i> Date of Birth
            </p>
            <p class="info-value">6/15/1995</p>
          </div>
          <div class="col-12 info-item">
            <p class="info-label">Bio</p>
            <p class="bio-text">
              Computer Science student passionate about learning and technology.
            </p>
          </div>
        </div>
      </div>

      <!-- Account Settings Section -->
      <div class="profile-section-card">
        <h3 class="section-title">Account Settings</h3>
        <div class="settings-item">
          <div class="settings-iteum-content">
            <h6>Change Password</h6>
            <p>Update your account password</p>
          </div>
          <i class="ri-arrow-right-s-line text-secondary"></i>
        </div>
        <div class="settings-item">
          <div class="settings-item-content">
            <h6>Notification Preferences</h6>
            <p>Manage your email and push notifications</p>
          </div>
          <i class="ri-arrow-right-s-line text-secondary"></i>
        </div>
        <div class="delete-account-item">
          <div class="settings-item-content">
            <h6>Delete Account</h6>
            <p>Permanently delete your account and all data</p>
          </div>
          <i class="ri-arrow-right-s-line text-danger"></i>
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
