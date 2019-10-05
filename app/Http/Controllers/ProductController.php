<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {

        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->all();
        return view('list',compact('products'));
    }

    public function show($id)
    {
        $productKey = 'product_' . $id;


        if (!Session::has($productKey)) {
            $this->product->where('id', $id)->increment('view_count');
            Session($productKey, 1);
        }


        $product = $this->product->find($id);


        return view('detail', compact('product'));
    }

}
