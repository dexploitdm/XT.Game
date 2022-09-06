<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Selection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Image;

class SelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        $selection = Selection::all();

        return \inertia('lk/selection/list',[
            'selection' => $selection
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return \inertia('lk/selection/add');

//        return Inertia::render(
//            'lk/selection/add',
//            [
//                'games' => Games::query()
//                    ->when(Request::input('search'), function ($query, $search) {
//                        $query->where('title', 'like', '%' . $search . '%')
//                            ->OrWhere('desc', 'like', '%' . $search . '%');
//                    })->paginate(8)
//                    ->withQueryString(),
//            ]
//        );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $selection = new Selection();
        $selection->title = $request->title;

        $area = json_encode($request->game_ids);
        $selection->game_ids = $area;

        if($request->cover != '') {
            $strpos = strpos($request->cover, ';');
            $sub = substr($request->cover,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->cover);
            $upload_path = public_path().'/uploads/selection/';
            $img->save($upload_path.$name);
            $selection->cover = $name;
        }

        $selection->save();
        return Redirect::route('selection.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function show(Selection $selection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit($id)
    {
        $selection = Selection::find($id);
        $listSelectGame = [];

        $area = json_decode($selection->game_ids, true);
        foreach ((array) $area as $se){
            $game = Games::find($se['id']);
            $listSelectGame[] = $game;

        }

        return \inertia('lk/selection/edit', [
            'selection' => $selection,
            'listSelectGame' => $listSelectGame
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $selection = Selection::find($id);
        $selection->title = $request->title;

        $area = json_encode($request->game_ids);
        $selection->game_ids = $area;

        if($selection->cover != $request->cover) {
            $strpos = strpos($request->cover, ';');
            $sub = substr($request->cover,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->cover);
            $upload_path = public_path().'/uploads/selection/';
            $image = $upload_path. $selection->cover;
            $img->save($upload_path.$name);
            if(file_exists($image)) {
                @unlink($image);
            }
        } else {
            $name = $selection->cover;
        }
        $selection->cover = $name;
        $selection->save();
        return Redirect::route('selection.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selection  $selection
     */
    public function destroy($id)
    {
        $selection = Selection::findOrFail($id);
        $image_path = public_path()."/uploads/selection/";
        $image = $image_path. $selection->cover;
        if(file_exists($image)) {
            @unlink($image);
        }
        $selection->delete();
        return back();
    }

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
