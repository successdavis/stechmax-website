<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\Filters\ClientFilters;
use App\Filters\EmployeeFilters;
use App\Filters\NewsletterFilters;
use App\Filters\UserFilters;
use App\Http\Resources\ClientResourceSearch;
use App\Http\Resources\EmployeeResourceSearch;
use App\Http\Resources\UserResourceSearch;
use App\Newsletter;
use App\User;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = Newsletter::latest()->get();

        if (request()->wantsJson()) {
            return $newsletters;
        }

        return view('dashboard.newsletter.index', compact('newsletters'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }

    public function recievers(Request $request) {
        $request->validate([
            'sendTo' => 'string|required'
        ]);

        $s = $request->search;

        if (!isset($s)) {
            return [];
        }

        if ($request->sendTo === "user") {
            $filters = new UserFilters($request);
            $query = User::filter($filters);

            return UserResourceSearch::collection($query->get());
        }

        if ($request->sendTo === "client") {
            $filters = new ClientFilters($request);
            $query = Client::filter($filters);

            return ClientResourceSearch::collection($query->get());
        }

        if ($request->sendTo === "employee") {
            $filters = new EmployeeFilters($request);
            $query = Employee::filter($filters);

            return EmployeeResourceSearch::collection($query->get());
        }

        if ($request->sendTo === "tag") {
            // $filters = new EmployeeFilters($request);
            // $query = Employee::filter($filters);

            // return $query->get();
            return [];
        }

    }
}
