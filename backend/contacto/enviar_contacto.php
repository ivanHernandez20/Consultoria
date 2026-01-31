<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nombre   = htmlspecialchars($_POST["nombre"]);
        $apaterno = htmlspecialchars($_POST["aPaterno"]);
        $correo   = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
        $telefono = htmlspecialchars($_POST["telefono"]);
        $asunto   = htmlspecialchars($_POST["asunto"]);
        $mensaje  = htmlspecialchars($_POST["mensaje"]);

        $destinatario = "ivahh300266@outlook.com"; // <-- CAMBIA ESTO
        $asuntoCorreo = "Asunto: $asunto";

        $contenido = "
        Nombre: $nombre $apaterno
        Correo: $correo
        Telefono: $telefono
        
        Mensaje: 
        $mensaje
        ";

        $headers = "From: $correo\r\n";
        $headers .= "Reply-To: $correo\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8";

        if(mail($destinatario, $asuntoCorreo, $contenido, $headers)){
            echo "OK";
        }else{
            echo "ERROR";
        }
        
    }
?>