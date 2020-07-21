<div class="p-20">
  <a href="<?php echo BASE_URL?>user/compose" class="btn btn-danger btn-rounded btn-custom btn-block waves-effect waves-light">Compose</a>

  <div class="list-group mail-list  m-t-20">
    <a href="<?php echo BASE_URL;?>user/messages" class="list-group-item b-0 active"><i class="fa fa-download m-r-10"></i>Inbox <b>(<?php echo $countMessages;?>)</b></a>

    <a href="<?php echo BASE_URL;?>user/messages-sent" class="list-group-item b-0"><i class="fa fa-paper-plane-o m-r-10"></i>Sent Mail</a>
    
  </div>
</div>