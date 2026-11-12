<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Update the contact section settings (single-record model).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'section_label'      => ['nullable', 'string', 'max:255'],
            'section_heading'    => ['nullable', 'string', 'max:255'],
            'subtext'            => ['nullable', 'string'],
            'form_action'        => ['nullable', 'string', 'max:500'],
            'button_label'       => ['nullable', 'string', 'max:255'],
            'show_name'          => ['nullable', 'in:0,1,true,false'],
            'show_email'         => ['nullable', 'in:0,1,true,false'],
            'show_subject'       => ['nullable', 'in:0,1,true,false'],
            'show_message'       => ['nullable', 'in:0,1,true,false'],
            'recaptcha_key'      => ['nullable', 'string', 'max:255'],
            'notification_email' => ['nullable', 'string', 'email', 'max:255'],
            'auto_reply'         => ['nullable', 'string'],
        ]);

        // Convert boolean fields
        foreach (['show_name', 'show_email', 'show_subject', 'show_message'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = filter_var($validated[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }

        $contact = Contact::firstOrFail();
        $contact->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Contact section updated successfully.',
                'data' => $contact->fresh(),
            ]);
        }

        return back()->with('success', 'Contact section updated successfully.');
    }

    /**
     * Handle the public contact form submission.
     * Creates a new Message record from the contact form.
     * Supports AJAX (JSON) responses.
     */
    public function post(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        // Generate initials from the name
        $nameParts = explode(' ', trim($validated['name']));
        $initials = strtoupper(
            count($nameParts) >= 2
                ? substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)
                : substr($nameParts[0], 0, 2)
        );

        $msg = Message::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'subject'  => $validated['subject'] ?? 'No Subject',
            'body'     => $validated['message'],
            'initials' => $initials,
            'is_read'  => false,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!',
            ]);
        }

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
