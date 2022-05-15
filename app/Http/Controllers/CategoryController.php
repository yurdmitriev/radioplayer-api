<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Radio;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }

    public function show($id) {
        return Category::findOrFail($id);
    }

    public function store(Request $request) {
        return Category::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    public function destroy($id) {
        return Category::findOrFail($id)->delete();
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $array = [];
        $fields = ['title', 'description'];

        foreach ($fields as $field) {
            if ($request->has($field)) $array[$field] = $request->$field;
        }

        $category->update($array);

        return $category;
    }

    public function attach(Request $request, $id) {
        $category = Category::findOrFail($id);
        $radio = Radio::findOrFail($request->radio);

        return $radio->categories()->attach($category);
    }

    public function detach($id, $radioId) {
        $category = Category::findOrFail($id);
        $radio = Radio::findOrFail($radioId);

        return $radio->categories()->detach($category);
    }

    public function listMembers($id) {
        return Category::findOrFail($id)->radios()->getResults();
    }
}
