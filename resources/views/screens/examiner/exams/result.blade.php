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
                                <th scope="col">Name</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Finshed At</th>
                                <th scope="col">duration_minutes</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userExamAttempts as $userExamAttempt)
                                <tr>
                                    <td> {{ $userExamAttempt->id }} </td>
                                    <td> {{ $userExamAttempt->user->first_name . ' ' . $userExamAttempt->user->last_name }}
                                    </td>
                                    <td> {{ $userExamAttempt->total_marks }} </td>
                                    <td data-time="{{ $userExamAttempt->finished_at }}" id="time"> </td>
                                    <td data-time="{{ $userExamAttempt->exam->duration_minutes }}"> </td>
                                <td> <a href="{{ route('examiner.exams.candidate.result',$userExamAttempt->id) }}" class="btn btn-primary">View Answer Sheet</a> </td>
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
                function formatTime(totalSeconds) {
                    const minutes = Math.floor(totalSeconds / 60);
                    const seconds = totalSeconds % 60;
                    const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
                    const formattedSeconds = seconds < 10 ? '0' + seconds : seconds;
                    return `${formattedMinutes}:${formattedSeconds}`;
                }

                document.addEventListener('DOMContentLoaded', function() {
                    // Assuming the total time is a difference in seconds and is stored in a data attribute
                    document.querySelectorAll('td[data-time]').forEach(cell => {
                        const totalSeconds = parseInt(cell.dataset.time);
                        if (!isNaN(totalSeconds)) {
                            cell.textContent = formatTime(totalSeconds);
                        }
                    });
                });
            </script>
        @endpush
