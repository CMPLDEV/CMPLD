<?php
namespace App\Http\Controllers\Admin;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller{
 
 public function __construct(){
  $this->middleware('auth:admin');  
 }
 
 public function index(){
  $data = Log::latest()->paginate(100);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.log', compact('data','i'));
 }
 
 public function search(Request $req){
  $date = $req->date;
  $filter = $req->filter;
  $search_keyword = $req->search_keyword;
  $data = Log::latest();
  if(!empty($search_keyword)){
   $data->where(function($q) use($search_keyword){
    $q->where('action_title','LIKE','%'.$search_keyword.'%')
      ->orWhere('action_by',$search_keyword);      
   });      
   
  }if(!empty($filter)){
   $data->where('action',$filter);      
  }if(!empty($date)){
   $data->whereDate('created_at',$date);      
  }
  $data = $data->paginate(100);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.log', compact('data','i','search_keyword','filter','date'));
 }
     
}