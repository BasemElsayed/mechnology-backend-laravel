<?php

namespace App\Http\Controllers\API;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function show(Contact $contact)
    {
        //
        $contact = DB::table('contacts')->get();
        $success['contacts'] =  $contact; 
        return response()->json($success, 200);
    }

    public function update(Request $request)
    {
        $contact = Contact::findOrFail(1);
        $input = $request->all(); 
        $contact->update($input);
        return $contact;
    }
}
