<?php

namespace App\Http\Controllers;

use App\coporatetraining;
use Illuminate\Http\Request;

class CoporatetrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        request()->validate([
            'coporate'      => 'required|array',
            'courses'       =>  'required|array',
        ]);
        
        $coporate = auth()->user()->createCoporateTraining($request->coporate);
        $coporate->addCourses($request->courses);
        
        if (!empty($request->schedule)) {
            $coporate->addSchedule($request->schedule);
        }

        return Response('',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coporatetraining  $coporatetraining
     * @return \Illuminate\Http\Response
     */
    public function show(coporatetraining $coporatetraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coporatetraining  $coporatetraining
     * @return \Illuminate\Http\Response
     */
    public function edit(coporatetraining $coporatetraining)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coporatetraining  $coporatetraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coporatetraining $coporatetraining)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coporatetraining  $coporatetraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(coporatetraining $coporatetraining)
    {
        //
    }
}
