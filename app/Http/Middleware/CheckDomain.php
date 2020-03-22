<?php

namespace App\Http\Middleware;

use App\Http\Requests\BaseRequest;
use Closure;
use Illuminate\Http\Request;
use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LanguageRepository;

/**
 * Class CheckDomain
 * @package App\Http\Middleware
 */
class CheckDomain
{
    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;

    /**
     * CheckDomain constructor.
     * @param LanguageRepositoryInterface $languageRepository
     */
    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  BaseRequest  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($langname = request('language')){
            switch ($langname){
                case 'is':
                    config(['app.lang' => 1]);
                    break;
                case 'sw':
                    config(['app.lang' => 2]);
                    break;
            }
            $request->request->add(['language' => $this->languageRepository->get(config('app.lang'))]);
        }

        $request->route()->forgetParameter('subdomain');

        return $next($request);
    }
}
