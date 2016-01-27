$(document).ready(function()
{
	var you;
	var select_room = undefined;

	/*you = {id: 1, name: 'Test'};
	$('#login').hide();
	$('#chat').show();
	get_chat_room();*/

	/* CONNEXION */

	$('button[name=login]').click(function()
	{
		if ($('input[name=pseudo]').val() != "")
		{
			$.ajax({
			    url: url + 'connect',
			    method: 'POST',
			    dataType: 'json',
			    data: {
			        name: $('input[name=pseudo]').val()
			    },
			    success: function(data)
			    {
			    	you = data;
			    	pseudo = $('input[name=pseudo]').val();
			        $('#login').hide();
			        $('#chat').show();
			        get_chat_room();
			        setInterval(get_new_message, 1000);
			        setInterval(get_notif, 1000);
			    }
			});
		}
	});

	/* ADD CONTACT */

	$('button[name=add_contact]').click(function()
	{
		if ($('input[name=new_contact]') != '')
		{
			$.ajax({
			    url: url + 'contact/add',
			    method: 'POST',
			    dataType: 'json',
			    data: {
			    	member_id: you.id,
			    	member: you.name,
			        contact: $('input[name=new_contact]').val()
			    },
			    success: function(data)
			    {
			    	console.log(data);
			    	if (data != 'false')
						write_contact(data);
			    }
			});
			$('input[name=new_contact]').val('');
		}
	});


	/* SEND MESSAGE */
	$('button[name=send]').click(send_message);

 	$(document).keypress(function(e)
  	{
    	if (e.keyCode == 13 && $('textarea:focus').length)
    	{
     	 	e.preventDefault();
      		send_message();
  	 	}
 	});

 	function send_message()
  	{
    	var message = {
     		author: you.name,
     		author_id: you.id,
      		room_id: select_room,
      		text: $('textarea').val()
    	};

    	var re = /^[ \n\r]*$/;
    	if (re.exec($('textarea').val()) == null && select_room !== null)
    	{
      		write_message(null, message.text);

      		$.ajax({
        		url: url + 'send',
        		method: 'POST',
        		data: message
      		});
   		}
   		$('textarea').val('').empty();
	}

	/* WRITE MESSAGE */
  	function write_message(name, text)
  	{
   		if (name == you.name || name == null)
      		$('#message-container').append('<div class="message text-right bg-lightgray"><p>' + text + '</p></div>');
    	else 
    	{
      		$('#message-container').append('<div class="message"><h5>' + name +' :</h5><p>' + text + '</p></div>');
    	}

    	$('#message-container').scrollTop($('#message-container').prop("scrollHeight"));
 	}


	/* GET CHAT ROOM */
	
	function get_chat_room()
	{
		$.ajax({
			url: url + 'chatroom',
			method: 'POST',
			dataType: 'json',
			data: {
			 	id: you.id
			},
			success: function(data)
			{
				data.forEach(function(contact)
				{
					if (contact.length > 0)
					{
						write_contact(contact);
					}
				});
			}
		});
	}

	function write_contact(contact)
    {
    	$('#contact').append('<li class="contact" room="' + contact[0].id + '"><h4>' + contact[0].name + '</h4></li>');	   
    	$('.contact[room=' + contact[0].id + ']').click(function(e)
    	{
    		if (select_room !== null)
    			$('.contact[room=' + select_room + ']').removeClass('active-contact');
    		
    		select_room = $(e.currentTarget).attr('room');
    		$('.contact[room=' + select_room + ']').removeClass('notif');
    		$(e.currentTarget).addClass('active-contact');

    		get_last_message();
    	});
    }

    /* GET NEW MESSAGE */

    function get_new_message()
    {
    	if (select_room === undefined)
    		return;

    	$.ajax({
			url: url + 'message/new',
			method: 'POST',
			dataType: 'json',
			data: {
			 	room_id: select_room,
			 	member_id: you.id
			},
			success: function(data)
			{
				data.forEach(function(message)
				{
					write_message(message.author, message.text);
				});
    		}
		});
    }

	/* GET LAST MESSAGE */

	function get_last_message()
	{
		$.ajax({
			url: url + 'message/last',
			method: 'POST',
			dataType: 'json',
			data: {
			 	room_id: select_room,
			 	member_id: you.id
			},
			success: function(data)
			{
				$('#message-container').empty();
				data.forEach(function(message)
				{
					write_message(message.author, message.text);
				});
		 	
			}
		});
	}

	function new_contact_write(room_id)
	{
		$.ajax({
			url: url + 'chatroom/name',
			method: 'POST',
			dataType: 'json',
			data: {
				room_id: room_id
			},
			success: function (contact)
			{
				write_contact(contact);
			}
		});
	}

	/* GET NOTIF */

	function get_notif()
	{
		$.ajax({
			url: url + 'notif',
			method: 'POST',
			dataType: 'json',
			data: {
				member_id: you.id
			},
			success: function (data)
			{console.log(data);
				data.forEach(function(notif)
				{
					
					if (notif !== undefined)
					{
						if ($('.contact[room=' + notif + ']').text() == '')
							new_contact_write(notif)

				        if (!$('.contact[room=' + notif + ']').hasClass('notif') && notif != select_room)
	          				$('.contact[room=' + notif + ']').addClass('notif');
					}
				});
			}
		});
	}
});
