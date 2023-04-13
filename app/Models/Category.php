<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "color"
    ];

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
