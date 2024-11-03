<?php

namespace App\Http\Controllers\API;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::get();
        return $this->responseSuccess('Data Retrieved Successfully', $contacts->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->responseSuccess('Created Successfully', $contact->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return $this->responseSuccess('Retreieved Successfully', $contact->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return $this->responseSuccess('updated Successfully', $contact->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->responseSuccess('Deleted Successfully', $contact->toArray());
    }
}
