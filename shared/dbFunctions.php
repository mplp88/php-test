<?php
function executeQuery($query) {
  global $db;
  $db->connect();
  $result = $db->executeDbQuery($query);
  $db->close();
  return $db->getResultSet();
}
?>