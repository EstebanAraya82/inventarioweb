<?php
    require_once "main.php"; 

    /* Almacenar datos */
    $nombre=limpiar_cadena($_POST['estadousuario_nombre']);

    /* Verificar campos obligatorios */
    if($nombre=="" ){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificar integridad de los datos */
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /* Guardando datos */
    $guardar_estadousuario=conexion();
    $guardar_estadousuario=$guardar_estadousuario->prepare("INSERT INTO estadousuario (estadousuario_nombre) VALUES(:nombre)");

    $marcadores=[
        ":nombre"=>$nombre
       
    ];

    $guardar_estadousuario->execute($marcadores);

    if($guardar_estadousuario->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario Registrado!</strong><br>
                El estado se registro correctamente
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar el estado, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_estadousuario=null;