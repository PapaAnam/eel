<?php

namespace App\Http\Controllers\MIdea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Altius\Product;

class ProductController extends Controller
{
    public function index()
    {
    	return Product::all();
    }
}
