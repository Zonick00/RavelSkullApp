<?php

require_once '../datos/Conexion.clase.php';

class Cliente extends Conexion{
    
    public function registrarCliente($p_name, $p_lastname, $p_dni, $p_address, $p_phone) {
        
        try {
            $sql = "select * from f_customer_register(:p_name, :p_lastname, :p_dni, :p_address, :p_phone);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute(array(":p_name"=> $p_name, 
                                      ":p_lastname"=> $p_lastname, 
                                      ":p_dni"=> $p_dni,
                                      ":p_address"=> $p_address,
                                      ":p_phone"=> $p_phone));
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listarClientes() {
        try {
            $sql = "select * from public.customers order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function buscarCliente($p_customerId) {
        try {
            $sql = "select * from public.customers where customer_id= :p_customerId";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute(array(":p_customerId"=> $p_customerId));
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function actualizarCliente($p_customerId, $p_name, $p_lastname, $p_dni, $p_address, $p_phone) {
        try{
            $sql = "UPDATE public.customers
                    SET customer_name=:p_name, 
                        customer_lastname=:p_lastname, 
                        customer_dni=:p_dni, 
                        customer_address=:p_address,
                        customer_phone=:p_phone
                    WHERE customer_id=:p_customerId";
                    
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute(array(":p_customerId"=> $p_customerId, 
                                      ":p_name"=> $p_name, 
                                      ":p_lastname"=> $p_lastname, 
                                      ":p_dni"=> $p_dni,
                                      ":p_address"=> $p_address,
                                      ":p_phone"=> $p_phone));
            return $sentencia->fetch(PDO::FETCH_ASSOC);
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}
