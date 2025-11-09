<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $data = $request->validate([
            'category_name' => 'string',
        ]);

        $category->create($data);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try{
        $data = $request->validate([
            'category_name' => 'string'
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Категория успешно добавлена');

        }catch(ValidationException $ex){
            return redirect()->back()->with('error', "Произошла ошибка: $ex")->withInput();
        }
        
    }

    public function indexProductToCategory(){

        $categories = Category::with('products')->get();

        return view('categories.productToCategory', compact('categories'));


    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }



}
