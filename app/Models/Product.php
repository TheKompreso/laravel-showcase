<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    protected $casts = [
        'name'      => 'string',
        'price'     => 'float',
        'quantity'  => 'integer',
    ];

    public function productProperties(): HasMany
    {
        return $this->hasMany(ProductProperty::class);
    }
}
