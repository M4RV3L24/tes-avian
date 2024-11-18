<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
