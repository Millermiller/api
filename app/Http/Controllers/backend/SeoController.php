<?php

/**
 * Class SeoController
 * @package Application\Controllers\Admin
 *
 * Created by PhpStorm.
 * User: user
 * Date: 15.05.2016
 * Time: 19:06
 *
 */

namespace Application\Controllers\Admin;

use Application\Models\Meta;
use Scandinaver\Classes\Controller;

class SeoController extends Controller{

    public function index()
    {
        $this->send(['data' => array_values(Meta::get()->sortByDesc('id')->toArray())]);
    }

    public function edit($id)
    {
        if($this->request->get('url'))
        {
            $data = [];

            $data['url']         = trim($this->request->get('url'));
            $data['title']       = trim($this->request->get('title'));
            $data['description'] = trim($this->request->get('description'));
            $data['keywords']    = trim($this->request->get('keywords'));

            $this->send(['success' => Meta::where('id', $id)->update($data)]);
        }
    }

    public function delete($id)
    {
        $this->send(['success' => Meta::destroy($id)]);
    }

    public function add()
    {
        $data['url'] = $this->request->get('url');
        $data['title'] = $this->request->get('title');
        $data['description'] = $this->request->get('description');
        $data['keywords'] = $this->request->get('keywords');

        $meta = new Meta($data);

        $this->send(['success' => $meta->save()]);
    }
}