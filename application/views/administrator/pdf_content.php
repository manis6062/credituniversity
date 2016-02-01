<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title); ?>
            <?php if ($role == BROKER or $role == SUPER_ADMIN or $role == ADMIN): ?>
                <a class="btn btn-link" href="<?php echo base_url() . 'administrator/content/contentPdfForm'; ?>">Create
                    New</a>
            <?php endif ?>
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
                        <th>Short Title</th>
                        <th>Title</th>
                        <th>Content Type</th>
                        <th>Sub Type</th>
                        <th>Description</th>
                        <th>Publish Date</th>
                        <th>File</th>
                        <?php if ($role == BROKER or $role == SUPER_ADMIN or $role == ADMIN): ?>
                            <th>Edit</th>
                            <th>Delete</th>
                        <?php endif ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($contents != 0 && count($contents) > 0) {
                        foreach ($contents as $key => $content) {
                            ?>
                            <tr role="row" class="odd">
                                <td><?php echo $content->id ?></td>
                                <td><a href="#" name="short_name" id="short_name" data-type="text" class="short_name"
                                       data-pk="<?php echo $content->id ?>"
                                       table="files"><?php echo $content->short_name; ?></a></td>
                                <td><a href="#" name="name" id="name" data-type="text"
                                       data-pk="<?php echo $content->id ?>"
                                       table="files"><?php echo $content->name; ?></a></td>

                                <td><a href="#" name="module" id="module" data-type="select"
                                       data-value="<?php echo $content->module ?>" table="files"
                                       data-pk="<?php echo $content->id ?>"
                                       data-source="[ {value: 'pdf', text: 'PDF'}, {value: 'fund', text: 'Funding'}, {value: 'monthly_tips', text: 'Monthly Tips'},{value: 'what_are_tradelines', text: 'What are Tradelines'},{value: 'tradeline_benefits', text: 'Tradeline Benefits'}]"><?php
                                        switch ($content->module) {
                                            case "monthly_tips":
                                                echo "Monthly Tips";
                                                break;
                                            case "fund":
                                                echo "Funding";
                                                break;
                                            case "pdf":
                                                echo "PDF";
                                                break;
                                            case "what_are_tradelines":
                                                echo "What are Tradelines?";
                                                break;
                                            case "tradeline_benefits":
                                                echo "Tradeline Benefits";
                                                break;
                                        } ?></a></td>
                                <td>
                                    <?php if ($content->module != 'pdf') { ?>
                                        <a href="#" name="sub_module" id="sub_module" data-type="select"
                                           data-value="<?php echo $content->sub_module ?>" table="files"
                                           data-pk='<?php echo $content->id ?>'
                                           data-source="[ {value: 'cpn', text: 'CPN'}, {value: 'financial', text: 'Financial'}, {value: 'real_estate', text: 'Real Estate'}, {value: 'credit_repair', text: 'Credit Repair'}, {value: 'business_credit', text: 'Business Credit'} ]"><?php
                                            switch ($content->sub_module) {
                                                case "cpn":
                                                    echo "CPN";
                                                    break;
                                                case "financial":
                                                    echo "Financial";
                                                    break;
                                                case "real_estate":
                                                    echo "Real Estate";
                                                    break;
                                                case "credit_repair":
                                                    echo "Credit Repair";
                                                    break;
                                                case "business_credit":
                                                    echo "Business Credit";
                                                    break;
                                            }
                                            ?></a>
                                    <?php } else { ?>
                                        <a href="#" name="sub_type" id="sub_type" data-type="select"
                                           data-value="<?php echo $content->sub_type ?>" table="files"
                                           data-pk='<?php echo $content->id ?>'
                                           data-source="[ {value: 'client', text: 'Client'}, {value: 'owner', text: 'Owner'}, {value: 'broker', text: 'Broker'} ]"></a>

                                    <?php } ?>
                                </td>
                                <td><a href="#" data-toggle="popover" title="Description" data-content="<?php echo $content->description ; ?>"><?php
                                        echo substr($content->description, 0, 10); ?></a>
                                    <a style="padding-left: 5px;" href="#" name="description" id="description" data-type="textarea" table="files" data-content="Description"
                                       data-pk="<?php echo $content->id ?>"> <i class="glyphicon glyphicon-pencil"><span id = 'pencil' hidden="hidden"><?php echo $content->description ; ?>  </span></i></a>
                                </td>
                                <script>
                                    $(document).ready(function(){
                                        $('[data-toggle="popover"]').popover({ html : true });
                                    });
                                </script>
                                <?php if ($content->module == "monthly_tips") { ?>
                                    <td><a href="#" name="value" id="value" data-type="date" table="files"
                                           data-pk="<?php echo $content->id ?>"><?php echo $content->value ?></a></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                                <td><a href="<?php echo base_url() . 'uploads/pdf_content/' . $content->file ?>"
                                       target="_blank" id="file"><i class="fa fa-file-pdf-o fa-lg"></i> </a></td>
                                <td>
                                    <?php if ($role == BROKER or $role == SUPER_ADMIN or $role == ADMIN): ?>
                                        <form enctype="multipart/form-data"
                                              action="<?php echo base_url() . 'administrator/content/editMonthlyTips'; ?>"
                                              method="post" id="content">
                                            <input hidden="hidden" id="old_file_id" name="old_file_id"
                                                   value="<?php echo $content->id ?>">
                                            <input hidden="hidden" id="old_file_name" name="old_file_name"
                                                   value="<?php echo $content->file ?>">
                                            <input type="file" onchange="this.form.submit()" name="file" id="file"
                                                   style="float-left">
                                        </form>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($role == BROKER or $role == SUPER_ADMIN or $role == ADMIN): ?>
                                        <a href="#" id="delete" name="delete"
                                           onclick="return confirm('Are you sure you want to delete?')? deleteContent('<?php echo $content->id ?>','<?php echo $content->file ?>'): '';">
                                            <i class="btn btn-danger fa fa-trash"></i>
                                        </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
</div>
<script>
    $('#content').dataTable({
        "order": [
            [2, "desc"]
        ],
        iDisplayLength: 100
    });


    $(document).on("focus", ".short_name", function () {
        $(this).mask("AAAAAAAAAA");
    });


    $('#content* a:not(#id, #file, #delete )').editable({
        placement: 'right',
        tpl: '<input type="text" class="short_name"   style="padding-right: 24px;">',
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
        var location = '<?php echo base_url(ADMIN_PATH.'content/deleteMonthlyTips');?>' + '/' + id + +'/' + name;
        window.location.href = location;
    }

    $(document).ready(function () {
        $('#select li').on('click', function () {
            var sentData = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'administrator/content/pdfContents' ; ?>" + '/' + sentData,
                data: "sentData=" + sentData,
                dataType: "html",
                success: function (data) {
                    var result = $('<div />').append(data).find('.content').html();
                    $('.content').html(result);
                    $('#content').dataTable();

                }
            });
        });
    });

</script>















