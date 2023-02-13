<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    use HasFactory;

    protected $fillable = ['card_number', 'expired_month', 'expired_year', 'card_employee_name', 'balance', 'bank_id','currency_id'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }


}
