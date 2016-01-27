<?php

class Chat_room extends Model
{
	public function create_room($name)
	{
		$this->insert(array('name' => $name));
		$this->execute();

		return ($this->select('id, name')->where('name = "'.$name.'"')->order_by('id DESC')->fetch());
	}

	public function get_chat_room($member_id)
	{
		$this->request = 'SELECT DISTINCT room_id FROM participants WHERE member_id = '.$member_id;

		return ($this->fetchAll());
	}

	public function get_name($room_id)
	{
		$req = $this->select('id, name')->where('id = "'.$room_id.'"');

		return ($req->fetchAll());
	}
}