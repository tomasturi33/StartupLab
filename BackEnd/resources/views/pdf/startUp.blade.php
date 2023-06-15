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


    <label> StartUp:</label>
    <p>{!! nl2br($entrepreneurship->title) !!}</p>

    <label>Vertical de trabajo:</label>
    <p>{!! nl2br($entrepreneurship->vertical_works->name) !!}</p>

    <table>
        <tr>
            <th style="width:50%;"><label>Estadio de la StartUp:</label></th>
            <th style="width:50%;"><label>Grado de desarrollo:</label></th>
        </tr>
        <tr>
            <td style="padding-top:.5rem;">{{ $entrepreneurship->entrepreneurship_stadia->name }}</td>
            <td style="padding-top:.5rem;">
                @if ($entrepreneurship->entrepreneurship_stadia->name=='Idea')
                    --
                @else
                    {{ $entrepreneurship->development_degrees->name }}
                @endif
            </td>
        </tr>
    </table>
    <br><br>

    <table>
        <tr>
            <th style="width:50%;"><label>Provincia:</label></th>
            <th style="width:50%;"><label>Localidad:</label></th>
        </tr>
        <tr>
            <td style="padding-top:.5rem;">{{ $entrepreneurship->provincia->name }}</td>
            <td style="padding-top:.5rem;">{{ $entrepreneurship->localidad->name }}</td>
        </tr>
    </table>
    <br><br>

    <label> Resumen Ejecutivo:</label>
    <p>{!! nl2br($entrepreneurship->executive_summary) !!}</p>

    <label>Problema detectado:</label>
    <p>{!! nl2br($entrepreneurship->problem_detected) !!}</p>

    <label>Solución propuesta:</label>
    <p>{!! nl2br($entrepreneurship->proposed_solution) !!}</p>

    <label>Producto o servicio que ofrecen:</label>
    <p>{!! nl2br($entrepreneurship->products_services_you_offer) !!}</p>

    <label>Mercado:</label>
    <p>{!! nl2br($entrepreneurship->market) !!}</p>

    <label>Equipo emprendedor:</label>
    <p>{!! nl2br($entrepreneurship->entrepreneurial_team) !!}</p>

    <label>Plan de acción:</label>
    <p>{!! nl2br($entrepreneurship->action_plan) !!}</p>

    @if (count($entrepreneurship->need_startup) != 0)
        <label>¿Qué estas buscando de la convocatoria?:</label><br>
        
        @foreach ($entrepreneurship->need_startup as $need)
            <br>- {{ $need->entrepreneurship_need['name'] }}<br>
        @endforeach

        <br><br>
    @endif

    @if ($entrepreneurship->video)
        <label>Video:</label><br>
        <p>{!! nl2br($entrepreneurship->video) !!}</p>
    @endif

    @if (count($entrepreneurship->curriculum) != 0)
        <label>Curriculum de la Idea:</label><br><br>
        
        @foreach ($entrepreneurship->curriculum as $cv)
            <b>- {{ $cv->type }}</b><br>
            {{ $cv->description }}<br><br>
        @endforeach
    @endif


    @foreach ($team as $t)
        <div class="page-break"></div>

        @if($t->status==0)
            <table class="table2">
                <tr>
                    <th><label>Emprendedor:</label></th>
                    <th><label>Estado:</label></th>
                </tr>
                <tr>
                    <td>{{ $t->lastname.', '.$t->name }}</td>
                    <td>El Emprendedor aún no se registro en la plataforma</td>
                </tr>

                <tr>
                    <th><label>Correo Electrónico</label></th>
                </tr>
                <tr>
                    <td>{{ $t->email }}</td>
                </tr>
            </table>
        @endif

        @if($t->status==1)
            <table class="table2">     
                <tr>
                    <th><label>Emprendedor/ra:</label></th>
                    <th><label>Estado:</label></th>
                </tr>
                <tr>
                    <td>{{ $t->lastname.', '.$t->name }}</td>
                    <td>Registrado en la plataforma</td>
                </tr>
                
                <tr>
                    <th><label>DNI:</label></th>
                    <th><label>Género:</label></th>
                </tr>

                <tr>
                    <td>{{ $t->dni}}</td>
                    <td>{{ $t->gender->name }}</td>
                </tr>

                <tr>
                    <th><label>Correo electrónico:</label></th>
                    <th><label>Numero de teléfono:</label></th>
                </tr>

                <tr>
                    <td>{{ $t->email}}</td>
                    <td>{{ $t->phone_number }}</td>
                </tr>
            </table>

            <table class="table2">   
                @if($t->country=='argentina')
                    <tr>
                        <th><label>País:</label></th>
                        <th><label>Provincia:</label></th>
                    </tr>

                    <tr>
                        <td>Argentina</td>
                        <td>{{ $t->provincia->name }}</td>
                    </tr>

                    <tr>
                        <th><label>Localidad:</label></th>
                        <th><label>Dirección:</label></th>
                    </tr>

                    <tr>
                        <td style="text-transform: capitalize;">{{ $t->localidad->name}}</td>
                        <td>{{ $t->legal_address }}</td>
                    </tr>
                @else
                    <tr>
                        <th><label>País:</label></th>
                        <th><label>Dirección:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->other_country}}</td>
                        <td>{{ $t->legal_address }}</td>
                    </tr>
                @endif

                @if($t->completed_studie->id==1 || $t->completed_studie->id==2)
                    <tr>
                        <th><label>Estudios:</label></th>
                        <th><label>Institución:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->completed_studie->name}}</td>
                        <td>{{ $t->secundary_tertiary_institute }}</td>
                    </tr>

                    <tr>
                        <th><label>Carrera:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->secundary_tertiary_career }}</td>
                    </tr>
                @endif

                @if($t->completed_studie->id==3 || $t->completed_studie->id==4)

                    @if($t->university=='unl')
                        <tr>
                            <th><label>Estudios:</label></th>
                            <th><label>Universidad:</label></th>
                        </tr>

                        <tr>
                            <td>{{ $t->completed_studie->name}}</td>
                            <td>Universidad Nacional del Litoral</td>
                        </tr>

                        <tr>
                            <th><label>Unidad académica:</label></th>
                            <th><label>Carrera:</label></th>
                        </tr>

                        <tr>
                            <td>{{ $t->academic_unit->name}}</td>
                            <td>{{ $t->career->name }}</td>
                        </tr>
                    @else
                        <tr>
                            <th><label>Estudios:</label></th>
                            <th><label>Universidad:</label></th>
                        </tr>

                        <tr>
                            <td>{{ $t->completed_studie->name}}</td>
                            <td>{{ $t->other_university }}</td>
                        </tr>

                        <tr>
                            <th><label>Carrera:</label></th>
                        </tr>

                        <tr>
                            <td>{{ $t->other_career }}</td>
                        </tr>
                    @endif

                    @if($t->posgrade && $t->completed_studie->id==4)
                        <tr>
                            <th><label>Estudios de posgrado:</label></th>
                        </tr>

                        <tr>
                            <td>Sí</td>
                        </tr>

                        <tr>
                            <th><label>Instituto:</label></th>
                            <th><label>Nombre posgrado:</label></th>
                        </tr>

                        <tr>
                            <td>{{ $t->posgrade_institute }}</td>
                            <td>{{ $t->posgrade_career }}</td>
                        </tr>
                    @endif
                @endif
                
            </table>

            @if($t->occupation!='Investigador')
                <table class="table2">  
                    <tr>
                        <th><label>Ocupación:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->occupation }}</td>
                    </tr>
                </table>
            @endif

            @if($t->occupation=='Investigador')
                <table class="table2">  
                    <tr>
                        <th><label>Ocupación:</label></th>
                        <th><label>Lugar de trabajo:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->occupation }}</td>
                        <td>{{ $t->researcher_workplace }}</td>
                    </tr>

                    <tr>
                        <th><label>Pertenencia Conicet:</label></th>
                        <th><label>Tipo de pertenencia:</label></th>
                    </tr>

                    <tr>
                        <td>{{ ($t->conicet=='Si')?'Si':'No' }}</td>
                        <td>{{ ($t->conicet=='Si')? $t->conicet_membership :'--' }}</td>
                    </tr>
                </table>

                <table class="table2">  
                    <tr>
                        <th><label>Cuenta con resultados de investigación protegidos:</label></th>
                        <th><label>Cuenta con resultados de investigación susceptibles de ser protegidos:</label></th>
                    </tr>
                    <tr>
                        <td>{{ ($t->is_protectable)?'Si':'No' }}</td>
                        <td>{{ ($t->is_susceptible_protected)?'Si':'No' }}</td>
                    </tr>

                    <tr>
                        <th><label>Cuenta con declaración de resultados:</label></th>
                    </tr>
                    <tr>
                        <td>{{ ($t->have_statement_results)?'Si':'No' }}</td>
                    </tr>
                </table>
            @endif
            

            @if($t->previous_experience)
                <table class="table2">  
                    <tr>
                        <th><label>Experiencia previa:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->previous_experience }}</td>
                    </tr>
                </table>
            @endif

            @if($t->linkedin)
                <table class="table2">  
                    <tr>
                        <th><label>Linkedin:</label></th>
                    </tr>

                    <tr>
                        <td>{{ $t->linkedin }}</td>
                    </tr>
                </table>
            @endif
        @endif

    @endforeach

</body>

</html>