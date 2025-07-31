<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProduct implements FromCollection, WithHeadings
{

    protected $product_ids;
    
    public function __construct($product_ids){
     $this->product_ids = $product_ids;  
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
      
     $products = Product::whereIn('id',explode(',',$this->product_ids))->get();
     
     return $products->map(function($data) {
         
       $category_name = "";   
       $category = Category::find($data->category_id);
        if(!empty($category)){                        
         $category_name = $category->name;        
        }                       
      
      $image_link = (!empty($data->image)) ? setting()->website_url."/uploaded_files/product/".$data->image : "N/A";
           
        return [
           'name' => $data->name,
           'image' => $image_link,
           'category_id' => $category_name,
           'mrp' => $data->mrp,
           'price' => $data->price,
           'stock' => $data->stock,
           'sku' => $data->sku,
           'asin' => $data->asin,
           'keywords' => $data->keywords,
           'video' => $data->video,
           'alt' => $data->alt,
           'title' => $data->title,
           'short_content' => $data->short_content,
           'content' => $data->content,
           'status' => $data->status,
           'meta_title' => $data->meta_title,
           'meta_description' => $data->meta_description,
           'meta_keywords' => $data->meta_keywords,
        ];
     });
    }

    public function headings(): array
    {

        return [
            
            'Name',
            'Image',
            'Category',
            'MRP',
            'Price',
            'Stock',
            'SKU',
            'ASIN',
            'Keywords',
            'Video',
            'Alt',
            'Title',
            'Short Content',
            'Content',
            'Status',
            'Meta Title',
            'Meta Description',
            'Meta Keywords',
        ];
      
    }
}
