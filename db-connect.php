<?php
  try {
    $con = new PDO('mysql:host=localhost;dbname=lavlexco_eduscrum', 'lavlexco_eduscrum', 'lavLex71');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $isCon = true;
  }

  catch(Exception $e) {
    return var_dump('The worsest connection situation ever!');
  }
?>