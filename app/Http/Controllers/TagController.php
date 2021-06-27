<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $result = Tag::where('tag', 'LIKE', '%' . $request->search . '%')->latest()->limit(20)->get();

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag'       => 'required',
            'model_id'  => 'required|integer',
            'model_type'=> 'required'
        ]);
        
        $class = 'App\\' .$request->model_type;

        $model = $class::whereId($request->model_id)->first();

        if (is_array($request->tag)) {

            if ($model->tags()->where('tag_id', $request->tag['id'])->exists()) {
                return true;
            }

            return $model->tags()->create(['tag_id' => $request->tag['id']]);
        }

        $tag = new Tag;
        $tag->tag = $request->tag;
        $tag->save();

        return $model->tags()->create(['tag_id' => $tag->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
