<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Funzione per ottenere le category dell'utente loggato
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $categories = Category::where('user_id', $user->id)->orderBy('name')->get();

        return response()->json($categories);
    }

    /**
     * Funzione per salvare la category dell'utente attualmente loggato
     */
    public function store(StoreCategoryRequest $request)
    {

        $data = $request->validated();

        $user = User::find(Auth::id());
        $category = new Category();
        $category->user_id = $user->id;
        $category->name = $data['name'];

        if (isset($data['bg_color_hex'])) {
            $category->bg_color_hex = $data['bg_color_hex'];
        }


        if (isset($data['text_color_hex'])) {
            $category->text_color_hex = $data['text_color_hex'];
        }

        $category->save();

        return response()->json($category, 201);
    }

    /**
     * Funzione per mostrare una category specifica dell'utente loggato
     */
    public function show($id)
    {
        $user = User::find(Auth::id());
        $category = $user->categories()->findOrFail($id);

        return response()->json($category);
    }

    /**
     * Funzione per modificare una category specifica dell'utente loggato
     */
    public function update(UpdateCategoryRequest $request, $id)
    {

        $user = User::find(Auth::id());
        $category = $user->categories()->findOrFail($id);
        $category->update($request->validated());

        return response()->json($category);
    }

    /**
     * Funzione per eliminare una category specifica dell'utente loggato
     */
    public function destroy($id)
    {
        $user = User::find(Auth::id());
        $category = $user->categories()->findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
