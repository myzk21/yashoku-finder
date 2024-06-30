<x-app-layout>
    <div class="bg-white rounded p-4 w-3/4 mx-auto">
    {{ Breadcrumbs::render('index') }}
        <div class="flex flex-wrap my-4 justify-end">
            <form action="{{route('recipe.index')}}" method="GET" class="mr-4 mb-2 sm:mb-0">
            <select class="w-32 p-2 form-control" name="sort" id="sortOrder" onchange="this.form.submit()">
                <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>新しい順</option>
                <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>古い順</option>
            </select>
            </form>
            <form action="{{route('recipe.index')}}" method="GET" class="flex">
            <input type="text" name="title" value="{{ $filters['title'] ?? '' }}" placeholder="レシピ名を入力" class="border border-gray-300 mr-2 mb-4">
                <div class="text-center">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">検索</button>
                </div>
            </form>
        </div>
    @foreach($recipes as $recipe)
        @include('recipes.partial.recipe_card'){{--レシピカードの標示--}}
    @endforeach
        {{ $recipes->links() }}
    </div>
</x-app-layout>
