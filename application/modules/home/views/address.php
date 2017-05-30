<section id="slider"><!--slider-->
    <div class="container">
        <div class="row" style="align-content:center">
            <?php $this->load->view('my_account_sidebar'); ?>
            <div class="col-sm-8" style="align-content:center">	
                <h2>Address</h2>
                <p align="right"><button type="button" class="btn btn-primary btn-lg" id="btn">Add</button></p>
                <div class="box box-primary">
                    <div class="box-body table-responsive no-padding" >
                        <table class="table table-bordered table-striped" id="address_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal" style="display:none">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Modal Header</h2>
                </div>
                <div class="modal-body">
                    <p>Some text in the Modal Body</p>
                    <p>Some other text...</p>
                </div>
                <div class="modal-footer">
                    <h3>Modal Footer</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("#address_table").DataTable({
            "paging": true,
            "processing": false,
            "serverSide": false,
            "autoWidth": true,
            "searching": false,
            "ordering": false,
            "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
            "lengthChange": true,
//            "ajax": "<?php // echo base_url();  ?>home/my_account/get_address",
        });

        $("#btn").click(function () {
            $('.modal').css('display', "block");
        });

        $(".close").click(function () {
            $('.modal').css('display', "none");
        });
    });
</script>


