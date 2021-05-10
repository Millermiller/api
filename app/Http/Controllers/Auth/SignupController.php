<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\UI\Command\CreateUserCommand;

/**
 * Class SignupController
 *
 * @package App\Http\Controllers\Auth
 */
class SignupController extends Controller
{
    use RegistersUsers;

    /**
     * @param  SignupRequest  $request
     *
     * @return JsonResponse
     */
    public function __invoke(SignupRequest $request): JsonResponse
    {
        /** @var UserInterface $user */
        $user = $this->commandBus->execute(new CreateUserCommand($request->toArray()));

       // $this->guard()->login($user);
        $tokenResult = auth()->user()->createToken('Personal Access Token');
        $tokenResult->token->save();

        return response()->json(['user' => $user, 'access_token' => $tokenResult->accessToken]);
    }
}