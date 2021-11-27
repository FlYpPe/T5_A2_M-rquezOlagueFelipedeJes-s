<?php

include('../scripts/php/conexiones_BD/conexion_bd_escuela.php');
$con = new ConexionBDEscuela();
$conexion = $con->getConexion();


if($_SERVER['REQUEST_METHOD']=='POST'){
    $cadenaJSON =file_get_contents('php://input');

    if($cadenaJSON==false){
        echo "No Hay cadena JSON";
    }else{

        $filtro = json_decode($cadenaJSON, true);
        $sql = "SELECT * FROM Alumnos";
        $res = mysqli_query($conexion,$sql);

        $datos ['alumnos'] = array();
        if($res){
            while($fila = mysqli_fetch_assoc($res)){
                $alumno = array();

                $alumno['nc'] =$fila['Num_Control'];
                $alumno['n'] =$fila['Nombre'];
                $alumno['pa'] =$fila['Primer_Ap'];
                $alumno['sa'] =$fila['Segundo_AP'];
                $alumno['e'] =$fila['Edad'];
                $alumno['s'] =$fila['Semestre'];
                $alumno['c'] =$fila['Carrera'];

                array_push($datos['alumnos'], $alumno);
            }
            echo json_encode($datos);
        }else{
            $respuesta['exito']= false;
            $respuesta['Mensaje']= "error en la consulta";
            $resJSON = json_encode($respuesta);
            echo $respuesta;
        }


    }
}

?>