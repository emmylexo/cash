<!-- Modal -->
<div id="custom-modal" class="modal-demo" style="width:100% !important;">
  <button type="button" class="close" onclick="Custombox.close();">
      <span>&times;</span><span class="sr-only">Close</span>
  </button>
  <h4 class="custom-modal-title">Phs Available for GH</h4>
  <div class="custom-modal-text text-left">
      <form role="form" action="" method="post">
        
<div class="table-responsive">
<?php if(!empty($myPHs)){?>
  <table class="table table-hover mails m-0 table table-actions-bar">
    <thead>
      <tr>
        <th></th>
        <th>Donate Date</th>
        <th>Donate Amount</th>
        <th>Interest</th>
        <th>Bonus</th>
        <th>Total</th>
        <th style="min-width: 150px;">Action</th>
      </tr>
    </thead>
    <tbody>
  <?php $i=0;
        foreach ($myPHs as $ph) {
          $i++;
          $sumPaidPHs = $front->sum_paidPHs($ph['ph_id']);?>
      <tr>  
        <td><?php echo $i;?></td>
        <td><?php echo strftime("%b %d, %Y %I:%M", strtotime($ph["date_added"]));?></td> 

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$ph['amount'], 2, '.', ',');?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$ph['interest'], 2, '.', ',');?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$ph['bonus'], 2, '.', ',');?></td>

        <td><?php echo $defaultCurrency['c_symbol'].number_format((float)$ph['request_amt'], 2, '.', ',');?></td>

        <td><?php if($ph["amount"] == $ph["paid"] AND $ph["gh_status"] == 0){?>
            <form action="" method="post">
              <input type="hidden" name="phID" value="<?php echo $ph["ph_id"];?>">
              <button name="ghRequest" class="btn btn-default btn-sm" type="submit">Request GH</button>
            </form>
          <?php }elseif($ph["amount"] == $ph["paid"] AND $ph["gh_status"] == 1){?>
            <span style="color:green">GH Request Sent</span>
          <?php }elseif($ph["amount"] > $ph["paid"] AND $ph["gh_status"] == 0){?>
              <span style="color:brown">Maturing</span>
          <?php }else{?>
              <span style="color:red">None</span>
          <?php }?>
        </td>

      </tr>
      <?php }?>      
    </tbody>
  </table>
  <?php }else{?>      
      <p>No record found!</p>
  <?php }?> 
</div>
      </form>
  </div>
</div>