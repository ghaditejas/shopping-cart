<?php

if(isset($roless)){
    $role_ids = explode(',',$roless);
}
?> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Users
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fill Your Details</h3>
                    </div>
                    <form id="add_user" class="add_user" action="<?php echo base_url(); ?>/user/user/user_add<?php if(isset($edit_id)){echo "/".$edit_id;}?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>First Name*</label>
                                <input class="form-control" name="firstname" id="fname" placeholder="First Name" type="text" value="<?php if(set_value('firstname')!=""){ echo set_value('firstname'); } else if (isset($firstname)) {
    echo $firstname;
} ?>">
                                <label class="error"><?php echo form_error('firstname'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Last Name*</label>
                                <input class="form-control" name="lastname" id="lname" placeholder="Last Name" type="text" value="<?php if(set_value('lastname')!=""){ echo set_value('lastname'); } elseif (isset($lastname)) {
    echo $lastname;
} ?>">
                                <label class="error"><?php echo form_error('lastname'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input class="form-control" name="email" id="email" placeholder="Email" type="text" value="<?php if(set_value('email')!=""){ echo set_value('email'); } else if (isset($email)) {
    echo $email;
} ?>">
                                <label class="error"><?php echo form_error('email'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Password*</label>
                                <input class="form-control" type="password" name="password" id="pass" placeholder="Password" type="text">
                                <label class="error"><?php echo form_error('password'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password*</label>
                                <input class="form-control" type="password" name="confirm_password" id="cnf_pass" placeholder="Confirm Password" type="text">
                                <label class="error"><?php echo form_error('confirm_password'); ?></label>
                            </div>

                            <!-- radio -->
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input name="status" id="optionsRadios1" value="1" <?php if ($stat == 1) {
    echo'checked=""';
} ?> type="radio">
                                        Active
                                    </label>
                                    <label>
                                        <input name="status" id="optionsRadios2" value="0" type="radio" <?php if ($stat == 0) {
    echo'checked=""';
} ?> >
                                        Inactive
                                    </label>
                                </div>

                            </div>

                            <!-- select -->
                            <div class="form-group">
                                <label>Role*</label>
                                <select class="form-control" name="select_role[]" id="select role" multiple="">
    <?php
    foreach ($role as $row) { ?>
                                            <option value="<?php echo $row['role_id'] ?>" <?php
        if (!empty($role_ids)) {
            
            if (in_array($row['role_id'],$role_ids)) {
                echo 'selected="selected"';
            }
        }
        ?>><?php echo $row['role_name']; ?></option>
    <?php } ?>
                                    </select>
                                    <label class="error"><?php echo form_error('select_role[]'); ?></label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>user/user/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

