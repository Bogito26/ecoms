<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = [
        'user_id', // store logged-in user's id if available
        'name',
        'email',
        'message',
        'reply', // admin reply
    ];

    /**
     * Relationship to the user who sent the message.
     * If no user_id (guest), return default 'Guest'.
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
            'email' => 'guest@example.com',
        ]);
    }

    /**
     * Get the display name of the sender.
     * Returns user name if logged-in, else the 'name' field from the message.
     */
    public function senderName()
    {
        return $this->user_id ? $this->user->name : $this->name;
    }

    /**
     * Get the display email of the sender.
     * Returns user email if logged-in, else the 'email' field from the message.
     */
    public function senderEmail()
    {
        return $this->user_id ? $this->user->email : $this->email;
    }
}
