<?php 
// Composer's auto-loading functionality

   require_once '../class/Mailer.php';
 
 
// inhibit DOMPDF's auto-loader
define('DOMPDF_ENABLE_AUTOLOAD', false);

//include the DOMPDF config file (required)
require '../vendors/dompdf/dompdf_config.inc.php';

//if you get errors about missing classes please also add:
require_once('../vendors/dompdf/include/autoload.inc.php');
require_once("../vendors/dompdf/dompdf_config.inc.php");


  $nombre_empresa=$_POST['nombre_empresa']; 
  $correo_empresa=$_POST['correo_empresa'];
  $tipo_app=$_POST['tipo'];
  if ($tipo_app=='android') {
    $precio_tipo=500;
  }elseif ($tipo_app=='ios') {
    $precio_tipo=700;
  }elseif ($tipo_app=='web') {
    $precio_tipo=450;
  }elseif ($tipo_app=='') {
    $precio_tipo=2000;
  }else{
    $precio_tipo=0;
  }
  $login=$_POST['login'];
  if ($login=='Si') {
    $precio_login=350;
  }else{
    $precio_login=0;
  }
  $diseño=$_POST['diseño'];
  if ($diseño=='Interfaz') {
    $precio_diseño=550;
  }elseif ($diseño=='Diseño Personal') {
    $precio_diseño=1500;
  }elseif ($diseño=='Diseño Personal y Responsive') {
    $precio_diseño=2500;
  }else{
    $precio_diseño=0;
  }
  $perfil=$_POST['perfil'];
  if ($perfil=='Si') {
    $precio_perfil=750;
  }else{
    $precio_perfil=0;
  }
  $compras=$_POST['compras'];
  if ($compras=='Si') {
    $precio_compras=2500;
  }else{
    $precio_compras=0;
  }
  $sincronizacion=$_POST['sincronizacion'];
   if ($sincronizacion=='Si') {
    $precio_sincronizacion=2500;
  }else{
    $precio_sincronizacion=0;
  }
  $idiomas=$_POST['idiomas'];
  if ($idiomas=='Un idioma') {
    $precio_idioma=100;
  }elseif ($idiomas=='Bilingue') {
    $precio_idioma=350;
  }else{
    $precio_idioma=0;
  }
  $etapa=$_POST['etapa'];
  if ($etapa=='Idea') {
    $precio_etapa=2500;
  }elseif ($etapa=='Boceto Preparado') {
    $precio_etapa=1500;
  }elseif ($etapa=='App Desarrollada') {
    $precio_etapa=1000;
  }else{
    $precio_diseño=0;
  }
  $panel=$_POST['panel'];
   if ($panel=='Si') {
    $precio_panel=2500;
  }else{
    $precio_panel=0;
  }
  $suma= $precio_etapa+$precio_panel+$precio_diseño+$precio_idioma+$precio_tipo+$precio_sincronizacion+$precio_perfil+$precio_login+$precio_compras;
  ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cotizador</title>
</head>
<body>
  <center><img src="../img/logo2.png"  height="auto"></center>
<center><h1>COTIZACION </h1></center>
               <label>*Precios sujetos a cambio</label> 
<?php 
 

                    
                      echo'
                       <div class="table-responsive">  
                   <table class="table table-bordered">
                   <tr>
                   <td>Tipo App</td><td>'.$tipo_app.'</td><td>'.$precio_tipo.'</td></tr>
                   <tr>
                   <td>Login</td><td>'.$login.'</td><td>'.$precio_login.'</td>
                   </tr>
                   <tr>
                   <td>Perfiles de Usuario</td><td>'.$perfil.'</td><td>'.$precio_perfil.'</td>
                   </tr>
                   <tr>
                   <td>Diseño aplicacion</td><td>'.$diseño.'</td><td>'.$precio_diseño.'</td>
                   </tr>
                   <tr>
                   <td>Compras</td><td>'.$compras.'</td><td>'.$precio_compras.'</td>
                   </tr>
                   <tr>
                   <td>Sincronizacion con la parte web</td><td>'.$sincronizacion.'</td><td>'.$precio_sincronizacion.'</td>
                   </tr>
                   <tr>
                   <td>Idiomas</td><td>'.$idiomas.'</td><td>'.$precio_idioma.'</td>
                   </tr>
                   <tr>
                   <td>Etapa del proyecto</td><td>'.$etapa.'</td><td>'.$precio_etapa.'</td>
                   </tr>
                   <tr>
                   <td>Requiere Panel Administrativo</td><td>'.$panel.'</td><td>'.$precio_panel.'</td>
                   </tr>
                   '; 
                  
            echo ' </table></div>

              <h1>TOTAL : <strong>'.$suma.'</strong></h1>
              ';
                  ?>
</body>
</html>
<?php
//$correo = 'jhosuegarciastarkand@gmail.com';
  $dompdf1 = new DOMPDF();
  $dompdf1->set_option('enable_html5_parser', TRUE);
$dompdf1->load_Html(ob_get_clean());
$dompdf1->render();
  $filename1 = 'cotizacion_'.$nombre_empresa.'.pdf';


  $pdf =$dompdf1->output();

  file_put_contents($_SERVER['DOCUMENT_ROOT'].'/Chiltex/enviados/'.$filename1, $pdf);
	//$archivo=$dompdf1->stream($filename1);

	$sending = new Mailer("Cotizacion: ".$nombre_empresa."", "Cotizacion:",$filename1,'',$nombre_empresa);
    $resultado = $sending->enviarCorreo();
  if ($resultado ==1) {
    

      header('Location: ../index.php?success=correcto');
  
    
  }else{
$dompdf1->stream($filename1);
      header('Location: ../index.php?success=no envio');
  
  }
           

?>