<?php
    function getFotoUsuario ( $idUsuario ){
        include('config.php');
        $sql= "SELECT foto  FROM usuario WHERE id = ? ";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $result = $result["foto"];
        return $result;
    }

    function addUsuario($nombre, $apellidos, $email, $dir, $fecha, $con_hash, $fecha_act){
        include "config.php";
        $random_string=uniqid();
        $verificacion=sha1($random_string);
        $sql ="INSERT INTO usuario(id,email,fecha_nacimiento,fecha_registro,
                                        contrasena,ubicacion,foto,activo,rol,nombre,apellidos,verificacion) 
        VALUES (null,?,?,?,?,?,'imagenes/fotoPerfilGenerica.png',
                0,1,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssss", $email, $fecha, $fecha_act, $con_hash, $dir, $nombre, $apellidos, $verificacion);
        $result = $stmt->execute() or trigger_error("Query: $sql\n<br />MySQL Error: " . mysqli_error($connection));

        sendVerificationEmail($email);
        return $result;
    }

    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    function sendVerificationEmail($email){
        include 'config.php';
        require 'vendor/autoload.php';
        include 'PHPMailer-master/src/PHPMailer.php';
        include 'PHPMailer-master/src/SMTP.php';

        $sql="SELECT id, email, verificacion FROM usuario WHERE email=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $id = $result['id'];
        $codigo_de_verificacion=$result['verificacion'];


        $enlace_de_verificacion = "http://localhost:63342/FindMyPet/verificacion.php?id=$id&verificacion=$codigo_de_verificacion";

        $sujeto = 'Please activate your account';
        $mensaje = "Por favor, haga click en el siguiente enlace para verificar su cuenta:
                    \r\n$enlace_de_verificacion
                    \r\nMuchas gracias!";

        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 1;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Mailer = "smtp";
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'findmypettestmailnoreply@gmail.com';                     //SMTP username
            $mail->Password   = 'JQgXtd4RC43qazA';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('findmypet.noreply@gmail.com', 'FindMyPet');
            $mail->addAddress('alberto.fidalgo101@alu.ulpgc.es');

            //Attachments

            //Content
            $mail->isHTML(false);                               //Set email format to HTML
            $mail->Subject = $sujeto;
            $mail->Body    = $mensaje;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }

    function verifyEmail($email){
        include "config.php";
        $sql="SELECT * FROM usuario WHERE email=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return (mysqli_num_rows($result)==0);
    }

    function verifyPassword($email, $password){
        include 'config.php';
        $sql = "SELECT * FROM `usuario` WHERE `email` = ? AND `contrasena` = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute() or trigger_error("Query: $sql\n<br />MySQL Error: " . mysqli_error($connection));
        $result = $stmt->get_result();
        return $result;
    }

    function verifyAuth($email){
        include 'config.php';

        $sql="SELECT activo FROM usuario WHERE email=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        return $result['activo'];
    }

    function verifyAccount($id, $verificacion){
        include 'config.php';

        $sql="SELECT * FROM usuario WHERE id=? AND verificacion= ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("is", $id, $verificacion);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!mysqli_num_rows($result)==0){
            $sql = "UPDATE usuario SET activo=1, verificacion='' WHERE id=?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            return true;
        }
        return false;

    }
?>