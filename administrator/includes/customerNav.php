<div class="row m-t-10 m-b-10">
  <div class="col-sm-12 col-lg-12">
      <div class="h5 m-0">
          <div class="btn-group vertical-middle">
           <a href="<?php echo BASE_URL.'administrator/customer-summary?uid='.$uID;?>" class="btn btn-white btn-md waves-effect <?php if(isset($pageSec) AND $pageSec == 'summary'){echo 'active';}?>">
              Summary
           </a>

           <a href="<?php echo BASE_URL.'administrator/customer-profile?uid='.$uID;?>" class="btn btn-white btn-md waves-effect <?php if(isset($pageSec) AND $pageSec == 'profile'){echo 'active';}?>">
              Profile
           </a>

           <a href="<?php echo BASE_URL.'administrator/customer-orders?uid='.$uID;?>" class="btn btn-white btn-md waves-effect <?php if(isset($pageSec) AND $pageSec == 'orders'){echo 'active';}?>">
              PH Orders
           </a>

           <a href="<?php echo BASE_URL.'administrator/customer-gh-orders?uid='.$uID;?>" class="btn btn-white btn-md waves-effect <?php if(isset($pageSec) AND $pageSec == 'GH'){echo 'active';}?>">
              GH Orders
           </a>
          
           <a href="<?php echo BASE_URL.'administrator/customer-referrals?uid='.$uID;?>" class="btn btn-white btn-md waves-effect <?php if(isset($pageSec) AND $pageSec == 'referral'){echo 'active';}?>">
              Referrals
           </a>
          </div>
      </div>
      <div class="col-lg-4">
        <h3><?php echo '#'.$uID.' - '.$uInfo['first_name'].' '.$uInfo['last_name'];?></h3>
      </div>
      <div class="col-lg-8">
          
      </div>
  </div>
</div>