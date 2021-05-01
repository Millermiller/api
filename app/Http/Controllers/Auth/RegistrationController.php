<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\UI\Command\CreateUserCommand;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Auth
 */
class RegistrationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Handle a registration request for the application.
     *
     * @param  SignupRequest  $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function handle(SignupRequest $request): JsonResponse
    {
        /** @var UserInterface $user */
        $user = $this->commandBus->execute(new CreateUserCommand($request->toArray()));

        $this->guard()->login($user);
        $tokenResult = auth()->user()->createToken('Personal Access Token');
        $tokenResult->token->save();

        return response()->json(['user' => $user, 'access_token' => $tokenResult->accessToken]);
    }
}
