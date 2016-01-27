<?php

class Members extends Model
{
	public function register_member($name)
	{
		$req = $this->insert(array('name' => $name));
		$req->execute();
	}

    public function is_exist($name)
    {
     	$req = $this->select('id, name')->where('name = "'.$name.'"');
    	return ($req->fetch());
    }
}
