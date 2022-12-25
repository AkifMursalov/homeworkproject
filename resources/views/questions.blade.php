@extends('layouts.app')

@section('content')
    {{-- Show all questions according to the type --}}
    <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $question->title }}</div>
                        <div class="card-body">
                            <h3>{{ $question->body }}</h3>
                            <h6>
                                @foreach($types as $type)
                                    {{ $type->name }}
                                @endforeach
                            </h6>
                            <hr>
                            @foreach($options as $option)
                                @if($option->question_id == $question->id)
                                <ol>
                                    @if($option->option1 != NULL)
                                    <li>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <p>{{$option->option1}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($option->option2 != NULL)
                                    <li>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <p>{{$option->option2}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($option->option3 != NULL)
                                    <li>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <p>{{$option->option3}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($option->option4 != NULL)
                                    <li>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <p>{{$option->option4}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($option->option5 != NULL)
                                    <li>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <p>{{$option->option5}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    {{-- If all of them are null --}}
                                    @if($option->option1 == NULL && $option->option2 == NULL && $option->option3 == NULL && $option->option4 == NULL && $option->option5 == NULL)
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <p>There are no options for this question</p>
                                        </div>
                                    </div>
                                    @endif
                                </ol>
                                @endif
                            @endforeach
                            <hr>
                            {{-- Show the answer --}}
                            <div style="display: none" id="answer" class="form-group row">
                                <div class="col-md-6">
                                    <h3>Answer</h3>
                                    <p>{{$answer->answer}}</p>
                                </div>
                            </div>
                            {{-- Create a show answer button --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-info">Show Answer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- Create a function that shows and hides the answer --}}
    <script>
        $(document).ready(function(){
            $("button").click(function(){
                $("#answer").toggle();
                // Change the text of button
                if($(this).text() == "Show Answer"){
                    $(this).text("Hide Answer");
                }else{
                    $(this).text("Show Answer");
                }
                
            });
        });
    </script>
@endsection
