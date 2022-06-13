<?php

namespace App\Http\Controllers;

use App\Http\Resources\RadioBasicResource;
use App\Models\Radio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function attach(Request $request) {
        $radio = Radio::findOrFail($request->radio);
        $user = Auth::user();

        return $user->favourites()->attach($radio);
    }

    public function detach($radioId) {
        $radio = Radio::findOrFail($radioId);
        $user = Auth::user();

        return $user->favourites()->detach($radio);
    }

    public function listFavourites() {
        return RadioBasicResource::collection(Auth::user()->favourites()->getResults());
    }
}
