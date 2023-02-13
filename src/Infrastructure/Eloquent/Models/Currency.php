<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['currency', 'rates'];

    protected $casts = [
        'rates' => 'array'
    ];
}
