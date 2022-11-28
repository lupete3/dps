<?php 

include ('connex.php');
session_start();

if(isset($_POST['log_in'])){
	$user = $_POST['login'];
	$pwd = $_POST['password'];

	$query1 = $bd->prepare("SELECT * FROM admin WHERE login = ? AND password = ? ");
	$query1->execute(array($user, $pwd ));

	$query2 = $bd->prepare("SELECT * FROM ecole WHERE login = ? AND password = ? ");
	$query2->execute(array($user, $pwd ));

	$query3 = $bd->prepare("SELECT * FROM eleve WHERE login = ? AND password = ? ");
	$query3->execute(array($user, $pwd ));


	if ($done=$query1->fetch(PDO::FETCH_ASSOC)) {

		$_SESSION['profile']['admin']=$done;

		header('location:../pages/admin');
								
	}elseif ($done1=$query2->fetch(PDO::FETCH_ASSOC)) {

		$_SESSION['profile']['ecole']=$done1;

		header('location:../pages/ecole');
								
	}elseif ($done2=$query3->fetch(PDO::FETCH_ASSOC)) {

		$_SESSION['profile']['eleve']=$done2;

		header('location:../pages/eleve');
								
	}else {

		header('location:../index?err=Login ou mot de pass incorrect');
				  	
	}

}

 ?>