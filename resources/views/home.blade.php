<x-app-layout>
    <section class="bg-white shadow px-8  fixed top-0 w-full z-10">
        <div class="container mx-auto h-16 flex justify-between items-center">
            <a href="{{route('home')}}" class="flex items-center">
                <img src="/images/logo.jpg" alt="logo" class="w-12 h-12 rounded-full mr-3">
                <h1 class="text-2xl font-bold text-gray-800">YASHOKU finder</h1>
            </a>
            <div class="flex">
                @auth
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="focus:outline-none text-white bg-gray-600 hover:bg-gray-800 rounded text-sm px-5 py-2.5 ml-auto">ログアウト</button>
                    </form>
                @endauth
                @guest
                    <a href="{{route('register')}}" class="mr-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 rounded text-sm px-5 py-2.5">ユーザー登録（無料）</a>
                    <a href="{{route('login')}}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 rounded text-sm px-5 py-2.5">ログイン</a>
                @endauth
            </div>
        </div>
    </section>
    <form action="{{ route('recipe.suggestion') }}" method="GET">
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
                    <button type="submit" class="button-color text-white font-bold py-2 px-4 rounded">レシピを見つける</button>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>

