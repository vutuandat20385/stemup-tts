<aside class="col-md-12">
    <div role="tabpanel">
        <div id="tabContent2" class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home2a">
                <div class="box-bor MB20">
                    <div role="tabpanel" id="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home1" id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Stemup Phụ Huynh </a></li>
                            <li role="presentation"><a href="#home2" id="text-tabs2" data-toggle="tab" role="tab" aria-controls="tab1">Stemup Học Sinh</a></li>
                            <li role="presentation" onclick=""><a href="#home3" id="text-tabs3" data-toggle="tab" role="tab" aria-controls="tab2">Web Stemup</a></li>
                        </ul>
                        <div id="tabContent1" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home1">
                                <?php $this->load->view('help/help_mobile_parent'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in " id="home2">
                                <?php $this->load->view('help/help_mobile_student'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="home3">
                                <?php $this->load->view('help/help_mobile_home'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>