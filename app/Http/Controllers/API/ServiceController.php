<?php

namespace App\Http\Controllers\API;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
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
        //'name', 'description', 'imageURL', 'nameArabic', 'descriptionArabic',
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'description' => 'required', 
            'imageURL' => 'required'
        ]);
        if ($validator->fails()) 
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $service = new Service();
        if($request->hasFile('imageURL'))
        {
            $image = $request->file('imageURL');
            $name = str_slug($request->name) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $imagePath = $destinationPath . '/' . $name;
            $image->move($destinationPath, $name);
            $service->imageURL = $name;
        }
        $service->name = $request->get('name');
        $service->description = $request->get('description');
        $service->nameArabic = $request->get('nameArabic');
        $service->descriptionArabic = $request->get('descriptionArabic');
        $service->save();
        
        $success['service'] =  $service; 
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
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
        $services = DB::table('services')->get();
        $success['services'] =  $services; 
        return response()->json($success, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $input = $request->all(); 
        if($request->hasFile('imageURL'))
        {
            $image = $request->file('imageURL');
            $name = str_slug($service->name) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $imagePath = $destinationPath . '/' . $name;
            $image->move($destinationPath, $name);
            $input['imageURL'] = $name;
        }
        $service->update($input);
        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $service = Service::find($id);
        if(!$service)
        {
            return response()->json('Empty Playground', 401); 
        }
        $service->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
