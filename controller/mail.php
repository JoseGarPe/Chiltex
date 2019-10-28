<?php 
   require_once '../class/Mailer.php';
   	if (isset($_POST['name'])) {
   		$nombre_empresa = $_POST['name'];
   	}else{
   		$nombre_empresa="No Specify";
   	}   	
if (isset($_POST['email'])) {
   		$email_empresa = $_POST['email'];
   	}else{
   		$email_empresa="No Specify";
   	} 	
if (isset($_POST['subject'])) {
   		$subject_empresa = $_POST['subject'];
   	}else{
   		$subject_empresa="No Specify";
   	}
 	
if (isset($_POST['message'])) {
   		$message_empresa = $_POST['message'];
   	}else{
   		$message_empresa="No Specify";
   	}




 	$sending = new Mailer("", ":","","","");
    $resultado = $sending->enviarCorreoContacto($nombre_empresa,$email_empresa,$subject_empresa,$message_empresa);
    if ($resultado ==1) {
    

      header('Location: ../index.php?success=correcto');
  
    
  }else{
      header('Location: ../index.php?success=no envio');
  
  }
 ?>