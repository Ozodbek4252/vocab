<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoRequest;
use App\Models\Lang;
use App\Models\Seo;
use App\ViewModels\Seo\IndexSeoViewModel;
use App\ViewModels\Seo\SeoViewModel;
use Exception;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function index()
    {
        $seo = Seo::first();
        $seo = new IndexSeoViewModel($seo);
        return view('admin.seo.index', compact('seo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seo $seo)
    {
        $langs = Lang::where('is_published', true)->get();

        $seo =  Seo::with('translations.lang')->find($seo->id);
        $seo = new SeoViewModel($seo);
        return view('admin.seo.edit', compact('langs', 'seo'));
    }

    public function update(SeoRequest $request, Seo $seo)
    {
        try {
            DB::beginTransaction();

            $seo->update([
                'keywords' => $request->input('keywords'),
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $seo->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'title',
                        ],
                        [
                            'content' => $request->input('title_' . $lang->code),
                        ]
                    );
                }

                if ($request->input('description_' . $lang->code)) {
                    $seo->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'description',
                        ],
                        [
                            'content' => $request->input('description_' . $lang->code),
                        ]
                    );
                }
            }

            toastr(trans('body.Updated successfully'));

            DB::commit();
            return redirect()->route('seos.index');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => trans('body.Error. Can\'t update'),
            ]);
        }
    }
}
