<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\NextTextLevel;
use App\Http\Controllers\Controller;
use App\Models\Text;
use App\Models\TextResult;
use Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class TextController
 * @package Application\Controllers
 */
class TextController extends Controller
{

    public function getText($id)
    {
        if (!Auth::user()->hasText($id) && !Auth::user()->_admin)
            return response()->json(['success' => false, 'message' => 'Этот перевод недоступен']);
        else
            return response()->json(['success' => true, 'text' => Text::withCount('words')->with('textExtra')->find($id)]);
    }

    public function getSyns($id)
    {
        return response()->json([
            'success' => true,
            'sentences' => Text::getSynonyms($id)
        ]);
    }

    public function nextLevel()
    {
        $this->answer = ['succcess' => false];

        $text_id = Input::get('id');

        $next_text_id = Text::getNextLevel($text_id);// получаем id следующего набора

        if ($next_text_id &&
            !TextResult::where('text_id', $next_text_id)
                ->where('user_id', Auth::user()->id)
                ->get()
                ->count()
        ) {

            /** @var TextResult $result */
            $result = new TextResult(['text_id' => $next_text_id, 'user_id' => Auth::user()->id,]);

            if ($result->save()) {

                event(new NextTextLevel(Auth::user(),$result));

                return response()->json([
                    'success' => true,
                    'new_level' => $next_text_id,
                    'msg' => $result->text->title . $result->text->level,
                    'texts' => Text::getTextsByUser(Auth::user()->id)
                ]);
            }
        }
    }
}