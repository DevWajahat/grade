@extends('layouts.candidate.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Poppins:wght@400;600&display=swap');

        .main-content {
            font-family: 'Poppins', sans-serif;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        .card-title {
            font-family: 'Merriweather', serif;
            font-weight: 700;
        }

        .instruction-item strong,
        .exam-sections h6 {
            font-weight: 600;
        }

        .exam-meta .badge,
        .alert {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    {{-- @dd($examHall->hall_users) --}}
    <main class="main-content pt-5" style="margin-top:9.5vh !important; margin-bottom: 8vh;">
        <div class="top-nav d-none d-lg-block">
            <div class="container-fluid">
                <ul class="nav nav-tabs border-0">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('candidate.examination', $code) }}" data-tab="stream">Exams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidate.results', $code) }}" data-tab="classwork">Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('candidate.people', $code) }}"
                            data-tab="people">People</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container mb-5">
            <h1 class="display-4 fw-bold text-center text-dark mb-4">Exam Hall</h1>

            <!-- Examiners List -->
            <div class="card shadow rounded-3 p-4 mb-4 border-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fs-4 fw-bold text-dark mb-0">Examiners</h2>
                </div>
                <ul class="list-group list-group-flush" id="examiners-list">
                    <!-- Examiner list items will be dynamically generated here -->
                </ul>
            </div>

            <!-- Candidates List -->
            <div class="card shadow rounded-3 p-4 mb-4 border-0 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fs-4 fw-bold text-dark mb-0">Candidates</h2>
                    <span class="badge bg-secondary">{{ count($examHall->hall_users) }} students</span>
                </div>
                <ul class="list-group list-group-flush" id="candidates-list">
                    <!-- Candidate list items will be dynamically generated here -->
                </ul>
            </div>
        </div>

    </main>

    <!-- Bottom Navigation for Mobile -->
    <div class="bottom-nav d-flex d-lg-none"
        style="position:fixed; bottom:0; width:100%; background-color:#fff; box-shadow:0 -2px 5px rgba(0,0,0,0.1); padding:0.5rem 0; justify-content:space-around; align-items:center;">
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                style="fill:#6c757d; margin-bottom:0.25rem;">
                <path
                    d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
            </svg>
            <a href="{{ route('candidate.examination', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">Exams</a>
        </div>
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                style="fill:#6c757d; margin-bottom:0.25rem;">
                <path
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-9h-1V7h2V6h-2V5h-1v2h-1v2h2v1h-1v2h1v1h-1v2h1v-1h2v-1h-2v-1z" />
            </svg>
            <a href="{{ route('candidate.results', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">Results</a>
        </div>
        <div class="nav-item"
            style="display:flex; flex-direction:column; align-items:center; color:#6c757d; font-size:0.75rem;">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                style="fill:#0d6efd;  margin-bottom:0.25rem;">
                <path
                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
            </svg>
            <a href="{{ route('candidate.people', $code) }}"
                style="text-decoration:none; color:inherit; font-family:'Poppins', sans-serif;">People</a>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to generate a random hex color
            function getRandomColor() {
                const colors = [
                    '#4285f4', '#db4437', '#fbbc05', '#34a853', // Google's brand colors
                    '#8a2be2', '#00ced1', '#ff4500', '#20b2aa', // Other vibrant colors
                    '#5d5d81', '#1a73e8', '#db4437'
                ];
                return colors[Math.floor(Math.random() * colors.length)];
            }

            // Function to create a list item with a dynamic profile icon
            function createProfileCard(name) {
                const firstLetter = name.charAt(0).toUpperCase();
                const color = getRandomColor();
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex align-items-center';

                listItem.innerHTML = `
                    <div class="profile-icon me-3" style="background-color: ${color};">
                        ${firstLetter}
                    </div>
                    <p class="mb-0 fw-medium">${name}</p>
                `;
                return listItem;
            }

            // Sample data for examiners and candidates
            const examiners = [
                '{{ $examHall->user->first_name . ' ' . $examHall->user->last_name }}',
            ];

            const candidates = [
                @forelse ($examHall->hall_users as $user)

                    '{{ $user->first_name . ' ' . $user->last_name }}',
                @empty
                @endforelse

            ];

            // Render the lists
            const examinersListContainer = document.getElementById('examiners-list');
            const candidatesListContainer = document.getElementById('candidates-list');

            examiners.forEach(name => {
                examinersListContainer.appendChild(createProfileCard(name));
            });

            candidates.forEach(name => {
                candidatesListContainer.appendChild(createProfileCard(name));
            });
        });
    </script>
@endpush
