<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            LOGO
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu sua senha? Sem problemas. Apenas insira seu endereço de email que nós do Squad 6 vamos mandar um email para você com um link para você resetar sua senha.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Recuperar Senha') }}
                </x-jet-button>
            </div>
            <div class="flex items-center mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Voltar') }}
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
