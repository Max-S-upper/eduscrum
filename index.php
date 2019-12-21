<?php
  session_start();
  include('db-connect.php');
  if ($isCon) {
    if (!isset($_COOKIE['PHPSESSDI'])) {
      include('sign.php');
      if (isset($_SESSION['sign_in_error'])) {
        var_dump($_SESSION['sign_in_error']);
        unset($_SESSION['sign_in_error']);
      }

      if (isset($_POST['signIn'])) {
        $user_email = trim($_POST['email']);
        $user_password = trim($_POST['password']);
        if (!empty($user_email) && !empty($user_password)) {
          $query = "SELECT password, id FROM user WHERE email = '$user_email'";
          $data = $con->query($query);
          $passw = $data->fetch();
          $passwrd = $passw[0];
          $id = $passw[1];
          if ($passwrd) {
            if (password_verify($user_password, $passwrd)) {
              setcookie('PHPSESSDI', $id, time() + (60 * 60 * 24 * 71));
              header("Location: /");
            }

            else $sign_in_error = "You entered a wrong password!";
          }

          else {
            $sign_in_error = "Account with these nickname and password doesn't exist!";
          }
        }

        if (!$user_email) $sign_in_error = "Enter your nickname";
        if (!$user_password && !$sign_in_error) $sign_in_error = "Enter your password";
        else if (!$user_password && $sign_in_error) $sign_in_error = "Enter your nickname and password";
        if (!$user_email || !$user_password) $sign_in_error .= ", please.";
        if ($sign_in_error) {
          $_SESSION['sign_in_error'] = $sign_in_error;
          header("Location: /");
        }
      }

      if (isset($_POST['signUp'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $group = $_POST['group'];
        $status = $_POST['status'];
        if ($status === 'student') {
        	$group = $_POST['group'];
        	$query = "INSERT INTO `user`(`name`, `surname`, `email`, `password`, `group`, `type`) VALUES('$name', '$surname', '$email', '$password', '$group', '1')";
        	$lists = $con->query("SELECT * FROM `lists`")
        }

        else {
        	$PIN = $_POST['PIN'];
        	$query = "INSERT INTO `user`(`name`, `surname`, `email`, `password`, `type`) VALUES('$name', '$surname', '$email', '$password', '0')";
        }

        $con->exec($query);
      }
    }

    else {
      include('main.php');
    }
  }