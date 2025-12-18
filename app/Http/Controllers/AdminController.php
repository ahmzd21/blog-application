<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $recentPosts = Post::latest()->take(5)->get();
        
        return view('admin.index', compact('usersCount', 'postsCount', 'recentPosts'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete yourself');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function posts()
    {
        $posts = Post::latest()->paginate(20);
        return view('admin.posts', compact('posts'));
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}
