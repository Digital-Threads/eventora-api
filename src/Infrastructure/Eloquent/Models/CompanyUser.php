<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\CompanyUser
 *
 * @property int         $id
 * @property int         $company_id
 * @property int         $user_id
 * @property string      $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class CompanyUser extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'user_id',
        'role',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'company_id' => 'integer',
        'user_id' => 'integer',
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
