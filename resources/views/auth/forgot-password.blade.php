<x-guest-layout>
    <div class="my-4">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="text-center mt-4">
            <x-primary-button>
                {{ __('Restablecer contraseña') }}
            </x-primary-button>
            <hr />
            <a href="{{ route('login') }}" class="small">Regresar</a>
        </div>
    </form>
</x-guest-layout>
