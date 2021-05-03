<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
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

    public function all(string $language): JsonResponse
    {
        // $last_day_users = User::where('created_at', '>', Carbon::yesterday())->count();
        // $message_count = Message::all()->count();
        // $unread = Message::find(['readed' => 0]);

        return response()->json([
                //'users'    => $this->execute(new UsersQuery()),
                //'words'    => $this->execute(new WordsCountQuery()),
                //'assets'   => $this->execute(new AssetsCountQuery($language)),
                //'audio'    => $this->execute(new AudioCountQuery()),
                //'texts'    => $this->execute(new TextsCountQuery()),
                //  'log'      => Activity::with('causer', 'subject')->get(),
                //'messages' => $this->execute(new MessagesQuery()),
            ]);
    }

    public function one(string $language): JsonResponse
    {
        return response()->json([
                'words'  => $this->execute(new WordsCountByLanguageQuery($language)),
                'assets' => $this->execute(new AssetsCountByLanguageQuery($language)),
                'audio'  => $this->execute(new AudioCountByLanguageQuery($language)),
                'texts'  => $this->execute(new TextsCountByLanguageQuery($language)),
            ]);
    }
}