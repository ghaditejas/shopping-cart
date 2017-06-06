<div class="content-wrapper">
    <?php
    $success = "";
    $success = $this->session->flashdata('success');
    if (!empty($success)) {
        ?>
        <div class="alert alert-adminLTE alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $success; ?></strong> 
        </div>
    <?php } ?>
    <section class="content-header">
        <h1>
            CMS
        </h1>
    </section>
    <section class="content">
        <p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>cms/cms/update')" class="btn btn-primary btn-lg" style="">Add</button>
            <button type="button"  onclick="javascript: del()" class="btn btn-danger btn-lg" style="">Delete</button></p>
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="coupon_table">
                    <thead>
                        <tr>
                            <th><label><input class="checkbox uncheck" id="checkall" type="checkbox"></label></th>
                            <th>ID</th>
                            <th>Title</th>
<!--                            <th>Percent</th>
                            <th>No. of uses</th>-->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>public/dist/js/checkall.js"></script>
<script>
    function del() {
        var arr = [];
        $('input.checkbox_check:checkbox:checked').each(function () {
            arr.push($(this).val());
        });
        if (arr.length == 0) {
            alert("Please check the banner you want to delete");
        } else {
            var r = confirm("Are you sure you want to delete");
            console.log(arr);
            if (r)
                $.ajax({
                    url: '<?php echo base_url(); ?>/cms/cms/delete',
                    data: {id: arr},
                    type: 'post',
                    success: function (output) {
                        if (output == 1) {
                            alert("Deleted successfully");
                            location.reload();
                        }

                    }
                });
        }
    }
    function delete_cms(id) {
        var arr = [];
        arr.push(id);
        var r = confirm("Are you sure you want to delete");
        console.log(arr);
        if (r)
            $.ajax({
                url: '<?php echo base_url(); ?>/cms/cms/delete',
                data: {id: arr},
                type: 'post',
                success: function (output) {
                    if (output == 1) {
                        alert("Deleted successfully");
                        location.reload();
                    }

                }
            });
    }
    $(document).ready(function () {
        $("#coupon_table").DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": true,
            "ordering": false,
            "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
            "lengthChange": true,
            "ajax": "<?php echo base_url(); ?>cms/cms/get_data",
        });
    });
</script>
