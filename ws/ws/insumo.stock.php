<?php
require_once '../logica/Insumo.clase.php';
require_once '../util/funciones/Funciones.clase.php';
require_once './token.validar.php';

if (! isset($_POST["p_suppliesId"]) || ! isset($_POST["p_stock"])){
    Funciones::imprimeArrayJSON(500,"Falta completar los datos requeridos", "");
    exit();
}

if (! isset($_POST["token"])){
    Funciones::imprimeArrayJSON(500, "Debe especificar un token", "");
    exit();
}
    
try {
    if(validarToken($_POST["token"])){
        //si devuelve true, quiere decir q el token es valido
        $objInsumo = new Insumo();
        
        $p_stock = $_POST["p_stock"];
        $p_suppliesId = $_POST["p_suppliesId"];
        
        $resultado = $objInsumo->actualizarStock($p_suppliesId, $p_stock);
        
        Funciones::imprimeArrayJSON(200, "Stock del Insumo actualizado con éxito", $resultado);
    }                                           
} catch (Exception $exc) {
    Funciones::imprimeArrayJSON(500,$exc->getMessage(),"");
}
