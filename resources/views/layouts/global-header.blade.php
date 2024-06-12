<section class="bg-white shadow px-8  fixed top-0 w-full z-10">
    <div class="container mx-auto h-16 flex justify-between items-center">
        <a href="{{route('home')}}" class="flex items-center">
            <img src="images/logo.jpg" alt="logo" class="w-12 h-12 rounded-full mr-3">
            <h1 class="text-2xl font-bold text-gray-800">YASHOKU finder</h1>
        </a>
        <div class="flex">
            @auth
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 rounded text-sm px-5 py-2.5 ml-auto">ログアウト</button>
                </form>
            @endauth
            @guest
                <a href="{{route('register')}}" class="mr-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 rounded text-sm px-5 py-2.5">ユーザー登録（無料）</a>
                <a href="{{route('login')}}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 rounded text-sm px-5 py-2.5">ログイン</a>
            @endauth
        </div>
    </div>
</section>
