<?php

namespace Modules\Company\Http\Requests;

use Modules\Company\Dto\CompanyViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CompanyViewRequest",
 *     type="object",
 *     required={"id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1,
 *         description="ID of the company to view"
 *     )
 * )
 */
class CompanyViewRequest extends FormRequest
{
    /**
     * Определить, авторизован ли пользователь делать этот запрос.
     * Мы не выполняем авторизацию здесь.
     */
    public function authorize(): bool
    {
        return true; // Авторизация будет в экшене.
    }

    /**
     * Получить правила валидации, применимые к запросу.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:companies,id',
        ];
    }

    /**
     * Преобразовать запрос в DTO для дальнейшей обработки.
     */
    public function toDto(): CompanyViewRequestDto
    {
        return new CompanyViewRequestDto($this->route('id'));
    }
}
