
<div class="content-wrapper bg-main">


    <section class="content-header">
        <h1>
            <?php echo $title;?>
            <small><?php echo ucfirst($action);?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/'.$title; ?>"><?php echo ucfirst($title);?>s</a></li>
            <li class="active"><?php echo $action;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/menu/addMenu'; ?>" method="post"
                  id="menu">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'menu_name', 'name' => 'menu_name','width' => '40'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-4">

                                        <?php
                                        echo form_label('Menu Type:');
                                        $data = array(
                                            'top-menu' => 'Top Menu',
                                            'main-menu' => 'Main Menu',
                                            'footer-menu' => 'Footer Menu',
                                            'main-menu/footer-menu'=> 'Main/Footer Menu',
                                            'top-menu/footer-menu' => 'Top/Footer Menu'
                                        );
                                        echo form_dropdown('menu_type', $data, 'main-menu', array('id' => 'menu_type', 'class' => 'form-control select2'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-4">
                                       <?php echo form_label('Content');?>
                                        <select name="content" id="content" class="form-control select2">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($contents as $value) {
                                                ?>
                                                <option value="<?php echo $value->content_id;?>"><?php echo $value->content_title;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php echo form_label('Module');?>
                                        <select name="module"  id="module" class="form-control select2">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($modules as $value) {
                                                ?>
                                                <option value="<?php echo $value->id;?>"><?php echo $value->module_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php
                                        echo form_label('Status:');
                                        $data = array(
                                            ''=> 'Select',
                                            'active' => 'Active',
                                            'inactive' => 'Inactive',

                                        );
                                        echo form_dropdown('status', $data, '', array('id' => 'status', 'class' => 'form-control select2'));
                                        ?>
                                    </div>



                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">add</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>




<script>

    $("#menu").bootstrapValidator({
        /*http://www.jqueryscript.net/form/Powerful-Form-Validation-Plugin-For-jQuery-Bootstrap-3.html*/
        message: 'This value is not valid',
        fields: {
            menu_name: {
                validators: {
                    notEmpty: {
                        message: 'The menu title is required and can\'t be empty'
                    }
                }
            },
            menu_type:{
                    validators:{
                        notEmpty:{
                            message: 'The menu type is required and can\'t be empty'
                        }
                    }
            },
            content:{
                validators:{
                    notEmpty:{
                        message: 'The Content is required and can\'t be empty'
                    }
                }
            },
            module:{
                validators:{
                    notEmpty:{
                        message: 'The module is required and can\'t be empty'
                    }
                }
            },
            status:{
                validators:{
                    notEmpty:{
                        message: 'The status is required and can\'t be empty'
                    }
                }
            }
        }
    });

</script>


