<x-app-layout>
    <div class="bg-white rounded p-4 w-3/4 mx-auto">
        {{ Breadcrumbs::render('suggestion') }}
        <div class="mb-4"></div>
        @if(!$recipes->isEmpty())
        <h1 class="text-4xl mb-8 text-center">今のあなたにぴったりの夜食はこちらです！</h1>
            @foreach($recipes as $recipe)
                @include('recipes.partial.recipe_card'){{--レシピカードの標示--}}
            @endforeach
        @else
            <h3 class="text-xl text-center mb-8">申し訳ございません。レシピが見つかりませんでした。ほかのカテゴリーを選択して探してみてください。</h3>
            <a href="{{ route('home') }}" class="block text-center hover:underline">ほかのカテゴリーで探す</a>
        @endif
        </div>
</x-app-layout>
