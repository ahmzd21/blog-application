<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post){
        $post->likes()->toggle(auth()->user());
        return response([
            'count' => $post->likes()->count(),
        ]);
    }
}
