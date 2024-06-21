<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RecipeCreateRequest;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::paginate(5);
        // dd($recipes);
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeCreateRequest $request)
    {
        $posts = $request->all();

        //画像ファイルの保存
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('recipe', $image, 'public');//s3のURLを取得、awsに保存
        $url = Storage::disk('s3')->url($path);//$pathはrecipe/以下のディレクトリパスだからurlに変換

        try{
            DB::beginTransaction();

            $recipe = new Recipe();
            $recipe->user_id = Auth::id();
            $recipe->title = $posts['title'];
            $recipe->description = $posts['description'];
            $recipe->image = $url;
            // $recipe->views = $posts->views;
            $recipe->save();

            //材料の保存
            $ingredients = [];
            foreach($posts['ingredients'] as $key => $ingredient) {
                $ingredients[$key] = [
                    'recipe_id' => $recipe->id,
                    'name' => $ingredient['name'],
                    'quantity' => $ingredient['quantity'],
                ];
            }
            Ingredient::insert($ingredients);

            //手順の保存(配列に入れて一括で保存)
            $steps = [];
            foreach($posts['steps'] as $key => $step) {
                $steps[$key] = [
                    'recipe_id' => $recipe->id,
                    'step_number' => $key + 1,
                    'description' => $step,
                ];
            }
            Step::insert($steps);

            //カテゴリーの保存
            $recipe->categories()->sync($posts['categories']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::debug(print_r($th->getMessage(), true));
            throw $th;
        }
        flash()->success('レシピを投稿しました');
        // return redirect()->route('recipe.show', ['id' => $recipe->id]);
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
    public function destroy(string $id)
    {
        //
    }
}
