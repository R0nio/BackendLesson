<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request, $productId)
    {
        try {

            if(!Product::find($productId)){
                return redirect()->back()->with('error', 'Товар не был найден!');
            }

            $userId = Auth::id();
            $data = $request->validate([
                'description' => 'required|string'
            ]);

            Comment::create([
                'description' => $data['description'],
                'product_id' => $productId,
                'user_id' => $userId
            ]);
            
            return redirect()->back()->with('success', 'Коммент успешно создан!');
            
            
        } catch (\Exception $ex) {

            return redirect()->back()->with('error', "Произошла ошибка: $ex");
        }
    }

   public function destroy($id)
    {
        $currentComment = Comment::findOrFail($id);
        $currentComment->softDeleted();
        return redirect()->back()->with('success', 'Комментарий успешно удален!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
}
