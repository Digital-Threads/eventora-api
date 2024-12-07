<?php

namespace Modules\Company\Http\Requests;

use Modules\Company\Dto\CompanyDeleteRequestDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CompanyDeleteRequest",
 *     type="object",
 *     required={"id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1,
 *         description="ID of the company to delete"
 *     )
 * )
 */
class CompanyDeleteRequest extends FormRequest
{
    /**
     * Определить, авторизован ли пользователь делать этот запрос.
     * Мы не делаем проверку здесь, а оставляем это для экшена.
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
    public function toDto(): CompanyDeleteRequestDto
    {
        return new CompanyDeleteRequestDto($this->route('id'));
    }
}
