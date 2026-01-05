<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $products = \App\Models\Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('sku', 'like', '%' . $query . '%')
            ->orWhereHas('brand', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->get();

        return view('client.search_results', compact('products', 'query'));
    }
}
