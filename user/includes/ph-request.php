<!-- Modal -->
<div id="custom-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
      <span>&times;</span><span class="sr-only">Close</span>
  </button>
  <h4 class="custom-modal-title">Add New PH Request</h4>
  <div class="custom-modal-text text-left">
      <form role="form" action="<?php echo BASE_URL;?>user/provide-help" method="post">
        <div class="row">
          
          <div class="col-lg-12">
            <div class="form-group">
              <label for="phAmt">PH Amount (in <?php echo $defaultCurrency['c_symbol'].' - '.$defaultCurrency['c_code'];?>) </label>
              <input type="number" class="form-control" id="phAmt" 
              placeholder="eg: 100" required name="phAmt"
              value="<?php if(isset($phAmt)){echo $phAmt;}?>">
            </div>
          </div>
          <div class="col-lg-12">
            <p style="font-size:12px; font-style: italic;color: red;">1. Please do not PH if you do not have the funds that you are pledging.<br>
            2. "I don't have the funds right now, but I will have it by the time orders come out." - IF THIS IS WHAT YOU ARE THINKING, PLEASE CANCEL.</p>
            <div class="form-group">
              <label>
                <input type="checkbox" required name="agree"> I agreed to the <a href="<?php echo BASE_URL;?>terms">Terms and Conditions</a>
              </label>
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-default waves-effect waves-light">Submitt Request</button>

        <button type="reset" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">Cancel</button>
      </form>
  </div>
</div>