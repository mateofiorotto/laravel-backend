<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    //indicate manually the table, because the default table name is plural..
    protected $table = 'category';

    //fields that can be mass assigned
    protected $fillable = ['name'];

    //one to many relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
