<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    use NavigationDataTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::paginate(5);
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.contact.index', $navigationData, compact('contacts'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admincontact.index')->with('success', 'Deleted successfully!');
    }
}
