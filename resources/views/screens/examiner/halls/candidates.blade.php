@extends('layouts.examiner.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Hall Added Successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid pt-4 px-4 min-vh-100">
        <div class="row ">
            <div class="col-sm-12 col-xl-12" style="min-height: 100vh">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Basic Table</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Guardian Name</th>
                                <th scope="col">Guardian Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hall->hall_users as $user)

                            <tr>
                                <th scope="row">{{ $user->id }} </th>
                                <th scope="row">{{ $user->first_name }} </th>
                                <th scope="row">{{ $user->last_name }} </th>
                                <th scope="row">{{ $user->phone }} </th>
                                <th scope="row">{{ $user->email }} </th>
                                <th scope="row">{{ $user->guardian_name }} </th>
                                <th scope="row">{{ $user->guardian_phone }} </th>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        @endsection
