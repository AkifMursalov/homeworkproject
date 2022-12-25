<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Answer;
use App\Models\Question as ModelQuestion;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Question extends Controller
{
    //
    public function index(){
        // Take the question and their types from types table
        $questions = ModelQuestion::get();
        $types = Type::get();

        return view('home')->with('questions',$questions)->with('types', $types);
    }

    public function show($id){
        $question = ModelQuestion::find($id);
        $options = Option::where('question_id', $id)->get();
        $types = Type::where('question_id', $id)->get();
        $answers = Answer::where('question_id',$id)->get();
        foreach($answers as $answer){
            $answer = $answer;
        }
        return view('questions')->with('question',$question)->with('options', $options)->with('types', $types)->with('answer', $answer);
    }

    public function edit($id){
        $question = ModelQuestion::find($id);
        $options = Option::where('question_id', $id)->get();
        $types = Type::where('question_id', $id)->get();
        $answers = Answer::where('question_id',$id)->get();
        foreach($options as $option){
            $option = $option;
        }
        foreach($types as $type){
            $type = $type;
        }
        foreach($answers as $answer){
            $answer = $answer;
        }
        return view('edit')->with('question', $question)->with('option', $option)->with('type', $type)->with('answer',$answer);
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'type' => 'required',
        ]);

        if($request->type == 'MCQ' || $request->type == 'DCQ'){
            if($request->answer == $request->option1 || $request->answer == $request->option2 || $request->answer == $request->option3 || $request->answer == $request->option4 || $request->answer == $request->option5){
                $question = DB::table('questions')->insert([
                    'title' => $request->title,
                    'body' => $request->body,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $question = DB::table('questions')->latest()->first();

                $type = DB::table('types')->insert([
                    'name' => $request->type,
                    'description' => $request->type,
                    'question_id' => $question->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $option = DB::table('options')->insert([
                    // Add several options to option field
                    'option1' => $request->option1,
                    'option2' => $request->option2,
                    'option3' => $request->option3,
                    'option4' => $request->option4,
                    'option5' => $request->option5,
                    'question_id' => $question->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if($request->type == 'TOF'){
                    $answer = DB::table('answers')->insert([
                        'answer' => $request->tof,
                        'question_id' => $question->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                else{
                    $answer = DB::table('answers')->insert([
                        'answer' => $request->answer,
                        'question_id' => $question->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            else{
                return redirect()->back()->with('error', 'Answer is not in the options');
            }

        }
        else{

            $question = DB::table('questions')->insert([
                'title' => $request->title,
                'body' => $request->body,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $question = DB::table('questions')->latest()->first();

            $type = DB::table('types')->insert([
                'name' => $request->type,
                'description' => $request->type,
                'question_id' => $question->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $option = DB::table('options')->insert([
                // Add several options to option field
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'option5' => $request->option5,
                'question_id' => $question->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if($request->type == 'TOF'){
                $answer = DB::table('answers')->insert([
                    'answer' => $request->tof,
                    'question_id' => $question->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $answer = DB::table('answers')->insert([
                    'answer' => $request->answer,
                    'question_id' => $question->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        return redirect()->route('home.show');
    }

    public function delete($id){
        $question = ModelQuestion::find($id);
        DB::table('questions')->where('id', $id)->delete();
        DB::table('options')->where('question_id', $id)->delete();
        DB::table('types')->where('question_id', $id)->delete();
        return redirect()->route('home.show');
    }

    public function update($id, Request $request){
        // Update question according to type as in 'create' function
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        if($request->type == 'MCQ' || $request->type == 'DCQ'){
            if($request->answer == $request->option1 || $request->answer == $request->option2 || $request->answer == $request->option3 || $request->answer == $request->option4 || $request->answer == $request->option5){
                $question = DB::table('questions')->where('id', $id)->update([
                    'title' => $request->title,
                    'body' => $request->body,
                    'updated_at' => now(),
                ]);

                $type = DB::table('types')->where('question_id', $id)->update([
                    'name' => $request->type,
                    'description' => $request->type,
                    'updated_at' => now(),
                ]);

                $option = DB::table('options')->where('question_id', $id)->update([
                    // Add several options to option field
                    'option1' => $request->option1,
                    'option2' => $request->option2,
                    'option3' => $request->option3,
                    'option4' => $request->option4,
                    'option5' => $request->option5,
                    'updated_at' => now(),
                ]);

                if($request->type == 'TOF'){
                    $answer = DB::table('answers')->where('question_id', $id)->update([
                        'answer' => $request->tof,
                        'updated_at' => now(),
                    ]);
                }
                else{
                    $answer = DB::table('answers')->where('question_id', $id)->update([
                        'answer' => $request->answer,
                        'updated_at' => now(),
                    ]);
                }
            }
            else{
                return redirect()->back()->with('error', 'Answer is not in the options');
            }
        }
        else{
            $question = DB::table('questions')->where('id', $id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'updated_at' => now(),
            ]);

            $type = DB::table('types')->where('question_id', $id)->update([
                'name' => $request->type,
                'description' => $request->type,
                'updated_at' => now(),
            ]);

            $option = DB::table('options')->where('question_id', $id)->update([
                // Add several options to option field
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'option5' => $request->option5,
                'updated_at' => now(),
            ]);

            if($request->type == 'TOF'){
                $answer = DB::table('answers')->where('question_id', $id)->update([
                    'answer' => $request->answer,
                    'updated_at' => now(),
                ]);
            }
            else{
                $answer = DB::table('answers')->where('question_id', $id)->update([
                    'answer' => $request->answer,
                    'updated_at' => now(),
                ]);
            }
        }
        return redirect()->route('home.show');
    }

}


    // INSERT INTO `types`(`name`, `description`, `question_id`) VALUES ('MCQ','Multiple Choice Question',1);
    // INSERT INTO `types`(`name`, `description`, `question_id`) VALUES ('DCQ','Dpuble Choice Question',2);
    // INSERT INTO `types`(`name`, `description`, `question_id`) VALUES ('FIB','Fill in the Blank',3);
    // INSERT INTO `types`(`name`, `description`, `question_id`) VALUES ('NUM','Numerical',4);
    // INSERT INTO `types`(`name`, `description`, `question_id`) VALUES ('TFQ','True False Question',5);
