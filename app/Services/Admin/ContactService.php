<?php

namespace App\Services\Admin;

use App\Enums\ContactStatus;
use App\Models\Contact;

class ContactService
{
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Display listing Contact.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function listContact($request)
    {
        $contact = $this->model->query();

        if ($request->full_name != '') {
            $contact->where('full_name', 'like', '%' . $request->full_name . '%');
        }

        if ($request->email != '') {
            $contact->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->status != '') {
            $contact->where('status', (int) $request->status);
        }

        return $contact->orderByDesc('created_at')->paginate(10);
    }

    /**
     * Delete contact.
     *
     * @param \App\Models\Contact $contact
     * @return boolean
     */
    public function delete($contact)
    {
        try {
            $contact->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update the specified resource
     *
     * @param \App\Models\Contact $contact
     * @return boolean
     */
    public function changeStatus($contact)
    {
        try {
            $contact['status'] == ContactStatus::READ ? $data = ['status' => ContactStatus::UNREAD] : $data = ['status' => ContactStatus::READ];
            $contact->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
