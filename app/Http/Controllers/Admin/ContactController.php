<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ContactService;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display listing contact.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = $this->contactService->listContact($request);

        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show contact.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {        
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Delete contact.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if ($this->contactService->delete($contact)) {
            return redirect()->back()->with('success', __('messages.contact.delete_success'));
        }

        return redirect()->back()->with('error', __('messages.contact.delete_fail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Contact $contact)
    {
        if ($this->contactService->changeStatus($contact)) {
            return redirect()->route('admin.contact.index')->with('success', __('messages.contact.change_status_success'));
        }

        return redirect()->back()->with('error', __('messages.contact.change_status_fail'));
    }
}
