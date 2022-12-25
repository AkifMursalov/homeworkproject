@extends('layouts.app')

@section('title')
    Create Question
@endsection

@section('content')
    {{-- Show error of any type --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Create a card --}}
    <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create Question') }}</div>
                    <div class="card-body">
                        {{-- Create a form --}}
                        <form action="{{ route('questions.create')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
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
                                    <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" required autocomplete="body" autofocus></textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="answer_field" class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>
                                <div id="answer_input" class="col-md-6">
                                        <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" required autocomplete="answer" autofocus>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div style="display: none" id="answer_radio" class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tof" id="true" value="True" checked>
                                        <label class="form-check-label" for="true">
                                          True
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tof" id="false" value="False">
                                        <label class="form-check-label" for="false">
                                          False
                                        </label>
                                      </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                <div class="col-md-6">
                                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required autocomplete="type" autofocus>
                                        <option value="0">Select Type</option>
                                        <option value="MCQ">Multiple Choice</option>
                                        <option value="DCQ">Double Choise</option>
                                        <option value="NUM">Numerical</option>
                                        <option value="FIB">Fill the Blank</option>
                                        <option value="TOF">True or False</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="options" style="display: none">
                                <p for="options" class="col-md-4 col-form-label text-md-right">{{ __('Option 1') }}</p>
                                <div id="inputs" class="col-md-6">
                                    <input id="option1" type="text" class="form-control @error('options') is-invalid @enderror" name="option1" value="{{ old('options') }}" autocomplete="options" autofocus>
                                    @error('options')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0" id="add_option" style="display: none">
                                <div class="col-md-6 offset-md-4">
                                    <button id="add_btn" type="button" class="btn btn-primary">
                                        {{ __('Add Option') }}
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 mt-2">
                                    <button id="create_btn" type="submit" class="btn btn-primary" disabled>
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- If the screen is small make it responsive --}}
    <style>
        @media (max-width: 768px) {
            #home{
                margin-top: 20px;
            }

            /* Make it icon clickable in little screens */
            .fas.fa-trash-alt{
                cursor: pointer;
                z-index: 2;
                width: 20px;
            }

            #inputs{
                margin-top: 0 !important;
            }
        }

        #home{
            margin-top: 20px;
        }
        .fas.fa-trash-alt{
            cursor: pointer;
        }

    </style>

    {{-- Add script that will show the options field if the dropdown is Multiple Choice in real time without refreshing the page--}}
    <script>
        $(document).ready(function(){
            $('#type').change(function(){
                if($(this).val() == 'MCQ' || $('#type').val() == 'DCQ'){
                    $('#options').show();
                    $('#add_option').show();
                    $('#options').attr('required', true);
                    $('#create_btn').attr('disabled', true);
                }else{
                    $('#options').hide();
                    $('#add_option').hide();
                    $('#options').attr('required', false);
                }
            });
        });

        // Checj if all the fields are filled each second
        setInterval(function(){
            if($('#type').val() == 'MCQ' || $('#type').val() == 'DCQ'){
                if($('#title').val() != '' && $('#body').val() != '' && $('#type').val() != 0 && $('#option1').val() != '' && $('#option2').val() != '' && $('#options3').val() != '' && $('#options4').val() != ''){
                    $('#create_btn').removeAttr('disabled');
                }
                else{
                    $('#create_btn').attr('disabled', true);
                }
            }else{
                if($('#title').val() != '' && $('#body').val() != '' && $('#type').val() != 0){
                    $('#create_btn').removeAttr('disabled');
                }
                else{
                    $('#create_btn').attr('disabled', true);
                }
            }
        }, 1000);


        // If add option button is clicked add one more options field
        $(document).ready(function(){
            // Add a number to each new option in the label
            var i = 2;
            $('#add_btn').click(function(){
                $('#options').append('<label for="options" class="col-md-4 col-form-label text-md-right mt-3">{{ __("Option") }} '+i+'</label><div class="col-md-6 mt-3" id="inputs"><input type="text" class="form-control @error("options") is-invalid @enderror" name="option'+i+'" value="{{ old("options") }}" autocomplete="options" autofocus id="'+i+'"><i class="fas fa-trash-alt" style="float: right; margin-top: -28px; margin-right: 10px; color: rgb(73, 73, 255, 0.4)"></i>@error("options")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div>');
                i++;

                if(i > 5){
                    $('#add_btn').attr('disabled', true);
                }
            });


            // If field is deleted continue in the right order
            $('#options').on('click', '.fa-trash-alt', function(){
                i--;
                if(i <= 5){
                    $('#add_btn').attr('disabled', false);
                }
            });


        });

        // If the trash icon is clicked remove the options field
        $(document).ready(function(){
            $('#options').on('click', '.fa-trash-alt', function(){
                // Remove the input field and it's label
                $(this).parent().prev().remove();
                $(this).parent().remove();

            });
        });

        // If the value of dropdown is TAF remove answer field
        $(document).ready(function(){
            $('#type').change(function(){
                if($(this).val() == 'TOF'){
                    $('#answer_input').hide();
                    $('#answer').attr('required', false);
                    $('#answer_radio').removeAttr('style');
                }else{
                    $('#answer_input').show();
                    $('#answer').attr('required', true);
                    $('#answer_radio').attr('style', 'display: none');
            }});
        });

        // If the value of dropdown is NUM make answer field of type number
        $(document).ready(function(){
            $('#type').change(function(){
                if($(this).val() == 'NUM'){
                    $('#answer').attr('type', 'number');
                }else{
                    $('#answer').attr('type', 'text');
                }
            });
        });

    </script>


@endsection

