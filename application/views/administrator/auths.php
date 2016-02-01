<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            auths
            <small>list</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/auth/authForm'; ?>">add an
                auth</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">auths</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="auths">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>value</th>
                                <th>label</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($data != 0 && count($data) > 0) {
                                foreach ($data as $key => $auth) {
                                    ?>
                                    <tr>
                                        <td class="sorting_1"><?php echo $auth->id; ?></td>
                                        <td><a href="" data-type="text" id="name"
                                               data-pk=<?php echo $auth->id; ?>> <?php echo $auth->name; ?> </a></td>
                                        <td><a href="" data-type="text" id="label"
                                               data-pk=<?php echo $auth->id; ?>> <?php echo $auth->label; ?> </a></td>
                                        <td>
                                            <submit type="text"
                                                    onclick="deleteAuth(<?php echo $auth->id ?>)">
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
    $('#auths').DataTable({
        "pageLength": 100,
        "order": [[2, "asc"]]
    });
    $.fn.editable.defaults.mode = 'inline';
    $('#auths a').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'auth';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteAuth(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'auth/deleteAuth');?>' + '/' + id;
        window.location.href = location;
    }
</script>








