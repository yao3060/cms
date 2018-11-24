<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Postmeta;
use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use Illuminate\Support\Facades\Auth;
use App\Answer;
use App\Post;

class AnswerController extends Controller
{
    //
    protected $answerRepository;

    public function __construct( AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    //Repository
    public function store( StoreAnswerRequest $request, $id)
    {

        $answer = new Answer();
        $answer->post_id = $id;
        $answer->user_id = Auth::id();
        $answer->body = $request->answer;

        //dd($answer);

        if($answer->save()){

            $meta_answer_count = Postmeta::where([
                ['post_id', '=', $id],
                ['meta_key', '=', 'answer_count'],
            ])->first();

            if($meta_answer_count){

                $meta_answer_count->meta_value = (int)$meta_answer_count->meta_value + 1;
                $meta_answer_count->save();

            }else{

                $new_answer_count = new Postmeta();
                $new_answer_count->post_id = $id;
                $new_answer_count->meta_key = 'answer_count';
                $new_answer_count->meta_value = 1;
                $new_answer_count->save();

            }

            return back();
        }

    }
}
