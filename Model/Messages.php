<?php

class Messages extends Model
{
	public function send($message)
	{
		$this->insert($message)->execute();
	}

	public function get_last_message($room_id, $limit)
	{
		$req = $this->select('author, text')->where('room_id = '.$room_id)->order_by('created_at');

		return ($req->fetchAll());
	}

	public function get_new_message($member_id, $room_id, $last_activity)
	{
		$req = $this->select('author, text')->where('author_id != '.$member_id.' AND room_id = '.$room_id.' AND created_at > "'.$last_activity.'"');

		return ($req->fetchAll());
	}
}