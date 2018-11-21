<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function image( Request $request )
    {
        //dd($request);
        $file = $request->file('img');
        $filename = md5(time()). '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $public_url = asset('/uploads/' . $filename);

        return [
            'url' => $public_url
        ];
    }
}
