<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
            'phone' => 'nullable|string'
        ], [
            'email.unique' => 'You are already subscribed!'
        ]);

        $subscription = Subscription::create([
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully'
        ]);
    }
} 