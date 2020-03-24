<body class="bg-body">
    <header class="navbar navbar-fixed-top navbar-stemup">
        <div class="container pos-stemup">
            <div class="header-giua">
                <a class="pull-left logo123" href="<?php echo site_url('action') ?>"><img class="" src="<?php echo base_url('images/app-07.png') ?> " alt="" height="40"></a>
                <div class="slogan123"><span class="text-header">Trợ lý a.i<br> giúp phụ huynh học cùng con</span></div>
            </div>
            <div class="div-guide hidden-xs">
                <a class="bt-hoi hidden-xs" href="<?php echo site_url('help') ?>"><i class="far fa-question-circle fa-2x mr-5"></i>Hướng dẫn</a>
            </div>
            <?php
            $user = $this->session->userdata('logged_in');
            if ($user) {
            ?>
                <div class="div-logout">
                    <a href="#" onclick="window.location= '<?php echo base_url() ?>index.php/user/logout' "><i class="text-logout fas fa-sign-out-alt fa-2x"></i>&nbsp;&nbsp;&nbsp;<span id="text-logout-1" style="font-family: 'Roboto Condensed', sans-serif;
                     font-size: 15px;">Đăng xuất</span></a>
                </div>

            <?php
            }

            ?>
        </div>
    </header>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v3.3'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div attribution="setup_tool" class="fb-customerchat" page_id="518178758717445" logged_in_greeting="Hãy liên lạc với chúng tôi để nhận hỗ trợ trong quá trình sử dụng STEMUP!" logged_out_greeting="Hãy liên lạc với chúng tôi để nhận hỗ trợ trong quá trình sử dụng STEMUP!">

    </div>