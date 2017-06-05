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
           User Queries
        </h1>
    </section>
    <section class="content">
        <p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>user/user/user_add')" class="btn btn-primary btn-lg" style="">Add</button></p>
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
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
<script>
$(document).ready(function () {
        $("#user_table").DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": true,
            "ordering": true,
            "columnDefs": [ { orderable: false, targets: [0,1,2,3,4,6] }],
            "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
            "lengthChange": true,
            "ajax": "<?php echo base_url(); ?>user_queries/user_queries/get_data",
        });
    });
</script>


