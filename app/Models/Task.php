<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

    use HasFactory;

    protected $fillable = [
        "id_user",
        "category_id",
        "title",
        "description",
        "due_date",
        "urgency"
    ];



    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->hasOne(Category::class);
    }


}
