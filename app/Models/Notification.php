<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'inventory_id',
        'is_read',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
