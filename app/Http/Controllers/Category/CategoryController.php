<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function getCategory(){
        return response()->json(CategoryModel::getAllNotBlockedCategory(),200);
    }
    public function getCategory_id($id){
        return response()->json(CategoryModel::getCategory_id($id),200);
    }
}
