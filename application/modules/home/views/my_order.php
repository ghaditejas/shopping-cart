<section id="slider"><!--slider-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>home/my_account/view">My Account</a></li>
                <li class="active">My Order</li>
            </ol>
        </div>
        <div class="row" style="align-content:center">
            <?php $this->load->view('my_account_sidebar'); ?>
            <div class="col-sm-8" style="align-content:center">	
                <?php
                $success = "";
                $success = $this->session->flashdata('success');
                if (!empty($success)) {
                    ?><div class="alert alert-adminLTE alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong><?php echo $success; ?></strong> 
                    </div>
                <?php } ?>
                <h2>Address</h2>
                <p align="right"><button type="button" class="btn btn-info btn-lg" id="btn" onclick="javascript: window.location.assign('<?php echo base_url(); ?>home/my_account/track_order')">Track Order</button></p>
                <div class="box box-primary">
                    <div class="box-body table-responsive no-padding" >
                        <table class="table table-bordered table-striped" id="address_table">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Total</th>
                                    <th>View Order</th>
<!--                                    <th>State</th>
                                    <th>Country</th>
                                    <th>ZipCode</th>
                                    <th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("#address_table").DataTable({
            "paging": false,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": true,
            "ordering": true,
            "columnDefs": [ { orderable: false, targets: [0,2,3,4] }],
            "ajax": "<?php echo base_url(); ?>home/my_account/get_orders",
        });
    });
</script>
