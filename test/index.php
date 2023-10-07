<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/sendgrid/sendgrid.php');

$date = new DateTime();
$str = $date->format('Y-m-d H:i:s');
echo $str . '\n';

try {
  sendEmail();
  echo 'email enviado!';
} catch(Execption $e) {
  echo 'error enviando email';
  echo $e->getMessage();
}
?>