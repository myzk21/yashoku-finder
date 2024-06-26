<x-app-layout>
    <div class="bg-white rounded p-4 w-3/4 mx-auto">
        {{-- {{ Breadcrumbs::render('index') }} --}}
        <div class="mb-4"></div>
        <h1 class="text-white text-4xl mb-4 text-center">今のあなたにぴったりの夜食はこちらです！</h1>
        @if(!$recipes->isEmpty())
            @foreach($recipes as $recipe)
                @include('recipes.partial.recipe_card'){{--レシピカードの標示--}}
            @endforeach
        @else
            <h3 class="text-xl text-center">申し訳ございません。レシピが見つかりませんでした。ほかのカテゴリーを選択して探してみてください。</h3>
            <a href="{{ route('home') }}">ほかのカテゴリーで探す</a>
        @endif
        </div>
</x-app-layout>
