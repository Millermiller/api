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

use Application\Models\Category;
use Scandinaver\Classes\Controller;

class CategoryController extends Controller
{
    public function categories()
    {
       $this->send(['data' => Category::all()]);
    }

    public function add()
    {
        $name = $this->request->get('name');
        $category = new Category(['name' => $name]);

        if ($category->save())
            $this->answer = ['success' => true, 'id' => $category->id, 'name' => $name];
        else
            $this->answer = ['success' => false];

        $this->send();
    }

    public function delete($id)
    {
        if (Category::destroy($id))
            $this->answer = ['success' => true];
        else
            $this->answer = ['success' => false];

        $this->send();
    }

    public function edit($id)
    {
        $this->send([
            'success' => Category::where('id', $id)->update(['name' => $this->request->get('name')])
        ]);
    }
}