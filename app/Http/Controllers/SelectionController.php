<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Selection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SelectionController extends Controller
{
    public function get_selections() {
        $selection = Selection::all();
        return response()->json($selection);
    }

    public function get_selection_games($id) {
        $selection = Selection::find($id);

        $listSelectGame = [];

        $area = json_decode($selection->game_ids, true);

        foreach ((array) $area as $se){
            $game = Games::find($se['id']);
            $listSelectGame[] = $game;

        }

        return response()->json([
            'data' => $selection,
            'listSelectGame' => $listSelectGame
        ]);
    }
}
