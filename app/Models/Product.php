<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
     //indicate manually the table, because the default table name is plural..
     protected $table = 'product';

     protected $fillable = ['name', 'description', 'price', 'category_id'];

     public function category(){
        //belongsTo: a product belongs to a category 
        return $this->belongsTo(Category::class);
     }
}
