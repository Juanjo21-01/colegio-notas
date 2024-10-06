<x-guest-layout>
    <div class="my-4 text-sm text-gray-600">
        {{ __('Esta es una área segura de la aplicación. Por favor confirma tu contraseña antes de continuar') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <!-- Contraseña -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-end mt-4">
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>

        <hr />
        <a href="{{ route('login') }}" class="small">Regresar</a>
    </form>
</x-guest-layout>
