<?php

namespace App\Http\Controllers\Sub\Backend;

use Auth;
use ReflectionException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Validation\ValidationException;
use Scandinaver\User\Application\Query\LoginQuery;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;

/**
 * Created by PhpStorm.
 * User: Миллер
 * Date: 29.05.2017
 * Time: 19:05
 *
 * Class VueController
 * @package Application\Controllers\Admin
 */
class VueController extends Controller
{
    public function index()
    {
        return view('sub.backend.vue');
    }

    /**
     * @param Request $request
     * @return array|Factory|RedirectResponse|Redirector|View|mixed|void
     * @throws ValidationException
     * @throws ReflectionException
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required',
                'password' => 'required',
            ],
            [
                'required' => 'Поле :attribute должно быть заполнено.',
            ]
        );

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        $request->merge(
            [
                $login_type => $request->input('login')
            ]
        );

        try {//TODO: сделать нормально
            $this->queryBus->execute(new LoginQuery($request->only($login_type, 'password')));
            return redirect('/admin');
        }
        catch (UserNotFoundException $e){
            return view('backend.login', ['error' => true]);
        }
    }

    public function logout()
    {
        setcookie('token', 'w', time() - 1000, '/', '.' . config('app.DOMAIN'));
        setcookie('user', 'w', time() - 1000, '/', '.' . config('app.DOMAIN'));

        Auth::logout();

        return response()->json(['success' => true, 'url' => config('app.SITE') . '/admin']);
    }
}