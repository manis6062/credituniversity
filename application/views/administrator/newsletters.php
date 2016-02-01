<div class="content-wrapper bg-main transbox">
    <section class="content-header">
        <h1>
            NewsLetter Templates
               </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Newsletter Templates</li>
        </ol>
    </section>
    <section class="content">
        <ul class="nav nav-tabs">
                        <li style="background: lightgray;" class="active"><a href="#general"  data-toggle="tab">General</a></li>
                        <li style="background: lightgray;" ><a href="#welcome"  data-toggle="tab">Welcome Letter</a></li>
      </ul>
        <div id="row">
           
                <div class="box box-primary">
                    <div class="box-body">
                           <div class="tab-content" id="main_content">
                        <div class="active tab-pane" id="general">

                          <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/newsletterForm'; ?>">Add Newsletter Template</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/sendNewsletterForm'; ?>">Send Newsletter</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/sentNewsletters'; ?>">Sent Newsletters</a>
    
                        <table class="table table-bordered table-striped" id="templates">
                            <thead>
                            <tr>
                                <th>Template Id</th>
                                <th>Newsletter Title</th>
                                <th>Campaign</th>
                                <th>Campaign Type</th>
                                <th style="text-align: center">Preview</th>
                                <th style="text-align: center">Send</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($templates)) {
                                foreach ($templates as $template) { ?>
                                    <tr class="item">
                                        <td><?php echo $template->id; ?></a></td>
                                        <td><a href="#" data-type="text" data-pk="<?php echo $template->id ?>" name="title" id="title"><?php echo $template->title ?></a></td>
                                        <td><a href="#" data-type="select" data-pk="<?php echo $template->id ?>" name="campaign_id" id="campaign_id" data-source="<?php echo $campaigns ?>" data-value="<?php echo $template->campaign_id ?>"><?php echo $template->campaign_name ?></a></td>
                                        <td><?php echo $template->campaign_type ?></td>
                                        <td align="center" class="tiptext"><a href="<?php echo base_url('administrator/newsletter/view') . '/' . $template->id ?>" target="_blank"><i class="fa fa-laptop"></i>
                                                <iframe class="description" src="<?php echo base_url('administrator/newsletter/view') . '/' . $template->id ?>"></iframe>
                                            </a>
                                        </td>
                                        <td><a href="<?php echo base_url() . 'administrator/newsletter/sendNewsletterForm/' . $template->id; ?>"><i class="fa fa-paper-plane"></i></a></td>
                                        <td><a href="<?php echo base_url('administrator/newsletter/edit') . '/' . $template->id ?>"><i class="fa fa-edit"></i></a></td>
                                        <td><a class="" href="<?php echo 'newsletter/deleteTemplate' . '/' . $template->id ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                                    </tr>
                                <?php }
                            } ?>

                            </tbody>
                        </table>
             </div>


                          <div class=" tab-pane" id="welcome">
                              <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter/welcomeletterForm'; ?>">Add Welcome Letters</a>
                        <table class="table table-bordered table-striped" id="letter">
                            <thead>
                            <tr>
                                <th>Template Id</th>
                                <th>Slug</th>
                                <th>Welcome Letter Title</th>
                               
                                 <th style="text-align: center">Preview</th>
                              <!--  <th style="text-align: center">Preview</th>-->
                                
                                <th>Edit</th>
                                
                            </tr>+
                            </thead>
                            <tbody>
                            <?php if (!empty($WelcomeLetters)) {
                                foreach ($WelcomeLetters as $template) { ?>
                                    <tr class="item">
                                        <td><?php echo $template->id; ?></a></td>
                                        <td><?php echo $template->short_code; ?></a></td>
                                        <td><a href="#" data-type="text" data-pk="<?php echo $template->id ?>" name="title" id="title"><?php echo $template->title ?></a></td>
                                       
                                       <td align="center" class="tiptext"><a href="<?php echo base_url('administrator/newsletter/view') . '/' . $template->id ?>" target="_blank"><i class="fa fa-laptop"></i>
                                                <iframe class="description" src="<?php echo base_url('administrator/newsletter/view') . '/' . $template->id ?>"></iframe>
                                            </a>
                                        </td><!--
                                        <td><a href="<?php echo base_url() . 'administrator/newsletter/' . $template->id; ?>"><input type="radio" name="status"></a></td>
                                        <td><a href="<?php echo base_url('administrator/newsletter/editWelcomeLetter') .    '/' . $template->id ?>"><i class="fa fa-edit"></i></a></td>
                                        <td><a class="" href="<?php echo 'newsletter/deleteWelcomeLetter' . '/' . $template->id ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                                   --> 
                                     <td><a href="<?php echo base_url('administrator/newsletter/editWelcomeLetter') .    '/' . $template->id ?>"><i class="fa fa-edit"></i></a></td>
                                   </tr>
                                <?php }
                            } ?>

                            </tbody>
                        </table>
                         </div>
                </div>
                    </div>
                </div>
          
        </div>
    </section>
</div>

<script type="text/javascript">

    $('#title*, #campaign_id*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'newsletter_template';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;

            } else {
                window.location.reload();
            }
        }
    });

    $('#templates').dataTable();
    $('#letter').dataTable();
    $('.selectpicker').select2();

    $(".tiptext").mouseover(function () {
        $(this).find('a').children(".description").show();
    }).mouseout(function () {
        $(this).find('a').children(".description").hide();
    });

</script>
