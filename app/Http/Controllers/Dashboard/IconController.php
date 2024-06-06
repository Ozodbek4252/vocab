<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IconController extends Controller
{
    public function index()
    {
        $icons = Icon::orderBy('updated_at', 'desc')->paginate(20);
        return view('admin.icons.index', compact('icons'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'icon' => 'required|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            ]);

            // Store the icon in a directory: 'public/icons/'
            $generatedName = 'icons_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $iconPath = $request->file('icon')->storeAs('icons', $generatedName, 'public');

            Icon::create([
                'name' => $request->name,
                'icon' => $iconPath,
            ]);

            toastr(trans('body.Created successfully'));

            return redirect()->route('icons.index');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => trans('body.Error. Can\'t store'),
            ]);
        }
    }

    public function update(Request $request, Icon $icon)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            ]);

            $icon->update([
                'name' => $request->name,
            ]);

            if ($request->hasFile('icon')) {
                if (Storage::exists('/public/' . $icon->icon)) {
                    Storage::delete('/public/' . $icon->icon);
                }

                // Store the new icon in a directory: 'public/icons/'
                $generatedName = 'icons_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();
                $iconPath = $request->file('icon')->storeAs('icons', $generatedName, 'public');

                $icon->update([
                    'icon' => $iconPath,
                ]);
            }

            toastr(trans('body.Updated successfully'));

            return redirect()->route('icons.index');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' =>  trans('body.Error. Can\'t update'),
            ]);
        }
    }

    public function destroy(Icon $icon)
    {
        try {
            if (Storage::exists('/public/' . $icon->icon)) {
                Storage::delete('/public/' . $icon->icon);
            }

            $icon->delete();

            toastr(trans('body.Deleted successfully'));

            return redirect()->route('icons.index');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => trans('body.Error. Can\'t delete'),
            ]);
        }
    }
}
