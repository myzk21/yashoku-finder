<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RecipeRequest;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Ingredient;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


class RecipeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }
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
    public function store(RecipeRequest $request)
    {
        $posts = $request->all();

        //画像ファイルの保存
        if( $request->hasFile('image') ) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('recipe', $image, 'public');//s3のURLを取得、awsに保存
            $url = Storage::disk('s3')->url($path);//$pathはrecipe/以下のディレクトリパスだからurlに変換
        }

        try{
            DB::beginTransaction();

            $recipe = new Recipe();
            $recipe->user_id = Auth::id();
            $recipe->title = $posts['title'];
            $recipe->description = $posts['description'];
            if (isset($url)) {
                $recipe->image = $url;
            }
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

            //手順の保存
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
        return redirect()->route('recipe.show', ['id' => $recipe->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $recipe = Recipe::with(['ingredients', 'steps', 'reviews.user', 'categories', 'user'])
        ->where('recipes.id', $id)
        ->first();
        $recipe->increment('views');

         // レシピの投稿者とログインユーザーが同じかどうか
         $is_my_recipe = false;
         if( Auth::check() && (Auth::id() === $recipe->user_id) ) {
            $is_my_recipe = true;
         }
        //投稿済みかどうか
        $is_reviewed = false;
        if( Auth::check() ) {
            $is_reviewed = $recipe->reviews->contains('user_id', Auth::id());
        }


        return view('recipes.show', compact('recipe', 'is_my_recipe', 'is_reviewed'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::with(['ingredients', 'steps', 'reviews.user', 'categories', 'user'])
        ->where('recipes.id', $id)
        ->first();
        $categories = Category::all();

        if( !Auth::check() || (Auth::id() !== $recipe->user_id) ) {
            abort(403);
        }
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeRequest $request, string $id)
    {
        $posts = $request->all();
        $update_array = [
            'title' => $posts['title'],
            'description' => $posts['description'],
        ];
        if( $request->hasFile('image') ) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('recipe', $image, 'public');
            $url = Storage::disk('s3')->url($path);//s3に画像保存ー＞url取得
            $update_array['image'] = $url;//もし画像が更新されたら配列に追加
        }
        try{
            DB::beginTransaction();

            Recipe::where('id', $id)->update($update_array);

            Ingredient::where('recipe_id', $id)->delete();//既存の材料、ステップの削除
            Step::where('recipe_id', $id)->delete();

            //材料の保存
            $ingredients = [];
            foreach($posts['ingredients'] as $key => $ingredient) {
                $ingredients[$key] = [
                    'recipe_id' => $id,
                    'name' => $ingredient['name'],
                    'quantity' => $ingredient['quantity'],
                ];
            }
            Ingredient::insert($ingredients);

            //手順の保存
            $steps = [];
            foreach($posts['steps'] as $key => $step) {
                $steps[$key] = [
                    'recipe_id' => $id,
                    'step_number' => $key + 1,
                    'description' => $step,
                ];
            }
            Step::insert($steps);
            //カテゴリー
            $recipe = Recipe::find($id);
            $recipe->categories()->sync($posts['categories']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::debug(print_r($th->getMessage(), true));
            throw $th;
        }
        flash()->success('レシピを更新しました');
        return redirect()->route('recipe.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Recipe::where('id', $id)->delete();

        flash()->warning('レシピを削除しました');
        return redirect()->route('home');
    }
}
