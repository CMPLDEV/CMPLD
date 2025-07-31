<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SitemapController extends Controller{
  
  public function sitemap(){
   $pages = Page::where('status',1)->orderBy('order_by')->get();
   $blogs = Blog::where('status',1)->orderBy('order_by')->get();
   $products = Product::where('status',1)->orderBy('order_by')->get();
   return response()->view('sitemap.sitemap',compact('pages','blogs','products'))
                    ->header('Content-Type', 'text/xml');                
  }
    
}