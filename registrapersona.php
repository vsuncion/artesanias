<?php
session_start();
include("conexion.php");
include("cabecera.php");
$link= Conectarse();

// echo var_dump($_POST); 
if(isset($_POST["btngrabar"])){
    $p_nombre         = $_POST["Nombre"];
    $p_paterno        = $_POST["paterno"];
    $p_materno        = $_POST["materno"];
    $p_cbdepartamento = $_POST["cbdepartamento"];
    $p_cbprovincia    = $_POST["cbprovincia"];
    $p_cbdistrito     = $_POST["cbdistrito"];
    $p_direccion      = $_POST["direccion"];
    $p_referencia     = $_POST["referencia"];
    $p_telefono       = $_POST["telefono"];
    $p_correo         = $_POST["correo"];

    $p_tipo_alerta="alert-primary";
    $mensaje="";
    // VERIFICAMOS CORREO SI YA ESTA REGISTRADO
    $query="SELECT VNOMBRE,VAPEPATERNO,VAPEMATERNO FROM personas WHERE UPPER(VCORREO)=UPPER('".$p_correo."')";
    $result=mysqli_query($link,$query);
    $rowCount = mysqli_num_rows($result);
    if($rowCount>0){
        $row=mysqli_fetch_array($result);
        $mensaje="EL REGISTRO DE LA PERSONA ".$p_paterno." ".$p_materno." ".$p_nombre." ya se encuentra registrado con correo : ".$p_correo;
        $p_tipo_alerta="alert-danger";
    }else{
        $sql_insercion="INSERT INTO personas(VNOMBRE,VAPEPATERNO, VAPEMATERNO, FDEPARTAMENTO, FPROVINCIA,";
        $sql_insercion.="FDISTRITO, VDIRECCION, VREFERENCIA, VTELEFONO,VCORREO,FECREGISTRO) ";
        $sql_insercion.=" VALUES('".$p_nombre."','".$p_paterno."','".$p_materno."','".$p_cbdepartamento."','".$p_cbprovincia;
        $sql_insercion.="','".$p_cbdistrito."','".$p_direccion."','".$p_referencia."','".$p_telefono."','".$p_correo."',CURDATE())";
        $result=mysqli_query($link,$sql_insercion);
        $afecto= mysqli_affected_rows($link);
        if($afecto>0){
            $last_id = $link->insert_id;
            $sql_insercion="INSERT INTO usuarios(FPERSONA,FROL,VCORREO,VCLAVE,FECREGISTRO) ";
            $sql_insercion.="VALUES(".$last_id .",1,'".$p_correo."','654321@',CURDATE())"; 
            $result=mysqli_query($link,$sql_insercion);
            if ($result){
                $p_tipo_alerta="alert-success";
                $mensaje="EL REGISTRO CON CORREO ".$p_correo." SE REGISTRO CON EXITO"; 
            }else{
               // echo "Failed to connect to MySQL: " . $link -> error;
                $sql_insercion="DELETE FROM  personas WHERE PIDPERSONA=".$last_id;
                $result=mysqli_query($link,$sql_insercion);
                $p_tipo_alerta="alert-danger";
                $mensaje="OCURRIO UN ERROR ".$link -> error;
                exit();
            }
            
        }
        
        mysqli_close($link);
    }
    
    
}
?>

<div class="container">
   <P>
   <div class="row justify-content-center">

    <div class="alert <?php echo $p_tipo_alerta ?> text-center" role="alert"> 
         <?php echo $mensaje ?> 
    </div>
 
    <a href="login.php"   class="btn btn-outline-primary" role="button" aria-disabled="true">IR AL LOGIN <i class="fa fa-lock"></i></a>&nbsp;

   </div>

</div>

<?php include("pie_pagina.php");  ?>