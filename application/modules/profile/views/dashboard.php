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
            Dashboard
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $orders;?></h3>

                        <p>Total No. of Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $currency;?>
                        <?php echo $sale;?></h3>
                        <p>Totsl Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $users;?></h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $products;?></h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="box box-primary">
            <h2>Recent Orders</h2>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="order_table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Date</th>
                            <th>Grand Total</th>
                            <th>Discount</th>
                            <th>Payable Amount</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box box-primary">
             <h2>Recent User Queries</h2>
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-striped" id="contact_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box box-primary">
            <h2>Recent Registered Users</h2>
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Id</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal" style='display:none'>

    </div>
</div>
<script src="<?php echo base_url(); ?>public/dist/js/checkall.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#order_table1").DataTable({
            "paging": false,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "info": false,
            "searching": false,
            "ordering": false,
            "ajax": "<?php echo base_url(); ?>profile/dashboard/get_order",
        });
        $("#contact_table").DataTable({
            "paging": false,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "info": false,
            "searching": false,
            "ordering": false,
            "ajax": "<?php echo base_url(); ?>profile/dashboard/get_contact",
        });
        $("#user_table").DataTable({
            "paging": false,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "info": false,
            "searching": false,
            "ordering": false,
            "ajax": "<?php echo base_url(); ?>profile/dashboard/get_user",
        });

    });
</script>
