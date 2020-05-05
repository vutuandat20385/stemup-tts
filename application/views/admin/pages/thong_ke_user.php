<script src="<?php echo base_url(); ?>js/admin/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>js/admin/utils.js"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
<div class="col-xs-12 p0">
    <div class="box">
        <div class="box-body">
            <div style="width:75%;">
                <canvas id="canvas"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 p0">
<h2 style="padding-top: 20px;">Bảng thống kê đăng ký tài khoản trong vòng 60 ngày</h2>
    <div class="box">
        <div class="box-body">
            <div style="width:75%;">
                <canvas id="canvas2"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    var config = {
        type: 'line',

        data: {
            labels: [<?php foreach ($user as $row) {
                            $date = strtotime($row['Date']);
                            $row['Date'] = date('d-m-Y', $date);
                            echo "'" . $row['Date'] . "', ";
                        } ?>],
            datasets: [{
                label: 'Tổng',
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: [
                    <?php foreach ($user as $row) {
                        echo "'" . $row['totalNewUsers'] . "', ";
                    } ?>
                ],
                fill: false,
            }, {
                label: 'Phụ huynh',
                fill: false,
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: [
                    <?php foreach ($user as $row) {
                        echo "'" . $row['totalNewParents'] . "', ";
                    } ?>
                ],
            }, {
                label: 'Học sinh',
                fill: false,
                backgroundColor: window.chartColors.yellow,
                borderColor: window.chartColors.yellow,
                data: [
                    <?php foreach ($user as $row) {
                        echo "'" . $row['totalNewStudents'] . "', ";
                    } ?>
                ],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Bảng thống kê'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 200
                    }
                }]
            }
        }
    };

    var config2 = {
        type: 'line',

        data: {
            labels: [<?php
                $date_lm = array();
                foreach ($user_cr30day as $row) {
                    $date = strtotime($row['Date']);
                    $row['Date'] = date('d-m-Y', $date);
                    echo "'" .  $row['Date'] . "', ";
                }
                ?> ],
            datasets: [{
                label: '30 ngày trước nữa',
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: [
                    <?php foreach ($user_l30day as $row) {
                        echo "'" . $row['totalNewUsers_l30day'] . "', ";
                    }?>
                ],
                fill: false,
            }, {
                label: '30 ngày trước',
                fill: false,
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: [
                    <?php foreach ($user_cr30day as $row) {
                        echo "'" . $row['totalNewUsers_cr30day'] . "', ";
                    } ?>
                ],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Bảng thống kê'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 200
                    }
                }]
            }
        }
    };


    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        var ctx2 = document.getElementById('canvas2').getContext('2d');
        window.myLine = new Chart(ctx, config);
        window.myLine = new Chart(ctx2, config2);
    };
</script>