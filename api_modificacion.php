<?php
include('../scripts/php/conexiones_BD/conexion_bd_escuela.php');
$con = new ConexionBDEscuela();
$conexion = $con->getConexion();


if($_SERVER['REQUEST_METHOD']=='POST'){
    $cadenaJSON =file_get_contents('php://input');

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

        $sql = "UPDATE Alumnos SET Nombre='$n', Primer_Ap='$pa', Segundo_AP='$sa',Edad=$e,Semestre=$s,Carrera='$c' WHERE Num_Control='$nc'";

        $res = mysqli_query($conexion, $sql);

        $respuesta =array();

        if($res){
            $respuesta['exito']= true;
            $respuesta['Mensaje']= "Modificación correcta";
            $resJSON = json_encode($respuesta);
        }else{
            $respuesta['exito']= false;
            $respuesta['Mensaje']= "error en la Modificación";
            $resJSON = json_encode($respuesta);
        }
        echo $resJSON;
    }

}

?>

