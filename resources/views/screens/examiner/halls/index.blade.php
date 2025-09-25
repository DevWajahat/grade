@extends('layouts.examiner.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
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
                                <th scope="col">Title</th>
                                <th scope="col">Hall Code</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($halls as $hall)
                                <tr>
                                    <th scope="row">{{ $hall->id }}</th>
                                    <td>{{ $hall->title }}</td>
                                    <td>{{ $hall->hall_code }}</td>
                                    <td><a href="{{ route('examiner.hall.edit', $hall->id) }}"
                                            class="btn btn-warning">Edit</a>
                                            <a href="{{ route('examiner.hall.candidates', $hall->id) }}"
                                                class="btn btn-primary">View Candidates </a>
                                            </td>

                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endsection
