<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CompanyUser
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property string $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class CompanyUser extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'user_id',
        'role',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'company_id' => 'integer',
        'user_id'    => 'integer',
    ];

    /**
     * Связь с моделью компании.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Связь с моделью пользователя.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}