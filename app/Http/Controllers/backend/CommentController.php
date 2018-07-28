<?php

/**
 * Class ArticleController
 * @package Application\Controllers\Admin
 *
 * Created by PhpStorm.
 * User: user
 * Date: 11.05.2016
 * Time: 17:15
 */

namespace Application\Controllers\Admin;

use Application\Models\Comment;
use Scandinaver\Classes\Controller;

class CommentController extends Controller
{
    public function search()
    {
        $search = $this->request->get('q');

        $this->send([
            'success' => true,
            'comments' => Comment::with(['author', 'post'])->where(function ($query) use ($search) {
                $query->where('text', 'LIKE', "%{$search}%");
            })->get()
        ]);
    }

    public function comments()
    {
        if($this->request->get('id'))
            $this->send(['data' => Comment::where('post_id', '=', $this->request->get('id'))->get()]);
        else
            $this->send(['data' => Comment::all()]);
    }

    public function delete($id)
    {
        if (Comment::destroy($id))
            $this->answer = ['success' => true];
        else
            $this->answer = ['success' => false];

        $this->send();
    }
}