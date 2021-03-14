<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $primaryKey = 'product_id';
    protected $fillable = [
        "product_id",
        "product_name",
        "product_price",
        "product_status",
        "product_image",
        "product_description",
        "product_quantity",
        "category_id"
    ];

    public function category(){
        return $this->belongsTo('App\Models\CategoryModel');
    }
}
