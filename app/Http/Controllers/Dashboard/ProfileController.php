<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Profile\ProfileRequest;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $user = auth()->user();

        $images = collect($user->images)->groupBy('type')->map(function ($image) {
            return $image->first();
        });
        $user->images = $images;
        $user->image_medium = isset($user->images['medium']) ? $user->images['medium']->full_path : null;
        $user->image_thumbnail = isset($user->images['thumbnail']) ? $user->images['thumbnail']->full_path : null;
        $user->image_original = isset($user->images['original']) ? $user->images['original']->full_path : null;

        $user->image = $user->image_medium ?? $user->image_original ?? $user->image_thumbnail ?? null;

        return view('admin.profile.index', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        try {
            /**
             * @var User
             */
            $user = auth()->user();

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->hasFile('profile_image')) {
                foreach ($user->images as $image) {
                    if (Storage::exists('/public/' . $image->path)) {
                        Storage::delete('/public/' . $image->path);
                    }
                    $image->delete();
                }

                $this->storeImage($request->file('profile_image'), 'users', User::class, $user->id);
            }

            toastr('Updated successfully');

            return redirect()->route('profile');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => trans('body.Error. Can\'t update'),
            ]);
        }
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request)
    {
        try {
            /**
             * @var User
             */
            $user = auth()->user();

            // Check if the current password matches the user's existing password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => trans('.body.The current password is incorrect.')]);
            }

            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            toastr('Password updated successfully');

            return redirect()->route('profile');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => trans('body.Error. Can\'t update'),
                'message' => $e->getMessage()
            ]);
        }
    }
}
