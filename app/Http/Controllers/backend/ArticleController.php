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

use Application\Models\Meta;
use Application\Models\Post;
use Scandinaver\Classes\Controller;
use Scandinaver\Classes\User;
use Intervention\Image\ImageManagerStatic as Image;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

class ArticleController extends Controller
{

    public function index()
    {
        $this->send([
            'articles' =>  array_values(Post::with(['category', 'comments'])->get()->sortByDesc('id')->toArray())
        ]);
    }

    public function article($id)
    {
        $this->send([
            'success' => true,
            'data' => Post::with(['category', 'comments'])->find($id),
            'meta' => Meta::firstOrCreate(['url' =>  '/blog/' . $id])
        ]);
    }

    public function add()
    {
        $this->answer['success'] = false;

        if ($this->request->get('text')) {

            $data = [];
            $seodata = [];

            $data['user_id'] = User::$id;
            $data['post_content'] = $this->request->get('text');
            $data['post_name'] = $this->request->get('title');
            $data['category_id'] = $this->request->get('category');
            $data['post_anonse'] = $this->request->get('anonse');
            $data['post_status'] = $this->request->get('post_status');
            $data['comment_status'] = $this->request->get('comment_status');

            $seodata['title'] = $this->request->get('seotitle');
            $seodata['description'] = $this->request->get('description');
            $seodata['keywords'] = $this->request->get('keywords');

            $post = new Post($data);
            $this->answer['success'] = $post->save();

            $seodata['url'] = '/blog/' . $post->id;

            $meta = new Meta($seodata);
            $meta->save();
        }

        $this->send();
    }

    public function edit($post_id)
    {
        if ($this->request->get('text')) {
            $data = [];
            $seodata = [];

            $data['user_id']        = User::$id;
            $data['post_content']   = trim($this->request->get('text'));
            $data['post_name']      = trim($this->request->get('title'));
            $data['category_id']    = $this->request->get('category');
            $data['post_anonse']    = trim($this->request->get('anonse'));
            $data['post_status']    = $this->request->get('post_status');
            $data['comment_status'] = (int) $this->request->get('comment_status');

            $seodata['title'] = trim($this->request->get('seotitle'));
            $seodata['description'] = trim($this->request->get('description'));
            $seodata['keywords'] = trim($this->request->get('keywords'));

            $meta = Meta::where('id', $this->request->get('meta_id'))->update($seodata);
            $post = Post::where('id', $post_id)->update($data);

            $this->answer['success'] = ($meta && $post);
        }

        $this->send();
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if ($post->delete())
            $this->answer = ['success' => true];
        else
            $this->answer = ['success' => false];

        $this->send();
    }

    public function search()
    {
        $search = $this->request->get('q');

        $this->send([
            'success' => true,
            'articles' => Post::with(['category', 'comments'])->where(function ($query) use ($search) {
                $query->where('post_name', 'LIKE', "%{$search}%");
            })->get()
        ]);
    }

    public function upload()
    {
        $storage = new FileSystem(PUBLIC_PATH.'/uploads/articles/');
        $file = new File('img', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            new Mimetype(array('image/png','image/jpg','image/jpeg')),
            new Size('5M')
        ));

        try {
            $file->upload();
            $url = '/uploads/articles/'.$file->getNameWithExtension();

            // Image::configure(array('driver' => 'GD'));
            $img = Image::make(PUBLIC_PATH.$url);

            if($img->getWidth() > 1000)
                $img->widen(600);

            if($img->getHeight() > 1000)
                $img->heighten(600);

            $img->save(null, 100);
            $this->answer['success']  = true;
            $this->answer['data'] = $url;
        } catch (\Exception $e) {
            $this->answer['success']  = false;
            $this->answer['msg']  = $e->getMessage();
        }

        $this->send();
    }
}