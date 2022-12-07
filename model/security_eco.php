<?php

	session_start();

	if(!isset($_SESSION['profile']['ecole'])){
		header('location:../index');
     }else 
     $id= $_SESSION['profile']['ecole']['idEcole'];
	 $username= $_SESSION['profile']['ecole']['designationEcole'];

 ?>