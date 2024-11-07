<x-app-layout>
    @section('title', '- Calificaciones Estudiantes')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.estudiantes') }}">Calificaciones de los
                    Estudiantes</a>
            </li>
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

    <div class="px-4 pb-4">

        {{-- Titulo --}}
        <h1 class="text-primary font-weight-bold text-lg text-center text-uppercase">Grados</h1>
        <hr class="my-3">

        {{-- Contenido --}}
        <div class="row">
            <div class="col-12">
                @foreach ($grados->groupBy('nombre') as $gradoNombre => $gradosPorNombre)
                    {{-- Tarjeta de encabezado para cada grado --}}
                    <div class="card shadow m-2">
                        <div class="card-header">
                            <h4 class="text-primary text-lg m-0 text-center text-uppercase font-weight-bold">
                                {{ $gradoNombre }} Básico
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                @foreach ($gradosPorNombre as $grado)
                                    <div class="col-6 d-flex align-items-center justify-content-center">
                                        <div class="card shadow m-2 w-100">
                                            <div class="card-header">
                                                <h5 class="text-primary text-center text-lg m-0"> {{ $grado->nombre }}
                                                    Sección "{{ $grado->seccion }}"</h5>
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <div class="px-2">
                                                    <p><span class="font-weight-bold">Estudiantes Activos:</span>
                                                        {{ $grado->asignacionGradoEstudiantes->count() }} estudiantes
                                                    </p>
                                                </div>
                                                <div class="mt-auto d-flex justify-content-center">
                                                    <a href="{{ route('calificaciones.estudiantes.notas', $grado->id) }}"
                                                        class="btn btn-primary mb-2"> <i class="bi bi-eye"></i>
                                                        Ver Calificaciones
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</x-app-layout>
