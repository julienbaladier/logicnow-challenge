<?php

class Database{

  private static $instance = NULL;

  private static $config = array(
          'host'      => 'localhost',
          'database'  => 'logicnow',
          'login'     => 'root',
          'password'  => '1234',
  );

  /* Private constructor to avoid having mulitple instanse of database*/
  private function __construct(){}


  public static function getInstance(){

    /* If we have already the connections, we return it */

    if(isset(Database::$instance)){
      return Database::$instance; 
    }else{

    /* Else we create an instance and return it */

      Database::$instance = new PDO('mysql:host='.Database::$config['host'].';
                                           dbname='.Database::$config['database'].';', 
                                           Database::$config['login'], 
                                           Database::$config['password']);
      return Database::$instance;
    }

    
  }



}



?>