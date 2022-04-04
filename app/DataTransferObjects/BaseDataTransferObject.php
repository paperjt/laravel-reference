<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class BaseDataTransferObject extends DataTransferObject
{
    /**
     * @param Request $request
     * @return $this
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): self
    {
        return new static($request->validated());
    }
}
