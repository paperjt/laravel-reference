<?php

namespace App\Repositories;

use Illuminate\Http\Request;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected static Request $request;
    protected static array $allowedFilters = [];
    protected static array $allowedSorts = [];
    protected static array $allowedIncludes = [];

    /**
     * @param Request|null $request hydrated when Dependency Injected in a Controller
     */
    public function __construct(?Request $request) {
        self::$request = $request;
    }
}
