<?php


namespace App\Http\Controllers\Main\Backend;

use Auth;
use ReflectionException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Scandinaver\User\Application\Query\LoginQuery;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;

/**
 * Class IndexController
 *
 * @package Application\Controllers\Admin
 * Created by PhpStorm.
 * User: whiskey
 * Date: 23.11.14
 * Time: 18:07
 */
class VueController extends Controller
{
    public function index()
    {
        return view('main.backend.vue');
    }

    /**
     * @param Request $request
     *
     * @return array|Factory|RedirectResponse|Redirector|View|mixed|void
     * @throws ValidationException
     * @throws ReflectionException
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'login'    => 'required',
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
        } catch (UserNotFoundException $e) {
            return view('main.backend.login', ['error' => true]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        setcookie('token', 'w', time() - 1000, '/', '.' . config('app.DOMAIN'));
        setcookie('user', 'w', time() - 1000, '/', '.' . config('app.DOMAIN'));

        Auth::logout();

        return response()->json(['success' => true, 'url' => config('app.SITE') . '/admin']);
    }

    /**
     *
     */
    public function testmail()
    {
        //Mail::send('mails.registration', [], function ($message){
        //    $message->from('support@scandinaver.org', 'Sender');
        //    $message->to('day_at_the_way@mail.ru')->subject('Test message');
        //});
    }
}