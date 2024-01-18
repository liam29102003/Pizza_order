<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contactList()

    {
        $rawData = Contact::orderBy('view','asc');
        $data = $rawData->paginate(5);
        
// dd($data->toArray());
        return view('admin.Contact.list',compact('data'));
    }
    
    public function filter($subject)
    {
        $data = Contact::orderBy('view','asc');

        if($subject == 'null')
        {
            $data = $data->paginate(5);
        }
      
        else
        {
            $data = $data->where('subject',$subject)->paginate(5);
        }
       
        // dd($data->toArray());
        // dd($id);
        return view('admin.Contact.list',compact('data'));

    }
    public function detail($id)
    {
        $data = Contact::where('id',$id)->first();
        return view('admin.Contact.detail',compact('data'));
    }
    public function delete($id)
    {
        $data = Contact::where('id',$id)->delete();
        return back();
    }
    public function index()
    {
        return view('user.contact');
    }
    public function send(Request $request)
    {
        $this->validateContactData($request);
       Contact::create($this->contactData($request));
       return back()->with(['Success' => 'Message Sent Successfully']);
    //    dd($this->contactData($request));

    }
    private function validateContactData($request)
    {
        Validator::make($request->all(),[
            'subject' =>'required',
            'message' => 'required',
        ])->validate();
    }
    private function contactData($request)
    {
        return [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,

            'OEmail' =>$request->oEmail,
            'OPhone' => $request->oPhone,
            'subject'=>$request->subject,
            'message'=>$request->message
        ];
    }
}
