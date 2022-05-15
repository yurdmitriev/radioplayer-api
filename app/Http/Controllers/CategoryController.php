<?php

namespace App\Http\Controllers;

use App\Http\Resources\CatalogCategoryResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RadioBasicResource;
use App\Models\Category;
use App\Models\Radio;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return CatalogCategoryResource::collection(Category::all());
    }

    public function show($id) {
        return new CategoryResource(Category::findOrFail($id));
    }

    public function store(Request $request) {
        return new CategoryResource(Category::create([
            'title' => $request->title,
            'description' => $request->description
        ]));
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

        return new CategoryResource($category);
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
        return RadioBasicResource::collection(Category::findOrFail($id)->radios()->getResults());
    }
}
