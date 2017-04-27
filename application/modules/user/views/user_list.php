<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Userlists goes here
        </h1>
    </section>
    <section class="content">
        <p align="right"><button type="button" class="btn btn-primary btn-lg" style="">Add</button></p>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Id</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['role_id']; ?></td>
                            <td><?php if ($row['status'] == 1) {
                            ?>
                                    <span class="label label-success">Active</span>
                            <?php } else { ?>
                                    <span class="label label-danger">Inactive</span>
                            <?php } ?></td>
                                <td>
                                    <ul class="nav navbar-nav">
                                        <li><span  class="btn btn-success"><i class="fa fa-edit"></i></span></li>
                                        <li><span  class="btn btn-danger"><i class="fa fa-remove"></i></span></li>
                                    </ul>  
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

