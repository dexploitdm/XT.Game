<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    public function get_all_games(Request $request) {
        $games = Games::paginate(27);

        if($request->query('select') === 'sale') {
            $games = DB::table('games')->whereNotNull('sale')->paginate(27);
        }

        return response()->json($games);
    }

    public function get_game($id) {
        $game = Games::find($id);
        return response()->json($game);
    }

    public function search(Request $request) {
        $games = Games::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->OrWhere('desc', 'like', '%' . $search . '%');
            })->paginate(8)
            ->withQueryString();

        return response()->json($games);
    }

    public function get_categories() {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function get_cat_games($id) {
        $category = Category::find($id)->toArray();
        $games = Games::with('categories')
            ->whereHas('categories', function($q) use ($id) {
                $q->where('id', $id);
            })->paginate(27)->toArray();

        #Получение списка категорий с привязаными играми
//        $categories = Category::with(['games' => function ($q) {
//            $q->orderBy('created_at', 'desc');
//        }])->paginate(10);

        $info = array_merge($games, $category);
        return response()->json([
            'data' => $info,
        ]);
    }
}
