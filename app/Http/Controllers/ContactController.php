<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function showForm()
    {
        $userEmail = auth()->check() ? auth()->user()->email : null;

        // Fetch the latest message by this user if logged in
        $latestMessage = $userEmail ? Message::where('email', $userEmail)->latest()->first() : null;

        return view('contact', [
            'adminReply' => $latestMessage ? $latestMessage->reply : null
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Fetch the message just created so we can pass admin reply if it exists
        $latestMessage = Message::where('email', $request->email)->latest()->first();

        return redirect()->back()->with([
            'success' => 'Your message has been sent!',
            'adminReply' => $latestMessage ? $latestMessage->reply : null
        ]);
    }
}
