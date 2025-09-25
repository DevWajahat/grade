@extends('layouts.examiner.app')

@section('content')
    <div class="container mt-3 " style="min-height: 70vh">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid mt-5">
                    <h3>Edit Examination Hall</h3>
                </div>
                <form action="{{ route('examiner.hall.update',parameters: $hall->id) }}" method="post">
                    @csrf
                    <div class="mt-3">
                        <label for="" class="form-label">Title:</label>
                        <input type="text" name="title" class="form-control" value="{{ $hall->title }}" placeholder="Enter Hall Name" id="">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <button class="btn btn-primary col-12" type="submit">Update Exam Hall</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
