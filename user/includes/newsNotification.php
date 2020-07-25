<?php if(isset($newsUnread['subject']) 
  AND $newsUnread['subject'] != ''){?>
<div style="width:100%; background:#FFF5EE; border: 1px dashed red; border-radius:10px;margin-bottom:15px; height:auto; padding:10px;">
    <div class="row">
      <div class="col-sm-2">
        <h3 style="font-size:18px" align="left">News Update: </h3>
      </div>
      <div class="col-sm-8">
        <h3 style="font-size:16px"> <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"><?php echo $newsUnread['subject'];?>
        <span style="font-size:12px;font-style: italic;"><?php echo substr(str_replace('<p>', '', $newsUnread['content']), 0, 120);?>...</span></marquee></h3>
      </div>
      <div class="col-sm-2">
        <h3 align="left"><a class="btn btn-default btn-sm" href="<?php echo BASE_URL.'user/new?nid='.$newsUnread['id']?>">Read more!</a></h3>
      </div>
    </div>
  </div>
<?php }?>