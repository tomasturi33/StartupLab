<!DOCTYPE html>
<html>
<head>
    <title>UNL Potencia</title>
    <style>
        @page { margin: 0px; }

        body {
            font-family: lato, sans-serif;
            font-size: 12px;
            margin-top: 8rem;
            margin-bottom: 6rem;
            margin-left: 4rem;
            margin-right: 4rem;
        }

        header { 
            position: fixed; 
            top: -40px; 
            left: 0px; 
            right: 0px; 
            height: 70px; 
            width: 100%;
        }
        
        footer { 
            position: fixed; 
            bottom: 0px; 
            left: 0px; 
            right: 0px; 
            height: 97px; 
            width: 100%;
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }

        .table {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        .table2, tr, th {
            width: 100%;
        }

        th {
            padding-top: .8rem!important;
            padding-bottom: 0.2rem!important;
        }

        td, th {
          text-align: left;
          padding: 0px;
        }

        label {
            font-weight: bolder;
            text-transform: uppercase;
        }

        p {
            margin-top: 8px;
            margin-bottom: 2rem;
        }

        .page-break {
            page-break-after:always;
        }
    </style>
</head>

<body>
    
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header>
        <img src="./img/header.png" width="100%"/>
    </header>

    <footer>
        <img src="./img/footer.png" width="100%"/>
    </footer>

    @if($entrepreneurship->title)
        <label> StartUp:</label>
        <p>{!! nl2br($entrepreneurship->title) !!}</p>
    @endif

    @if($entrepreneurship->executive_summary)
        <label> Resumen Ejecutivo:</label>
        <p>{!! nl2br($entrepreneurship->executive_summary) !!}</p>
    @endif

    @if($entrepreneurship->problem_detected)
        <label>Problema detectado:</label>
        <p>{!! nl2br($entrepreneurship->problem_detected) !!}</p>
    @endif

    @if($entrepreneurship->proposed_solution)
        <label>Solución propuesta:</label>
        <p>{!! nl2br($entrepreneurship->proposed_solution) !!}</p>
    @endif

    @if($entrepreneurship->market)
        <label>Mercado:</label>
        <p>{!! nl2br($entrepreneurship->market) !!}</p>
    @endif

    @if($entrepreneurship->strategic_alliance)
        <label>Asociación estrategica:</label>
        <p>{!! nl2br($entrepreneurship->strategic_alliance) !!}</p>
    @endif

    @if($entrepreneurship->entrepreneurial_team)
        <label>Equipo emprendedor:</label>
        <p>{!! nl2br($entrepreneurship->entrepreneurial_team) !!}</p>
    @endif

    @if($entrepreneurship->contact)
        <label>Contacto:</label>
        <p>{!! nl2br($entrepreneurship->contact ) !!}</p>
    @endif

    <div class="page-break"></div>
    @foreach ($team as $t)
        <table class="table2">
            <tr>
                <th><label>Emprendedor:</label></th>
                <th><label>Correo Electrónico</label></th>
            </tr>
            <tr>
                <td>{{ $t->lastname.', '.$t->name }}</td>
                <td>{{ $t->email }}</td>
            </tr>
        </table>
    @endforeach
</body>

</html>