<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function messageList(){
        $messages = Contact::paginate(3);
        return view('admin.contact.list',compact('messages'));
    }

    //message delete
    public function messageDelete($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#messageList')->with(['deleteSuccess'=>'Product Delete Successfully...']);
    }

    //message detail
    public function messageDetail($id){
        $message = Contact::where('id',$id)->first();
        // dd($message->toArray());
        return view('admin.contact.detail',compact('message'));
    }
}
