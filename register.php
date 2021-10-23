<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';
	if(isset($_POST['signup'])){
		
		echo "si llega";
		echo $_POST['password'];

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;

		$_SESSION['captcha'] = time() + (10*60);

		if($password != $repassword){
			$_SESSION['error'] = 'La contraseña y la verificacion no coinciden';
			header('location: signup.php');
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Este correo esta en uso';
				header('location: signup.php');
			}
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);

				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);
				echo $code;
				try{
					$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, activate_code, created_on, type, address, contact_info,photo,status,reset_code) VALUES (:email, :password, :firstname, :lastname, :code, :now, 0,\"\",\"\",\"\",1,\"\");");
					$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					// $message = "
					// 	<h2>Gracias por registrarte.</h2>
					// 	<p>Tue cuenta:</p>
					// 	<p>Correo: ".$email."</p>
					// 	<p>contraseña: ".$_POST['password']."</p>
					// 	<p>Haga click en el siguiente enlace para activar su cuenta.</p>
					// 	<a href='http://localhost/ecommerce/activate.php?code=".$code."&user=".$userid."'>Activar Cuenta</a>
					// ";

					//Load phpmailer
		    		// require 'vendor/autoload.php';

		    		// $mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        // $mail->isSMTP();                                     
				        // $mail->Host = 'smtp.gmail.com';                      
				        // $mail->SMTPAuth = true;                               
				        // $mail->Username = 'erviin.drop@gmail.com';     
				        // $mail->Password = '';                    
				        // $mail->SMTPOptions = array(
				        //     'ssl' => array(
				        //     'verify_peer' => false,
				        //     'verify_peer_name' => false,
				        //     'allow_self_signed' => true
				        //     )
				        // );                         
				        // $mail->SMTPSecure = 'ssl';                           
				        // $mail->Port = 465;                                   

				        // $mail->setFrom('erviin.drop@gmail.com');
				        
				        // //Recipients
				        // $mail->addAddress($email);              
				        // $mail->addReplyTo('erviin.drop@gmail.com');
				       
				        // //Content
				        // $mail->isHTML(true);                                  
				        // $mail->Subject = 'Registro en nuestro Ecommerce';
				        // $mail->Body    = $message;

				        // $mail->send();

				        unset($_SESSION['firstname']);
				        unset($_SESSION['lastname']);
				        unset($_SESSION['email']);

				        $_SESSION['success'] = 'Cuenta Creada. Inicia sesion para continuar.';
				        header('location: signup.php');

				    } 
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Mensaje no se pudo enviar. Mailer Error: '.$mail->ErrorInfo;
				        header('location: signup.php');
				    }


				}
				catch(PDOException $e){
					echo $e->getMessage();
					$_SESSION['error'] = $e->getMessage();
					header('location: register.php');
				}

				$pdo->close();

			}

		}

	}
	else{
		$_SESSION['error'] = 'Llene el formulario primero';
		// header('location: signup.php');
	}

?>