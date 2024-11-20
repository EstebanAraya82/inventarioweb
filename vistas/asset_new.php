<div class="container is-fluid mb-6">
	<h1 class="title">Activo</h1>
	<h2 class="subtitle">Nuevo Activo</h2>
</div>
<div class="container pb-6 pt-6">

		<?php 
		require_once "./php/main.php"; 
		?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<form action="./php/activo_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form_data">
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Activo Fijo</label>
				  	<input class="input" type="text" name="activo_codigo" placeholder="Ingrese dato" pattern="[0-9]{3,50}" maxlength="50" require >
				</div>
		  	</div>
		<div class="column">
		    	<div class="control">
					<label>Marca</label>
				  	<input class="input" type="int" name="activo_marca" placeholder="Ingrese dato" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,50}" maxlength="50" required >
				</div>
                </div>	
                </div>
                <div class="columns">
              <div class="column">
		    	<div class="control">
					<label>Modelo</label>
				  	<input class="input" type="text" name="activo_modelo" placeholder="Ingrese dato" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,50}" maxlength="50" required >
				</div>
		  	</div>
		     <div class="column">
		    	<div class="control">
					<label>Serial</label>
				  	<input class="input" type="text" name="activo_serial" placeholder="Ingrese dato" pattern="[a-zA-Z0-9]{3,50}" maxlength="50" required >
				</div>
		</div>   
        </div>   
        <div class="columns"> 
	  	<div class="column">
			<label>Categoria</label><br>
			<div class="select is-rounded">
				<select name="activo_categoria">
					<option value="" selected="" >Seleccione una opción</option>					
					<?php
					    $categorias=conexion();
						$categorias=$categorias->query("SELECT * From categoria");
						if($categorias->rowCount()>0){
							$categorias=$categorias->fetchAll();
							foreach($categorias as $row){
								echo '<option value="'.$row['categoria_id'].'" >'.$row['categoria_nombre'].'</option>';

							}
						}
						$categorias=null;
					?>
                    </select>
                    </div>
                    </div>
                    <div class="column">
			<label>Piso</label><br>
			<div class="select is-rounded">
				<select name="activo_piso">
					<option value="" selected="" >Seleccione una opción</option>					
					<?php
					    $pisos=conexion();
						$pisos=$pisos->query("SELECT * From piso");
						if($pisos->rowCount()>0){
							$pisos=$pisos->fetchAll();
							foreach($pisos as $row){
								echo '<option value="'.$row['piso_id'].'" >'.$row['piso_numero'].'</option>';

							}
						}
						$pisos=null;
					?>
                    </select>
                    </div>
                    </div>
                    </div>
                    <div class="columns"> 
                     <div class="column">
			<label>Posición</label><br>
			<div class="select is-rounded">
				<select name="activo_posicion">
					<option value="" selected="" >Seleccione una opción</option>					
					<?php
					    $posiciones=conexion();
						$posiciones=$posiciones->query("SELECT * From posicion");
						if($posiciones->rowCount()>0){
							$posiciones=$posiciones->fetchAll();
							foreach($posiciones as $row){
								echo '<option value="'.$row['posicion_id'].'" >'.$row['posicion_posicion'].'</option>';

							}
						}
						$posiciones=null;
					?>
                    </select>
                    	</div>
                   	 </div>
                     <div class="column">
			<label>Area</label><br>
			<div class="select is-rounded">
				<select name="activo_area">
					<option value="" selected="" >Seleccione una opción</option>					
					<?php
					    $areas=conexion();
						$areas=$areas->query("SELECT * From area");
						if($areas->rowCount()>0){
							$areas=$areas->fetchAll();
							foreach($areas as $row){
								echo '<option value="'.$row['area_id'].'" >'.$row['area_nombre'].'</option>';

							}
						}
						$areas=null;
					?>
                      
				</select>
			</div>
		</div>
		</div>
        <div class="columns"> 
	  	<div class="column">
			<label>Servicio</label><br>
			<div class="select is-rounded">
				<select name="activo_servicio">
					<option value="" selected="" >Seleccione una opción</option>					
					<?php
					    $servicios=conexion();
						$servicios=$servicios->query("SELECT * From servicio");
						if($servicios->rowCount()>0){
							$servicios=$servicios->fetchAll();
							foreach($servicios as $row){
								echo '<option value="'.$row['servicio_id'].'" >'.$row['servicio_nombre'].'</option>';

							}
						}
						$servicios=null;
					?>
                    </select>
                    </div>
                    </div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>