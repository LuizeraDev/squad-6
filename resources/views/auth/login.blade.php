<x-guest-layout>

    <div class="gridLogin">

      <div class="logo">
      
      </div>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="formContainer">
            
                <section class="formWrapper">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="email">
                            <label for="email" value="{{ __('Email') }}" />
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div class="password">
                            <label for="password" value="{{ __('Senha') }}" />
                            <input id="password" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="remember_me">
                            <label for="remember_me" >
                                <input id="remember_me" type="checkbox"  name="remember"/>
                                <span>{{ __('Lembre de mim') }}</span>
                            </label>

                        </div>

                        <button class="button">
                                {{ __('Entrar') }}
                        </button>

                        <section class="form_links">
                            <div class="register">
                                    <a href="{{ route('register') }}">
                                        {{ __('Não possuo uma conta') }}
                                    </a>
                            </div>

                            <div class="forgot_pw">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Esqueceu sua senha?') }}
                                    </a>
                                @endif
                            </div>
                            
                        </section>

                    </form>

                </section>  
        </div>              

    </div>
    
</x-guest-layout>

