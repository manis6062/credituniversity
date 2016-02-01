<div class="content-wrapper">


    <div class="box-header">
        <div class="dropdown">

            <a  href="#" data-toggle="dropdown" class="dropdown-toggle btn-sm btn-primary">Add Pdf's  </i><i class="glyphicon glyphicon-file"></i></a>

            <ul  class="dropdown-menu">

                <li><a class="btn btn-link" href="<?php echo base_url() . 'administrator/content/monthlyTipsForm'; ?>">Add Monthly Tip</a></li>

                <li><a class="btn btn-link" href="<?php echo base_url() . 'administrator/content/pdfForm'; ?>">Add Pdf Books</a></li>

            </ul>

        </div>
    </div>

    <section class="content-header">
        <h1>
            <?php echo ucfirst($title); ?>
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-striped" id="content">
                    <thead>
                    <tr role="row">
                        <th>Id</th>
                        <th>Name</th>
                        <th>File</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($contents != 0 && count($contents) > 0) {
                        foreach ($contents as $key => $content) {
                            ?>
                            <tr role="row" class="odd">
                                <td><?php echo anchor(base_url(ADMIN_PATH . 'content/content/' . $content->id), $content->id, array('id' => 'id')) ?></td>
                                <td>
                                    <button type="button" class="btn-link"
                                            onclick="updateContent(<?php echo $content->id ?>)">
                                        <?php echo $content->name; ?>
                                    </button>
                                <td><a href="<?php echo base_url() . 'uploads/pdf/' . $content->file ?>" target="_blank" id="file"><i class="fa fa-file-pdf-o fa-lg"></i> </a></td>
                                <td>
                                    <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/content/updatePdf'; ?>" method="post" id="content">
                                        <input hidden="hidden" id="old_file_id" name="old_file_id" value="<?php echo $content->id ?>">
                                        <input hidden="hidden" id="old_file_name" name="old_file_name" value="<?php echo $content->file ?>">
                                        <input type="file" onchange="this.form.submit()" name="file" id="file" style="float-left">
                                    </form>
                                </td>
                                <td>
                                    <a href="#" id="delete" name="delete"
                                       onclick="deleteContent('<?php echo $content->id ?>' , '<?php echo $content->file ?>')">
                                        <i class="btn btn-danger fa fa-trash"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php }
                    } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
</div>
<script>
    $('#content').dataTable();
    $('#content a:not(#id, #file, #delete)').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            var table = $(this).attr("table");
            params.table = table;
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteContent(id, name) {
        var location = '<?php echo base_url(ADMIN_PATH.'content/deletePdfBooks');?>' + '/' + id + +'/' + name;
        window.location.href = location;
    }

</script>







