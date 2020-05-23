@extends('layouts.app')


@section('content')

    <div class="d-flex justify-content-end mb-2"></div>

    <div class="card card-default">

        <div class="card-header">Tasks</div>

        <div class="card-body">

            @if($tasks->count() > 0)
                <table class="table">

                    <thead>

                    <th>User Name</th>

                    <th>Task Description</th>

                    <th>Status</th>

                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>
                                {{$task->user->name}}
                            </td>

                            <td>{{ $task->taskText }}</td>

                            <td>
                                {{$task->isDone == 1 ? 'done' : 'not done'}}
                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>
                @else
                <h3 class="text-center">No Tasks Yet</h3>
            @endif

        </div>

    </div>

    @endsection
