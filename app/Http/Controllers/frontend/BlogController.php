<?php

/**
 * Class BlogController
 * @package Application\Controllers
 * Created by PhpStorm.
 * User: user
 * Date: 12.05.2016
 * Time: 16:53
 */

namespace Application\Controllers;

use Application\Models\Comment;
use Application\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Scandinaver\Classes\Controller;
use Scandinaver\Classes\User;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        $this->view->setLayout('index')
                    ->setTemplate('index')
                    ->add('posts', $posts)
                    ->render();
    }

    public function post($post_id)
    {
        if($this->request->get('comment'))
        {
            $text = $this->request->get('comment');
            $post_id = $this->request->get('post_id');
            $user_id = User::$id;

            $comment = new Comment();
            $comment->post_id = $post_id;
            $comment->text = $text;
            $comment->user_id = $user_id;
            $comment->save();

            $this->redirect('blog/'.$post_id);
        }

        try{
            /** @var Post $post */
            $post = Post::with('comments.author')->findOrFail($post_id);
            $post->views++;
            $post->save();

            $this->view->setLayout('index')
                ->setTemplate('post')
                ->add('post', $post)
                ->render();

        }catch (ModelNotFoundException $e){
            $this->pageNotFound();
        }
    }
}