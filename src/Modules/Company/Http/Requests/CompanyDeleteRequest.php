<?php

namespace Modules\Company\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\Company\Dto\CompanyDeleteRequestDto;

class CompanyDeleteRequest extends FormRequest
{
    /**
     * Определить, авторизован ли пользователь делать этот запрос.
     * Мы не делаем проверку здесь, а оставляем это для экшена.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Авторизация будет в экшене.
    }

    /**
     * Получить правила валидации, применимые к запросу.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:companies,id',
        ];
    }

    /**
     * Преобразовать запрос в DTO для дальнейшей обработки.
     *
     * @return CompanyDeleteRequestDto
     */
    public function toDto(): CompanyDeleteRequestDto
    {
        return new CompanyDeleteRequestDto($this->route('id'));
    }
}
