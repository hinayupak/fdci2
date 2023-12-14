<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Contact::select('*'))
            ->addColumn('action', 'contacts.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('contacts.index');
    }

    public function store(Request $request)
    {  
  
        $contactId = $request->id;
  
        $contact   =   Contact::updateOrCreate(
                    [
                     'id' => $contactId
                    ],
                    [
                    'name' => $request->name, 
                    'company' => $request->company, 
                    'phone' => $request->phone, 
                    'email' => $request->email
                    ]);    
                          
        return Response()->json($contact);
    }
}
