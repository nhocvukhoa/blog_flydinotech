<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ContactRequest;
use App\Services\User\ContactService;
use Session;

class ContactController extends Controller
{
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

     /**
     * Form contact
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.contact.index');
    }

     /**
     * create a new contact
     *
     * @param App\Http\Requests\User\ContactRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(ContactRequest $request, $language)
    {
        if ($this->contactService->create($request)) {
            Session::put('website_language', $language);

            return redirect()->back()->with('success', __('messages.contact.create_success'));
        }

        return redirect()->back()->with('error', __('messages.contact.create_fail'));
    }
}
