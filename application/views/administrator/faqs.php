<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title); ?>s
            <small>list</small>
            <a class="btn btn-link"
               href="<?php echo base_url() . 'administrator/faq/faqForm'; ?>">Add <?php echo ucfirst($title); ?></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?>s</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <strong>Users</strong>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="faq">
                    <thead>
                    <tr role="row">
                        <th></th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($faqs != 0 && count($faqs) > 0) {
                        foreach ($faqs as $key => $faq) {
                            ?>
                            <tr role="row" class="odd" data-position="<?php echo $faq->sequence; ?>">
                                <td><?php echo $faq->sequence; ?></td>
                                <td>
                                    <button type="button" class="btn-link"
                                            onclick="updateFaq(<?php echo $faq->faq_id ?>)">
                                        <?php $question = $faq->faq_question;
                                        $length = strlen($question);
                                        if ($length > 50) $length = 50;
                                        echo substr($question, 0, $length); ?>
                                    </button>
                                </td>

                                <td><?php $answer = $faq->faq_answer;
                                    $length = strlen($answer);
                                    if ($length > 70) $length = 70;
                                    echo substr($answer, 0, $length); ?>
                                </td>

                                <td>
                                    <submit type="text"
                                            onclick="deleteFaq(<?php echo $faq->faq_id ?>)">
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
    </section>
</div>
<script>
    var table = $('#faq').dataTable({
        iDisplayLength: 100,
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('id', 'row-' + dataIndex);
        },
        rowReorder: true
    });

    var jQuery = table.rowReordering({
        sURL: '<?php echo base_url() . 'administrator/faq/reOrder'; ?>'
    });


    $('#faq a:not(#faq_id)').editable({
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
    function deleteFaq(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'faq/deleteFaq');?>' + '/' + id;
        window.location.href = location;
    }
    function updateFaq(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'faq/faq/');?>' + '/' + id;
        window.location.href = location;
    }
</script>







