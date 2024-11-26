<div class="container is-fluid mb-6">
    <h1 class="title">Pisos</h1>
    <h2 class="subtitle">Lista de pisos</h2>
</div>

<div class="container pb-6 pt-6">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

       
        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=floor_list&page=";
        $registros=3;
        $busqueda="";

        # Paginador rol #
        require_once "./php/piso_listar.php";
    ?>
</div>