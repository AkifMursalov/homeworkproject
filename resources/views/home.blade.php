@extends('layouts.app')

@section('content')

{{-- Create a table --}}
<div id="home" class="container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Questions') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <th scope="row">{{ $question->id }}</th>
                                        <td>{{ $question->title }}</td>
                                        <td>{{ $question->body }}</td>
                                        @foreach($types as $type)
                                            @if($type->question_id == $question->id)
                                                <td>{{ $type->name }}</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <a href="{{ route('questions.show', $question->id) }}" class="btn btn-primary">View</a>
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('questions.delete', $question->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- If the screen is small make it responsive --}}
<style>
    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        #home{
            margin-top: 20px;
        }
    }
    #home{
        margin-top: 20px;
    }
</style>


@endsection
