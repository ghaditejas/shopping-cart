<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Banner
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fill In Details</h3>
                    </div>
                    <form id="add_banner" class="add_user" action="<?php echo base_url(); ?>banner/banner/add<?php
                    if (isset($edit_id)) {
                        echo "/" . $edit_id;
                    }
                    ?>" method="post" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="box-body">

                            <div class="form-group">
                                <label>Banner Image*</label>
                                <input class="form-control" name="banner_img" id="banner_img" type="file">
                                <label><img src='<?php
                                    if (isset($banner_path)) {
                                        echo "../../../upload/" . $banner_path . "' ";
                                        echo 'style="height:120px;width:150px"';
                                    }
                                    ?>' id="image_preview"></label>
                                <label class="error"><?php echo $error_img; ?></label>
                            </div>
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input name="status" id="optionsRadios1" value="1" <?php
                                        if ($stat == 1) {
                                            echo'checked=""';
                                        }
                                        ?> type="radio">
                                        Active
                                    </label>
                                    <label>
                                        <input name="status" id="optionsRadios2" value="0" type="radio" <?php
                                        if ($stat == 0) {
                                            echo'checked=""';
                                        }
                                        ?> >
                                        Inactive
                                    </label>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>banner/banner/banner_view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $('#banner_img').change(function () {
            $('#image_preview').attr('src', '').hide();
            var file = $('#banner_img').val();
            var extension = file.substr((file.lastIndexOf('.') + 1));
            if (extension == 'jpg' || extension == 'png') {
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $("#image_preview").fadeIn("fast").attr('src', tmppath).css({'height': '120px', 'width': '150px'});
            }
        });
    });
</script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>
<script>
<?php if (isset($edit_id)) { ?>

        setTimeout(function () {
            $("#banner_img").rules("remove", "required");
        }, 400);

<?php } ?>
</script>

