<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title;?>s
            <small>list</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/'.$title.'/'.$title.'Form'; ?>">add a
                <?php echo $title?></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title?>s</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="socials">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>icon title</th>
                                <th>url</th>
                                <th>action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($socials != 0 && count($socials) > 0) {
                                foreach ($socials as $key => $social) {
                                    ?>
                                    <tr social="row" class="odd">
                                        <td class="sorting_1"><?php echo $social->id; ?></td>
                                        <td><a href="" data-type="text" id="social_title"
                                               data-pk=<?php echo $social->id; ?>> <?php echo $social->social_title; ?> </a></td>
                                        <td><a href="" data-type="text" id="social_link"
                                               data-pk=<?php echo $social->id; ?>> <?php echo $social->social_link; ?> </a></td>
                                        <td>
                                            <submit type="text"
                                                    onclick="deleteSocial(<?php echo $social->id ?>)">
                                                <i class="btn btn-danger fa fa-trash"></i>
                                            </submit>
                                        </td>

                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    $('#socials').DataTable();
    $.fn.editable.defaults.mode = 'inline';
    $('#socials a').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'social';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteSocial(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'social/deleteSocial');?>' + '/' + id;
        window.location.href = location;
    }
</script>








