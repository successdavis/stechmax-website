<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncTagsController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'model_id'  => 'required|integer',
            'model_type'=> 'required'
        ]);
        
        $class = 'App\\' .$request->model_type;

        $model = $class::whereId($request->model_id)->first();
        $tags = $model->getAssociatedTags();

        return $tags;
    }

    public function delete(Request $request) {
        $request->validate([
            'tag'       => 'required',
            'model_id'  => 'required|integer',
            'model_type'=> 'required'
        ]);
        
        $class = 'App\\' .$request->model_type;

        $model = $class::whereId($request->model_id)->first();

        $model->tags()->where('tag_id', $request->tag['id'])->delete();

        return true;
    }
}
