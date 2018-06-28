<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreFileRequest;
use App\File;
use App\Http\Requests\File\UpdateFileRequest;
use App\Http\Transformers\Core\Manager;
use App\Http\Transformers\FileTransformer;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;

/**
 * @resource File
 *
 */
class FileController extends ApiController {

    private $transformer;

    public function __construct(Manager $fractalManager, FileTransformer $transformer) {
        parent::__construct($fractalManager);

        $this->transformer = $transformer;
    }

    /**
     * File Create
     *
     * Store a newly created resource in storage.
     *
     * @param  StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request) {
        $newFileName =
            str_random(3) . '_' .
            Carbon::now(config('app.timezone'))->getTimestamp() . "." .
            $request->file->getClientOriginalExtension();

        $path = 'uploads' . '/' . $request->input('entity') . '/' . $request->input('type');
        $fullPath = $path . '/' . $newFileName;

        $request->file->storeAs('storage/' . $path, $newFileName);

        return $this->item(File::create([
            "path" => $newFileName,
            "type" => $request->input('type'),
            "entity" => $request->input('entity'),
            "purpose" => $request->input('purpose'),
            "name" => $request->file->getClientOriginalName()
        ]), $this->transformer);
    }

    public function update(UpdateFileRequest $request, File $file) {
        $filePath = explode('.', $file->path);
        $fileExtension = $filePath[count($filePath)-1];

        $newFileName = str_random(3) . '_' . Carbon::now(config('app.timezone'))->getTimestamp() . "." . $fileExtension;

        $path = 'uploads' . '/' . $file->entity . '/' . $file->type;
        $request->file->storeAs('storage/' . $path, $newFileName);

        $file->path = $newFileName;
        $file->save();

        return $this->item($file, $this->transformer);
    }
    /**
     * File Show
     *
     * Display the specified resource.
     *
     * @param File $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file) {
        return $this->item($file, $this->transformer);
    }

    /**
     * File Delete
     *
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @param Filesystem $filesystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file, Filesystem $filesystem) {
        $file->delete();
        $filesystem->delete($this->getFilePath($file));

        return $this->item($file, $this->transformer);
    }

    private function getFilePath($file) {
        return 'storage/uploads/' . $file->entity . '/' . $file->type . '/' .  $file->path;
    }
}
