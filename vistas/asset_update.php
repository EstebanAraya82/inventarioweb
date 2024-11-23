<div class="container is-fluid mb-12">
	<h1 class="title">Activos</h1>
	<h2 class="subtitle">Actualizar activo</h2>
</div>

<div class="container pb-12 pt-12">
	<?php
		include "./inc/btn_atras.php";
		require_once "./php/main.php";

		$id = (isset($_GET['asset_id_up'])) ? $_GET['asset_id_up'] : 0;
		$id=limpiar_cadena($id);

		/* Verificar equipo */
    	$check_activo=conexion();
    	$check_activo=$check_activo->query("SELECT * FROM activo WHERE activo_id='$id'");

        if($check_activo->rowCount()>0){
        	$datos=$check_activo->fetch();
	?>

	<div class="form-rest mb-12 mt-12"></div>
	
	<h2 class="title has-text-centered"><?php echo $datos['activo_codigo']; ?></h2>

	<form action="./php/equipo_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="id_equipo" value="<?php echo $datos['id_equipo']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Activo Fijo</label>
				  	<input class="input" type="text" name="equipo_activo" pattern="[0-9 ]{3,10}" maxlength="10" required value="<?php echo $datos['equipo_activo']; ?>">
				</div>
		  	</div>
              <div class="column">
		    	<div class="control">
					<label>Sector</label>
				  	<input class="input" type="text" name="equipo_sector" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['equipo_sector']; ?> ">
				</div>
		  	</div>
        </div>              
              <div class="columns">
             	<div class="column">
		    	<div class="control">
					<label>Piso</label>
				  	<input class="input" type="text" name="equipo_piso" pattern="[a-zA-Z0-9 ]{1,20}" maxlength="20" required value="<?php echo $datos['equipo_piso']; ?>" >
				</div>
		  	</div>
               	<div class="column">
		    	<div class="control">
					<label>Ubicación</label>
				  	<input class="input" type="text" name="equipo_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{2,40}" maxlength="40" required value="<?php echo $datos['equipo_ubicacion']; ?> ">
				</div>
            </div>
        </div>      		
		<div class="file">
  <label class="file-label">
    <input class="file-input" type="file" name="activo_documento" required value="<?php echo $datos['activo_documento']; ?> />
    <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label"> Cargue el documento… </span>
    </span>
  </label>
</div>
		 <div class="columns">
			 <div class="column">
		    	<div class="control">
					<label>Responsable</label>
				  	<input class="input" type="text" name="equipo_responsable" pattern="[a-zA-Z0-9 ]{2,100}" maxlength="100" required value="<?php echo $datos['equipo_responsable']; ?> ">
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría</label><br>
		    	<div class="select is-rounded">
				  	<select name="equipo_categoria" >
				    	<?php
    						$categorias=conexion();
    						$categorias=$categorias->query("SELECT * FROM categoria");
    						if($categorias->rowCount()>0){
    							$categorias=$categorias->fetchAll();
    							foreach($categorias as $row){
    								if($datos['id_categoria']==$row['id_categoria']){
    									echo '<option value="'.$row['id_categoria'].'" selected="" >'.$row['nombre_categoria'].' </option>';
    								}else{
    									echo '<option value="'.$row['id_categoria'].'" >'.$row['nombre_categoria'].'</option>';
    								}
				    			}
				   			}
				   			$categorias=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/alerta_error.php";
		}
		$check_equipo=null;
	?>
</div>