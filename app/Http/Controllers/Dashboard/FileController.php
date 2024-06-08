<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Models\File as FileModel;
use App\Services\FileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FileController extends Controller
{
    /**
     * File service instance.
     *
     * @var FileService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new FileService();
    }

    /**
     * Display a listing of the files.
     *
     * @return View
     */
    public function index(): View
    {
        $files = FileModel::orderByDesc('created_at')->get();
        return view('admin.files.index', compact('files'));
    }

    /**
     * Store a newly created file.
     *
     * @param FileRequest $request
     * @return RedirectResponse
     */
    public function store(FileRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->service->store($request);
            DB::commit();
            return redirect()->route('files.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => trans('body.Error. Can\'t store')]);
        }
    }

    /**
     * Update the specified file.
     *
     * @param FileRequest $request
     * @param FileModel $file
     * @return RedirectResponse
     */
    public function update(FileRequest $request, $file): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $file = FileModel::findOrFail($file);
            $this->service->update($request, $file);
            DB::commit();
            return redirect()->route('files.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => trans('body.Error. Can\'t update')]);
        }
    }

    /**
     * Remove the specified file from storage.
     *
     * @param FileModel $file
     * @return RedirectResponse
     */
    public function destroy($file)
    {
        try {
            DB::beginTransaction();
            $file = FileModel::findOrFail($file);
            $this->service->destroy($file);
            DB::commit();
            return redirect()->route('files.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => trans('body.Error. Can\'t delete')]);
        }
    }
}
