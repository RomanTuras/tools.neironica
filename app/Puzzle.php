<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Puzzle extends Model
{
    protected $fillable = [
        'folder_id', 'image', 'preview_image', 'width', 'height', 'ratio'
    ];

    public function puzzleTables() {
        return $this->belongsToMany(PuzzleFolder::class);
    }

    /**
     * Deleting a puzzle object
     * @param $puzzleId
     */
    public function deletePuzzle($puzzleId) {
        DB::table('puzzles')->where('id', '=', $puzzleId)->delete();
    }

    /**
     * Updating a puzzle image
     * @param $puzzleId
     * @param $image
     * @param $previewImage
     * @param $width
     * @param $height
     * @param $ratio
     */
    public function updatePuzzleImage($puzzleId, $image, $previewImage, $width, $height, $ratio) {
        DB::table('puzzles')->where('id', '=', $puzzleId)
            ->update([
                'image' => $image,
                'preview_image' => $previewImage,
                'width' => $width,
                'height' => $height,
                'ratio' => $ratio,
                'updated_at' => now()
            ]);
    }

    /**
     * Inserting a new puzzle
     * @param $folderId
     * @param $image
     * @param $previewImage
     * @param $width
     * @param $height
     * @param $ratio
     */
    public function insertNewPuzzle($folderId, $image, $previewImage, $width, $height, $ratio) {
        DB::table('puzzles')
            ->insert([
                'folder_id' => $folderId,
                'image' => $image,
                'preview_image' => $previewImage,
                'width' => $width,
                'height' => $height,
                'ratio' => $ratio,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }


    /**
     * Getting puzzles from folder
     * @param $folder_id
     *
     * @return Collection
     */
    public function getPuzzles($folder_id) {
        return DB::table('puzzles')
                 ->where('folder_id', '=', $folder_id)
                 ->orderBy('updated_at', 'desc')
                 ->get();
    }

    /**
     * Getting puzzle object
     * @param $id
     *
     * @return Model|Builder|object|null
     */
    public function getPuzzle($id) {
        return DB::table('puzzles')
            ->where('id', '=', $id)
            ->first();
    }

}
