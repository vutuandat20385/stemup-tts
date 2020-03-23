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
<script>
    var config = {
        type: 'line',

        data: {
            labels: [<?php foreach ($user as $row) {
                            $date = strtotime($row['Date']);
                            $row['Date'] = date('m-d', $date);
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



    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
</script>