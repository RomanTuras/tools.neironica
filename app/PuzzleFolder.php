<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PuzzleFolder extends Model
{
    protected $fillable = [
        'name', 'alias', 'image', 'puzzles'
    ];

    /**
     * Decrementing puzzles quantity
     * @param $folderId
     */
    public function decrementPuzzles($folderId) {
        DB::table('puzzle_folders')
          ->where('id', '=', $folderId)->decrement('puzzles');
    }

    /**
     * Incrementing puzzles quantity
     * @param $folderId
     */
    public function incrementPuzzles($folderId) {
        DB::table('puzzle_folders')
          ->where('id', '=', $folderId)->increment('puzzles');
    }

    /**
     * Updating folder image
     * @param $id
     * @param $image
     */
    public function updateFolderImage($id, $image) {
        DB::table('puzzle_folders')
            ->where('id', '=', $id)
            ->update(['image' => $image]);
    }

    /**
     * Updating a folder name and alias
     * @param $id
     * @param $name
     * @param $alias
     */
    public function updateFolderName($id, $name, $alias) {
        DB::table('puzzle_folders')
          ->where('id', '=', $id)
            ->update(['name' => $name, 'alias' => $alias]);
    }

    /**
     * Getting all folders
     *
     * @param  bool  $isBackend
     *
     * @return Collection
     */
    public function getFolders($isBackend = false) {
        return $isBackend
            ? DB::table('puzzle_folders')
                ->orderBy('name')
                ->get()
            : DB::table('puzzle_folders')
                ->where('puzzles', '>', 0)
                ->orderBy('name')
                ->get();
    }

    /**
     * Getting folder image name
     * @param $id
     *
     * @return Model|Builder|object|null
     */
    public function getImageName($id) {
        return DB::table('puzzle_folders')
            ->where('id', '=', $id)
            ->select('image')->first();
    }

    /**
     * Checking is alias exist
     * @param $alias
     *
     * @return bool
     */
    public function isAliasExist($alias) {
        return DB::table('puzzle_folders')
            ->where('alias', 'LIKE', $alias)
            ->exists();
    }

    /**
     * Getting folder alias by ID
     * @param $folder_id
     *
     * @return Model|Builder|object|null
     */
    public function getAlias($folder_id) {
        return DB::table('puzzle_folders')->where('id', '=', $folder_id)->select(['alias'])->first();
    }

    /**
     * Inserting a folder name and alias
     * @param $name
     * @param $alias
     *
     * @return int
     */
    public function insertFolderName($name, $alias) {
        return DB::table('puzzle_folders')
                 ->insertGetId(
                     ['name' => $name, 'alias' => $alias, 'created_at' => now(), 'updated_at' => now(),]
                 );
    }
}
