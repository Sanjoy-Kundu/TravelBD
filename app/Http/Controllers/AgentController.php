<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    /**
     * agent create page for dashboard
     */
        public function agentLoginPage(){
        try{
            return view("/form.agent.login");
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }






    /**
     * Agent create page for dashboard
     */
        /**
     * Staff create page
     */
    public function agentCreatePage()
    {
        try {
            return view('pages.backend.agent.agentCreatePage');
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
        }
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
