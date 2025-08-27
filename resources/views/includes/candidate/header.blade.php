 <!-- Converting sidebar to offcanvas -->
    <!-- Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Grade Genius</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="user-profile text-center mb-4">
                <div class="profile-avatar mb-3">
                    <i class="fas fa-user-circle fa-4x text-primary"></i>
                </div>
                <h5>John Doe</h5>
                <p class="text-muted">Student</p>
            </div>

            <nav class="sidebar-nav">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('candidate.profile.index') }}" class="nav-link d-flex align-items-center">
                            <i class="fas fa-user me-3"></i>
                            Profile
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('candidate.dashboard') }}" class="nav-link d-flex align-items-center active">
                            <i class="fas fa-home me-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('logout') }}" class="nav-link d-flex align-items-center">
                            <i class="fas fa-sign-out-alt me-3"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
        <div class="container-fluid"
            style="width:100%; display: flex; justify-content: space-between;align-items: flex-end">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-graduation-cap me-2"></i>
                <span class="brand-text">Grade Genius</span>
            </a>
            <button class="btn btn-outline-primary me-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar">
                <i class="fas fa-bars"></i>
            </button>

        </div>
    </nav>
