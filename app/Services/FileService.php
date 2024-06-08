<?php

namespace App\Services;


use App\Models\File as FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Str;

class FileService
{
    /**
     * Store a newly uploaded file.
     *
     * @param Request $request
     * @return FileModel
     */
    public function store(Request $request): FileModel
    {
        $file = $request->file('file');
        $filePath = $file->store('public/files');
        $fullFilePath = storage_path('app/' . $filePath);

        $fileSize = filesize($fullFilePath);

        $parser = new Parser();
        $pdf = $parser->parseFile($fullFilePath);
        $numberOfPages = isset($pdf->getDetails()['Pages']) ? $pdf->getDetails()['Pages'] : 0;

        $filePath = str_replace('public/', '', $filePath);
        $name = $request->name ?: $file->getClientOriginalName();
        $slug = Str::slug($name) . time();

        $fileModel = FileModel::create([
            'name' => $name,
            'slug' => $slug,
            'path' => $filePath,
            'size' => $fileSize,
            'page' => $numberOfPages,
            'extension' => 'pdf',
        ]);

        toastr(trans('body.Created successfully'));

        return $fileModel;
    }

    /**
     * Update an existing file.
     *
     * @param Request $request
     * @param FileModel $fileModel
     * @return FileModel
     */
    public function update(Request $request, FileModel $fileModel): FileModel
    {
        if ($request->hasFile('file')) {
            $this->deleteFile($fileModel);

            $file = $request->file('file');
            $filePath = $file->store('public/files');
            $fullFilePath = storage_path('app/' . $filePath);

            $fileSize = filesize($fullFilePath);

            $parser = new Parser();
            $pdf = $parser->parseFile($fullFilePath);
            $numberOfPages = isset($pdf->getDetails()['Pages']) ? $pdf->getDetails()['Pages'] : 0;

            $filePath = str_replace('public/', '', $filePath);
            $name = $file->getClientOriginalName();
        } else {
            $name = $request->name ?: $fileModel->name;
            $filePath = $fileModel->path;
            $fileSize = $fileModel->size;
            $numberOfPages = $fileModel->page;
        }

        $slug = Str::slug($name) . time();

        $fileModel->update([
            'name' => $name,
            'slug' => $slug,
            'path' => $filePath,
            'size' => $fileSize,
            'page' => $numberOfPages,
        ]);

        toastr(trans('body.Updated successfully'));

        return $fileModel;
    }

    /**
     * Delete a file.
     *
     * @param FileModel $fileModel
     * @return void
     */
    public function destroy(FileModel $fileModel): void
    {
        $this->deleteFile($fileModel);
        $fileModel->delete();

        toastr(trans('body.Deleted successfully'));
    }

    /**
     * Delete the physical file.
     *
     * @param FileModel $fileModel
     * @return void
     */
    private function deleteFile(FileModel $fileModel): void
    {
        if (Storage::exists('/public/' . $fileModel->path)) {
            Storage::delete('/public/' . $fileModel->path);
        }
    }
}
