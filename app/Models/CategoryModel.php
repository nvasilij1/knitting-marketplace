<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = "category";
    protected $primaryKey = 'category_id';
    protected $fillable = [
        "category_id",
        "category_name",
        "category_image",
        "vk_oid",
        "vk_first_name",
        "vk_last_name",
        "block_time",
        "block_reason",
        "market_description",
        "email",
        "email_check",
        "email_check_code",
        "email_notification",
        "push_notification",
        "last_time_send_check_code"
    ];

    public function product(){
        return $this->hasMany('App\Models\ProductModel');
    }

    static public function getAllNotBlockedCategory(){
        /*
         * SELECT
    DISTINCT c.category_id,
    c.category_name,
    c.category_image,
    COUNT(DISTINCT CASE WHEN product_status = 'Available' THEN p.product_id END) as product_count, c.market_description,
    IF(TIME_TO_SEC(TIMEDIFF(NOW(),c.`block_time`)) < 0,1,0) as is_block
    FROM tbl_category c
    LEFT JOIN tbl_product p ON c.category_id = p.category_id
    GROUP BY c.category_id
    having is_block=0
    ORDER BY c.category_id DESC
         */
        $db = \Config::get('database');
        $prefix = $db['connections']['mysql']['prefix'];

        return \DB::table('category as c')->selectRaw("DISTINCT ".$prefix."c.category_id,
    ".$prefix."c.category_name,
    ".$prefix."c.category_image,
    COUNT(DISTINCT CASE WHEN product_status = 'Available' THEN ".$prefix."p.product_id END) as product_count,
    ".$prefix."c.market_description,
    IF(TIME_TO_SEC(TIMEDIFF(NOW(),".$prefix."c.`block_time`)) < 0,1,0) as is_block")
            ->leftjoin('product as p', 'c.category_id', '=', 'p.category_id')
            ->groupBy('c.category_id')
            ->having('is_block', '=',0)
            ->orderBy('c.category_id', 'DESC')
            ->get();
    }

    static public function getCategory_id($id){
        /*
         * SELECT
  p.product_id, p.product_name, p.category_id, n.category_name, p.product_price, p.product_status, p.product_image,
  p.product_description, p.product_quantity, c.currency_id, c.tax, o.currency_code, o.currency_name
  ,IF(TIME_TO_SEC(TIMEDIFF(NOW(),n.`block_time`)) < 0,1,0) as is_block
  FROM tbl_category n, tbl_product p, tbl_config c, tbl_currency o
  WHERE c.currency_id = o.currency_id AND c.id = 1 AND n.category_id = p.category_id AND n.category_id ='".$_GET['category_id']."'
        having is_block=0
        ORDER BY p.product_id DESC
         */
        $db = \Config::get('database');
        $prefix = $db['connections']['mysql']['prefix'];

        return \DB::table(\DB::raw($prefix.'category n, '.$prefix.'product p, '.$prefix.'config c, '.$prefix.'currency o'))
            ->selectRaw("p.product_id, p.product_name, p.category_id, n.category_name, p.product_price, p.product_status, p.product_image,
  p.product_description, p.product_quantity, c.currency_id, c.tax, o.currency_code, o.currency_name
  ,IF(TIME_TO_SEC(TIMEDIFF(NOW(),n.`block_time`)) < 0,1,0) as is_block")
            ->where(\DB::raw('n.category_id'), '=', $id)
            ->where(\DB::raw('c.currency_id'), '=', \DB::raw('o.currency_id'))
            ->where(\DB::raw('c.id'), '=', 1)
            ->where(\DB::raw('n.category_id '), '=', \DB::raw('p.category_id'))
            ->having(\DB::raw('is_block'), '=', 0)
            ->orderBy(\DB::raw('p.product_id'), 'DESC')
            ->get();
    }
}
