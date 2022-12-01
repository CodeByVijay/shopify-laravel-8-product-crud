<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $shop = Auth::user();
        $products = $shop->api()->rest('GET', '/admin/api/2022-10/products.json');
        $products = json_decode($products['response']->getBody(), JSON_PRETTY_PRINT);
        return view('welcome')->with('products', $products);
    }

    public function getSingleProduct(Request $request)
    {
        $shop = Auth::user();
        $product = $shop->api()->rest('GET', '/admin/api/2022-10/products/' . $request->pid . '.json');
        $product = json_decode($product['response']->getBody(), JSON_PRETTY_PRINT);
        return response()->json(['msg' => 'success', 'product' => $product]);
    }

    public function editSingleProduct(Request $request)
    {
        $shop = Auth::user();
        $arr = array(
            "product" => array(
                'id' => $request->productId,
                'title' => $request->productTitle,
                'body_html' => $request->productDesc
            )
        );

        $product = $shop->api()->rest('PUT', '/admin/api/2022-10/products/' . $request->productId . '.json', $arr);
        $product = json_decode($product['response']->getBody(), JSON_PRETTY_PRINT);
        // echo "<pre>";
        // print_r($product);
        // die();
        // return response()->json(['msg' => 'success', 'product' => $product]);
        return redirect()->back();
    }

    public function productDelete($id)
    {
        $shop = Auth::user();
        $shop->api()->rest('DELETE', '/admin/api/2022-10/products/' . $id . '.json');
        return redirect()->back();
    }
}
