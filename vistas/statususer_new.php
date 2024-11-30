<div class="container is-fluid mb-6">
	<h1 class="title">Estado Usuario</h1>
	<h2 class="subtitle">Alta Estado</h2>
</div>
<div class="container pb-6 pt-6">
		<?php 
	    include "./inc/btn_atras.php";
		require_once "./php/main.php"; 
		?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/estadousuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
    <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Tipo de estado</label>
				  	<input class="input" type="text" name="estadousuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		  </div>
		        
       	<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>