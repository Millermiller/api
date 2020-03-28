<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Class LoginAdminController
 *
 * @package App\Http\Controllers\Auth
 */
class LoginAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectAfterLogout = '/admin';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return array|Factory|View|mixed
     */
    public function showLoginForm()
    {
        return config('app.lang') ? view('sub.backend.login') : view('main.backend.login');
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return 'login';
    }
}
