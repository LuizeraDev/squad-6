<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            LOGO
        </x-slot>
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css" 
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mt-4 wrapperNome">

                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" />
                <label class="labelNome" for="name" value="{{ __('Nome') }}"><span class="contentNome">Nome</span></label>
            </div>

            <div class="mt-4 wrapperNome">
                <input id="email" type="email" name="email" :value="old('email')" required />
                <label class="labelNome" for="email" value="{{ __('Email') }}"><span class="contentNome">Email</span></label>
                
            </div>

            <div class="mt-4 wrapperNome">

                <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <label class="labelNome" for="password" value="{{ __('Senha') }}"><span class="contentNome">Senha</span> </label>
            </div>

            <div class="mt-4 wrapperNome">
                <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <label class="labelNome" for="password_confirmation" value="{{ __('Confirmar Senha') }}"><span class="contentNome">Repetir Senha</span> </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-orange-500 hover:text-blue-500" href="{{ route('login') }}">
                    {{ __('Já possui uma conta?') }}
                </a>

                <button class="ml-4 items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    {{ __('Registrar-se') }}
                <button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
