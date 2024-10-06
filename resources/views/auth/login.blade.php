<x-guest-layout meta-title="- Login">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center">
        <h1 class="text-gray-900 mb-4">Bienvenido</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Correo -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-3 form-group">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Recuerda me -->
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="recuerdame">
                <label class="custom-control-label" for="recuerdame">
                    Recuérdame
                </label>
            </div>
        </div>

        <div class="text-center">
            <x-primary-button class="w-100">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
            <hr />
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">
                    {{ __('¿Olvidó su Contraseña?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
