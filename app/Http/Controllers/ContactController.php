<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->all();

        // validation
        $validator = Validator::make($data, [
            'email' => 'bail|required|email',
            'subject' => 'bail|required|string',
            'message' => 'bail|required|string',
            'subscription' => 'nullable|boolean'
        ], [
            'email.required' => 'La email è obbligatoria',
            'email.email' => 'La email non è valida',
            'subject.required' => 'Il messaggio deve avere un oggetto',
            'message.required' => 'Il messaggio deve avere un contenuto',
            'subscription.boolean' => 'Il valore del checkbox non è valido'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // check if user wants to subscribe to newsletter
        if (Arr::exists($data, 'subscription')) {
            $exists = Contact::where('email', $data['email'])->count();
            if (!$exists) {
                $contact = new Contact();
                $contact->email = $data['email'];
                $contact->save();
            }
        }

        // sending email
        $mail = new ContactMessageMail(
            sender: $data['email'],
            subject: $data['subject'],
            message: $data['message']
        );

        Mail::to(env('MAIL_FROM_ADDRESS'))->send($mail);

        return response(null, 204);
    }
}
