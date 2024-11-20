<?php

require_once "../inc/inicio_sesion.php";
require_once "../php/main.php";

/* Almacenamiento de datos */
$codigo=limpiar_cadena($_POST['activo_codigo']);
$marca=limpiar_cadena($_POST['activo_marca']);
$modelo=limpiar_cadena($_POST['activo_modelo']);
$serial=limpiar_cadena($_POST['activo_serial']);
$categoria=limpiar_cadena($_POST['activo_categoria']);
$piso=limpiar_cadena($_POST['activo_piso']);
$posicion=limpiar_cadena($_POST['activo_posicion']);
$area=limpiar_cadena($_POST['activo_area']);
$servicio=limpiar_cadena($_POST['activo_servicio']);


/* Verificación de datos obligatorios */
if($codigo=="" || $marca=="" || $modelo=="" || $serial=="" || $categoria=="" || $piso=="" ||
 $posicion=="" || $area=="" || $servicio==""){
    echo '
    <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    No llenaste todos los datos solicitados
  </div>';
    exit();
}

/* Verificación de integridad de datos */
if(verificar_datos("[0-9]{3,50}", $codigo)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos del Activo Fijo no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}", $marca)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos del Sector no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,50}", $modelo)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos del Piso no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-Z0-9]{3,50}", $serial)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos de la Ubicación no corresponden con el formato solicitado
  </div>';
    exit();
}


/* verificar codigo */
$check_codigo=conexion();
$check_codigo=$check_codigo->query("SELECT activo_codigo From activo where activo_codigo='$codigo'");
if($check_codigo->rowCount()>0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  El Activo Fijo ya esta ingresado
  </div>
  ';
  exit();

}
$check_codigo=null;

/*verificar serial */
$check_serial=conexion();
$check_serial=$check_serial->query("SELECT activo_serial From activo where activo_serial='$serial'");
if($check_serial->rowCount()>0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  El Numero de serie ya esta ingresado
  </div>
  ';
  exit();

}
$check_serial=null;

/*verificar categoria */
$check_categoria=conexion();
$check_categoria=$check_categoria->query("SELECT categoria_id From categoria where categoria_id='$categoria'");
if($check_categoria->rowCount()<=0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  La Categoria no existe
  </div>
  ';
  exit();

}
$check_categoria=null;

/*verificar piso */
$check_piso=conexion();
$check_piso=$check_piso->query("SELECT piso_id From piso where piso_id='$piso'");
if($check_piso->rowCount()<=0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  El piso no existe
  </div>
  ';
  exit();

}
$check_piso=null;

/*verificar posición */
$check_posicion=conexion();
$check_posicion=$check_posicion->query("SELECT posicion_id From posicion where posicion_id='$posicion'");
if($check_posicion->rowCount()<=0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  La Posicion no existe
  </div>
  ';
  exit();

}
$check_posicion=null;

/*verificar área */
$check_area=conexion();
$check_area=$check_area->query("SELECT area_id From area where area_id='$area'");
if($check_area->rowCount()<=0){
  echo'
  <div class="notification is-danger is-light">
 <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  El área no existe
  </div>
  ';
  exit();

}
$check_area=null;

/*verificar servicio */
$check_servicio=conexion();
$check_servicio=$check_servicio->query("SELECT servicio_id From servicio where servicio_id='$servicio'");
if($check_servicio->rowCount()<=0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  El áservicio no existe
  </div>
  ';
  exit();

}
$check_servicio=null;

      
  	/* Guardando datos */
    $guardar_activo
    =conexion();
    $guardar_activo=$guardar_activo->prepare("INSERT INTO activo (activo_codigo	,activo_marca,activo_modelo,activo_serial,
    categoria_id ,piso_id ,posición_id ,area_id ,servicio_id ) VALUES(:codigo,:marca,:modelo,:serial,:categoria,:piso,:posision,:area,:servicio)");

    $marcadores=[
        ":codigo"=>$codigo,
        ":marca"=>$marca,
        ":modelo"=>$modelo,
        ":serial"=>$serial,
        ":categoria"=>$categoria,
        ":piso"=>$piso,
        ":posicion"=>$posicion,
        ":area"=>$area,
        ":servicio"=>$servicio

    ];

    $guardar_activo->execute($marcadores);

    if($guardar_activo->rowCount()==1){
        echo '
        <div class="notification is-info is-light">
        <strong>¡Equipo Registrado!</strong><br>
        El activo se registro correctamente
    </div>
';
}else{
echo '
    <div class="notification is-danger is-light">
        <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
        No se pudo registrar el activo, por favor intente nuevamente
    </div>
        ';
    }
    $guardar_activo=null;