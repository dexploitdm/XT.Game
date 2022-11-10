<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        $slider = Slider::all();

        return \inertia('lk/slider/list',[
            'slider' => $slider
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return \inertia('lk/slider/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $slider = new Slider();

        $slider->game_id = $request->game_id;

        if($request->cover != '') {
            $strpos = strpos($request->cover, ';');
            $sub = substr($request->cover,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->cover)->encode('webp', 90);
            $upload_path = public_path().'/uploads/slider/';
            $img->save($upload_path.$name);
            $slider->cover = $name;
        }

        $slider->save();
        return Redirect::route('slider.index');
    }

    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Selection  $selection
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        $selectGame = [];

        $area = json_decode($slider->game_id, true);

        $game = Games::find($slider->game_id);
        $selectGame[] = $game;

        return \inertia('lk/slider/edit', [
            'slider' => $slider,
            'selectGame' => $selectGame
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
        $slider = Slider::find($id);

        $slider->game_id = $request->game_id;

        if($slider->cover != $request->cover) {
            $strpos = strpos($request->cover, ';');
            $sub = substr($request->cover,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->cover)->encode('webp', 90);
            $upload_path = public_path().'/uploads/slider/';
            $image = $upload_path. $slider->cover;
            $img->save($upload_path.$name);
            if(file_exists($image)) {
                @unlink($image);
            }
        } else {
            $name = $slider->cover;
        }
        $slider->cover = $name;
        $slider->save();
        return Redirect::route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selection  $selection
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $image_path = public_path()."/uploads/slider/";
        $image = $image_path. $slider->cover;
        if(file_exists($image)) {
            @unlink($image);
        }
        $slider->delete();
        return back();
    }
}
