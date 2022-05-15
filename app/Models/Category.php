<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'description'];

    public function radios() {
        return $this->belongsToMany(Radio::class);
    }
}
