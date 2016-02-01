
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Clients
            <small>list</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/client/clientForm'; ?>">Add Client</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title;?></li>
        </ol>
    </section>


    <section class="content">
        <div class="box">
            <div class="box-header">
                <strong><?php echo $title?></strong>
            </div>
            <div class="box-body">
                <table id="users" class="table table-bordered table-striped">
                    <thead>
                    <tr role="row">
                        <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 180px;" aria-label="Rendering engine: activate to sort column ascending"
                            aria-sort="descending">User Id
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 229px;" aria-label="Browser: activate to sort column ascending">Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 194px;" aria-label="Platform(s): activate to sort column ascending">Email
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 154px;" aria-label="Engine version: activate to sort column ascending">Action
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            style="width: 111px;" aria-label="CSS grade: activate to sort column ascending">Status
                        </th>

                    </tr>
                    </thead>

                    <?php
                    if ($clients != 0 && count($clients) > 0) {
                        foreach ($clients as $key => $client) {
                            ?>
                            <tbody>
                            <tr role="row" class="odd">
                                <td><?php echo anchor(base_url(ADMIN_PATH . 'user/user/'.$client->id), $client->id, array('id' => 'userId')) ?></td>

                                <td>
                                    <button type="button" class="btn-link"
                                            onclick="updateUser(<?php echo $client->id ?>)">
                                        <?php echo $client->first_name . ' ' . $client->middle_initial . ' ' . $client->last_name ?>
                                    </button>
                                <td><?php echo $client->email; ?></td>
                                <td>
                                    <submit type="text"
                                            onclick="deleteUser(<?php echo $client->id ?>)">
                                        <i class="btn btn-danger fa fa-trash"></i>
                                    </submit>
                                </td>
                                <td><a href="" data-type="select" id="status" table="user"
                                       data-pk="<?php echo $client->id ?>"
                                       data-value="<?php echo $client->status ?>"
                                       data-source="[ {value: 0, text: 'inactive'}, {value: 1, text: 'active'}]"
                                       data-pk=<?php echo $client->status; ?>></a>
                                </td>

                            </tr>
                            </tbody>
                        <?php }
                    } ?>


                </table>
            </div>
        </div>
    </section>

    <script>
        $('#users').DataTable();
        $('#users a:not(#userId)').editable({
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
        function deleteUser(id) {
            var location = '<?php echo base_url(ADMIN_PATH.'user/deleteUser');?>' + '/' + id;
            window.location.href = location;
        }
        function updateUser(id) {
            var location = '<?php echo base_url(ADMIN_PATH.'user/user/');?>' + '/' + id;
            window.location.href = location;
        }
    </script>

</div>
