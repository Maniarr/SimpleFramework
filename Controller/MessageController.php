<?php 

class MessageController extends Controller
{
	public function send()
	{
		$messages = $this->model('Messages');

		$messages->send(array(
							'author' 		=> htmlspecialchars($_POST['author']),
							'author_id' 	=> htmlspecialchars($_POST['author_id']),
							'room_id' 		=> htmlspecialchars($_POST['room_id']),
							'text'			=> htmlspecialchars($_POST['text'])
						));
	}

	public function get_notif()
	{
		$participants = $this->model('Participants');
		$member_id = htmlspecialchars($_POST['member_id']);
		$messages = $this->model('Messages');
		$activities = $participants->get_last_activities($member_id);
		$response = array();

		foreach ($activities as $activity)
		{
			$new_messages = $messages->get_new_message($member_id, $activity['room_id'], $activity['last_activity']);
			if (isset($new_messages[0]))
				array_push($response, $activity['room_id']);
		}

		echo json_encode($response);
	}

	public function get_last_message()
	{
		$limit = 10;
		$room_id = htmlspecialchars($_POST['room_id']);
		$member_id = htmlspecialchars($_POST['member_id']);
		$messages = $this->model('Messages');
		$participants = $this->model('Participants');

		$participants->update_activity($member_id, $room_id);
		echo json_encode($messages->get_last_message($room_id, $limit));
	}

	public function get_new_message()
	{
		$participants = $this->model('Participants');
		$messages = $this->model('Messages');

		$room_id = htmlspecialchars($_POST['room_id']);
		$member_id = htmlspecialchars($_POST['member_id']);

		$last_activity = $participants->get_last_activity($member_id, $room_id);
		$new_messages = $messages->get_new_message($member_id, $room_id, $last_activity['last_activity']);

		if (isset($new_messages[0]))
			$participants->update_activity($member_id, $room_id);

		echo json_encode($new_messages);
	}
}