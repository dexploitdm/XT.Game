<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Selection;
use App\Http\Requests\StoreSelectionRequest;
use App\Http\Requests\UpdateSelectionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

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
        //return \inertia('lk/selection/add');



        return Inertia::render(
            'lk/selection/add',
            [
                'games' => Games::query()
                    ->when(Request::input('search'), function ($query, $search) {
                        $query->where('title', 'like', '%' . $search . '%')
                            ->OrWhere('desc', 'like', '%' . $search . '%');
                    })->paginate(8)
                    ->withQueryString(),
            ]
        );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSelectionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $selection = new Selection();
        $selection->title = $request->title;
//        $array = implode(',', $request->game_ids);
//        $selection->game_ids = $array;

        $area = json_encode($request->game_ids);
        $selection->game_ids = $area;


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
     * @return \Illuminate\Http\Response
     */
    public function edit(Selection $selection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSelectionRequest  $request
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSelectionRequest $request, Selection $selection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selection $selection)
    {
        //
    }

    public function get_selection_games($id) {
        $selection = Selection::find($id);

        $listSelectGame = [];

        $area = json_decode($selection->game_ids, true);

        foreach ((array) $area as $se){
            $game = Games::find($se['id']);
            $listSelectGame[] = $game;

        }


        return response()->json($listSelectGame);
    }
}
