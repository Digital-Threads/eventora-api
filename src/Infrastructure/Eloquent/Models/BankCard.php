<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Infrastructure\Enums\BankCardEnum;

class BankCard extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['card_number', 'expired_month', 'expired_year', 'card_employee_name', 'balance', 'bank_id', 'currency_id'];

    /**
     * @var string[]
     */
    protected $casts = [
        'card_type' => BankCardEnum::class
    ];

    /**
     * @return BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }


}
