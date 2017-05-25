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
            Configuration
        </h1>
    </section>
    <section class="content">
        <!--<p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>config/config/config_add')" class="btn btn-primary btn-lg" style="">Add</button></p>-->
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="config_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Configuration key</th>
                            <th>Configuration value</th>
                            <th>Status</th>
                            <th>Actions</th>
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
        $("#config_table").DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": true,
            "ordering": false,
            "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
            "lengthChange": true,
            "ajax": "<?php echo base_url(); ?>config/config/get_data",
        });
    });
</script>