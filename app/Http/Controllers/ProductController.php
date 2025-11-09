<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'path_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = new Product;
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];

        if ($request->hasFile('path_picture')) {
            $file = $request->file('path_picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;

            $path = public_path('uploads/products');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $file->move($path, $filename);
            $product->path_picture = 'uploads/products/' . $filename;
        }

        $product->save();
        return redirect()->route('dashboard');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->validate(['name' => 'string']);
        $product->description = $request->validate(['description' => 'string']);
        $product->price = $request->validate(['price' => 'float']);

        if ($request->hasFile('path_picture')) {
            $destination = 'uploads/products/' . $product->path_picture;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('path_picture');
            $extension  = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products/', $filename);
            $product->path_picture = $filename;
        }

        $product->update();
        return redirect()->route('dashboard');
    }

    public function destroy(Product $product)
    {
        $destination = 'uploads/products/' . $product->path_picture;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        return redirect()->route('dashboard');
    }
}
