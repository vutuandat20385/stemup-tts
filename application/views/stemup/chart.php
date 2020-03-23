    <div role="tabpanel" class="tab-pane fade in " id="home5" style="margin-top: 40px;">
                            <h1> Thống kê</h1>
                            <form  id="form_search" method="post" onsubmit="return false">
                                <div class="col-md-4">
                                    <LABEL>Tháng</LABEL>
                                    <select id="thang" onclick="myFuntion(1)" class="form-control " name="thang">
                                        <option value='0'>--Chọn tháng--</option>
                                        
                                       <?php for($i=1;$i<=12;$i++){?>

                                            <option <?php if($month==$i) echo "selected" ?>  value="<?php echo $i?>"><?php echo $i?></option> 
                                            
                                             <?php  }?>
                                    </select> </div>

                                <div class="col-md-4">
                                    <label>Năm</label>
                                    <select id="nam" onclick="myFuntion(2)" class="form-control " name="nam">
                                        <option value="">--Chọn năm--</option>
                                       <?php for($i=2018;$i<=2025;$i++){?>

                                            <option <?php if($year==$i) echo "selected" ?>  value="<?php echo $i?>"><?php echo $i?></option> 
                                            
                                             <?php  }?>

                                    </select></div>

                                
                            </form>
                            <?php if($question >0){?>
                  <div id="piechart" style="width: 100%; height: 400px; margin-top:70px ">
                            </div>
                            <center><h4>Bạn đã làm <?php  echo $question ?> bài, Số quiz đã vượt qua <?php  echo $q_corr ?> bài
                                quiz trong  </h4>
                                </center>
                            <?php }else{?>
                             <div class="opp"  >
                            <center><h4> OPP! Không có dữ liệu tháng bạn vừa chọn </h4>
                                </center>
                            </div>
                             <?php }?>
                            <?php if($thang['tuan1']['correct']) {?>
                            <div id="chart_div" style="width: 100%; height: 500px;"></div>


                            <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawVisualization);

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable([
                                    ['week', 'Bài quiz vượt qua', 'Bài quiz đã làm', 'Tổng số bài đã giao',
                                        'Tỷ lệ hoàn thành/100 '
                                    ],
                                    ['1', <?php echo $thang['tuan1']['correct'] ?> , <?php echo $thang[
                                        'tuan1']['quiz_done'] ?> , <?php echo $thang['tuan1'][
                                        'total_quiz'
                                    ] ?> , <?php echo $thang['tuan1']['ty_le'] ?> ],
                                    ['2', <?php echo $thang['tuan2']['correct'] ?> , <?php echo $thang[
                                        'tuan2']['quiz_done'] ?> , <?php echo $thang['tuan2'][
                                        'total_quiz'
                                    ] ?> , <?php echo $thang['tuan2']['ty_le'] ?> ],
                                    ['3', <?php echo $thang['tuan3']['correct'] ?> , <?php echo $thang[
                                        'tuan3']['quiz_done'] ?> , <?php echo $thang['tuan3'][
                                        'total_quiz'
                                    ] ?> , <?php echo $thang['tuan3']['ty_le'] ?> ],
                                    ['4', <?php echo $thang['tuan4']['correct'] ?> , <?php echo $thang[
                                        'tuan4']['quiz_done'] ?> , <?php echo $thang['tuan4'][
                                        'total_quiz'
                                    ] ?> , <?php echo $thang['tuan4']['ty_le'] ?> ]

                                ]);

                                var options = {
                                    title: 'Hoạt động làm bài của bạn trong tháng <?php echo $month ?>/<?php echo $year ?>',
                                    vAxis: {
                                        title: 'Số bài'
                                    },
                                    hAxis: {
                                        title: 'Tuần'
                                    },
                                    seriesType: 'bars',
                                    series: {
                                        3: {
                                            type: 'line'
                                        }
                                    }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                            </script>
                            <?php }else{
    ?>

                            <div id="chart_div" style="width: 100%; height: 500px;"></div>


                            <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawVisualization);

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable([
                                    ['Week', 'Bài quiz vượt qua', 'Bài  quiz đã làm', 'Tổng số bài đã giao',
                                        'Tỷ lệ hoàn thành /100 '
                                    ],
                                    ['1', <?php echo $nam['thang1']['correct'] ?> , <?php echo $nam[
                                        'thang1']['quiz_done'] ?> , <?php echo $nam['thang1'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang1']['ty_le'] ?> ],
                                    ['2', <?php echo $nam['thang2']['correct'] ?> , <?php echo $nam[
                                        'thang2']['quiz_done'] ?> , <?php echo $nam['thang2'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang2']['ty_le'] ?> ],
                                    ['3', <?php echo $nam['thang3']['correct'] ?> , <?php echo $nam[
                                        'thang3']['quiz_done'] ?> , <?php echo $nam['thang3'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang3']['ty_le'] ?> ],
                                    ['4', <?php echo $nam['thang4']['correct'] ?> , <?php echo $nam[
                                        'thang4']['quiz_done'] ?> , <?php echo $nam['thang4'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang4']['ty_le'] ?> ],
                                    ['5', <?php echo $nam['thang5']['correct'] ?> , <?php echo $nam[
                                        'thang5']['quiz_done'] ?> , <?php echo $nam['thang5'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang1']['ty_le'] ?> ],
                                    ['6', <?php echo $nam['thang6']['correct'] ?> , <?php echo $nam[
                                        'thang6']['quiz_done'] ?> , <?php echo $nam['thang6'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang6']['ty_le'] ?> ],
                                    ['7', <?php echo $nam['thang7']['correct'] ?> , <?php echo $nam[
                                        'thang7']['quiz_done'] ?> , <?php echo $nam['thang7'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang7']['ty_le'] ?> ],
                                    ['8', <?php echo $nam['thang8']['correct'] ?> , <?php echo $nam[
                                        'thang8']['quiz_done'] ?> , <?php echo $nam['thang8'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang8']['ty_le'] ?> ],
                                    ['9', <?php echo $nam['thang9']['correct'] ?> , <?php echo $nam[
                                        'thang9']['quiz_done'] ?> , <?php echo $nam['thang9'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang9']['ty_le'] ?> ],
                                    ['10', <?php echo $nam['thang10']['correct'] ?> , <?php echo $nam[
                                        'thang10']['quiz_done'] ?> , <?php echo $nam['thang10'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang10']['ty_le'] ?> ],
                                    ['11', <?php echo $nam['thang11']['correct'] ?> , <?php echo $nam[
                                        'thang11']['quiz_done'] ?> , <?php echo $nam['thang11'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang11']['ty_le'] ?> ],
                                    ['12', <?php echo $nam['thang12']['correct'] ?> , <?php echo $nam[
                                        'thang12']['quiz_done'] ?> , <?php echo $nam['thang12'][
                                        'total_quiz'
                                    ] ?> , <?php echo $nam['thang12']['ty_le'] ?> ]

                                ]);

                                var options = {
                                    title: 'Hoạt động làm bài của bạn trong năm  <?php echo $year ?>',
                                    vAxis: {
                                        title: 'Số Bài'
                                    },
                                    hAxis: {
                                        title: 'Tháng'
                                    },
                                    seriesType: 'bars',
                                    series: {
                                        3: {
                                            type: 'line'
                                        }
                                    }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                            </script>
                            <?php
  }?>

                            <script type="text/javascript">
                            // Load google charts
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            // Draw the chart and set the chart values
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Task', 'question complete'],
                                    ['Bài quiz vượt qua', <?php echo $q_corr ?> ],
                                    ['bài chưa vượt qua', <?php echo $q_wrong ?> ]

                                ]);


                                // Optional; add a title and set the width and height of the chart
                                var options = {
                                    'title': 'Bài Quiz đã hoàn thành ',
                                    'width': '100%',
                                    'height': 400
                                };

                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                chart.draw(data, options);
                            }
                            </script>
</div>