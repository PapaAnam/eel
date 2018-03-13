<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\Barang;
use App\Models\Warehouse\Product;

class BarangController extends Controller
{

	public function index($value='')
	{
		// Barang::chunk(1000, function($barangs){
			// dd($barangs->toArray());
		// });
		dd(Product::first()->toArray());
		dd(Barang::where('SubGrup', '!=', null)->count());
		dd(Barang::where('grup', '!=', null)->get()->toArray());
	}

}
