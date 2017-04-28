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
            Admin Users
        </h1>
    </section>
    <section class="content">
        <p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>user/user/config_add')" class="btn btn-primary btn-lg" style="">Add</button></p>
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Configuration key</th>
                            <th>Configuration value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <?php if(!empty($result)) { ?>
                        <?php foreach ($result as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['conf_key']; ?></td>
                                <td><?php echo $row['conf_value']; ?></td>
                                <td><?php if ($row['status'] == 1) {
                                ?>
                                        <span class="label label-success">Active</span>
                                    <?php } else { ?>
                                        <span class="label label-danger">Inactive</span>
                                    <?php } ?></td>
                                <td>
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="<?php echo base_url(); ?>user/user/config_add/<?php echo $row['id']; ?>">
                                                <span  class="btn btn-success"><i class="fa fa-edit"></i></span>
                                            </a>
                                        </li>
                                    </ul>  
                                </td>
                            </tr>
                            <?php
                        }}else{?>
                            <tr> <td colspan="5"><center>No data found</center></td></tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>