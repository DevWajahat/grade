
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
            <div class="offcanvas-body">
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#"
                                class="text-decoration-none text-dark">Dashboard</a></li>
                        <li class="list-group-item"><a href="#"
                                class="text-decoration-none text-dark">Settings</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Help</a>
                        </li>
                        <li class="list-group-item"><a href="{{ route('logout') }} " class="text-decoration-none text-dark">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- ================================= header ends ============================================= -->
