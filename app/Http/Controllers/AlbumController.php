<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Album;
use App\Models\User;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('auth.album.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.album.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'year' => 'required|numeric|gte:1900|lte:'.date('Y'),
                'artist' =>  'required'
            ]
        );

        $album = new Album();
        $album->name = $request->input('name');
        $album->artist = $request->input('artist');
        $album->year = $request->input('year');
        $album->save();
        return redirect('/albums');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Album::find($id)->toJson();         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);
        return view('auth.album.form',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'year' => 'required|numeric|gte:1900|lte:'.date('Y'),
                'artist' =>  'required'
            ]
        );
        
        $album = Album::find($id);
        
        if(isset($album)) 
        {
            $album->name = $request->input('name');
            $album->artist = $request->input('artist');
            $album->year = $request->input('year');
            $album->save();
            return redirect('/albums');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->role == 'admin') 
        {
            $album = album::find($id);
            if(isset($album)) 
            {
                $album->delete();
            }
        } 
        else 
        {
            return json_encode(['msg'=>'You do not have right do delete records.']);
        }
    }
}