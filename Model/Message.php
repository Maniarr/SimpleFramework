<?php 

namespace Model;

use Model\Model;

class Message extends Model
{
	public function test()
	{
		$this->select('*');

		return ($this->fetchAll());
	}
}