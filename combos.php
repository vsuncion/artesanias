<?php
include("conexion.php");
include("utilitarios.php");
$link= Conectarse();
$p_codigo = filter_input(INPUT_POST, 'p_codigo');
$p_tipo = filter_input(INPUT_POST, 'p_tipo'); 
$query ="";

switch($p_tipo){
  case "PR":
     $query="SELECT id,NAME FROM provincia WHERE departamento_id='".$p_codigo."'"; 
    break;

  case "DT":
    $query="SELECT id,NAME FROM distrito WHERE provincia_id='".$p_codigo."'"; 
    break;

}

$result=mysqli_query($link,$query);
while($row=mysqli_fetch_array($result)){
?> 
  <option value="<?php echo $row["id"] ?>"><?php echo $row["NAME"] ?></option>
<?php 
 }
?>