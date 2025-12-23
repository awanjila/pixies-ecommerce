<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string',
                'phone' => 'required|string|max:20',
            ]);

            // Add a default subject for the email
            $validated['subject'] = 'New Contact Form Message from ' . $validated['name'];

            // Log the incoming request data
            Log::info('Contact form submission:', $validated);

            // Send email to admin - using direct email address
            Mail::to('keruboalice0@gmail.com')->send(new ContactFormMail($validated));

            // Send auto-reply to user
            Mail::to($validated['email'])->send(new ContactFormMail($validated, true));

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);

        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Contact form error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ], 500);
        }
    }
}
