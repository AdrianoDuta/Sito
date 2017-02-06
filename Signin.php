<html>
	<head>
		<title> SignIn </title>
	</head>
		
	<body bgcolor="#ffff00" ">
			<?php
				session_start();
				include 'conn.inc.php';
	
	if(isset($_POST['password'])){
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db,$username,$passwd);
		$stm = $dbh->prepare('INSERT INTO quintab_sito.utente (username,password,nome,cognome) VALUE(:username,:password,:nome,:cognome)');
		$stm->bindValue(':username',$_POST['username']);
		$stm->bindValue(':password',$_POST['password']);
		$stm->bindValue(':nome',$_POST['nome']);
		$stm->bindValue(':cognome',$_POST['cognome']);
		if($stm->execute() == true){
			$_SESSION['esiste']=1;
			//header("location: sito.php");
		}
		else{
			echo 'Username non valido.';
		}
	}
?>

	<html>
	<body>
		<form method="post">
			Email: <input type="text" name="username" value=""> <br>
			Nome: <input type="text" name="nome" value=""> <br>
			Cognome: <input type="text" name="cognome" value=""> <br>
			Password: <input type="password" name="password" value=""> <br>
			<input type="submit" name="signin" value="Sign in">
		</form>
	</body>
</html>