<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            
            
        </x-slot>

        <div class="message">
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

            <div class="wrapperNomeFPW">
                <input id="email" class="shadow appearance-none border border-blue-200 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" type="email" name="email" :value="old('email')" required  />
                <label class=" labelNome" for="email" value="{{ __('Email') }}"><span class="contentNome">Email</span></>
            </div>

            <button class="enterButtonReg transform motion-reduce:transform-none hover:-translate-y-1 hover:scale-110 transition ease-in-out duration-300
                ml-4 items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    {{ __('Recuperar Senha') }}
            </button>

            <div class="voltarLink">
                <a class="text-sm text-gray-600 hover:underline" href="{{ route('login') }}">
                            {{ __('Voltar') }}
                </a>

               
            </div>
            
        </form>

        
    </x-jet-authentication-card>
    
    <div class="logoForgotPW">
        <img src="{{ asset('assets/esqueceuSenha.svg') }}" alt="Logo">
    </div>

</x-guest-layout>
