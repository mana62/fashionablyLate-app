<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Http\Requests\ContactFormRequest ;

class ContactController extends Controller
{
    public function index()
    {
        return view('form.index');
    }

    public function confirm(ContactFormRequest  $request)
    {
        $contact = $request->only(['name', 'email', 'tell', 'content']);
        return view('form.confirm', compact('contact'));
    }

    public function store(ContactFormRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tell', 'content']);
        Form::create($contact);
        return view('form.thanks');
    }

}