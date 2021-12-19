
<html lang="en" style="margin: 50pt 15pt;">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SPAC</title>
	</head>
	<body class="no-skin">        
        <div class="row">
            <div style="text-align: center;">
                <label> Grado :{{$plan[0]->grado}} </label></br><!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
            <div style="width:100% ;padding: 10px;">
                <label class="control-label col-xs-12 " for="form-field-1"> Bimestre </label>
            </div>
            <div style="width:100% ;padding: 10px;">
                <label class="control-label col-xs-12 " for="form-field-1"> Bimestre </label></br></br><label> Docente : {{$plan[0]->docente}} </label>   </br>                                                     
                <!-- PAGE CONTENT ENDS -->
            </div>
            <div style="width:100% ;padding: 10px;">
                <label> Duracion Aproximada: 4 Semanas </label>      </br> 
            </div>
            <div style="width:100% ;padding: 10px;">                                                 
                <label> Grado : {{$plan[0]->grado}} </label>     
            </div>
            <div style="width:100% ;padding: 10px;">
                <label> Seccion : {{$plan[0]->seccion}} </label>  </br>                                                      
            </div>
            <div style="width:100% ;padding: 10px;">
                <label> Unidad didactica {{$plan[0]->unidads_id}} </label>                                                        
            </div>
            <div style="width:100% ;padding: 10px;">
                <h3>1.-PROPÓSITOS Y EVIDENCIA DE APRENDIZAJE</h3>
                
                <table style="page-break-inside: avoid; border-collapse: collapse; width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid #ddd; ">                                     
                    <thead style="border-collapse: collapse;">
                        <tr style="color: #707070;font-weight: 400;;">
                            <th colspan="4" style=" border: 1px solid #ddd;">PROPÓSITOS DE APRENDIZAJE</th>
                        </tr>
                        <tr style="color: #707070;">
                            <th style="width: 1000px; border: 1px solid #ddd;">Capacidades</th>
                            <th style="width: 1200px;border: 1px solid #ddd; border: 1px solid #ddd;">Desempeños</th>
                            <th style="width: 1400px;border: 1px solid #ddd;">Evidencias de</br> aprendizaje</th>
                            <th style="width: 810px;border: 1px solid #ddd;">Instrumentos de valoración</th>
                        </tr>
                    </thead>                           
                    <tbody>
                        @foreach($unidades[0] as $competencias)                                    
                            <?php 
                                $i=0;
                            ?>
                                @if(count($competencias->desempenos)==0)       
                                <tr style="color: #707070;font-weight: 400;;">
                                    <td style="border: 1px solid #ddd;">
                                        <h5>{{$competencias->competencia}}</h5></br> 
                                        <ul>
                                            @foreach($competencias->competencias as $capacidad)
                                                <li>{{$capacidad->nombre}}</li>
                                            @endforeach
                                        </ul>
                                    </td>                                             
                                    <td style="border: 1px solid #ddd;"><p></p></td>
                                    <td style="border: 1px solid #ddd;"><p></p></td>
                                    <td style="border: 1px solid #ddd;"><p></p></td>
                                </tr>
                                @else
                                <tr style="color: #707070;font-weight: 400;;">
                                    <td rowspan="{{count($competencias->desempenos)}}" style=" border: 1px solid #ddd;" ><h5>{{$competencias->competencia}}</h5></br> 
                                        <ul>
                                            @foreach($competencias->competencias as $capacidad)
                                                <li>{{$capacidad->nombre}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @foreach($competencias->desempenos as $desempeno)
                                        @if($i==0)
                                                <td style="border: 1px solid #ddd;"><p style="width:100%">{{$desempeno->nombre}}</p></td>
                                                <td style="border: 1px solid #ddd;"><p>{{$desempeno->evidencia}}</p></td>
                                                <td rowspan="{{count($competencias->desempenos)}}" style="width: 10%; border: 1px solid #ddd;"><p>{{$competencias->instrumento}}</p></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        ?>
                                        @else
                                            <tr style="color: #707070;font-weight: 400;;">
                                                <td style="border: 1px solid #ddd;"><p>{{$desempeno->nombre}}</p></td>
                                                <td style="border: 1px solid #ddd;"><p>{{$desempeno->evidencia}}</p></td>
                                            </tr>
                                        @endif
                                    @endforeach

                                @endif
                        @endforeach
                    </tbody>
                </table>
                <table style="border-collapse: collapse; width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid #ddd; ">                                     
                    <thead style="border-collapse: collapse;">
                    <tr style="color: #707070;font-weight: 400;;">
                            <th colspan="2" style="border: 1px solid #ddd;">ENFOQUES TRANSVERSALES</th>
                        </tr>
                        <tr style="color: #707070;font-weight: 400;;">
                            <th style="width: 15%;border: 1px solid #ddd;">Capacidades</th>                                       
                            <th style="border: 1px solid #ddd;">Actividades o actitudes observables</th>                                       
                        </tr>
                    </thead>                           
                    <tbody>
                    @if(count($unidades[1])>0)
                        @foreach($unidades[1] as $enfoque)                               
                            <?php 
                                $i=0;
                            ?>
                                @if(count($enfoque->actitudes)==0)       
                                <tr style="color: #707070;font-weight: 400;;">
                                    <td style="border: 1px solid #ddd;">
                                        <h5>{{$enfoque->nombre}}</h5> 
                                    </td>                                             
                                    <td style="border: 1px solid #ddd;"><p></p></td>
                                </tr>
                                @else
                                <tr style="color: #707070;font-weight: 400;;">
                                    <td rowspan="{{count($enfoque->actitudes)}}" style="width: 15%;border: 1px solid #ddd;"  ><h5>{{$enfoque->nombre}}</h5></br> 
                                    </td>
                                    @foreach($enfoque->actitudes as $actitud)
                                        @if($i==0)
                                                <td style="border: 1px solid #ddd;"><p>{{$actitud->nombre}}</p></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        ?>
                                        @else
                                            <tr style="color: #707070;font-weight: 400;;">
                                                <td style="border: 1px solid #ddd;"><p>{{$actitud->nombre}}</p></td>
                                            </tr>
                                        @endif
                                    @endforeach

                                @endif

                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div  style="top: 10px;" >
                <h3>2 .-SITUACIÓN SIGNIFICATIVA</h3>
                <div style="border-color: #ddd; border-width: 1px;  border-style: solid;" >
                @if(count($unidades[2])>0)
                    <p>{{$unidades[2][0]->nombre}}</p>
                @endif
                </div>
            </div><!-- /.span -->
            <div  style="top: 10px;">
                <h3>3 .-SECUENCIA DE SESIONES DE APRENDIZAJE</h3>
                
                <table style="border-collapse: collapse; width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid #ddd; ">                                     
                    <thead style="border-collapse: collapse;">
                        <tr style="color: #707070;font-weight: 400;;">
                            <th colspan="5" style=" border: 1px solid #ddd;">PROPÓSITOS DE APRENDIZAJE</th>
                        </tr>
                        <tr style="color: #707070;font-weight: 400;;">
                            <th style="width: 80px; border: 1px solid #ddd;">SESIÓN</th>
                            <th style="width: 80px;border: 1px solid #ddd;">NOMBRE</th>
                            <th style="width: 80px;border: 1px solid #ddd;">ÁREA</th>
                            <th style="width: 300px; border: 1px solid #ddd;">DESEMPEÑO</th>
                            <th style="width: 180px; border: 1px solid #ddd;">EVIDENCIA</th>
                        </tr>
                    </thead>  
                    <tbody>
                        <?php
                            $i=1;
                        ?>
                        @if(count($unidades[3])>0)
                            @foreach($unidades[3] as $sesion)
                            <tr style="color: #707070;font-weight: 400;;">
                                <td style="border: 1px solid #ddd;"><p>Sesion  {{$i}} </p></td>
                                <td style="border: 1px solid #ddd;"><p>{{$sesion->nombre}}</p></td>
                                <td style="border: 1px solid #ddd;"<p>{{$sesion->area}}</p></td>
                                <td style="border: 1px solid #ddd;"><p>{{$sesion->criterio}}</p></td>
                                <td style="border: 1px solid #ddd;"><p>{{$sesion->evidencia}}</p></td>
                            </tr>
                            <?php $i++?>
                            @endforeach
                        @endif
                                
                    </tbody>
                </table>
            </div><!-- /.span -->
            <div  style="top: 10px;">
                <h3 class="header smaller lighter purple">4 .-MATERIALES BASICOS O RECURSOS A UTILIZAR</h3>

                <div style="width:100% ;padding: 10px;">
                    <div class="form-group">
                        <div  class="col-sm-12"> 
                            <ul>
                                @foreach($materiales as $material)
                                    <li>{{$material->nombre}}</li>
                                @endforeach
                            </ul>
                        </div>  
                    </div> 
                </div>
            </div><!-- /.span -->
            <div  style="top: 10px;margin-bottom: 100px" id="sesionesAprendizaje">
                <h3>5 .-REFLEXIONES SOBRE LOS APRENDIZAJES</h3>
                <div style="width:100% ;padding: 10px;">
                    <table style="border-collapse: collapse; width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid #ddd; ">                                     
                        <thead style="border-collapse: collapse;">
                            <tr style="color: #707070;font-weight: 400;;">
                                <th style="border: 1px solid #ddd;">QUE LOGRARON LOS ESTUDIENTES EN ESTA UNIDAD</th>
                                <th style="border: 1px solid #ddd;">QUE DIFICULTADES SE OBSERVARON DURANTE EL APRENDIZAJE Y LA ENSEÑANZA</th>
                            </tr>
                        </thead>  
                        <tbody>   
                            <tr style="color: #707070;font-weight: 400;;">
                                <td style="border: 1px solid #ddd;">¿Qué avances tuvieron mis estudiantes?</td>
                                <th style="border: 1px solid #ddd;"></th>
                            </tr>
                            <tr style="color: #707070;font-weight: 400;;">
                                <td style="border: 1px solid #ddd;">¿Qué dificultades tuvieron mis estudiantes?</td>
                                <td style="border: 1px solid #ddd;"></td>
                            </tr>
                            <tr style="color: #707070;font-weight: 400;;">
                                <td style="border: 1px solid #ddd;">¿Qué actividades, estrategias y materiales funcionaron y cuáles no?</td>
                                <td style="border: 1px solid #ddd;"></td>
                            </tr>                                            
                        </tbody>
                    </table>
                </div>
            </div><!-- /.span -->	
            <div style="width:100% ;padding: 10px;">
                <div style="width:100% ;padding: 10px;">
                    <div style="width:50%;float: left; top: 10px;top: 10px;text-align: center;" >
                        <div style="padding: 10px;">
                            <h3>_________________________</h3>
                            <label for="">Docente</label>
                        </div>
                    </div><!-- /.span -->
                    <div style="width:50%;float: left; top: 10px;top: 10px;text-align: center;" >
                        <div style="padding: 10px;">
                            <h3>_________________________</h3>
                            <label for="">Director</label>
                        </div>
                    </div><!-- /.span -->
                
                </div>
            </div>			
        </div><!-- /.row -->
	</body>
</html>
