<x-app-layout>
    @section('title', '- Perfil')

    <x-slot name="header">
        <ol class="breadcrumb bg-light mb-0 p-2">
            <li class="breadcrumb-item"><a href="{{ route('profile.edit') }}">Perfil</a></li>
        </ol>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Formulario de actualización de información de perfil -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Actualizar Información de Perfil</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Formulario de actualización de contraseña -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Actualizar Contraseña</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Formulario de eliminación de usuario -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 text-danger">Eliminar Cuenta</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
