<x-app-layout>
    @section('title', '- Inicio')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
        </ol>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="h2 font-weight-bold">Bienvenido al Sistema de Gestión Escolar</h1>
            </div>

            <div class="row justify-content-center">
                <!-- Tarjeta de acceso a calificaciones -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold">Calificaciones</h5>
                            <p class="card-text">Accede a las calificaciones de los estudiantes.</p>
                            <a href="{{ route('calificaciones.cursos.index') }}"
                                class="btn btn-primary rounded-pill px-4">Ir a Calificaciones</a>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role->nombre !== 'Profesor')
                    <!-- Tarjeta de acceso a estudiantes -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">Estudiantes</h5>
                                <p class="card-text">Gestiona la información de los estudiantes.</p>
                                <a href="{{ route('estudiantes.index') }}" class="btn btn-primary rounded-pill px-4">Ir
                                    a
                                    Estudiantes</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de agregar estudiantes -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">Agregar Estudiantes</h5>
                                <p class="card-text">Añade nuevos estudiantes al sistema.</p>
                                <a href="{{ route('estudiantes.create') }}"
                                    class="btn btn-primary rounded-pill px-4">Agregar Estudiantes</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de agregar cursos -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">Agregar Cursos</h5>
                                <p class="card-text">Añade nuevos cursos al sistema.</p>
                                <a href="{{ route('cursos.create') }}" class="btn btn-primary rounded-pill px-4">Agregar
                                    Cursos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de asignar estudiantes al grado -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">Asignar Estudiantes al Grado</h5>
                                <p class="card-text">Asigna estudiantes a los grados correspondientes.</p>
                                <a href="{{ route('grados-estudiantes.create') }}"
                                    class="btn btn-primary rounded-pill px-4">Asignar Estudiantes al Grado</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de asignar estudiantes al curso -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">Asignar Estudiantes al Curso</h5>
                                <p class="card-text">Asigna estudiantes a los cursos correspondientes.</p>
                                <a href="{{ route('grados-cursos.create') }}"
                                    class="btn btn-primary rounded-pill px-4">Asignar Estudiantes al Curso</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <hr class="my-4">

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Misión</h5>
                    <p class="card-text">
                        Somos una institución cooperativista abierto a los cambios políticos, sociales, económicos,
                        culturales y tecnológicos, con vocación de servicio a la comunidad urbana y rural, ofreciendo
                        una educación con tecnologías educativas adecuadas al nivel, con modalidad intercultural, con
                        procesos de formación creativa, recreativa, académica, deportiva, tecnológica y pedagógica.
                    </p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Visión</h5>
                    <p class="card-text">
                        Ser una institución educativa con cobertura en San Lorenzo, y municipios aledaños con plenos
                        reconocimientos del Ministerio de Educación, comprometido con la comunidad educativa en la
                        búsqueda de constante perfeccionamiento, con plena disposición y capacidad para cumplir
                        eficientemente con las políticas y estrategias del Ministerio de Educación, brindando excelente
                        servicio educativo con personal altamente capacitado.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
