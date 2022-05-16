<?php

namespace App\Models;

use App\Http\Resources\RadioBasicResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Radio extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'logo', 'stream', 'website'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function similarRadios() {
        $ids = [];
        $result = [];
        $categories = $this->categories()->allRelatedIds()->toArray();

        $res = DB::table('category_radio')->select('radio_id')
            ->whereIn('category_id', $categories)
            ->whereNot('radio_id', '=', $this->id)->inRandomOrder()->limit(10)->get();

        foreach ($res as $r) $ids[] = $r->radio_id;

        $radios = Radio::findMany($ids);
        foreach ($radios as $radio) $result[] = new RadioBasicResource($radio);

        return $result;
    }
}
