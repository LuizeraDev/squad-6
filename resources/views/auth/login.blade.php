<x-guest-layout>

    <div class="grid">
        <div class="row">

        <div class="col-12">
            <div class="logo">
                <H1>LOGO</H1>
            </div>
        </div>

        <div class="col-12">
            <x-jet-validation-errors class="mb-4" />
        

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        </div>

        <div class="col-12">
            
                <section class="formWrapper">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="email">
                            <label for="email" value="{{ __('Email') }}" />
                            <input id="email" type="email" name="email" :value="old('email')" placeholder="e-mail" required autofocus />
                        </div>

                        <div class="password">
                            <label for="password" value="{{ __('Senha') }}" />
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder ="senha" />
                        </div>

                        <div class="remember_me">
                            <input id="remember_me" type="checkbox"  name="remember"/>   
                            <label for="remember_me" >{{ __('Lembre de mim') }}</label>                      
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

    </div>
    
</x-guest-layout>

