<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'discount',
        'description',
        'type',
        'external_code',
        'barcodes',
        'additional_features',
    ];

    public function characteristics()
    {
        return $this->hasMany(ProductCharacteristic::class);
    }
}
