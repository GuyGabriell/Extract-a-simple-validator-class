
<?php 

$config = require('config.php');
  
$db = new Database($config['database']);

$heading = 'Note';

$currentUserId = 1;


//dd($_GET['id']);


//small tweaks and refactors that can be done to clean the code or makes it cleaner.

$note = $db->query('select * from notes where id = :id', ['id' => $_GET['id']])->findorfail();


authorized($note['user_id'] === $currentUserId);



require "views/note.view.php";
