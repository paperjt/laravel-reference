<?php

namespace App\Repositories;

use Spatie\DataTransferObject\DataTransferObject;

interface BaseRepositoryInterface
{
    public const PER_PAGE = 15;

    public static function getAll();

    public static function getAllPaginated(int $perPage = self::PER_PAGE);

    public static function getById(int $id);

    public static function create(DataTransferObject $dto);

    public static function update();

    public static function delete(int $id);

}
