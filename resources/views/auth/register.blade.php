<x-guest-layout>
    

        <div class="gridLogin">

        <div class="logo">
            <H1> LOGO </H1>
        </div>

        <x-jet-validation-errors class="mb-4" />

            <div class="formContainer">

                <section class="formWrapper">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class ="name">
                            <label for="name" value="{{ __('Nome') }}" />
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="email">
                            <label for="email" value="{{ __('Email') }}" />
                            <input id="email" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="password">
                            <label for="password" value="{{ __('Senha') }}" />
                            <input id="password" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="password">
                            <label for="password_confirmation" value="{{ __('Confirmar Senha') }}" />
                            <input id="password_confirmation"  type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="">
                            <a href="{{ route('login') }}">
                                {{ __('Já possui uma conta?') }}
                            </a>

                            <button class="button">
                                {{ __('Registrar-se') }}
                            </button>

                        </div>

                    </form>

                </section>

            </div>

        </div>
    
</x-guest-layout>
