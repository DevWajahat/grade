@extends('layouts.candidate.app')
@section('content')
<main class="container py-4">
    <div class="profile-header">
        <div class="profile-avatar-container">
            <i class="ri-user-fill"></i>
            {{-- <div class="profile-avatar-camera">
                <i class="ri-camera-fill"></i>
            </div> --}}
        </div>
        <div class="profile-info">
            <h4> {{ $user->first_name . ' ' . $user->last_name }} </h4>
            <p><i class="ri-mail-line"></i> {{ $user->email }} </p>
            <p><i class="ri-map-pin-line"></i> {{ $user->phone }} </p>
        </div>
    </div>

    <!-- Personal Information Section -->
    <div class="profile-section-card">
        <div class="section-header-flex">
            <h3 class="section-title">Personal Information</h3>
            {{-- <button class="btn btn-primary btn-sm">
                <i class="ri-edit-line me-1"></i> Edit Profile
            </button> --}}
        </div>
        <div class="row">
            <div class="col-md-6 info-item">
                <p class="info-label">First Name</p>
                <p class="info-value"> {{ $user->first_name }} </p>
            </div>
            <div class="col-md-6 info-item">
                <p class="info-label">Last Name</p>
                <p class="info-value"> {{ $user->last_name }} </p>
            </div>
            <div class="col-md-6 info-item">
                <p class="info-label"><i class="ri-mail-line"></i> Email Address</p>
                <p class="info-value"> {{ $user->email }} </p>
            </div>
            <div class="col-md-6 info-item">
                <p class="info-label"><i class="ri-phone-line"></i> Phone Number</p>
                <p class="info-value"> {{ $user->phone }} </p>
            </div>
            <div class="col-md-6 info-item">
                <p class="info-label"><i class="ri-phone-line"></i> Guardian Phone</p>
                <p class="info-value"> {{ $user->guardian_phone }} </p>
            </div>
            <div class="col-md-6 info-item">
                <p class="info-label">
                    <i class="ri-calendar-line"></i> Guardian Name
                </p>
                <p class="info-value"> {{ $user->guardian_name }} </p>
            </div>
            <div class="col-12 info-item">
                {{-- <p class="info-label">Bio</p>
                <p class="bio-text">
                    Computer Science student passionate about learning and technology.
                </p> --}}
            </div>
        </div>
    </div>

    <!-- Account Settings Section -->
    {{-- <div class="profile-section-card">
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
    </div> --}}
</main>
@endsection
