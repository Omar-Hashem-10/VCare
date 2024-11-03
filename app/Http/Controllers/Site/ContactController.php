<?php

namespace App\Http\Controllers\Site;

use App\Models\About;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::get();
        return view('web.site.pages.contact.index', compact('abouts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('site.contact.index')->with('success', 'Send Contact Successfully!');
    }
}
