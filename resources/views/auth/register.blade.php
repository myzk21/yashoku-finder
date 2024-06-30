<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="text-center text-lg border-b mb-3">ユーザー登録（無料）</h1>
        <!-- Name -->
        <div>
            <div class="flex">
                <x-input-label for="name" :value="__('Name')" /><span class="text-red-500 ml-1">必須</span>
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Introduction -->
        <div class="mt-4">
            <x-input-label for="introduction" value="自己紹介" />
            <textarea id="introduction" name="introduction" type="text" class="mt-1 block w-full">{{ old('introduction') }}</textarea>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="email" :value="__('Email')" /><span class="text-red-500 ml-1">必須</span>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password" :value="__('Password')" /><span class="text-red-500 ml-1">必須</span>
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span class="text-red-500 ml-1">必須</span>
            </div>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('すでにご登録されてますか？') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
