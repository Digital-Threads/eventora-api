<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = ['bank_account', 'currency_id', 'bank_id'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
