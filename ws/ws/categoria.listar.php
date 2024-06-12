<?php
require_once '../logica/Categoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once './token.validar.php';

if (! isset($_POST["token"])){
    Funciones::imprimeArrayJSON(500, "Debe especificar un token", "");
    exit();
}

try {
    if(validarToken($_POST["token"])){
        //si devuelve true, quiere decir q el token es valido
        $objCategoria = new Categoria();
        
        $resultado = $objCategoria->listarCategoria();
        
        Funciones::imprimeArrayJSON(200, "Lista de categorias", $resultado);
    }                                           
} catch (Exception $exc) {
    Funciones::imprimeArrayJSON(500,$exc->getMessage(),"");
}