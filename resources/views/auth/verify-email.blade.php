<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('ご登録ありがとうございます。弊社から送信したリンクをクリックしてメールアドレスを確認してください。もしメールを受信されなかった場合は、お手数ですが再度送信いたします。') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('ご登録のメールアドレスに新しい確認リンクを送信しました') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('確認メールを再送信する') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('ログアウト') }}
            </button>
        </form>
    </div>
</x-guest-layout>
