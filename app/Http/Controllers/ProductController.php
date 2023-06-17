<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:product.index')->only('index');
        $this->middleware('permission:product.create')->only('create','store');
        $this->middleware('permission:product.show')->only('show');
        $this->middleware('permission:product.edit')->only('edit','update');
        $this->middleware('permission:product.destroy')->only('destroy');
    }

    public function index(Request $request){
        $products = DB::table('products')
        ->when($request->input('name'),function($query, $name){
                return $query->where('name', 'like', '%' . $name . '%');
          })
          ->paginate(10);
          return view ('product.index', compact('products'));
    }

    // untuk menampilkan di view
    public function create(){
        return view('product.create');
    }

    // menstore ke database untuk create
    public function store(ProductRequest $request){

        Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'picture' => $request['picture'],
            'descriptions' => $request['descriptions'],
        ]);
        return redirect(route('product.index'))->with('success', 'Data Berhasil Ditambahkan');
    }

    // Show

    public function show(Product $product){
        // menampilkan detail satu user
    }

    // Edit
    public function edit(Product $product){
        return view('product.edit')->with('product', $product);
    }

    // update
    public function update(ProductRequest $request, Product $product){
        $validate = $request->validate();

        $product->update($validate);

        return redirect()->route('product.index')->with('success','Data Berhasil Ditambahkan');
    }


    // Delete
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('product.index')->with('success','Data Berhasil Dihapus');
    }
}
