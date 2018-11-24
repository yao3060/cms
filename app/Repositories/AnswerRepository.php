<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/23
 * Time: 21:37
 */

namespace App\Repositories;

use App\Answer;

class AnswerRepository
{

    public function create($attributes)
    {
        return Answer::create($attributes);
    }
}
