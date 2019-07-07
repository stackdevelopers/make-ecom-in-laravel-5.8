<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function mainCategories(){
    	$mainCategories = Category::where(['parent_id' => 0])->get();
    	$mainCategories = json_decode(json_encode($mainCategories));
    	/*echo "<pre>"; print_r($mainCategories); die;*/
    	return $mainCategories;
    }
}
