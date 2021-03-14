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

    public function createMarket(Request $request){
        $result = array();
        $status = 201;
        $data = $request->input();
        $user = CategoryModel::where('vk_oid', '=', $data['vk_oid'])->first();
        if ($user === null) {
            try {
                $category = new CategoryModel;
                $category->category_image = put_file_string(base64_decode($data["encoded_string"]));
                $category->category_name = $data['vk_name'] . " " . $data['vk_surname'];
                $category->vk_oid = $data['vk_oid'];
                $category->vk_first_name = $data['vk_name'];
                $category->vk_last_name = $data['vk_surname'];

                $category->save();
                $result[]['success'] = 1;
            } catch (\Exception $e) {
                $set[]['error'] = 1;
                $status = 401;
            }

        } else {
            $set[]['error'] = 1;
            $status = 402;
        }
        return response()->json($result, $status);
    }
}
