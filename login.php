<body bgcolor="#ffa500"">
<?php
	session_start();            																						// come sempre prima cosa, aprire la sessione 

	include 'conn.inc.php';     																						// Include il file di connessione al database

	if($_SESSION['esiste']==0){
		
		$_SESSION['esiste']=0;
		echo "<html>
				<body>
					<form method='post'>
						EMail: <input type='text' name='username' value=''></br>
						Password: <input type='password' name='password' value=''></br>
						<input type='submit' name='login' value='Login'>
					</form>
				</body>
			</html>";	
		if(isset($_POST['password'])){
			$dbh = new PDO('mysql:host='.$host.';dbname='.$db,$username,$passwd);		
			$stm = $dbh->prepare('SELECT * FROM quintab_sito.utenti u WHERE u.password=":password" and u.username=":username"');   		 //per selezionare nel db l'utente e pw
			$stm->bindValue(':username',$_POST['username']);                                                          // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
			$stm->bindValue(':password',$_POST['password']);														// con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password
			if($stm->execute() == true){
				$_SESSION['esiste']=1; 																				//Nella variabile SESSION associo 1 (TRUE) al valore logged
				header("location: sito.php");																		// e mando per esempio ad una pagina esempio.php// in questo caso rimanderò ad una sito.php
		}
		else{
			echo 'Username o password non valido.';             												   // altrimenti esce scritta a video questa stringa di errore
		}
	}
	}
	else{
		echo 'Sei già loggato.';
	}
?>


