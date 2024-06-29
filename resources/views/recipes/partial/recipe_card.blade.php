<a href="{{ route('recipe.show', ['id' => $recipe->id]) }}" class="flex flex-col items-center w-full bg-white mb-6 border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100">
    @if($recipe->image)
        <img class="object-cover rounded-t-lg h-40 w-50 md:rounded-l-lg"src="{{ $recipe->image }}" alt="{{ $recipe->title }}">
    @else
        <img class="object-cover rounded-t-lg h-40 w-50 md:rounded-l-lg"src="/images/noImage.jpg" alt="{{ $recipe->title }}">
    @endif
    <div class="flex flex-col justify-between p-4 leading-normal w-full">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-800">{{$recipe->title}}</h5>
        <p class="mb-3 font-normal">{{ $recipe->description }}</p>
        <div class="flex">
            <p class="font-bold mr-2">{{$recipe->user->name}}</p>
            <p class="text-gray-500">{{$recipe->created_at->format('Y年m月d日')}}</p>
        </div>
    </div>
</a>
