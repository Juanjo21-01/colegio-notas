<x-app-layout>
    @section('title', '- Usuarios - Editar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item"><a href="{{ route('usuarios.edit', $usuario->id) }}">Editar Usuario</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Editar Usuario </h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Datos personales --}}
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos Personales</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Nombres ---->
                        <div class="col">
                            <x-input-label for="nombres" class="form-label">Nombres</x-input-label>
                            <x-text-input type="text" class="form-control" id="nombres" name="nombres"
                                value="{{ old('nombres', $usuario->nombres) }}" />
                            @error('nombres')
                                <x-input-error for="nombres">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- DPI ---->
                        <div class="col">
                            <x-input-label for="dpi" class="form-label">DPI</x-input-label>
                            <x-text-input type="text" class="form-control" id="dpi" name="dpi"
                                value="{{ old('dpi', $usuario->dpi) }}" />
                            @error('dpi')
                                <x-input-error for="dpi">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Telefono ---->
                        <div class="col">
                            <x-input-label for="telefono" class="form-label">Teléfono</x-input-label>
                            <x-text-input type="text" class="form-control" id="telefono" name="telefono"
                                value="{{ old('telefono', $usuario->telefono) }}" />
                            @error('telefono')
                                <x-input-error for="telefono">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Apellidos ---->
                        <div class="col">
                            <x-input-label for="apellidos" class="form-label">Apellidos</x-input-label>
                            <x-text-input type="text" class="form-control" id="apellidos" name="apellidos"
                                value="{{ old('apellidos', $usuario->apellidos) }}" />
                            @error('apellidos')
                                <x-input-error for="apellidos">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Rol ---->
                        <div class="col">
                            <x-input-label for="role_id"
                                class="form-label
                                ">Rol</x-input-label>
                            <select class="form-control" id="role_id" name="role_id">
                                <option value="">Seleccione un rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}"
                                        @if (old('role_id', $usuario->role_id) == $rol->id) selected @endif>
                                        {{ $rol->nombre }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <x-input-error for="role_id">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Datos de la cuenta --}}
            <div class="card shadow mt-3">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos de la Cuenta</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Correo ---->
                        <div class="col">
                            <x-input-label for="email" class="form-label
                                ">Correo
                                Electrónico</x-input-label>
                            <x-text-input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $usuario->email) }}" />
                            @error('email')
                                <x-input-error for="email">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Contraseña ---->
                        <div class="col">
                            <x-input-label for="password" class="form-label">Contraseña</x-input-label>
                            <x-text-input type="password" class="form-control" id="password" name="password" />
                            @error('password')
                                <x-input-error for="password">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones ---->
            <div class="d-flex justify-content-center pt-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-danger mr-4"><i class="bi bi-x-lg"></i>
                    Cancelar</a>
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Actualizar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
