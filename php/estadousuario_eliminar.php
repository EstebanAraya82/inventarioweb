<?php
	/* Almacenando datos */
    $statususer_id_del=limpiar_cadena($_GET['statususer_id_del']);

    /* Verificando estado usuario */
    $check_estadousuario=conexion();
    $check_estadousuario=$check_estadousuario->query("SELECT * FROM estadousuario WHERE estadousuario_id='$statususer_id_del'");

    if($check_estadousuario->rowCount()==1){

    	$datos=$check_estadousuario->fetch();

    	$eliminar_estadousuario=conexion();
    	$eliminar_estadousuario=$eliminar_estadousuario->prepare("DELETE FROM estadousuario WHERE estadousuario_id=:id");

    	$eliminar_estadousuario->execute([":id"=>$statususer_id_del]);

    	if($eliminar_estadousuario->rowCount()==1){

    		echo '
	            <div class="notification is-info is-light">
	                <strong>¡Estado eliminado!</strong><br>
	                Los datos del estado se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el estado, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_estadousuario=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El estado que intenta eliminar no existe
            </div>
        ';
    }
    $check_estadousuario=null;