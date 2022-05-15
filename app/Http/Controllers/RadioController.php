<?php

namespace App\Http\Controllers;

use App\Http\Resources\RadioBasicResource;
use App\Http\Resources\RadioResource;
use App\Models\Radio;
use Illuminate\Http\Request;

class RadioController extends Controller
{
    public function index() {
//        return Radio::all();
        return RadioBasicResource::collection(Radio::all());
    }

    public function show($id) {
        return new RadioResource(Radio::findOrFail($id));
    }

    public function store(Request $request) {
        return new RadioBasicResource(Radio::create([
            'title' => $request->title,
            'description' => $request->description,
            'stream' => $request->stream,
            'logo' => $request->logo,
            'website' => $request->website
        ]));
    }

    public function update(Request $request, $id) {
        $radio = Radio::findOrFail($id);

        $fields = ['title', 'description', 'stream', 'logo', 'website'];
        $array = [];
        foreach ($fields as $field) {
            if ($request->has($field)) $array[$field] = $request->$field;
        }

        $radio->update($array);

        return $radio;
    }

    public function destroy($id) {
        return Radio::findOrFail($id)->delete();
    }
}
