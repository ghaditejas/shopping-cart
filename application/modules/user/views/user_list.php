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
        <p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>user/user/user_add')" class="btn btn-primary btn-lg" style="">Add</button></p>
        <div class="box box-primary">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php // foreach ($result as $row) {
                        ?>
<!--                            <tr>
                             <td><?php // echo $row['user_id'];                  ?></td>
                             <td><?php // echo $row['firstname'];                  ?></td>
                             <td><?php // echo $row['lastname'];                  ?></td>
                             <td><?php // echo $row['email'];                  ?></td>
                             <td><?php // echo $row['role'];                  ?></td>
                             <td><?php // if ($row['status'] == 1) {
                        ?>
                                     <span class="label label-success">Active</span>
                        <?php // } else { ?>
                                     <span class="label label-danger">Inactive</span>
                        <?php // } ?></td>
                             <td>
                                 <ul class="nav navbar-nav">
                                     <li>
                                         <a href="<?php echo base_url(); ?>user/user/user_add/<?php echo $row['user_id']; ?>" style="padding:0px">
                                             <span  class="btn btn-success"><i class="fa fa-edit"></i></span>
                                         </a>
                                     </li>
                                 </ul>  
                             </td>
                         </tr>-->
                        <?php
//                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script>
    var promise = function () {
        var tmp = null;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'html',
            'url': "<?php echo base_url(); ?>user/user/get_data",
            'data': {'request': "", 'target': 'arrange_url', 'method': 'method_target'},
            'success': function (data) {
                tmp = data;
            }
        });
        return tmp;
    }();
    var data = JSON.parse(promise);
    $(document).ready(function () {
        $("#user_table").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "data": data,
            "columns": [
                {"data": "user_id"},
                {"data": "firstname"},
                {"data": "lastname"},
                {"data": "email"},
                {"data": "role"},
                {"data": "status"},
                {"data": "none",
                    "defaultContent": "<a href=''><span  class='btn btn-success edit'><i class='fa fa-edit'></i></span></a>",
                    "targets": -1
                }
            ]
        });
        $(".edit").click(function () {
//            var Row = document.getElementById("somerow");
//            var Cells = Row.getElementsByTagName("td");
//            alert(Cells[0].innerText);
            var pr = $(this).closest(".sorting_1").text();
            console.log(pr);
        });
    });


</script>
<?php
// echo base_url(); user/user/user_add/' style='padding:0px?>