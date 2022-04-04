<?php
 namespace App\Repositories;

 use App\Models\Blog;
 use Illuminate\Contracts\Pagination\LengthAwarePaginator;
 use Illuminate\Database\Eloquent\Collection;
 use Illuminate\Support\Facades\Auth;
 use Spatie\DataTransferObject\DataTransferObject;
 use Spatie\QueryBuilder\QueryBuilder;

 class BlogRepository extends BaseRepository
 {
     public const PER_PAGE = 15;

     protected static array $allowedFilters = ['name'];
     protected static array $allowedSorts = ['name'];
     protected static array $allowedIncludes = ['user'];

     /**
      * @return Collection
      */
     public static function getAll(): Collection
     {
         return QueryBuilder::for(Blog::class)
             ->allowedFilters(self::$allowedFilters)
             ->allowedSorts(self::$allowedSorts)
             ->allowedIncludes(self::$allowedIncludes)
             ->get();
     }

     /**
      * @param int $perPage
      * @return LengthAwarePaginator
      */
     public static function getAllPaginated(int $perPage = self::PER_PAGE): LengthAwarePaginator
     {
         return QueryBuilder::for(Blog::class)
             ->allowedFilters(self::$allowedFilters)
             ->allowedSorts(self::$allowedSorts)
             ->allowedIncludes(self::$allowedIncludes)
             ->paginate($perPage)
             ->withQueryString();
     }

     /**
      * @param int $id
      * @return Blog
      */
     public static function getById(int $id): Blog
     {
         return Blog::find($id);
     }

     /**
      * @param DataTransferObject $dto
      * @return Blog
      */
     public static function create(DataTransferObject $dto): Blog
     {
         return Auth::user()->blogs()->create($dto->toArray());
     }

     public static function update()
     {
         // TODO: Implement update() method.
     }

     public static function delete(int $id)
     {
         Blog::destroy($id);
     }
 }
