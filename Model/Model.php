<?php

class Model
{
  public $request;
  public $table_name;
  public $db;

  function __construct($table_name)
  {
    $this->request = '';
    $this->table_name = strtolower($table_name);

    $this->db = (new Database())->get_db();
  }

  /* PRIMARY METHOD */

  public function select()
  {
    $fields = func_get_args();

    $values = '';

    foreach ($fields as $field)
    {
      if (!empty($values))
        $values .= ', ';
      $values .= $field;
    }

    $this->request = 'SELECT '.$values.' FROM '.$this->table_name;

    return ($this);
  }

  public function insert($fields)
  {
    $columns = '';
    $values = '';

    foreach ($fields as $key => $value)
    {
      if (!empty($columns))
        $columns .= ', ';
      $columns .= $key;

      if (!empty($values))
        $values .= ', ';
      $values .= '\''.$value.'\'';
    }

    $this->request = 'INSERT INTO '.$this->table_name.' ('.$columns.') VALUES ('.$values.')';

    return ($this);
  }

  public function update($fields)
  {
    $updates = '';

    foreach ($fields as $key => $value)
    {
      if (!empty($updates))
        $updates .= ', ';
      $updates .= $key.' = \''.$value.'\'';
    }

    $this->request = 'UPDATE '.$this->table_name.' SET ('.$updates.')';

    return ($this);
  }

  public function delete()
  {
    $this->request = 'DELETE FROM '.$this->table_name;

    return ($this);
  }

  /* SLAVE ACTION */

  public function limit($limit)
  {
    $this->request .= ' LIMIT '.$limit;

    return ($this);
  }

  public function order_by($order)
  {
    $this->request .= ' ORDER BY '.$order;

    return ($this);
  }

    /* WHERE */
  public function where($condition)
  {
    $this->request .= ' WHERE '.$condition;

    return ($this);
  }

  public function and_where($condition)
  {
    $this->request .= ' AND '.$condition;

    return ($this);
  }

  public function or_where($condition)
  {
    $this->request .= ' OR '.$condition;

    return ($this);
  }


  /* RESULT ACTION */

  public function fetch()
  {

    try
    {
      $req = $this->db->prepare($this->request);
      $req->execute();
      return ($req->fetch());
    }
    catch (PDOException $e)
    {
      echo 'SQL Error : '.$e->getMessage();
    }

    return (false);
  }

  public function fetchAll()
  {

    try
    {
      $req = $this->db->prepare($this->request);
      $req->execute();
      return ($req->fetchAll());
    }
    catch (PDOException $e)
    {
      echo 'SQL Error : '.$e->getMessage();
    }

    return (false);
  }
}
//$orm->delete();
//$orm->update(array('name' => 'test', 'email' => 'test@test.fr'));
//$orm->insert(array('name' => 'test', 'email' => 'test@test.fr'));
