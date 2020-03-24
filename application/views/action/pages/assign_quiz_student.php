<div role="tabpanel">
    <div id="tabContent2" class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home2a">
            <div class="box-bor MB20">
                <div role="tabpanel" id="tabs">
                    <ul class="row col-xs-12 nav nav-tabs" role="tablist">
                        <li class="active col-xs-4 action_answer" role="presentation"><a href="#home1" id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Hoạt động được giao</a></li>
                        <li class="col-xs-4 action_answer" role="presentation" onclick="quizAssignTo_undone(0,0,1,0,'')"><a href="#home5" id="text-tabs5" data-toggle="tab" role="tab" aria-controls="tab5">Hoạt động chưa làm</a></li>

                        <li class="col-xs-4 action_answer" role="presentation" onclick="quizAssignTo_done(0,0,1,0,'')"><a href="#home4" id="text-tabs4" data-toggle="tab" role="tab" aria-controls="tab4">Hoạt động đã làm</a></li>
                    </ul>
                    <div id="tabContent1" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home1">
                        </div>
                        <div role="tabpanel" class="tab-pane fade in" id="home4">
                        </div>
                        <div role="tabpanel" class="tab-pane fade in " id="home5">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    quizAssignTo_1(0, 0, 1, 0, "");
</script>