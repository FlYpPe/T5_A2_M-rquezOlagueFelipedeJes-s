<?php
include('../scripts/php/conexiones_BD/conexion_bd_escuela.php');
$con = new ConexionBDEscuela();
$conexion = $con->getConexion();


if($_SERVER['REQUEST_METHOD']=='POST'){
    $cadenaJSON = file_get_contents('php://input');

    if($cadenaJSON==false){
        echo "No Hay cadena JSON";
    }else{
        $datos = json_decode($cadenaJSON, true);
        $nc = $datos['nc'];
        $n = $datos['n'];
        $pa = $datos['pa'];
        $sa = $datos['sa'];
        $e = $datos['e'];
        $s = $datos['s'];
        $c = $datos['c'];

        $sql = "INSERT INTO alumnos VALUES('$nc','$n','$pa','$sa',$e,$s,'$c')";
        

        $res = mysqli_query($conexion, $sql);

        $respuesta =array();

        if($res){
            $respuesta['exito']= true;
            $respuesta['Mensaje']= "Insercion correcta";
            $resJSON = json_encode($respuesta);
        }else{
            $respuesta['exito']= false;
            $respuesta['Mensaje']= "error en la Insercion";
            $resJSON = json_encode($respuesta);
        }
        echo $resJSON;
    }

}

?>

