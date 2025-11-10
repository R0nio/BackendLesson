<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Dotenv\Parser\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['category', 'comments.user'])->get();

        return view('dashboard', compact('products'));
    }
    public function edit($id)
        {
            $product = Product::with('category')->findOrFail($id);
            $categories = Category::all();
            return view('products.edit', compact('categories', 'product'));
        }

    public function create () {
        $categories = Category::all();
        return view('products.create', compact( 'categories'));

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'path_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $product = new Product;
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];

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

    

    public function update(Request $request, $id)
    {

        try{

        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'path_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];


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

        $product->save();
        return redirect()->route('dashboard')->with('success', 'Товар успешно обновлен!');


        }
        catch(\Exception $ex){

            return redirect()->back()->with('error', "Произошла ошибка: $ex")->withInput();

        }
       
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
