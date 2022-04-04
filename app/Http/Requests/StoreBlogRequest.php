<?php

namespace App\Http\Requests;

use App\DataTransferObjects\BlogDTO;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class StoreBlogRequest extends FormRequest implements BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    /**
     * @return BlogDTO
     * @throws UnknownProperties
     */
    public function data(): BlogDTO
    {
        return new BlogDTO([
            'name' => $this->input('name'),
        ]);
    }
}
