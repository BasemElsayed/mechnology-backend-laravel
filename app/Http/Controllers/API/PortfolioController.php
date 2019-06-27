<?php

namespace App\Http\Controllers\API;

use App\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Image;

class PortfolioController extends Controller
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
        $validator = Validator::make($request->all(), [ 
            'maintenancePlace' => 'required', 
            'maintenanceScope' => 'required', 
            'maintenanceDuration' => 'required', 
            'maintenanceDescription' => 'required', 
            'imageURL' => 'required'
        ]);
        if ($validator->fails()) 
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        //
        $port = new Portfolio();
        if($request->hasFile('imageURL'))
        {

            
            $image = $request->file('imageURL');
            $name = str_slug($request->maintenancePlace) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/portfolioImages');
            $imagePath = $destinationPath . '/' . $name;
            $image->move($destinationPath, $name);
            Image::make($imagePath)->resize(280, 215)->save();
            $port->imageURL = $name;
        }
        $port->maintenancePlace = $request->maintenancePlace;
        $port->maintenanceScope = $request->maintenanceScope;
        $port->maintenanceDuration = $request->maintenanceDuration;
        $port->maintenanceDescription = $request->maintenanceDescription;
        $port->maintenancePlaceArabic = $request->maintenancePlaceArabic;
        $port->maintenanceScopeArabic = $request->maintenanceScopeArabic;
        $port->maintenanceDurationArabic = $request->maintenanceDurationArabic;
        $port->maintenanceDescriptionArabic = $request->maintenanceDescriptionArabic;
        $port->save();
        $success['portfolio'] =  $port;
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
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
        $portfolios = DB::table('portfolios')->get();
        $success['portfolios'] =  $portfolios; 
        return response()->json($success, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $port = Portfolio::findOrFail($id);
        $input = $request->all(); 
        if($request->hasFile('imageURL'))
        {
            $image = $request->file('imageURL');
            $name = str_slug($port->maintenancePlace) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/portfolioImages');
            $imagePath = $destinationPath . '/' . $name;
            $image->move($destinationPath, $name);
            Image::make($imagePath)->resize(280, 215)->save();
            $input['imageURL'] = $name;
        }
        $port->update($input);
        return $port;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        //
        $port = Portfolio::find($id);
        if(!$port)
        {
            return response()->json('Empty Row', 401); 
        }
        $port->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
