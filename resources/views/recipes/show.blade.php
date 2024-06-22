<x-app-layout>
    <div class="w-10/12 p-6 mx-auto bg-white rounded mb-6">
        {{---レシピ詳細--}}
        <div class="grid grid-cols-2 rounded border border-gray-700 my-4">
            <div class="col-span-1">
                <img class="object-cover w-full aspect-square"src="{{ $recipe->image }}" alt="{{ $recipe->title }}">
            </div>
            <div class="col-span-1 p-4">
                <h4 class="text-2xl font-bold mb-2">レシピ名</h4>
                <p class="mb-4 ml-6">{{ $recipe->title }}</p>
                <h4 class="text-2xl font-bold mb-2">説明</h4>
                <p class="mb-4 ml-6">{{ $recipe->description }}</p>
                <p class="mb-4 text-gray-800 ml-6">{{ $recipe->user->name }}</p>
                <h4 class="text-2xl font-bold mb-2">材料</h4>
                <ul class="text-gray-800 ml-6 mb-4">
                    @foreach($recipe->ingredients as $i)
                        <li>{{ $i->name }}:{{ $i->quantity }}</li>
                    @endforeach
                </ul>
                <h4 class="text-2xl font-bold mb-2">カテゴリー</h4>
                @foreach($recipe->categories as $c)
                    <p class="font-bold ml-6 mb-2">{{ $c->name }}</p>
                @endforeach
                {{-- <div class="flex-container">
                    @foreach($recipe->categories as $c)
                    <div class="category-card bg-white rounded-lg">
                        <div class="p-2">
                                <p class="font-bold ml-6">{{ $c->name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
            </div>
        </div>

     {{--手順--}}
        <div class="">
            <h4 class="text-2xl font-bold mb-6">作り方</h4>
            <div class="grid grid-cols-4 gap-4">
                @foreach($recipe->steps as $s)
                    <div class="mb-2 p-2 border border-gray-700 rounded">
                        <div class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full mr-4 mb-2">
                            {{ $s->step_number }}
                        </div>
                        <p>{{ $s->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

     {{--レビュー--}}
    <div class="w-10/12 p-6 mx-auto bg-white rounded">
        <h4 class="text-2xl font-bold mb-6">レビュー</h4>
            <div class="flex mb-4 justify-end">
                @for($i = 0; $i < 5; $i++) {{--星のアイコン--}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" id="review-star">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                @endfor
                <input type="text" id="comment" name="comment" placeholder="コメント" class="w-2/5 border border-gray-400 p-2 ml-4 rounded">
                <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 ml-2 rounded">コメントを投稿</button>
            </div>
            @foreach($recipe->reviews as $r)
                <div class="recipe-background-color rounded mb-4">
                    <div class="flex mb-4">
                        @for($i = 0; $i < $r->rating; $i++) {{--星のアイコン--}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-400">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                            </svg>
                        @endfor
                        {{-- <p class="text-gray-800 font-bold ml-2">{{ $r->user->name }}</p> --}}
                    </div>
                    <p>{{ $r->comment }}</p>
                </div>
            @endforeach
            @if($recipe->reviews->isEmpty())
                <p class="recipe-background-color p-2">レビューはありません</p>
            @endif
    </div>

</x-app-layout>
