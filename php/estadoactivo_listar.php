<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM estadoactivo WHERE estado_nombre LIKE '%$busqueda%' ORDER BY estado_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(estado_id) FROM estadoactivo WHERE estado_nombre LIKE '%$busqueda%'";

	}else{

		$consulta_datos="SELECT * FROM estadoactivo ORDER BY estado_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(estado_id) FROM estadoactivo";
		
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
                    <th>Estado</th>
                    </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['estado_nombre'].'</td>
                    <td>
                        <a href="index.php?vista=asset_statusasset&statusasset_id='.$rows['estado_id'].'" class="button is-link is-rounded is-small">Ver equipos</a>
                    </td>
                    <td>
                        <a href="index.php?vista=statusasset_update&statusasset_id_up='.$rows['estado_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    </tr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando estados <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}