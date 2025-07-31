<?php

namespace App\Imports;

use Str;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportProduct implements ToCollection
{
    
    public function collection(Collection $rows){
      foreach($rows as $row){ 
         $cat_id = 0;    
        //CHECK CATEGORIES NAME
        if(!empty($row[2])){
          $name = trim($row[2]);     
          $cat = Category::where('name',$name)->first();
          if(!empty($cat)){
            $cat_id= $cat->id;  
          }else{
            //ADD NEW CATEGORY
            $add = new Category;
            $add->parent_id = 0;
            $cat_slug = Str::slug($name);
            $add->name = $name;
            $add->slug = $cat_slug;
            $add->save();
            $cat_id = $add->id;  
          }
        }
        
        $name = $row[0];
        $image_url = (isset($row[1])) ? $row[1] : "";
        $category_id = $cat_id;
        $mrp = (isset($row[3])) ? $row[3] : "";
        $price = (isset($row[4])) ? $row[4] : "";
        $stock = (isset($row[5])) ? $row[5] : "";
        $sku = (isset($row[6])) ? $row[6] : "";
        $asin = (isset($row[7])) ? $row[7] : "";
        $keywords = (isset($row[8])) ? $row[8] : "";
        $video = (isset($row[9])) ? $row[9] : "";
        $alt = (isset($row[10])) ? $row[10] : "";
        $title = (isset($row[11])) ? $row[11] : "";
        $short_content = (isset($row[12])) ? $row[12] : "";
        $content = (isset($row[13])) ? $row[13] : "";
        $status = (isset($row[14])) ? $row[14] : "";
        $meta_title = (isset($row[15])) ? $row[15] : "";
        $meta_description = (isset($row[16])) ? $row[16] : "";
        $meta_keywords = (isset($row[17])) ? $row[17] : "";
        $allowed_ext = array('jpeg','jpg','png','webp'); 

        $image = "";
         
        $is_exist = Product::where('name',$name)->select('id')->first();
        $slug = Str::slug($name);
        
        
        if(empty($is_exist)){
          $product = new Product();
          $product->name = $name;
          $product->slug = $slug;
          $product->category_id = $category_id;
          $product->mrp = $mrp;
          $product->price = $price;
          $product->stock = $stock;
          $product->sku = $sku;
          $product->asin = $asin;
          $product->keywords = $keywords;
          $product->video = $video;
          $product->image_alt = $alt;
          $product->image_title = $title;
          $product->additional_information = $short_content;
          $product->content = $content;
          $product->status = $status;
          $product->meta_title = $meta_title;
          $product->meta_description = $meta_description;
          $product->meta_keywords = $meta_keywords;
          if(!empty($image_url)){
            $url_array = explode('.',$image_url);
            $ext = $url_array[COUNT($url_array) - 1];
            if(in_array($ext,$allowed_ext)){
             $path = public_path('/uploaded_files/product');
             $image = rand(11111111,99999999).'.'.$ext;
             $fp = fopen($path.'/'.$image, 'wb');
             $ch = curl_init($image_url);
             curl_setopt($ch, CURLOPT_FILE, $fp);
             curl_exec($ch);
             curl_close($ch);
             fclose($fp);
             $product->image = $image;
            } 
           }
          $product->save();
        }else{
          $product = Product::find($is_exist->id);
          $product->name = $name;
          $product->slug = $slug;
          $product->category_id = $category_id;
          $product->mrp = $mrp;
          $product->price = $price;
          $product->stock = $stock;
          $product->sku = $sku;
          $product->asin = $asin;
          $product->keywords = $keywords;
          $product->video = $video;
          $product->image_alt = $alt;
          $product->image_title = $title;
          $product->additional_information = $short_content;
          $product->content = $content;
          $product->status = $status;
          $product->meta_title = $meta_title;
          $product->meta_description = $meta_description;
          $product->meta_keywords = $meta_keywords;
          $image = $is_exist->image;
          if(!empty($image_url)){
          $url_array = explode('.',$image_url);
          $ext = $url_array[COUNT($url_array) - 1];
          if(in_array($ext,$allowed_ext)){
            $path = public_path('/uploaded_files/product');
            @unlink($path.'/'.$image);
            $image = rand(11111111,99999999).'.'.$ext;
            $fp = fopen($path.'/'.$image, 'w');
            $ch = curl_init($image_url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            $product->image = $image;
          } 
          }
          $product->update();

        }
       }
    }
}
