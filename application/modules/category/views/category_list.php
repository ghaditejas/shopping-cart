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
            Banners
        </h1>
    </section>
    <section class="content">
        <p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>category/category/add')" class="btn btn-primary btn-lg" style="">Add</button>
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th><label><input class="checkbox uncheck" id="checkall" type="checkbox"></label></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Parent Category</th>
                            <th>Actions</th>
                        </tr>
                        <?php if(!empty($result)) { ?>
                        <?php foreach ($result as $row) {
                            ?>
                            <tr>
                                <td><label><input class="checkbox checkbox_check" id="<?php echo $row['category_id']; ?>" type="checkbox" name="cat_ids[]" value="<?php echo $row['category_id'];?>"></label></td>
                                <td><?php echo $row['category_id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php if ($row['status'] == 1) {
                                ?>
                                        <span class="label label-success">Active</span>
                                    <?php } else { ?>
                                        <span class="label label-danger">Inactive</span>
                                    <?php } ?></td>
                                <td><?php echo $row['parent_id']; ?></td>
                                <td>
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="<?php echo base_url(); ?>category/category/add/<?php echo $row['category_id']; ?>" style="padding-top:0px">
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
<script src="http://localhost/shopping-cart/public/dist/js/checkall.js"></script>
<script type="text/javascript">
    function del() {
        var arr = [];
        $('input.checkbox_check:checkbox:checked').each(function () {
            arr.push($(this).val());
        });
        if (arr.length == 0) {
            alert("Please check the category u want to delete");
        } else {
            var r = confirm("Are you sure you want to delete");
            console.log(arr);
            if (r)
                $.ajax({
                    url: 'http://localhost/shopping-cart/category/category/delete',
                    data: {banner_id: arr},
                    type: 'post',
                    success: function (output) {
                        if (output == 1) {
                            alert("Selected category deleted successfully");
                            location.reload();
                        }

                    }
                });
        }
    }
</script>
</script>