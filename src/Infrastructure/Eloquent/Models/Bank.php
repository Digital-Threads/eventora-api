<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country', 'city', 'address'];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_banks');
    }


}
