<?php

class Participants extends Model
{
	public function create_participant($room_id, $member_id, $time = null)
	{
		if ($time = null)
			$this->insert(array('room_id' => $room_id, 'member_id' => $member_id));
		else
			$this->insert(array('room_id' => $room_id, 'member_id' => $member_id, 'last_activity' => $time));
		$this->execute();
	}

	public function get_last_activities($member_id)
	{
		$this->request = 'SELECT DISTINCT room_id, last_activity FROM participants WHERE member_id = '.$member_id;
		return ($this->fetchAll());
	}

	public function update_activity($member_id, $room_id)
	{
		$req = $this->update(array('last_activity' => 'NOW()'))->where('member_id = '.$member_id.' AND room_id = '.$room_id);
		$req->execute();
	}

	public function get_last_activity($member_id, $room_id)
	{
		$req = $this->select('last_activity')->where('member_id = '.$member_id.' AND room_id = '.$room_id);
		return ($req->fetch());
	}
}