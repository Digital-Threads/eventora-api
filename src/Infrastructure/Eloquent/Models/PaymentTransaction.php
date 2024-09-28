<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentTransaction
 *
 * @property int $id
 * @property int $ticket_id
 * @property float $amount
 * @property string $payment_method
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $transaction_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'amount', 'payment_method', 'status', 'transaction_date'];

    // Один ко многим: транзакция связана с билетом
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}