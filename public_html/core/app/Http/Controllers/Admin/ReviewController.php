<?php
namespace App\Http\Controllers\Admin;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller{
 
 protected $section_name;
 
 public function __construct(){
  $this->middleware('auth:admin');
  $this->section_name = "Rating-Review";
 }
 
 public function index(){
  $data = Rating::join('products','products.id','=','ratings.product_id')
                ->select('products.name','ratings.*')
                ->orderBy('ratings.id','desc')
                ->groupBy('product_id')->paginate(30);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.product_review.index', compact('data','i'));
 }
 
 public function detail(Request $req){
  $product = Product::find($req->product_id);     
  $data = Rating::join('users','users.id','ratings.user_id')
                ->select('ratings.*','users.name')
                ->where('product_id',$product->id)->latest()->paginate(30);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.product_review.detail', compact('product','data','i'));
 }
 
 public function bottomAction(Request $req){ 
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   $data = Rating::whereIn('id',$ids)->get();
    foreach($data as $row){
     @unlink("uploaded_files/review/".$row->image);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, "Product ID : ".$row->product_id);
     Rating::where('id',$row->id)->delete();
    }
  }
  return redirect()->route('admin.product.reviews')
                   ->with('message','error|Action completed.');
 }
     
}
