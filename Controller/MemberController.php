<?php

class MemberController extends Controller
{
  public function connect()
  {
  	$name = htmlspecialchars($_POST['name']);
    $members = $this->model('Members');

    $response = $members->is_exist($name);
   	if (!$response)
   	{
   		$members->register_member($name);
   		$response = $members->is_exist($name);
   	}

   	echo json_encode(array('id' => $response['id'],
   						   'name' => $response['name']
   							)
   					);
  }

  public function get_chat_name()
  {
      $room_id = htmlspecialchars($_POST['room_id']);
      $chat_room = $this->model('Chat_room');

      echo json_encode($chat_room->get_name($room_id));
  }

  public function get_chat_room()
  {
  	$id = htmlspecialchars($_POST['id']);
  	$chatroom = $this->model('Chat_room');
  	$rooms = $chatroom->get_chat_room($id);
  	$response = array();

  	foreach($rooms as $room)
  	{	
  		array_push($response, $chatroom->get_name($room['room_id']));
  	}	

  	echo json_encode($response);
  }

  public function add_contact()
  {
    $members = $this->model('Members');
    $participants = $this->model('Participants');
    $chatroom = $this->model('Chat_room');
    $messages = $this->model('Messages');
    $member_id = htmlspecialchars($_POST['member_id']);
    $member = htmlspecialchars($_POST['member']);
    $contact = htmlspecialchars($_POST['contact']);
    $contact = $members->is_exist($contact);

    if ($contact)
    {
      $room_id = $chatroom->create_room($member.' - '.$contact['name']);
      $participants->create_participant($room_id['id'], $member_id);
      $participants->create_participant($room_id['id'], $contact['id'], date('Y-m-d H:i:s', strtotime('- 1 year')));
      $messages->send(array('author' => $member, 'author_id' => $member_id, 'room_id' => $room_id['id'], 'text' => 'Hi !'));
      echo json_encode(array($room_id));
    }
    else
      echo json_encode('false');
  }
}
