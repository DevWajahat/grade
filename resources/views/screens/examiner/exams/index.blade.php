@extends('layouts.examiner.app')

@section('content')
    <div class="container-fluid pt-4 px-4 min-vh-100">
        <div class="row ">
            <div class="col-sm-12 col-xl-12" style="min-height: 100vh">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Basic Table</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">hall</th>
                                <th scope="col">Title</th>
                                <th scope="col">Total_Marks</th>
                                <th scope="col">duration_minutes</th>
                                <th scope="col">status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exams as $exam)
                                <tr>
                                    <td>{{ $exam->id }}</td>
                                    <td>{{ $exam->exam_hall->title }}</td>
                                    <td>{{ $exam->title }}</td>
                                    <td>{{ $exam->total_marks }}</td>
                                    <td>{{ $exam->duration_minutes }}</td>
                                    <td>
                                        <select name="status" id="status" data-id="{{ $exam->id }}"
                                            class="form-control">
                                            <option value="public" {{ $exam->status == 'public' ? 'selected' : '' }}>public
                                            </option>
                                            <option value="private"{{ $exam->status == 'private' ? 'selected' : '' }}>
                                                private</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('examiner.exams.edit', $exam->id) }}"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>

                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        @endsection
        @push('scripts')
            <script>
                $(document).ready(function() {
                    // Use a class selector to target all status dropdowns
                    $('#status').on('change', function() {
                        var newStatus = $(this).val();
                        var examId = $(this).data('id');
                        console.log(newStatus)
                        $.ajax({
                            type: 'POST', // Or 'PUT' if you prefer a RESTful approach
                            url: '{{ route("examiner.exams.status.update") }}', // The URL to your update route
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: newStatus
                            },
                            success: function(response) {
                                console.log(response.message);
                                // Optional: Show a success message to the user
                                alert(response.message);
                            },
                            error: function(xhr, status, error) {
                                console.error("Error updating status:", error);
                                // Optional: Show an error message to the user
                                alert("An error occurred while updating the status.");
                            }
                        });
                    });
                });
            </script>
        @endpush
