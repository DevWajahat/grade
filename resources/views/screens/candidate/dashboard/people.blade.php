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
    {{-- @dd($examHall->hall_users) --}}

    <div class="container  mb-5">
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
    @include('includes.candidate.bottomnav')
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
