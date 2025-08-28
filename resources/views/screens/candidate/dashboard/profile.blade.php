@extends('layouts.candidate.app')
@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <div class="profile-avatar-large">
                            <i class="fas fa-user"></i>
                            <button class="avatar-edit-btn" data-bs-toggle="modal" data-bs-target="#avatarModal">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-info">
                            <h1 class="profile-name">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</h1>
                            <p class="profile-role">Student</p>
                            <div class="profile-stats">
                                <div class="stat-item">
                                    {{-- @dd(auth()->user()->user_exam_attempts) --}}
                                    <span class="stat-number">{{ count(auth()->user()->user_exam_attempts) }}</span>
                                    <span class="stat-label">Exams Taken</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">85%</span>
                                    <span class="stat-label">Average Score</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">12</span>
                                    <span class="stat-label">Exam Halls</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="row">
                <!-- Personal Information -->
                <div class="col-lg-8">
                    <div class="profile-card">
                        <div class="card-header d-flex justify-content-between">
                            <h3><i class="fas fa-user-edit"></i> Personal Information</h3>
                            <button class="btn btn-outline-primary btn-sm" onclick="toggleEdit('personal')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="personalForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->first_name }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->last_name }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" class="form-control" value="{{ auth()->user()->phone }}"
                                            readonly>
                                    </div>
                                    {{-- <div class="col-12 mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" value="2000-01-15" readonly>
                                    </div> --}}
                                </div>
                                <div class="form-actions" style="display: none;">
                                    <button type="button" class="btn btn-primary" onclick="saveForm('personal')">Save
                                        Changes</button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="cancelEdit('personal')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    {{-- <div class="profile-card">
                        <div class="card-header d-flex justify-content-between">
                            <h3><i class="fas fa-graduation-cap"></i> Academic Information</h3>
                            <button class="btn btn-outline-primary btn-sm" onclick="toggleEdit('academic')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div> --}}
                    {{-- <div class="card-body">
                            <form id="academicForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" class="form-control" value="STU2024001" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Grade Level</label>
                                        <select class="form-control" disabled>
                                            <option>Grade 12</option>
                                            <option>Grade 11</option>
                                            <option>Grade 10</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Institution</label>
                                        <input type="text" class="form-control" value="Springfield High School" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Academic Year</label>
                                        <input type="text" class="form-control" value="2024-2025" readonly>
                                    </div>
                                </div>
                                <div class="form-actions" style="display: none;">
                                    <button type="button" class="btn btn-primary" onclick="saveForm('academic')">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" onclick="cancelEdit('academic')">Cancel</button>
                                </div>
                            </form>
                        </div> --}}
                    {{-- </div> --}}

                    <!-- Guardian Information -->
                    <div class="profile-card">
                        <div class="card-header d-flex justify-content-between">
                            <h3><i class="fas fa-users"></i> Guardian Information</h3>
                            <button class="btn btn-outline-primary btn-sm" onclick="toggleEdit('guardian')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="guardianForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Guardian Name</label>
                                        <input type="text" class="form-control" value="Jane Doe" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Guardian Phone</label>
                                        <input type="tel" class="form-control" value="+1 234 567 8901" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Relationship</label>
                                        <select class="form-control" disabled>
                                            <option>Mother</option>
                                            <option>Father</option>
                                            <option>Guardian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions" style="display: none;">
                                    <button type="button" class="btn btn-primary" onclick="saveForm('guardian')">Save
                                        Changes</button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="cancelEdit('guardian')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>


                <!-- Sidebar Content -->
                <div class="col-lg-4">
                    <!-- Quick Stats -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-chart-line"></i> Performance Overview</h3>
                        </div>
                        <div class="card-body">
                            <div class="performance-metric">
                                <div class="metric-info">
                                    <span class="metric-label">Overall Performance</span>
                                    <span class="metric-value">85%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 85%"></div>
                                </div>
                            </div>
                            <div class="performance-metric">
                                <div class="metric-info">
                                    <span class="metric-label">Mathematics</span>
                                    <span class="metric-value">92%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 92%"></div>
                                </div>
                            </div>
                            <div class="performance-metric">
                                <div class="metric-info">
                                    <span class="metric-label">Science</span>
                                    <span class="metric-value">78%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 78%"></div>
                                </div>
                            </div>
                            <div class="performance-metric">
                                <div class="metric-info">
                                    <span class="metric-label">English</span>
                                    <span class="metric-value">88%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 88%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-clock"></i> Recent Activity</h3>
                        </div>
                        <div class="card-body">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-title">Completed Mathematics Exam</p>
                                    <small class="activity-time">2 hours ago</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-title">Achieved 95% in Physics</p>
                                    <small class="activity-time">1 day ago</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-title">Joined Chemistry Exam Hall</p>
                                    <small class="activity-time">3 days ago</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-cog"></i> Account Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="setting-item">
                                <div class="setting-info">
                                    <span class="setting-label">Email Notifications</span>
                                    <small class="text-muted">Receive exam updates via email</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-info">
                                    <span class="setting-label">SMS Notifications</span>
                                    <small class="text-muted">Get exam reminders via SMS</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-info">
                                    <span class="setting-label">Auto-save Progress</span>
                                    <small class="text-muted">Automatically save exam progress</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-key"></i> Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Avatar Upload Modal -->
    <div class="modal fade" id="avatarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="avatar-preview">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                    <button class="btn btn-primary" onclick="document.getElementById('avatarInput').click()">
                        <i class="fas fa-upload"></i> Choose Photo
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/candidate/js/profile.js') }}"></script>
@endpush
