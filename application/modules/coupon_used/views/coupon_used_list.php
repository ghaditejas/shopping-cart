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
            Coupons Used
        </h1>
    </section>
    <section class="content">
        <!--<p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>config/config/config_add')" class="btn btn-primary btn-lg" style="">Add</button></p>-->
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="coupon_used_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Order Id</th>
                            <th>Coupon Code</th>
                            <th>Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        $("#coupon_used_table").DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": false,
            "ordering": false,
            "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
            "lengthChange": true,
            "ajax": "<?php echo base_url(); ?>coupon_used/coupon_used/get_data",
        });
    });
</script>