<?php

namespace App\Http\Controllers\API;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Image;

class TeamController extends Controller
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
    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',  
            'imageURL' => 'required'
        ]);
        if ($validator->fails()) 
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $team = new Team();
        if($request->hasFile('imageURL'))
        {
            $image = $request->file('imageURL');
            $name = str_slug($request->name) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/teamImages');
            $imagePath = $destinationPath . '/' . $name;
            $image->move($destinationPath, $name);
            Image::make($imagePath)->resize(200, 120)->save();
            $team->imageURL = $name;
        }
        $team->name = $request->get('name');
        $team->save();

        $success['team'] =  $team; 
        return response()->json(['success'=>$success], 200);
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
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
        $teams = DB::table('teams')->get();
        $success['teams'] =  $teams; 
        return response()->json($success, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        //
        $team = Team::find($id);
        if(!$team)
        {
            return response()->json('Empty Row', 401); 
        }
        $team->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
