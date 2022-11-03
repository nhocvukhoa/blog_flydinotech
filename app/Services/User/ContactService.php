<?php

namespace App\Services\User;

use App\Enums\ContactStatus;
use App\Models\Contact;
use Carbon\Carbon;

class ContactService
{
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new contact.
     *
     * @param \Illuminate\Http\ContactRequest  $request
     * @return boolean
     */
    public function create($request)
    {
        try {
            $this->model->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'content' => $request->content,
                'status' => ContactStatus::UNREAD,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
