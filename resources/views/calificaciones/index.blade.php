<x-app-layout>
    @section('title', '- Calificaciones')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.index') }}">Calificaciones</a></li>
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
        @if (Auth::user()->role->nombre == 'Administrador' || Auth::user()->role->nombre == 'Secretaria')
            <h1 class="text-primary font-weight-bold text-lg text-center">Cursos</h1>
        @elseif (Auth::user()->role->nombre == 'Profesor')
            <h1 class="text-primary font-weight-bold text-lg text-center">Cursos Asignados del Profesor:
                {{ Auth::user()->nombres }}
                {{ Auth::user()->apellidos }}</h1>
        @endif
        <hr class="my-3">
        <h2 class="text-secondary text-lg ml-3">
            <span class="font-weight-bold"> Total: </span> {{ $gradosCursos->count() }} cursos
        </h2>

        {{-- Contenido --}}
        <div class="row">
            <div class="col-12">
                @foreach ($gradosCursos->groupBy('grado.nombre') as $gradoNombre => $cursosPorGrado)
                    {{-- Tarjeta de encabezado para cada grado --}}
                    <div class="card shadow m-2">
                        <div class="card-header">
                            <h4 class="text-primary text-lg m-0 text-center text-uppercase font-weight-bold">
                                {{ $gradoNombre }} Básico
                            </h4>
                        </div>
                        <div class="card-body">
                            @foreach ($cursosPorGrado->groupBy('grado.seccion') as $seccion => $cursosPorSeccion)
                                {{-- Encabezado para cada sección dentro del grado --}}
                                <div class="px-2">
                                    <h5 class="text-secondary font-weight-bolder text-center">Sección
                                        "{{ $seccion }}"</h5>
                                    <div class="row justify-content-center align-items-center">
                                        @foreach ($cursosPorSeccion as $gradoCurso)
                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                <div class="card shadow m-1">
                                                    <div class="card-header">
                                                        <h5 class="text-primary text-center text-lg m-0">
                                                            {{ $gradoCurso->curso->nombre }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="px-2">
                                                            <p><span class="font-weight-bold">Profesor:</span>
                                                                {{ $gradoCurso->user->nombres }}
                                                            </p>
                                                            <p><span class="font-weight-bold">Estudiantes
                                                                    Activos:</span>
                                                                {{ $gradoCurso->grado->asignacionGradoEstudiantes->count() }}
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="d-flex flex-column justify-content-center align-items-center">
                                                            <div
                                                                class="d-flex justify-content-center align-items-center">
                                                                <a href="{{ route('calificaciones.create', ['gradoCurso' => $gradoCurso->id]) }}"
                                                                    class="btn btn-success mr-1"> <i
                                                                        class="bi bi-plus-lg"></i>
                                                                    Ingresar
                                                                </a>
                                                                <a href="{{ route('calificaciones.edit', $gradoCurso->id) }}"
                                                                    class="btn btn-secondary m-1"> <i
                                                                        class="bi bi-pencil"></i>
                                                                    Editar
                                                                </a>
                                                            </div>
                                                            <a href="{{ route('calificaciones.show', $gradoCurso->id) }}"
                                                                class="btn btn-primary "> <i
                                                                    class="bi bi-eye"></i>
                                                                Ver Calificaciones
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr class="my-3">

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</x-app-layout>
