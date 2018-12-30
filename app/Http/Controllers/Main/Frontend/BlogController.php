<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class BlogController
 * @package Application\Controllers
 * Created by PhpStorm.
 * User: user
 * Date: 12.05.2016
 * Time: 16:53
 */
class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('frontend.blog.index', ['posts' => $posts]);
    }

    public function post($post_id)
    {
        if (Input::get('comment')) {
            $text = Input::get('comment');
            $post_id = Input::get('post_id');
            $user_id = Auth::user()->id;

            $comment = new Comment();
            $comment->post_id = $post_id;
            $comment->text = $text;
            $comment->user_id = $user_id;
            $comment->save();

            return redirect('blog/' . $post_id);
        }

        /** @var Post $post */
        $post = Post::with('comments.author')->findOrFail($post_id);
        $post->views++;
        $post->save();
        return view('frontend.blog.post', ['post' => $post]);
    }
}