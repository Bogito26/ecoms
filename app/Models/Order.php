<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // Define available statuses
    public static $statuses = ['Pending', 'Processing', 'Completed', 'Cancelled'];

    // Fillable fields
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    /**
     * The user who placed this order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The items associated with this order
     */
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
public function items()
{
    return $this->hasMany(OrderItem::class);
}

}
