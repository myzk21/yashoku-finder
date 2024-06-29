<x-app-layout>
    <div class="container mx-auto p-4 w-3/4">
        <div class="bg-white shadow-md rounded p-6 mb-4 flex">
            <div class="flex-grow">
                <h1 class="text-2xl font-bold mb-2">{{ $user->name }}</h1>
                <p class="text-gray-700 mb-4">{{ $user->introduction }}</p>
            </div>
            @if(Auth::check() && (Auth::user()->id === $user->id))
                <a href="{{route('profile.edit')}}" class="ml-auto hover:underline">編集</a>
            @endif
        </div>

        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-xl font-bold mb-4">投稿したレシピ</h2>
            @if($recipes->isEmpty())
                <p class="text-gray-700">まだレシピが投稿されていません。</p>
            @else
                <ul>
                    @foreach($recipes as $recipe)
                        @include('recipes.partial.recipe_card'){{--レシピカードの標示--}}
                    @endforeach
                </ul>
            {{ $recipes->links() }}
            @endif
        </div>
    </div>
</x-app-layout>
