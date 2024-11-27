<?php
	$modulo_buscador=limpiar_cadena($_POST['modulo_buscador']);

	$modulos=["usuario","estadousuario","rol","activo","estadoactivo","categoria","piso","posicion","area","sector"];

	if(in_array($modulo_buscador, $modulos)){
		
		$modulos_url=[
			"usuario"=>"user_search",
			"estadousuario"=>"statususer_search",
			"rol"=>"role_search",
			"activo"=>"asset_search",
			"estadoactivo"=>"statusasset_search",
			"categoria"=>"category_search",
			"piso"=>"floor_search",
			"posicion"=>"position_search",
			"area"=>"area_search",
			"sector"=>"sector_search"
			
		];

		$modulos_url=$modulos_url[$modulo_buscador];

		$modulo_buscador="busqueda_".$modulo_buscador;


		/* Iniciar busqueda */
		if(isset($_POST['txt_buscador'])){

			$txt=limpiar_cadena($_POST['txt_buscador']);

			if($txt==""){
				echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
		                Introduce el termino de busqueda
		            </div>
		        ';
			}else{
				if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@.]{1,30}",$txt)){
			        echo '
			            <div class="notification is-danger is-light">
			                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
			                El termino de busqueda no coincide con el formato solicitado
			            </div>
			        ';
			    }else{
			    	$_SESSION[$modulo_buscador]=$txt;
			    	header("Location: index.php?vista=$modulos_url",true,303); 
 					exit();  
			    }
			}
		}


		/* Eliminar busqueda */
		if(isset($_POST['eliminar_buscador'])){
			unset($_SESSION[$modulo_buscador]);
			header("Location: index.php?vista=$modulos_url",true,303); 
 			exit();
		}

	}else{
		echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No podemos procesar la solicitud
            </div>
        ';
	}