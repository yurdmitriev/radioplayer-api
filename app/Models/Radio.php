<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'logo', 'stream', 'website'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
