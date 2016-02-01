<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> <?php echo $title; ?></h2>
            </div>



            <div class="box-content">
                <?php
                if($this->session->flashdata('su_message'))
                { ?>
                    <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div>
                <?php } ?>

                <!-- <?php if (($this->session->userdata('ADMIN_AUTH_ROLE')==4) && ($this->session->userdata('ADMIN_AUTH_ROLE')==5)){ ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/addCard/'.$to_id.'/'.$to_name); ?>" class="btn btn-primary">Add New Card</a>
                        <?php } ?> -->
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lines Owner<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"> </th>
                        <th>Auth User<img src="<?php echo base_url();?>/style/img/sort.png"></th>

                        <th>Card Type<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"> </th>
                        <th>Card Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"> </th>
                        <th>Issued Bank<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>Credit Limit<?php echo '&nbsp;&nbsp;';?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>Credit Changed Date<?php echo '&nbsp;&nbsp;';?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>AU Added<img src="<?php echo base_url();?>/style/img/sort.png"></th>
                        <th>AU Pending<img src="<?php echo base_url();?>/style/img/sort.png"></th>
                        <th>Member Since<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>Closing<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>Bal<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>%<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>Cost<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                        <th>Note<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>



                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if( $cardList !=0 && count($cardList) > 0)
                    {
                        $count=1;
                        foreach($cardList as  $values)
                        {
                            ?>
                            <tr class="item">
                                <td><?php echo $count;?></td>
                                <td><a href="<?php echo site_url(ADMIN_PATH . 'lineowner/creditcard_update/'  .$values->to_id. '/'. $values -> card_id.'/'.$values->to_fname.'_'.$values->to_lname); ?>" title="Click to edit"> <?php echo $values -> to_fname.' '.$values->to_lname;?></a></td>
                                <td><a title="Add Client To The Card" href="<?php echo base_url().'administrator/creditcard/creditCardClients/'.$values->to_id. '/'. $values -> card_id.'/'.$values->to_fname.'_'.$values->to_lname;?>"><?php echo ($values -> card_sell_com + $values->card_sell_pro ); ?></a></td>
                                <td><a href="<?php echo site_url(ADMIN_PATH . 'lineowner/creditcard_update/' .$values->to_id. '/'. $values -> card_id.'/'.$values->to_fname.'_'.$values->to_lname); ?>" title="Click to edit"> <?php echo $values -> card_name;?></a></td>
                                <td><a href="<?php echo site_url(ADMIN_PATH . 'lineowner/creditcard_update/'  .$values->to_id. '/'. $values -> card_id.'/'.$values->to_fname.'_'.$values->to_lname); ?>" title="Click to edit"> <?php echo $values -> type_id;?></a></td>
                                <td><a href="<?php if($values->bank_url!='') {echo $values->bank_url;} ?>" target="_blank" title="Click to view bank website"> <?php echo $values -> card_bank_name;?></a></td>
                                <td><?php echo '$'. "&nbsp" . (number_format($values -> card_limit));?></td>
                                <td><?php echo $values -> credit_limit_date;?></td>
                                <td><?php echo $values->card_sell_com;?> </td>
                                <td><?php echo $values->card_sell_pro; ?>  </td>
                                <td><?php echo $values -> card_open_date;?></td>
                                <td><?php if($values -> card_close_date!=0) echo $values -> card_close_date;?></td>
                                <td>$ <?php echo number_format($values->card_balance)?></td>
                                <td><?php if($values->card_limit!=0){ echo ceil((($values -> card_balance * 100)/$values->card_limit)).'%';}else{echo '0%';}?> </td>
                                <td>$ <?php  echo number_format($values -> card_cost);?>
                                </td>
                                <td><a href="#"><i class="icon-edit"></i></a><?php echo $values -> card_note;?></td>


                            </tr>
                            <?php
                            $count++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
</div>
</div>
<hr>

