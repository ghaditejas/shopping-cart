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
            Orders
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
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
                            <th>Invoice</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="content-header">
        <h3>
            Graph
        </h3>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <div id="container" style="width: 550px; height: 400px; margin: 0 auto;" ></div>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal" style='display:none'>
    </div>
</div>
<script src="<?php echo base_url(); ?>public/dist/js/checkall.js"></script>
<script type="text/javascript">
    $(document).on('change', '.status', function () {
        var value = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url(); ?>order_management/order_manage/update_status/' + id + '/' + value,
            success: function (e) {
                alert(e);
            }
        });
    });

    $(document).ready(function () {
        $("#order_table1").DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": true,
            "ordering": true,
            "columnDefs": [{orderable: false, targets: [0, 1, 3, 4, 5, 6, 7, 8]}],
            "lengthMenu": [2, 5, 10, 25, 50, 75, 100],
            "lengthChange": true,
            "ajax": "<?php echo base_url(); ?>order_management/order_manage/get_data",
        });
        $.ajax({
            url: '<?php echo base_url(); ?>order_management/order_manage/graph',
            dataType: 'json',
            success: function (jsn) {
//                var arr = [];
//                for (var x in jsn) {
//                    arr.push(parsed[x]);
//                }
//                $.each(jsn,function (x,v){
//                  console.log(x+'---'+v);  
//                });
                google.charts.setOnLoadCallback(function () {
                    // Define the chart to be drawn.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Month');
                    data.addColumn('number', 'Sales');
                    data.addRows(jsn);

                    // Set chart options
                    var options = {
                        chart: {
                            title: 'Sales',
                            subtitle: 'As per month'
                        },
                        hAxis: {
                            title: 'Month',
                        },
                        vAxis: {
                            title: 'Sales',
                        },
                        'width': 550,
                        'height': 400
                    };

                    // Instantiate and draw the chart.
                    var chart = new google.charts.Line(document.getElementById('container'));
                    chart.draw(data, options);

                });
            }
        });
    });
    $(document).on('click', '.bill', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '<?php echo base_url(); ?>order_management/order_manage/get_invoice/' + id,
            dataType: 'html',
            success: function (e) {
                if (e) {
                    $('.modal').empty().append(e);
                    $('.modal').css('display', "block");
                } else {
                    alert('Error while loading invoice');
                }
            }
        })

    });
    $(document).on('click', '.close', function () {
        $('.modal').empty();
        $('.modal').css('display', "none");

    });
</script>