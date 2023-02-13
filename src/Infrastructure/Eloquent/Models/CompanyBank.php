<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBank extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'bank_id'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
