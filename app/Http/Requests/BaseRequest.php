<?php

namespace App\Http\Requests;

use Spatie\DataTransferObject\DataTransferObject;

interface BaseRequest
{
    public function rules(): array;

    public function data(): DataTransferObject;
}
