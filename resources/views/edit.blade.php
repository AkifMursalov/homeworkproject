@extends('layouts.app')

@section('content')
    {{-- Create a form for editing the question --}}
    <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Question') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('questions.update',$question->id)}}">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $question->title }}" required autocomplete="title" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ $question->body }}" required autocomplete="body" autofocus>{{ $question->body }}</textarea>
                                        @error('body')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                    <div class="col-md-6">
                                        <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $type->name }}" required autocomplete="type" autofocus readonly>
                                        @error('body')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @if($type->name == 'MCQ' || $type->name == 'DCQ')
                                <div class="form-group row">
                                    <label for="option1" class="col-md-4 col-form-label text-md-right">{{ __('Option 1') }}</label>
                                    <div class="col-md-6">
                                        <input id="option1" type="text" class="form-control @error('option1') is-invalid @enderror" name="option1" value="{{ $option->option1 }}" required autocomplete="option1" autofocus>
                                        @error('option1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="option2" class="col-md-4 col-form-label text-md-right">{{ __('Option 2') }}</label>
                                    <div class="col-md-6">
                                        <input id="option2" type="text" class="form-control @error('option2') is-invalid @enderror" name="option2" value="{{ $option->option2 }}" required autocomplete="option2" autofocus>
                                        @error('option2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="option3" class="col-md-4 col-form-label text-md-right">{{ __('Option 3') }}</label>
                                    <div class="col-md-6">
                                        <input id="option3" type="text" class="form-control @error('option3') is-invalid @enderror" name="option3" value="{{ $option->option3 }}" required autocomplete="option3" autofocus>
                                        @error('option3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="option4" class="col-md-4 col-form-label text-md-right">{{ __('Option 4') }}</label>
                                    <div class="col-md-6">
                                        <input id="option4" type="text" class="form-control @error('option4') is-invalid @enderror" name="option4" value="{{ $option->option4 }}" required autocomplete="option4" autofocus>
                                        @error('option4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="option5" class="col-md-4 col-form-label text-md-right">{{ __('Option 5') }}</label>
                                    <div class="col-md-6">
                                        <input id="option5" type="text" class="form-control @error('option5') is-invalid @enderror" name="option5" value="{{ $option->option5 }}" required autocomplete="option5" autofocus>
                                        @error('option5')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
                                    <div class="col-md-6">
                                        @if($type->name == 'NUM')
                                        <input id="answer" type="number" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ $answer->answer }}" required autocomplete="answer" autofocus>
                                        @elseif($type->name == 'TOF')
                                        <select id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" required autocomplete="answer" autofocus>
                                            <option value="True" @if($answer->answer == 1) selected @endif>True</option>
                                            <option value="False" @if($answer->answer == 0) selected @endif>False</option>
                                        </select>
                                        @else
                                        <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ $answer->answer }}" required autocomplete="answer" autofocus>
                                        @endif
                                        @error('answer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


