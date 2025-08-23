<body>
    <!-- ================================= header start ============================================= -->
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
            <div class="offcanvas-body d-flex flex-column justify-content-between">
                <!-- Profile Component -->
                <div class="text-center mb-4">
                    <a href="" class="text-decoration-none text-dark">
                        <i class="ri-account-circle-line" style="font-size: 5rem;"></i>
                        <h5 class="mt-2 mb-0">John Doe</h5>
                        <p class="text-muted small">View Profile</p>
                    </a>
                </div>
                <!-- End Profile Component -->

                <ul class="list-group list-group-flush mb-auto">
                    <li class="list-group-item"><a href="{{ route('candidate.dashboard') }}"
                            class="text-decoration-none text-dark">Dashboard</a></li>
                    {{-- <li class="list-group-item"><a href="#"
                            class="text-decoration-none text-dark">Settings</a></li>
                    <li class="list-group-item"><a href="" class="text-decoration-none text-dark">Help</a>
                    </li> --}}
                </ul>

                <div class="mt-4">
                    <a href="{{ route('logout') }}" class="btn btn-danger w-100">
                        <i class="ri-logout-box-line me-2"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- ================================= header ends ============================================= -->
</body>
