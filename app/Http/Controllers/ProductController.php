<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller {
    public function index() {
         $dbFile = file_get_contents(base_path('public/data/data.json'));

        $data = json_decode($dbFile);

        $viewData = array_reverse($data->products);
        
        return view('home', compact('viewData'));
    }
    public function store(Request $request) {
        
        $dbFile = file_get_contents(base_path('public/data/data.json'));

        $data = json_decode($dbFile);

        $products = $data->products;
        // dd($data->meta->original_count);
        
        $data->products[] = array('id'=> ($data->meta->original_count + 1) ,'name' => $request->input('name'), 'quantity_in_stock' => $request->input('quantity_in_stock'),  'price_per_item' => $request->input('price_per_item'), 'created_at' => Carbon::now()->toDateTimeString());
        
        $data->meta->original_count = $data->meta->original_count + 1;
        $data->meta->current_count = $data->meta->current_count + 1;
            // dd($data);
            $updatedFileData = json_encode($data, JSON_PRETTY_PRINT);
            
            file_put_contents(base_path('public/data/data.json'), stripslashes($updatedFileData));
         $viewData = array_reverse($data->products);
        return response()->json($viewData);
        // $data = json_decode($dbFile);

        // $viewData = $data->products;
        // $respHtml = view('table-content', compact('viewData'))->render();
        // return response()->json(array('html'=> ));
        
    }
    
    public function destroy(Request $request) {
        
        $dbFile = file_get_contents(base_path('public/data/data.json'));

        $data = json_decode($dbFile);

        $products = $data->products;
        
        foreach($products as $key=>$product) {
            if ($product->id == $request->id) {
                        unset($products[$key]);
                break;
            }
        }   
        
        $data->products = $products;

        $data->meta->current_count = $data->meta->current_count - 1;

        $updatedFileData = json_encode($data, JSON_PRETTY_PRINT);
            
        file_put_contents(base_path('public/data/data.json'), stripslashes($updatedFileData));
        $viewData = array_reverse($data->products);
        return response()->json($viewData);
        // $data = json_decode($dbFile);

        // $viewData = $data->products;
        // $respHtml = view('table-content', compact('viewData'))->render();
        // return response()->json(array('html'=> ));
        
    }
}
