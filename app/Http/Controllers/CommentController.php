<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(CommentRequest $request){
        $data = $request->validated();
        Auth::user()->comments()->create($data);
        return redirect()->back();
    }
}
