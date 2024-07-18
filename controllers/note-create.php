<?php

//two layers of validation
//the client site or browser validation
//the server validation that cannot be bypass by any user 
//also giving the user feedback on what the error is 

$config = require('config.php');
  
$db = new Database($config['database']);



$heading = 'Create Note';





if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $errors = [];

  if (strlen($_POST['body']) === 0) {

    $errors['body'] = 'A body is required';
  }

//this validate the maximum Nos. of char and also not loose the typed data

  if (strlen($_POST['body']) > 1000) {

    $errors['body'] = 'A body can not be more than 1,000 characters.';
  }


  if (empty($errors)) {

      $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [

       'body' => $_POST['body'],
       'user_id' => 1

    ]);

  }

}


require 'views/note-create.view.php';