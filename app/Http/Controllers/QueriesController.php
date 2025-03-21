<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Product;
Use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class QueriesController extends Controller
{
    public function get(){
        $products = Product::all();
        return response()->json($products);
    }

    public function getById(int $id){
        $product = Product::find($id);
        
        if(!$product) {
            return response()->json(["error" => "Product not found"], Response::HTTP_NOT_FOUND);
        }
        
        return response()->json($product);
    }

    public function getNames(){
        $products = Product::select("name")
        ->orderBy("name", "desc")
        ->get();
    
        return response()->json($products);
    }

    public function searchNames(string $name, float $price){
            $products = Product::where("name", $name)
            ->where("price", ">", $price)
            ->orderBy("description")
            ->select("name", "description")
            ->get();

            return response()->json($products);
    }

    public function searchString(string $value){
        $products = Product::where("description", "like", "%{$value}%")
            ->orWhere("name", "like", "%{$value}%")
            ->get();

            return response()->json($products);
    }

    public function advancedSearch(Request $request){

        //function anonymous
        $products = Product::where(function($query) use ($request){
            if($request->input("name")){
                $query->where("name", "like", "%{$request->input("name")}%"); //only search by name if in the search there is a name
            }
        })
        //description
        ->where(function($query) use ($request){
            
            if($request->input("description")){
                $query->where("description", "like", "%{$request->input("description")}%"); //only search by name if in the search there is a name
            }
        })
        ->where(function($query) use ($request){
            
            if($request->input("price")){
                $query->where("price",">", $request->input("price"));
            }
        })
        ->get();

        return response()->json($products);
    }

    public function join(){
        //join method. First parameter the table to join, second the field of Product table to join (fk), third is the operator to relate the tables
        //fourth parameter, the field of the table to join
        $products = Product::join("category", "product.category_id", "=", "category.id")
        //select all from product table, and the name of the category
        ->select("product.*", "category.name as category")
        ->get();

        return response()->json($products);
    }

    public function groupBy(){
        $result = Product::join("category", "product.category_id", "=", "category.id")
        //bring total of products by category
        ->select("category.id", "category.name", DB::raw("COUNT(product.id) as total"))
        ->groupBy("category.id", "category.name")
        ->get();

        return response()->json($result);
    }
}
