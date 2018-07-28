<?php

/**
 * Class UsersController
 * @package Application\Controllers\Admin
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 29.11.14
 * Time: 18:47
 */

namespace Application\Controllers\Admin;

use Application\Models\User;
use Carbon\Carbon;
use Scandinaver\Classes\Controller;

class UsersController extends Controller
{

    public function index()
    {
        $this->send([
            'users' => User::all()
        ]);
    }

    public function active()
    {
        $this->answer['success'] = User::where('id', $this->request->get('id'))
            ->update(['active_to' => Carbon::parse($this->request->get('data'))]);

        $this->answer['active'] = (Carbon::parse($this->request->get('data')) > Carbon::today()) ? true : false;

        \Scandinaver\Classes\User::updateCookies();

        $this->send();
    }

    public function delete($id)
    {
        $this->send(['success'=> User::find($id)->delete()]);
    }

    public function user($id)
    {
        $this->send([User::find($id)]);
    }

    public function search()
    {
        $search = $this->request->get('q');

        $this->send([
            'success' => true,
            'users' => User::where(function ($query) use ($search) {
                $query->where('login', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })->get()
        ]);
    }
}