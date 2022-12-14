<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;

class GameController extends Controller
{
    public function index() {
        $games = Games::orderBy('id', 'desc')
            ->paginate(6);

        return \inertia('lk/game/list',[
            'games' => $games
        ]);
    }

    public function create() {
        $category = Category::all();
        return \inertia('lk/game/add',[
            'category' => $category
        ]);
    }

    public function store(Request $request) {
        $game = new Games();
        $game->title = $request->title;
        $game->desc = $request->desc;

        if($request->cover != '') {
            $strpos = strpos($request->cover, ';');
            $sub = substr($request->cover,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->cover);
            $upload_path = public_path().'/uploads/games/';
            $img->save($upload_path.$name);
            $game->cover = $name;
        } else {
            $game->cover = 'preview.png';
        }

        $game->content = $request->content;
        $game->price = $request->price;
        $game->sale = $request->sale;
        $game->category_id = $request->category_id;
        $game->xbox_one = $request->xbox_one;
        $game->xbox_sx = $request->xbox_sx;
        $game->save();

        return Redirect::route('game.index');
    }

    public function show($id) {

    }

    public function edit($id) {
        $game = Games::find($id);
        $category = Category::all();

        return \inertia('lk/game/edit', [
            'game' => $game,
            'category' => $category
        ]);
    }

    public function update(Request $request, $id) {
        $game = Games::find($id);
        $game->title = $request->title;
        $game->desc = $request->desc;

        if($game->cover != $request->cover) {
            $strpos = strpos($request->cover, ';');
            $sub = substr($request->cover,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->cover);
            $upload_path = public_path().'/uploads/games/';
            $image = $upload_path. $game->cover;
            $img->save($upload_path.$name);
            if(file_exists($image)) {
                @unlink($image);
            }
        } else {
            $name = $game->cover;
        }

        $game->cover = $name;
        $game->content = $request->content;
        $game->price = $request->price;
        $game->sale = $request->sale;
        $game->category_id = $request->category_id;
        $game->xbox_one = $request->xbox_one;
        $game->xbox_sx = $request->xbox_sx;
        $game->save();

        return Redirect::route('game.index');
    }

    public function destroy($id){
        $game = Games::findOrFail($id);
        $image_path = public_path()."/uploads/games/";
        $image = $image_path. $game->cover;
        if(file_exists($image)) {
            @unlink($image);
        }
        $game->delete();
        return back();
    }
}
