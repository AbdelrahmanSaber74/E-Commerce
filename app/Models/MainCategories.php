<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image',
    ];

    public function Category(){
        return $this->hasMany(Category::class, 'parent_id');
    }

}
