<nav class="navbar navbar-light bg-white border navbar-expand fixed-bottom" style="height: 50px;">
    <ul class="navbar-nav nav-justified w-100">

        <li class="nav-item"><a class="nav-link position-relative active"
                href="{{ route('candidate.examination', $code) }}">
                <div class="nav-icon"><i class="ri-graduation-cap-fill"></i></div>Exams
            </a></li>

        <li class="nav-item"><a class="nav-link position-relative" href="{{ route('candidate.results', $code) }}">
                <div class="nav-icon"><i class="ri-line-chart-line"></i></div>Results
            </a></li>

        <li class="nav-item"><a class="nav-link position-relative" href="{{ route('candidate.people',$code) }}">
                <div class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg></div>People
            </a></li>
    </ul>
</nav>
