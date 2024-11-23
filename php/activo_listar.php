<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	$campos="activo.activo_id,activo.activo_codigo,activo.activo_marca,activo.activo_modelo,activo.activo_serial,activo.categoria_id,activo.piso_id,activo.posicion_id,activo.area_id,activo.sector_id,categoria.categoria_id,categoria.categoria_nombre,piso.piso_id,
    piso.piso_numero,posicion.posicion_id,posicion.posicion_posicion,area.area_id,area.area_nombre,sector.sector_id,sector.sector_nombre";

	if(isset($busqueda) && $busqueda!=""){
				$consulta_datos="SELECT $campos FROM activo INNER JOIN categoria On activo.categoria_id=categoria.categoria_id INNER JOIN piso On activo.piso_id=piso.piso_id INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
                INNER JOIN area On activo.area_id=area.area_id INNER JOIN sector ON activo.sector_id=sector.sector_id where activo.activo_codigo Like '$busqueda%' Or activo.activo_marca Like '%$busqueda%' Or activo.activo_modelo Like '%$busqueda%' 
				Or activo.activo_serial Like '%$busqueda%' Order By activo.activo_codigo Asc Limit $inicio,$registros";

				$consulta_total="SELECT COUNT(activo_id) FROM activo where activo_codigo Like '%$busqueda%' Or activo_serial Like '%$busqueda%'";

			}elseif($categoria_id>0){

				$consulta_datos="SELECT $campos FROM activo INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id INNER JOIN piso On activo.piso_id=piso.piso_id INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
                INNER JOIN area On activo.area_id=area.area_id INNER JOIN sector ON activo.sector_id=sector.sector_id WHERE activo.categoria_id='$categoria_id' ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";
		
				$consulta_total="SELECT COUNT(producto_id) FROM producto WHERE categoria_id='$categoria_id'";
	
			}else{


		$consulta_datos="SELECT $campos FROM activo Inner Join categoria On activo.categoria_id=categoria.categoria_id INNER JOIN piso On activo.piso_id=piso.piso_id INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
                INNER JOIN area On activo.area_id=area.area_id INNER JOIN sector ON activo.sector_id=sector.sector_id Order By activo.activo_codigo Asc Limit $inicio,$registros";

		$consulta_total="SELECT COUNT(activo_id) FROM activo";

	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Código</th>
                    <th>Marca</th>
					<th>Modelo</th>
					<th>Serial</th>
					<th>Categoria</th>
					<th>Piso</th>
					<th>Posición</th>
					<th>Área</th>
					<th>Sector</th>		
   	                <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='</p>
			        </figure>
			        <div class="media-content">
			            <div class="content">
			              <p>
			                <strong>'.$contador.'</strong><br>
			                <strong>Codigo:</strong> '.$rows['activo_codigo'].'
							<strong>Marca:</strong> '.$rows['activo_marca'].'
							<strong>Modelo:</strong> '.$rows['activo_modelo'].'
							<strong>Serial:</strong> '.$rows['activo_serial'].'
							<strong>Categoria:</strong> '.$rows['activo_categoria'].'
							<strong>Piso:</strong> '.$rows['activo_piso'].'
							<strong>Posición:</strong> '.$rows['activo_posicion'].'
							<strong>Area:</strong> '.$rows['activo_area'].'
							<strong>Sector:</strong> '.$rows['activo_sector'].'
			              </p>
			            </div>
			            <div class="has-text-right">
			                <a href="index.php?vista=asset_update&asset_id_up='.$rows['activo_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
			                </div>
			        </div>
			    </article>

			    <hr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<p class="has-text-centered" >
					<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
						Haga clic acá para recargar el listado
					</a>
				</p>
			';
		}else{
			$tabla.='
				<p class="has-text-centered" >No hay registros en el sistema</p>
			';
		}
	}

	if($total>1 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando equipos <strong>'.$pag_inicio.
		'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}