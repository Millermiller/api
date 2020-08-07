<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Scandinaver\Learn\UI\Query\AssetsCountByLanguageQuery;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;
use Scandinaver\Learn\UI\Query\AudioCountByLanguageQuery;
use Scandinaver\Learn\UI\Query\AudioCountQuery;
use Scandinaver\Learn\UI\Query\TextsCountByLanguageQuery;
use Scandinaver\Learn\UI\Query\TextsCountQuery;
use Scandinaver\Learn\UI\Query\WordsCountByLanguageQuery;
use Scandinaver\Learn\UI\Query\WordsCountQuery;
use Scandinaver\User\UI\Query\UsersQuery;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:26
 * Class DashboardController
 *
 * @package Application\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        // $last_day_users = User::where('created_at', '>', Carbon::yesterday())->count();
        // $message_count = Message::all()->count();
        // $unread = Message::find(['readed' => 0]);

        return response()->json([
            'users' => $this->queryBus->execute(new UsersQuery()),
            'words' => $this->queryBus->execute(new WordsCountQuery()),
            'assets' => $this->queryBus->execute(new AssetsCountQuery()),
            'audio' => $this->queryBus->execute(new AudioCountQuery()),
            'texts' => $this->queryBus->execute(new TextsCountQuery()),
            //  'log'      => Activity::with('causer', 'subject')->get(),
            'messages' => $this->queryBus->execute(new MessagesQuery()),
        ]);
    }

    /**
     * @param  Language  $language
     *
     * @return JsonResponse
     */
    public function one(Language $language)
    {
        return response()->json([
            'words' => $this->queryBus->execute(new WordsCountByLanguageQuery($language)),
            'assets' => $this->queryBus->execute(new AssetsCountByLanguageQuery($language)),
            'audio' => $this->queryBus->execute(new AudioCountByLanguageQuery($language)),
            'texts' => $this->queryBus->execute(new TextsCountByLanguageQuery($language)),
        ]);
    }
}