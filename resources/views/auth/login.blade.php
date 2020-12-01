<x-guest-layout>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="logoDiv max-w-sm md:w-1/2 ">
            <img class="logo md:1/2" src="{{ asset('assets/Logo1.png') }}" alt="Logo">
        </div>

        <div class="faixa sm:w-full">
            <h3>BEM VINDO AO FIFO</h3>
            <p>Veja as filas de atividades que estão rolando no escritório</p>
        <div class="painel sm:w-full ">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Os erros serão mostrados aonde esta tag estiver -->
            <x-jet-validation-errors class="mb-4" />

            <div class="mt-4 wrapperNome">
                <input id="email" class="text-gray-800" id="username" type="text" type="email" name="email" :value="old('email')" required  />
                <label class=" labelNome" for="email" value="{{ __('Email') }}"><span class="contentNome">Email</span></>
            </div>

            <div class="mt-4 wrapperNome">
                <input class="text-gray-800" id="password" class="block mt-1 w-full" type="password" name="password"  required autocomplete="off" />
                <label class="labelNome" for="password" value="{{ __('Senha') }}"><span class="contentNome">Senha</span></>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="remember_me flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="text-sm">{{ __('Lembre de mim') }}</span>
                </label>
            </div>

           
                 
                <button class="enterButton transform motion-reduce:transform-none hover:-translate-y-1 hover:scale-110 transition ease-in-out duration-300
                 items-center px-4 py-2uppercase tracking-widest">
                    {{ __('Entrar') }}
                </button>

            
            <div class="links">

                <a class="register text-sm" href="{{ route('register') }}">
                            {{ __('Não possuo uma conta') }}
                        </a>


              
                    @if (Route::has('password.request'))
                        <a class="forgotPW text-sm" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif
              

            </div>
        </form>
        </div>
    </div>

</x-guest-layout>

