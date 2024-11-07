<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $pdfNombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
        }

        .header {
            margin: 10px 0;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .info {
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 24px;
            color: #00254E;
        }

        h2 {
            font-size: 18px;
            color: #5D83B1;
            margin: 0;
        }

        h3 {
            font-size: 15px;
            color: #565651;
            margin: 0;
        }

        .flag {
            width: 678px;
            height: 20px;
            display: inline-block;
            border: 1px solid black;
        }

        .flag .red {
            background-color: #BE0000;
            height: 100%;
            width: 38%;
            float: left;
        }

        .flag .yellow {
            background-color: #E8E600;
            height: 100%;
            width: 24%;
            float: left;
        }

        .flag .green {
            background-color: #06AD00;
            height: 100%;
            width: 38%;
            float: left;
        }

        .course-info {
            margin: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .bg-success {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
        }

        .bg-danger {
            background-color: #dc3545;
            color: #fff;
            font-weight: bold;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
        }

        .signature p {
            margin: 0;
            font-size: 14px;
            padding: 5px 0;
        }

        .titulo {
            color: #00254E;
            font-weight: bold;
            font-size: 24px;
            padding-left: 10px;
        }

        .tituloPromedio {
            color: #00254E;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div class="flag">
        <div class="red"></div>
        <div class="yellow"></div>
        <div class="green"></div>
    </div>
    <table class="header" style="border: none;">
        <tr>
            <td style="width: 100px; border: none;">
                <img src="{{ public_path('img/logotipo.png') }}" alt="Logo del Instituto" class="logo">
            </td>
            <td style="border: none;">
                <div class="info">
                    <h1>Instituto de Educación Básica por Cooperativa "Prof. Raquel Adolfo Barrios y Barrios"</h1>
                    <h2>San Lorenzo, San Marcos</h2>
                    <h2>Teléfono: 4942 7287</h2>
                </div>
            </td>
        </tr>
    </table>
    <hr>

    <!-- Título de la página -->
    <h1 class="titulo">{{ $grado->nombre }} Básico, Sección "{{ $grado->seccion }}"</h1>

    <!-- Datos del estudiante -->
    <table class="course-info" style="width: 100%; border: none; margin: 0px;">
        <tr>
            <td style="text-align: left; border: none; padding-right: 10px;">

                <h2 style="margin: 0;">Estudiante: {{ $estudiante->nombres }} {{ $estudiante->apellidos }}</h2>
                <h2 style="margin: 0;">Código Personal: {{ $estudiante->codigo_personal }}
                </h2>
            </td>
            <td style="text-align: right; border: none;">
            </td>
        </tr>
        <tr>
            <td style="text-align: left; border: none; padding-right: 10px;">
                <h3 style="margin: 0;">Clave No. _______</h3>
            </td>
            <td style="text-align: right; border: none;">
                <h3 style="margin: 0;">Ciclo Escolar: {{ date('Y') }}</h3>
            </td>
        </tr>
    </table>

    <!-- Tabla de calificaciones -->
    <table>
        <thead>
            <tr>
                <th colspan="7" style="background-color: #f2f2f2;" scope="colgroup">Ficha de Calificación
                </th>
            </tr>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Curso</th>
                <th scope="col">Primera Unidad</th>
                <th scope="col">Segunda Unidad</th>
                <th scope="col">Tercera Unidad</th>
                <th scope="col">Cuarta Unidad</th>
                <th scope="col">Promedio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calificacionesPorCurso as $cursoNombre => $datosCurso)
                @php
                    $promedioCurso = $datosCurso['promedio'];
                    $totalPromedio += $promedioCurso;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cursoNombre }}</td>
                    @foreach (['I', 'II', 'III', 'IV'] as $unidad)
                        <td
                            class="{{ $datosCurso['calificaciones'][$unidad] >= 60 ? 'text-success' : 'text-danger' }}">
                            {{ $datosCurso['calificaciones'][$unidad] }}
                        </td>
                    @endforeach
                    <td class="{{ $promedioCurso >= 60 ? 'bg-success' : 'bg-danger' }}">
                        {{ $promedioCurso }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" class="tituloPromedio">Promedio General</td>
                <td class="{{ $totalPromedio / $totalCursos >= 60 ? 'bg-success' : 'bg-danger' }}">
                    {{ round($totalPromedio / $totalCursos) }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Consideraciones finales y fecha de emisión -->
    <div style="margin-top: 20px;">
        <p><b>Nota:</b> El promedio mínimo para aprobar cada curso es de 60 puntos.</p>
        <p>Fecha de emisión: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- Firmas -->
    <div class="signature">
        <table style="width: 100%; border: none; margin-top: 50px;">
            <tr>
                <td style="border: none; text-align: center; padding: 10px;">
                    <p>F._____________________________</p>
                    <p>Prof. {{ auth()->user()->nombres }} {{ auth()->user()->apellidos }}</p>
                    <p>Docente del Curso</p>
                </td>
                <td style="border: none; text-align: center; padding: 10px;">
                    <p>F._____________________________</p>
                    <p>Prof. José Fernely Serrano Reyes</p>
                    <p>Director del Instituto</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
