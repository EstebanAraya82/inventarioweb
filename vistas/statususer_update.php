<div class="container is-fluid mb-6">
	<h1 class="title">Estados</h1>
	<h2 class="subtitle">Actualizar estados</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_atras.php";
		require_once "./php/main.php";

		$id = (isset($_GET['statususer_id_up'])) ? $_GET['statususer_id_up'] : 0;
		$id=limpiar_cadena($id);

		/* Verificando estado usuario */
    	$check_estadousuario=conexion();
    	$check_estadousuario=$check_estadousuario->query("SELECT * FROM estadousuario WHERE estadousuario_id='$id'");

        if($check_estadousuario->rowCount()>0){
        	$datos=$check_estadousuario->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/estadousuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="estadousuario_id" value="<?php echo $datos['estadousuario_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="estadousuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required value="<?php echo $datos['estado_nombre']; ?>" >
				</div>
		  	</div>
		  </div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_estadousuario=null;
	?>
</div>