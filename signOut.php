<?php 
	unset($_COOKIE['PHPSESSDI']); 
    setcookie('PHPSESSDI', null, -1, '/');
	header('Location: /');
?>