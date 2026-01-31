<?php

    require_once("../config/supabase.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nombre   = htmlspecialchars($_POST["nombre"]);
        $apaterno = htmlspecialchars($_POST["aPaterno"]);
        $correo   = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
        $telefono = htmlspecialchars($_POST["telefono"]);
        $asunto   = htmlspecialchars($_POST["asunto"]);
        $mensaje  = htmlspecialchars($_POST["mensaje"]);

        if (!$nombre || !$apaterno || !$correo || !$telefono || !$asunto || !$mensaje) {
            echo "ERROR";
            exit;
        }

        $sql = "INSERT INTO tb_usuarios (nombre_usuario, apaterno_usuario, correo_usuario, telefono_usuario, asunto_usuario, mensaje)
            VALUES(:nombre, :apaterno, :correo, :telefono, :asunto, :mensaje)";

        $stmt = $pdo->prepare($sql);
        $guardado = $stmt->execute([":nombre"   => $nombre, ":apaterno" => $apaterno, ":correo"   => $correo, ":telefono" => $telefono, ":asunto"   => $asunto, ":mensaje"  => $mensaje]);
        if(!$guardado){
            echo "ERROR";
            exit;
        }

        /* ENVIAR CORREO */

        $correoAdmin = "ivahh300266@outlook.com";
        /* $asuntoCorreo = "Asunto: $asunto"; */
        $asuntoAdmin = "Nuevo mensaje de contacto: $asunto";

        $contenidoAdmin = "
        Nombre: $nombre $apaterno
        Correo: $correo
        Telefono: $telefono
        
        Mensaje: 
        $mensaje
        ";

        $headersAdmin = "From: $correoAdmin\r\n";
        $headersAdmin .= "Reply-To: $correoAdmin\r\n";
        $headersAdmin .= "Content-Type: text/plain; charset=UTF-8";

        if(!mail($correoAdmin, $asuntoAdmin, $contenidoAdmin, $headersAdmin)){
            echo "ERROR";
        }

        /* CORREO DE RESPUESTA */

        $asuntoUsuario = "Hemos recibido tu mensaje - SysConsult";
        $contenidoUsuario = "
        Hola $nombre,
        
        Gracias por Contactarnos.
        
        Hemos recibido tu mensaje con el asunto:
        \"$asunto\"
        
        Nos pondremos en contacto contigo a la brevedad a traves de correo o teléfono.

        Saludos cordiales.
        Equipo SysConsult
        ";
        
        $headersUsuario = "From: SysConsult <no.reply@sysconsult.com>\r\n";
        $headersUsuario .= "Reply-To: info@sysconsult.com\r\n";
        $headersUsuario .= "Content-Type: text/plain; charset=UTF-8";

        if(!mail($correo, $asuntoUsuario, $contenidoUsuario, $headersUsuario)){
            echo "ERROR";
        }

        echo "OK";
    }
?>