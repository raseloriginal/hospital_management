<?php
  function getSystemSettings(){
    $db = new Database;
    $db->query('SELECT * FROM settings WHERE id = 1');
    return $db->single();
  }
