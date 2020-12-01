
<x-guest-layout>

    <x-jet-authentication-card>

        <x-slot name="logo" >
           
        </x-slot>

        <form class="formReg max-w-sm md:w-1/2 " method="POST" action="{{ route('register') }}">
            @csrf
            
            <img class="regLogoPreto" src="{{ asset('assets/Logo2.png') }}" alt="Logo">
            <!-- Mensagens de erro -->
            <x-jet-validation-errors class="mb-4" />

            <div class="Reg wrapperNome">
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" />
                <label class="labelNome" for="name" value="{{ __('Nome') }}"><span class="contentNome">Nome</span></label>
            </div>

            <div class="Reg wrapperNome ">
                <input id="email" type="email" name="email" :value="old('email')" required />
                <label class="labelNome" for="email" value="{{ __('Email') }}"><span class="contentNome">Email</span></label>
            </div>

            <div class="Reg wrapperNome">
                <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <label class="labelNome" for="password" value="{{ __('Senha') }}"><span class="contentNome">Senha</span> </label>
            </div>

            <div class="Reg wrapperNome">
                <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <label class="labelNome" for="password_confirmation" value="{{ __('Confirmar Senha') }}"><span class="contentNome">Repetir Senha</span> </label>
            </div>

            <button class="enterButtonReg transform motion-reduce:transform-none hover:-translate-y-1 hover:scale-110 transition ease-in-out duration-300
                ml-4 items-center px-4 py-2 bg-gray-600 border border-transparent font-semibold text-xs text-white uppercase tracking-widest">
                    {{ __('Registrar-se') }}
            <button>

          
                <a class="voltarLink" href="{{ route('login') }}">
                    {{ __('Já possui uma conta?') }}
                </a>
           
              
           
        </form>

    </x-jet-authentication-card>
      
    <div class="logoDivReg max-w-sm md:w-1/2 ">
            <img class="logoReg md:1/2" src="{{ asset('assets/Registro.svg') }}" alt="Foto Registro">
    </div>
  
</x-guest-layout>
