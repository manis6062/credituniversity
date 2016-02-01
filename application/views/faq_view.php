<style type="text/css">
	.top-legal{
		background: url(<?php echo base_url();?>frontend/images/sub_head.jpg) center top;
	}
</style>
<section id="legal">
<div class="top-legal">
<div class="center"><h1><?php echo $title;?></h1></div>
</div>
	<div class="container">
    	<div class="row">
     		<div class="bs-example">
     			<h2><?php echo $title;?></h2>
			    <div class="panel-group" id="accordion">
			    	<?php if(!empty($faq)){
			    		$i = 1;
			    		foreach ($faq as $key => $value) {
			    			if($i==1){?>
			    				<div class="panel panel-default">
						            <div class="panel-heading">
						                <h4 class="panel-title">
						                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>"><?php echo $value->faq_question;?></a>
						                </h4>
						            </div>
						            <div id="collapse<?php echo $i;?>">
						                <div class="panel-body">
						                    <?php echo $value->faq_answer;?>
						                </div>
						            </div>
						        </div>
			    			<?php }else{?>
			    				<div class="panel panel-default">
						            <div class="panel-heading">
						                <h4 class="panel-title">
						                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>"><?php echo $value->faq_question;?></a>
						                </h4>
						            </div>
						            <div id="collapse<?php echo $i;?>">
						                <div class="panel-body">
						                    <?php echo $value->faq_answer;?>
						                </div>
						            </div>
						        </div>
			    	<?php 		
							}		$i++;		
						}
			    	}?>
			    </div>
			</div>
    	</div>
	</div>
</section>
</div>
<hr>