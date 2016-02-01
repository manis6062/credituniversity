<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>s
            <small>list</small>
            <a class="btn btn-link"
               href="<?php echo base_url() . 'administrator/' . $title . '/' . $title . 'Form'; ?>">add a
                <?php echo $title ?></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title ?>s</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover" id="menus">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>title</th>
                                <th>menu type</th>
                                <th>status</th>
                                <th>action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($menus != 0 && count($menus) > 0) {
                                foreach ($menus as $key => $menu) {
                                    ?>
                                    <tr menu="row" class="odd">
                                        <td class="sorting_1">
                                            <button type="button" class="btn-link"
                                                    onclick="updateMenu(<?php echo $menu->id ?>)">
                                                <?php echo $menu->id; ?>
                                            </button>
                                        </td>
                                        <td><a href="" data-type="text" id="menu_name"
                                               data-pk=<?php echo $menu->id; ?>> <?php echo $menu->menu_name; ?> </a>
                                        </td>
                                        <td><a href="" data-type="select" id="menu_type"
                                               data-value="<?php echo $menu->menu_type ?>"
                                               data-source="[ {value: 'top-menu', text: 'TOP MENU'}, {value: 'main-menu', text: 'MAIN MENU'},{value: 'footer-menu', text:'FOOTER MENU'}, {value:'main-menu/footer-menu',text:'MAIN/FOOTER MENU'}, {value:'top-menu/footer-menu', text:'TOP/FOOTER MENU'}]"
                                               data-pk=<?php echo $menu->id; ?>></a>
                                        </td>
                                        <td><a href="" data-type="select" id="status"
                                               data-value="<?php echo $menu->status ?>"
                                               data-source="[ {value: 'inactive', text: 'Inactive'}, {value: 'active', text: 'Active'}]"
                                               data-pk=<?php echo $menu->id; ?>></a>
                                        </td>
                                        <td>
                                            <submit type="text"
                                                    onclick="deleteMenu(<?php echo $menu->id ?>)">
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
    $('#menus').DataTable({
        iDisplayLength: 100
    });
    $.fn.editable.defaults.mode = 'inline';
    $('#menus a').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'menu';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    function deleteMenu(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'menu/deleteMenu');?>' + '/' + id;
        window.location.href = location;
    }
    function updateMenu(id) {
        var location = '<?php echo base_url(ADMIN_PATH.'menu/menu');?>' + '/' + id;
        window.location.href = location;
    }
</script>








