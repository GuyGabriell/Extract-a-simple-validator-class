<?php 



class Database {

  //just a small tweak by making all class and method plublic for now.
  //by also gaining control of the data

  public $connection;

  public $statement;


  public function __construct($config, $username = 'root', $password = '') {

    //As it's name suggest is actually use for building of query string 
    //example.com?foo=bar
    $dsn = 'mysql:' . http_build_query($config, '', ';'); 

    
  $this->connection = new PDO($dsn, $username , $password, [

    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
  ]);

  }




  public function query($query, $params = []) {

    $this->statement = $this->connection->prepare($query);
    //$statement = $this->connection->prepare($query);
    
    $this->statement->execute($params);
    //$statement->execute($params);
 
    return $this;
    //return $statement;

  }



  public function get() {

    return $this->statement->fetchAll();

  }


//now i own that method name.
  public function find() {

     return $this->statement->fetch();
  }



  public function findorfail() {

    $result = $this->find();

      if (! $result) {

      abort();
    }

    return $result;

  }



} 