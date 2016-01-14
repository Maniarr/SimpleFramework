<?php

class Database
{
  private $db;

  function __construct()
  {
    $credentials = array(
      'host'     => 'localhost',
      'port'     => 3306,
      'dbname'   => 'simpleframework',
      'username' => 'zoidberg',
      'password' => 'password',
    );

    $this->db = $this->connect($credentials);
  }

  private function connect($credentials)
  {
    try
    {
        $database = new PDO('mysql:host='.$credentials['host'].';port='.$credentials['port'].';dbname='.$credentials['dbname'], $credentials['username'], $credentials['password']);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
      echo 'SQL Connection ERROR : '.$e->getMessage();
      return (false);
    }

    return ($database);
  }

  public function get_db()
  {
    return ($this->db);
  }
}
