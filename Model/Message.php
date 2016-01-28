<?php 

namespace Model;

class Message extends Model
{
	public function test()
	{
		$this->select('*');

		return ($this->fetchAll());
	}
}