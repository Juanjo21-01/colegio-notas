<x-app-layout>
    @section('title', '- Grados')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
        </ol>
    </x-slot>

    {{-- Mensajes --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
            <strong class="p-2">{{ session('success') }}</strong>
            <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"><i
                    class="bi bi-x-lg"></i></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
            <strong class="p-2">{{ session('error') }}</strong>
            <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"><i
                    class="bi bi-x-lg"></i></button>
        </div>
    @endif

    {{-- Contenido --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 p-2 font-weight-bold text-primary">Información de los Grados</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered max-w-full mt-2">
                    <thead>
                        <tr class="text-center">
                            <th class="px-4 py-2 col-1">No.</th>
                            <th class="px-4 py-2 col-3">Grado</th>
                            <th class="px-4 py-2 col-1">Sección</th>
                            <th class="px-4 py-2 col-2">Estudiantes</th>
                            <th class="px-4 py-2 col-2">Estado</th>
                            <th class="px-4 py-2 col-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($grados) == 0)
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="6">No hay grados registrados</td>
                            </tr>
                        @endif
                        @foreach ($grados as $grado)
                            <tr>
                                <td class="border px-4 py-2 col-1 align-middle">{{ $grado->id }}</td>
                                <td class="border px-4 py-2 col-3 align-middle">{{ $grado->nombre }} </td>
                                <td class="border px-4 py-2 col-1 align-middle text-center">{{ $grado->seccion }}</td>
                                <td class="border px-4 py-2 col-2 align-middle text-center">
                                    {{ $grado->asignacionGradoEstudiantes->count() }}</td>
                                <td class="border px-4 py-2 col-2 text-center align-middle">
                                    @if ($grado->estado == 'activo')
                                        <a href="{{ route('grados.cambiar-estado', $grado->id) }}" class="text-white">
                                            <span class="badge badge-success px-3 py-2">Activo </span>
                                        </a>
                                    @else
                                        <a href="{{ route('grados.cambiar-estado', $grado->id) }}" class="text-white">
                                            <span class="badge badge-danger px-3 py-2">
                                                Inactivo
                                            </span>
                                        </a>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 col-3 align-middle text-center">
                                    <a href="#" class="btn btn-info bg-gradient-info"><i class="bi bi-eye"></i>
                                        Cursos</a>
                                    <a href="#" class="btn btn-info bg-gradient-info"><i class="bi bi-eye"></i>
                                        Notas</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
