<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmail;
use App\Mail\customMail;
use Illuminate\Support\Facades\Mail;
use Session;

/**
 * Class EmailController.
 */
class EmailController extends Controller
{
    /**
     * Show send email form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('/emails/email');
    }

    /**
     * Send email.
     *
     * @param SendEmail $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SendEmail $request)
    {
        Mail::to($request->emailto)->send(new customMail($request->subject, $request->body));

        Session::flash('done', true);

        return back();
    }
}
