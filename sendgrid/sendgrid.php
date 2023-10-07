<?php
require("sendgrid-php.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');

$db = DatabaseContext::getInstance();

class Email {
  private $from;
  private $to;
  private $subject;
  private $content;
  private $isHtml = true;
  private $contentType = 'text/html';
}

function sendEmail() {
  global $db;
  $sql = 'SELECT `sendgridApiKey` FROM sendgridConfiguration;';
  $db->connect();
  $db->executeDbQuery($sql);
  $db->close();
  $result = $db->getResultSet();
  $sendgridApiKey = '';
  $fila = $result->fetch_assoc();
  if($fila) {
    $sendgridApiKey = $fila['sendgridApiKey'];
  }

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom("martin@martinponce.com.ar", "Martin Ponce");
  $email->setSubject("Sending with SendGrid is Fun");
  $email->addTo("martinp88@gmail.com", "Martin Ponce");
  $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
  $email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
  );

  $sendgrid = new \SendGrid($sendgridApiKey);

  try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
  } catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
  }
}