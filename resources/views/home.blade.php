<x-app-layout>
    {{-- <h1 class="text-white text-6xl text-center mb-6">夜食Finder</h1>
    <h3 class="text-white text-2xl text-center mb-6">～ 今のあなたに最適な夜食を見つけましょう ～</h3>

    <div class="text-white">
        <h3  class="text-xl border-b-2 text-center">あなたの今の気分を教えてください</h3>
    </div> --}}
    <form action="" method="POST">
        <div class="min-h-screen flex flex-col justify-center items-center py-16 w-4/5 mx-auto home-background-color">
            <h1 class="text-white text-6xl mb-4">夜食Finder</h1>
            <h3 class="text-white text-2xl mb-8">～ 今のあなたに最適な夜食を見つけましょう ～</h3>

            <div class="w-full max-w-lg rounded-lg overflow-hidden shadow-lg bg-white">
                <h3 class="text-2xl border-b-2 border-gray-300 py-4 text-center">あなたの今の気分を教えてください</h3>
                <div class="p-4">
                    <div class="text-center flex flex-wrap justify-center">
                        @foreach($categories as $c)
                            <label for="category{{ $c->id }}" class="mx-3 mb-3">
                                <input type="checkbox" name="categories[]" id="category{{ $c->id }}" value="{{ $c->id }}">
                                {{ $c->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <hr class="mb-6 border-gray-300">
                <div class="flex justify-center mb-6">
                    <button type="submit" class="button-color text-white font-bold py-2 px-4 rounded">レシピを投稿する</button>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>

