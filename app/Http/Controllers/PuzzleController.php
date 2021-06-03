<?php

namespace App\Http\Controllers;
use App\Puzzle;
use App\PuzzleFolder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class PuzzleController extends Controller {

    const MY_PATH = 'assets/images/';
    const PREVIEW_IMAGE_WIDTH = 200;
    const PREVIEW_IMAGE_HEIGHT = 120;
    const IMAGE_WIDTH = 800;
    const IMAGE_HEIGHT = 480;

    /**
     * Getting puzzle manage page
     * @return Factory|View
     */
    public function index() {
        $folders = $this->getFoldersList(true);
        return view('layouts.puzzle-manage',
            [
                'data'=> [
                    'page' => 'puzzle-manage',
                    'folders' => $folders,
                ]
            ]
        );
    }

    /**
     * Deleting a puzzle object
     * @param $puzzleId
     * @param $folderId
     */
    public function deletePuzzle($puzzleId, $folderId) {
        $p = new Puzzle();
        $pf = new PuzzleFolder();
        $puzzle = $p->getPuzzle($puzzleId);
        $alias = $pf->getAlias($folderId)->alias;
        $upload_path = public_path(self::MY_PATH . '/' . $alias);

        if (File::exists($upload_path . '/' . $puzzle->image)) {
            unlink($upload_path . '/' . $puzzle->image);
        }
        if (File::exists($upload_path . '/' . $puzzle->preview_image)) {
            unlink($upload_path . '/' . $puzzle->preview_image);
        }

        $p->deletePuzzle($puzzleId);
        $pf->decrementPuzzles($folderId);
    }

    /**
     * Deleting file if exist
     * @param $path
     * @param $fileName
     */
    private function deleteFile($path, $fileName) {
        if (File::exists($path . '/' . $fileName)) {
            unlink($path . '/' . $fileName);
        }
    }

    /**
     * Resizing image depend on is it Preview or not
     *
     * @param $isPreview
     * @param $requestImage
     * @param $uploadPath
     * @param $uploadFileName
     *
     * @return array
     */
    private function resizeImage($isPreview, $requestImage, $uploadPath, $uploadFileName){
        $img = Image::make($requestImage);
        $height = $img->height();
        $width = $img->width();
        $isLandscape = $width > $height;
        $ratio = round($width / $height, 2);

        if ($isPreview) { //Small Image
            if ($isLandscape) {
                $newWidth = self::PREVIEW_IMAGE_WIDTH;
                $newHeight = $newWidth / $ratio;
            } else {//Portrait
                $newHeight = self::PREVIEW_IMAGE_HEIGHT;
                $newWidth = $newHeight * $ratio;
            }
        } else {//FullSize Image
            if ($isLandscape) {
                $newWidth = self::IMAGE_WIDTH;
                $newHeight = $newWidth / $ratio;
            } else {//Portrait
                $newHeight = self::IMAGE_HEIGHT;
                $newWidth = $newHeight * $ratio;
            }
        }
        $newHeight = round($newHeight, 0);
        $newWidth = round($newWidth, 0);

        $img->resize($newWidth, $newHeight, function ($constraint) {
            $constraint->aspectRatio();
        })->save($uploadPath.'/'.$uploadFileName);

        return [
            'width' => $newWidth,
            'height' => $newHeight,
            'ratio' => $ratio,
        ];

    }

    /**
     * Updating a puzzle image
     * @param  Request  $request
     * @param $puzzleId
     * @param $folderId
     *
     * @return array
     */
    public function updatePuzzleImage(Request $request, $puzzleId, $folderId) {
        $p = new Puzzle();
        $pf = new PuzzleFolder();
        $imageName = time() . '.jpg';
        $previewImageName = 'preview_' . time() . '.jpg';
        $alias = $pf->getAlias($folderId)->alias;
        $uploadPath = public_path(self::MY_PATH . '/' . $alias);

        $this->resizeImage(true, $request->file, $uploadPath, $previewImageName);
        $imageSize = $this->resizeImage(false, $request->file, $uploadPath, $imageName);

        if (File::exists($uploadPath . '/' . $imageName)
            && File::exists($uploadPath . '/' . $previewImageName)) {

            $puzzle = $p->getPuzzle($puzzleId);
            $this->deleteFile($uploadPath, $puzzle->image);
            $this->deleteFile($uploadPath, $puzzle->preview_image);

            $error = false;
            $p->updatePuzzleImage(
                $puzzleId,
                $imageName,
                $previewImageName,
                $imageSize['width'],
                $imageSize['height'],
                $imageSize['ratio']
            );
            $response = 'Успешно обновлено!';
        } else {
            $error = true;
            $response = 'Ошибка при обновлении картинки!';
        }
        return [
            'error' => $error,
            'response' => $response,
        ];
    }

    /**
     * Inserting a new puzzle image
     * @param  Request  $request
     * @param $folderId
     *
     * @return array
     */
    public function insertNewPuzzleImage(Request $request, $folderId) {
        $p = new Puzzle();
        $pf = new PuzzleFolder();
        $imageName = time() . '.jpg';
        $previewImageName = 'preview_' . time() . '.jpg';
        $alias = $pf->getAlias($folderId)->alias;
        $uploadPath = public_path(self::MY_PATH . '/' . $alias);

        $this->resizeImage(true, $request->file, $uploadPath, $previewImageName);
        $imageSize = $this->resizeImage(false, $request->file, $uploadPath, $imageName);

        if (File::exists($uploadPath . '/' . $imageName)
        && File::exists($uploadPath . '/' . $previewImageName)) {
            $error = false;
            $p->insertNewPuzzle(
                $folderId,
                $imageName,
                $previewImageName,
                $imageSize['width'],
                $imageSize['height'],
                $imageSize['ratio']
            );
            $pf->incrementPuzzles($folderId);
            $response = 'Успешно загружено!';
        } else {
            $error = true;
            $response = 'Ошибка при сохранении картинки!';
        }
        return [
            'error' => $error,
            'response' => $response,
        ];
    }


    /**
     * Storing a Folder Image
     * @param  Request  $request
     * @param $folderId
     *
     * @return array
     */
    public function storeImage(Request $request, $folderId) {
        $pf = new PuzzleFolder();
        $imageName = 'category_' . time() . '.jpg';
        $alias = $pf->getAlias($folderId)->alias;

        $oldImageName = $pf->getImageName($folderId)->image;
        $uploadPath = public_path(self::MY_PATH . '/' . $alias);

        $imageSize = $this->resizeImage(true, $request->file, $uploadPath, $imageName);

        if (File::exists($uploadPath . '/' . $imageName)) {
            $error = false;
            $pf->updateFolderImage($folderId, $imageName);

            if ($oldImageName != null){
                $this->deleteFile($uploadPath, $oldImageName);
            }

            $response = 'Успешно загружено!';
        } else {
            $error = true;
            $response = 'Ошибка при сохранении картинки!';
        }
        return [
            'error' => $error,
            'response' => $response,
            'image' => 'assets/images/' . $alias . '/' . $imageName,
        ];
    }

    /**
     * Insert folder name and alias
     *
     * @param $name
     *
     * @return array
     */
    public function insertFolderName($name) {
        $pf = new PuzzleFolder();
        $alias = $this->cyrToLat($name);
        $error = false;
        if ($pf->isAliasExist($alias)) {
            $error = true;
            $response = 'Такое имя папки уже есть';
        } else {
            if ($this->createFolder($alias)) { //Create folder on server disk
                $response = $pf->insertFolderName($name, $alias); //ID
            } else {
                $response = 'Ошибка при создании папки на диске!';
            }
        }
        return [
            'error' => $error,
            'response' => $response,
        ];
    }

    /**
     * Creating a folder on the server disk
     * @param $name
     *
     * @return bool
     */
    private function createFolder($name) {
        $folderPath = public_path(self::MY_PATH . $name);
        $response = 0; //error
        if(!File::isDirectory($folderPath)){
            $response = File::makeDirectory($folderPath, 0777, true, true);
        }
        return $response == 1; //success
    }

    /**
     * Renaming a folder name on the server disk
     * @param $oldName
     * @param $newName
     *
     * @return bool
     */
    private function renameFolder($oldName, $newName) {
        $folderPathOldName = public_path(self::MY_PATH . $oldName);
        $folderPathNewName = public_path(self::MY_PATH . $newName);
        $response = 0; //error
        //if Old name exist and new name is not exist
        if(File::isDirectory($folderPathOldName) && !File::isDirectory($folderPathNewName)){
            rename($folderPathOldName, $folderPathNewName);
            $response =  1; //success
        }
        return $response == 1;
    }

    /**
     * Updating a folder name and alias
     * @param $id
     * @param $name
     *
     * @return array
     */
    public function updateFolderName($id, $name) {
        $pf = new PuzzleFolder();
        $alias = $this->cyrToLat($name);
        $error = false;
        if ($pf->isAliasExist($alias)) {
            $error = true;
            $response = 'Такое имя папки уже есть';
        } else {
            $oldAlias = $pf->getAlias($id)->alias;
            if ($this->renameFolder($oldAlias, $alias)) {
                $pf->updateFolderName($id, $name, $alias);
                $response = 'Успешно!';
            } else {
                $response = 'Ошибка. Невозможно переименовать!';
            }

        }
        return [
            'error' => $error,
            'response' => $response,
        ];
    }


    /**
     * Getting folders list
     *
     * @param  bool  $isBackend
     *
     * @return Collection
     */
    private function getFoldersList($isBackend = false) {
        $pf = new PuzzleFolder();
        $folders = $pf->getFolders($isBackend);
        foreach ($folders as $folder){
            $img = $folder->image;
            $path = $isBackend ? 'assets/images/' : 'images/';
            $folder->image = $path . $folder->alias . '/' . $img;
        }
        return $folders;
    }

    /**
     * Getting folders list from Manage puzzle page (For Backend usage)
     * @return Collection
     */
    public function getPuzzleFolders() {
        return $this->getFoldersList(true);
    }

    /**
     * Getting all folders (For Frontend usage)
     *
     * @param  bool  $isBackend
     *
     * @return JsonResponse
     */
    public function getFolders($isBackend = false) {
        $folders = $this->getFoldersList($isBackend);
        $data = [ 'folders' => $folders ];
        return response()
            ->json($data, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Getting puzzles from folder (For Frontend usage)
     * @param $folder_id
     *
     * @return JsonResponse
     */
    public function getPuzzles($folder_id) {
        $puzzles = $this->getPuzzlesList($folder_id);
        $data = [ 'puzzles' => $puzzles ];
        return response()
            ->json($data, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Getting puzzle list by folder ID
     *
     * @param $folderId
     *
     * @param  bool  $isBackend
     *
     * @return Collection
     */
    private function getPuzzlesList($folderId, $isBackend = false){
        $p = new Puzzle();
        $pf = new PuzzleFolder();
        $puzzles = $p->getPuzzles($folderId);
        $path = $isBackend ? 'assets/images/' : 'images/';
        foreach ($puzzles as $puzzle) {
            $img = $puzzle->preview_image;
            $folder_alias = $pf->getAlias($puzzle->folder_id)->alias;
            $puzzle->preview_image = $path . $folder_alias . '/' . $img;
        }
        return $puzzles;
    }

    /**
     * Getting all puzzles from folder (For Backend usage)
     *
     * @param $folderId
     *
     * @return Collection
     */
    public function getAllPuzzles($folderId) {
        return $this->getPuzzlesList($folderId, true);
    }

    /**
     * Getting puzzle image
     * @param $id
     *
     * @return JsonResponse
     */
    public function getPuzzleImage($id) {
        $p = new Puzzle();
        $pf = new PuzzleFolder();

        $puzzle = $p->getPuzzle($id);
        $folder_id = $puzzle->folder_id;
        $folder_alias = $pf->getAlias($folder_id);

        $img = $puzzle->image;
        $puzzle->image = 'images/' . $folder_alias->alias . '/' . $img;

        return response()
            ->json($puzzle, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Cyr to Lat
     * @param $str
     *
     * @return string
     */
    private function cyrToLat($str) {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', ' ',
            '.', '(', ')', '!', ';', '"', '+', '/', '*', '?', '@', '&', '>', '<', '#', '$', '%',
            '^', '=', '|', '~', '№', ':', '[', ']'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya', '_',
            '_', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
            '', '', '', '', '', '', '', ''
        ];

        $str = str_replace($cyr, $lat, $str);
        return strtolower($str);
    }
}