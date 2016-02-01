<div id="content" class="span10">
	<!-- content starts -->
	
	<?php
	$totalClients = ($completed_clients->clientcount)+($process_clients->processclientcount);?>
	
	
	<div class="sortable row-fluid ui-sortable">
    <a data-rel="tooltip" class="well span3 top-block" href="<?php echo base_url().'administrator/client/totalClientsUnderTO';?>" data-original-title=" <?php echo $totalClients; ?> Client">
     <span class="icon32 icon-red icon-user"></span>
     <div>Total Client</div>
     <div>
         <?php  echo $completed_clients->clientcount ; ?>
     </div>
     
     
     
     <?php if ($process_clients->processclientcount != 0) { ?>
     <span class="notification"><?php  echo $process_clients->processclientcount ; ?></span> <?php }
       else '';
     
      ?>
     
    </a>
    
  

    <a data-rel="tooltip" class="well span3 top-block" href="<?php echo base_url().'administrator/lineowner/cardList';?>" data-original-title="<?php  echo $cardinfo->countcard ; ?> Lines.">
     <span class="icon32 icon-color icon-star-on"></span>
     <div>Lines</div>
     <div><?php  echo $cardinfo->countcard ; ?></div>
     <!-- <span class="notification green">4</span> -->
    </a>

    <!-- <a data-rel="tooltip" class="well span3 top-block" href="#" data-original-title="3 New C-card Order">
     <span class="icon32 icon-color icon-cart"></span>
     <div>Client Credit Card Order</div>
     <div>150</div>
     <span class="notification yellow">3</span>
    </a> -->
    
    <a data-rel="tooltip" class="well span3 top-block" href="#" data-original-title="12 new messages.">
     <span class="icon32 icon-color icon-envelope-closed"></span>
     <div>Messages</div>
    <div>0</div> 
     <!-- <span class="notification red">0</span> -->
    </a>
   </div>
    <div class="row-fluid ui-sortable">
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2>Activity</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <ul class="dashboard-list">
                        <li>
                            <strong>Name:</strong> <a href="#">David
                            </a><br>
                            Jone add new client 17/05/2015<br>
                            <strong>Status:</strong> <span class="label label-success">Pending</span>
                        </li>
                        <li>
                            <a href="#">Sheikh Heera our new client
                            </a><br>
                            <strong>Status:</strong> <span class="label label-warning">Approved</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Abdullah
                            </a><br>
                            <strong>Since:</strong> 25/05/2012<br>
                            <strong>Status:</strong> <span class="label label-important">Banned</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Saruar Ahmed
                            </a><br>
                            <strong>Since:</strong> 17/05/2012<br>
                            <strong>Status:</strong> <span class="label label-info">Updates</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--/span-->
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2>Payment Details</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <ul class="dashboard-list">
                        <li>
                            <a href="#">Usman all ali mashur khan
                            </a><br>
                            cleared charge of new card for 3 month
                            <strong>Status:</strong> <span class="label label-success">paid</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Sheikh Heera
                            </a><br>
                            not paid till now 17/05/2012<br>
                            <strong>Status:</strong> <span class="label label-warning">Pending</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Abdullah
                            </a><br>
                            <strong>Since:</strong> 25/05/2012<br>
                            <strong>Status:</strong> <span class="label label-important">Banned</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Saruar Ahmed
                            </a><br>
                            <strong>Since:</strong> 17/05/2012<br>
                            <strong>Status:</strong> <span class="label label-info">Updates</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--/span-->
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2>Refereal Activity</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <ul class="dashboard-list">
                        <li>
                            <strong>Name:</strong> <a href="#">Usman all ali mashur khan
                            </a><br>
                            <strong>Card expired:</strong> 17/05/2015<br>

                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Sheikh Heera
                            </a><br>
                            <strong>Since:</strong> 17/05/2012<br>
                            <strong>Status:</strong> <span class="label label-warning">Pending</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Abdullah
                            </a><br>
                            <strong>Since:</strong> 25/05/2012<br>
                            <strong>Status:</strong> <span class="label label-important">Banned</span>
                        </li>
                        <li>
                            <strong>Name:</strong> <a href="#">Saruar Ahmed
                            </a><br>
                            <strong>Since:</strong> 17/05/2012<br>
                            <strong>Status:</strong> <span class="label label-info">Updates</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--/span-->

    </div>

	<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>

<div class="modal hide fade" id="myModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">
			×
		</button>
		<h3>Settings</h3>
	</div>
	<div class="modal-body">
		<p>
			Here settings can be configured...
		</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
		<a href="#" class="btn btn-primary">Save changes</a>
	</div>
</div>
