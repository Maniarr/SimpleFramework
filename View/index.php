<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php $this->asset('css/normalize.css') ?>" charset="utf-8">
        <link rel="stylesheet" href="<?php $this->asset('css/foundation.min.css') ?>" charset="utf-8">
        <link rel="stylesheet" href="<?php $this->asset('css/app.css') ?>" charset="utf-8">
        <title></title>
    </head>
    <body>
      <div id="login" class="row">
        <div class="columns medium-6 medium-centered login">
          <h2 class="text-center">Chat</h2>
          <p class="error text-center">

          </p>
          <input type="text" name="pseudo" value="" placeholder="Nickname">
          <button type="button" name="login">Login</button>
        </div>
      </div>
      <div id="chat" class="row chat" style="background: #f5f5f5; display: none">
          <div class="columns medium-4 contact-container">
            <div class="new_contact">
              <input type="text" name="new_contact" value="" placeholder="Nickname of contact">
              <button type="button" name="add_contact">Add</button>
            </div>
            <ul id="contact">

            </ul>
          </div>
          <div class="columns medium-8" style="background: #e1e1e1">
            <div id="message-container" class="message-container">

            </div>
            <div id="send-container" class="send-container">
              <textarea name="name" rows="3" cols="40"></textarea>
              <button type="button" name="send">Send</button>
              <div class="clear"></div>
            </div>
          </div>
      </div>
      <script type="text/javascript">
          var url = '<?php $this->url(''); ?>';
      </script>
      <script src="<?php $this->asset('js/jquery-2.1.4.js') ?>" charset="utf-8"></script>
      <script src="<?php $this->asset('js/chat.js') ?>" charset="utf-8"></script>
    </body>
</html>
