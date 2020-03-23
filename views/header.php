<html lang="en">
  <head>
  <title> <?php echo $title;?></title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  html,body,h1,h2,h3,h4,p,div,span{
    direction: <?php echo $this->config->item('direction');?>;
}

  </style>

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	 
	<!-- bootstrap css -->
	<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	
	<!-- custom css -->
	<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet">
	
	<script>
	
	var base_url="<?php echo base_url();?>";

	</script>
	
	<!-- jquery -->
	<script src="<?php echo base_url('js/jquery.js');?>"></script>
	
	<?php
	if(($this->uri->segment(1).'/'.$this->uri->segment(2))!='quiz/attempt'){
	?>
	<!-- custom javascript -->
	  	<script src="<?php echo base_url('js/basic.js');?>"></script>
		<script src="<?php echo base_url('js/data.js');?>"></script>
	<?php
	}
	?>	
	<!-- bootstrap js -->
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
	
	<!-- fontawesome css -->
	<link href="<?php echo base_url('font-awesome/css/font-awesome.css');?>" rel="stylesheet">
	
	<!-- chartjs -->
	<script src="<?php echo base_url('js/Chart.bundle.min.js');?>"></script>
	
	<!-- firebase messaging menifest.json -->
	 <link rel="manifest" href="<?php echo base_url('js/manifest.json');?>">
	 
	 
	 




 </head>
  <body   >
  
  
  	
	<?php 
			if($this->session->userdata('logged_in')){
				if(($this->uri->segment(1).'/'.$this->uri->segment(2))!='quiz/attempt'){
				$logged_in=$this->session->userdata('logged_in');
	?>
	    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
 <a class="navbar-brand" href="<?php echo site_url('home_user');?>"><i class="fas fa-home"></i></a> 	           
            <?php 

if(in_array('All',explode(',',$logged_in['setting']))){
?>	
	  
<a class="navbar-brand" href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('dashboard');?></a> 
            
<?php 
}
?>


             
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              
		 
<?php 
if($logged_in['su']==1 || $logged_in['su']==3|| $logged_in['uid']==7){	
if(in_array('List',explode(',',$logged_in['users'])) || in_array('List_all',explode(',',$logged_in['users']))){
?>			  <li class="dropdown" <?php if($this->uri->segment(1)=='user'){ echo "class='active'"; } ?> >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('users');?> <span class="caret_e_e_e_e_e_e_e_e"></span></a>
                <ul class="dropdown-menu">
  <?php 
if(in_array('Add',explode(',',$logged_in['users']))){
?>
							<li><a href="<?php echo site_url('user/new_user');?>">
									<?php echo $this->lang->line('add_new');?></a></li>
							<?php  if($logged_in['su']==1){?>
							<li><a href="<?php echo site_url('user/import_user');?>">
									<?php echo $this->lang->line('import_file');?></a></li>
							<?php  }?>
							<li><a href="<?php echo site_url('user/inaction') ?>">Người dùng ít hoạt động</a></li>
							<?php 
}
?>
<?php 
if(in_array('List',explode(',',$logged_in['users'])) || in_array('List_all',explode(',',$logged_in['users']))){
?>
                  <li><a href="<?php echo site_url('user');?>"><?php echo $this->lang->line('list');?> <?php echo $this->lang->line('users');?> </a></li>
                  
                  <?php } ?>
<!--				  
  <?php 
if(in_array('List_all',explode(',',$logged_in['appointment']))){ ?>
<li><a href="<?php echo site_url('appointment/myappointment/');?>"><?php echo $this->lang->line('myappointment');?></a></li>   
<?php } ?>   
-->           
                </ul>
              </li>

<?php 
}
?>


			 
<?php 
if(in_array('List',explode(',',$logged_in['questions'])) || in_array('List_all',explode(',',$logged_in['questions']))){
?> 			 
			 
			  <li class="dropdown" <?php if($this->uri->segment(1)=='qbank'){ echo "class='active'"; } ?> >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('qbank');?> <span class="caret_e"></span></a>
                <ul class="dropdown-menu">
                <?php 
if(in_array('Add',explode(',',$logged_in['questions']))){
?> 
                  <li><a href="<?php echo site_url('qbank/new_question_1/4/0');?>"><?php echo $this->lang->line('add_new');?></a></li>
                  <?php 
                  }
if(in_array('List',explode(',',$logged_in['questions'])) || in_array('List_all',explode(',',$logged_in['questions']))){
?> 
                  <li><a href="<?php echo site_url('qbank');?>"><?php echo $this->lang->line('list');?> <?php echo $this->lang->line('question');?> </a></li>
                  
                  <?php } ?>
                </ul>
              </li>
			 
<?php }  			 
			 
if((!in_array('List',explode(',',$logged_in['users'])) || !in_array('List_all',explode(',',$logged_in['questions']))) && in_array('Myaccount',explode(',',$logged_in['users']))){
?> 		     
			 <li><a href="<?php echo site_url('user/edit_user/'.$logged_in['uid']);?>"><?php echo $this->lang->line('myaccount');?></a></li>
 
			 <?php 
			 }
			 ?>
 <?php 
if(in_array('List',explode(',',$logged_in['appointment'])) && !in_array('List_all',explode(',',$logged_in['appointment']))){ ?>
<li><a href="<?php echo site_url('appointment/myappointment/');?>"><?php echo $this->lang->line('myappointment');?></a></li>   
<?php } ?> 

<?php 
if(in_array('List',explode(',',$logged_in['quiz'])) || in_array('List_all',explode(',',$logged_in['quiz']))){
?> 			 
     		  <li class="dropdown" <?php if($this->uri->segment(1)=='qbank'){ echo "class='active'"; } ?> >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('quiz');?> <span class="caret_e"></span></a>
                <ul class="dropdown-menu">
                 <?php  
  
if(in_array('Add',explode(',',$logged_in['quiz']))){
 
			?>     <li><a href="<?php echo site_url('quiz/add_new');?>"><?php echo $this->lang->line('add_new');?></a></li>
              <?php 
				}
?>
 <?php  
  
if(in_array('List',explode(',',$logged_in['quiz'])) || in_array('List_all',explode(',',$logged_in['quiz']))){
 
			?>  
							 <li><a href="<?php echo site_url('quiz');?>"> <?php echo $this->lang->line('list');?> <?php echo $this->lang->line('quiz');?></a></li>
               <?php 
               }
               ?>
                </ul>
              </li>
<?php 
}
?>	
<?php 
if(in_array('List',explode(',',$logged_in['results'])) || in_array('List_all',explode(',',$logged_in['results'])) ){
	if($logged_in['su']==1){
?> 
	           <li><a href="<?php echo site_url('result');?>"><?php echo $this->lang->line('result');?></a></li>
<?php 
	}
}
?>
<!--
<?php 
if(in_array('List',explode(',',$logged_in['quiz'])) || in_array('List_all',explode(',',$logged_in['quiz']))){
?> 			 
			 <li><a href="<?php echo site_url('liveclass');?>"><?php echo $this->lang->line('live_classroom');?></a></li>
			 <?php
			  }
			 ?>
-->
<!--
	 <?php 
if(!in_array('All',explode(',',$logged_in['setting']))){
?>


			  <li><a href="<?php echo site_url('notification');?>"><?php echo $this->lang->line('notification');?></a></li>
			  
			  <?php 
			  }
			  ?>
-->

	<!-- social group -->
<!--
	 <?php 

if(in_array('Join',explode(',',$logged_in['social_group']))){
?>


			  <li><a href="<?php echo site_url('social_group');?>"><?php echo $this->lang->line('social_group');?></a></li>
			  
			  <?php 
			  }
			  ?>
-->
	<!-- social group -->
<!--
<?php 
$acp=explode(',',$logged_in['study_material']);
if(in_array('List',$acp)){
?>
<li><a href="<?php echo site_url('study_material');?>"><?php echo $this->lang->line('study_material');?></a></li>
<?php 
}
?>
-->
<!--
<?php 
$acp=explode(',',$logged_in['assignment']);
if(in_array('List',$acp)){
?>
<li><a href="<?php echo site_url('assignment');?>"><?php echo $this->lang->line('assignment');?></a></li>
<?php 
}
?>


-->	

		 
			 
<li class="dropdown" <?php if($this->uri->segment(1)=='import'){ echo "class='active'"; } ?> >
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	Import <span class="caret_e"></span></a>
	<ul class="dropdown-menu">
	  <li><a href="<?php echo site_url("import/text_question")?>">Câu hỏi thường</a></li>

	  <li><a href="<?php echo site_url("import/video_question")?>">Câu hỏi chứa mã nhúng</a></li>
	  
      <li><a href="<?php echo site_url("import/library")?>">Thư viện</a></li>
	</ul>
  </li>
			 


 <li><a href="<?php echo site_url('tranfer_point');?>"><?php echo $this->lang->line('tranfer');?></a></li>

 <li><a href="<?php echo site_url("comment/manage_comment")?>">Bình luận</a></li>
		 <?php 
if(in_array('All',explode(',',$logged_in['setting']))){
?>
			 
			 
			  <li class="dropdown" <?php if($this->uri->segment(1)=='user_group'){ echo "class='active'"; } ?> >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('setting');?>  <span class="caret_e"></span></a>
                <ul class="dropdown-menu">
                  <!--<li><a href="<?php echo site_url('notification');?>"><?php echo $this->lang->line('notification');?></a></li>-->
                  <!--<li><a href="<?php echo site_url('user/group_list');?>"><?php echo $this->lang->line('group_list');?></a></li>-->
				    <li><a href="<?php echo site_url('data/datagroup_list');?>"><?php echo $this->lang->line('datagroup_list');?></a></li>
                 <li><a href="<?php echo site_url('data/dataitem_list');?>"><?php echo $this->lang->line('dataitem_list');?></a></li>
				  <li><a href="<?php echo site_url('rulepoint');?>"><?php echo $this->lang->line('rule_point');?></a></li>
				  
                  <li><a href="<?php echo site_url('qbank/category_list');?>"><?php echo $this->lang->line('category_list');?></a></li>
                  <li><a href="<?php echo site_url('qbank/level_list');?>"><?php echo $this->lang->line('level_list');?></a></li>
           
                 <!-- <li><a href="<?php echo site_url('dashboard/config');?>"><?php echo $this->lang->line('config');?></a></li>-->
				  <li><a href="<?php echo site_url('system_config');?>">System Config</a></li>	 
				<!--	<li><a href="<?php echo site_url('dashboard/css');?>"><?php echo $this->lang->line('custom_css');?></a></li>-->
				  <li><a href="<?php echo site_url('tags/all_tag');?>">Tags</a></li>		  
                <!--<li><a href="<?php echo site_url('advertisment');?>"><?php echo $this->lang->line('advertisment');?></a></li>  -->
                 <li><a href="<?php echo site_url('account');?>"><?php echo $this->lang->line('account_type');?></a></li> 
                 <!--    <li><a href="<?php echo site_url('user/custom_fields');?>"><?php echo $this->lang->line('custom_forms');?></a></li>-->
                <!--     <li><a href="<?php echo site_url('payment_gateway');?>"><?php echo $this->lang->line('payment_history');?></a></li>-->
                </ul>
              </li>
              
			
			<?php 
}}
				?>
             <li><a href="<?php echo site_url('user/logout');?>"><?php echo $this->lang->line('logout');?></a></li>
              <!--
			  <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret_e"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                 
                </ul>
              </li>
			  -->
			  
            </ul>
             
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

	<?php 
			}
			}
	?>
	<center><?php 
	if($this->uri->segment(3) != 'ph'){
if($this->uri->segment(2) != 'attempt' && $this->uri->segment(1) != 'install'){
	$this->db->where("add_status","Active");
	$this->db->where("position","Top");
	$query=$this->db->get('savsoft_add');
	if($query->num_rows()==1){
	$ad=$query->row_array();
	if($ad['advertisement_code'] != ""){
	echo $ad['advertisement_code'];
	}else if($ad['banner']!=''){ ?><a href="<?php echo $ad['banner_link'];?>" target="new_add"><img src="<?php echo base_url('upload/'.$ad['banner']);?>" class="img-responsive"  ></a> <?php    
	
	}
	}
	
}	
	
?></center>
	
	<?php if($this->session->flashdata('message_header')){
       
       echo $this->session->flashdata('message_header'); 
      } ?>
	
	
 <div class="container">	<?php 
 if($this->session->userdata('logged_in')){
	// check sg invitation
	$uid=$logged_in['uid'];
	$query=$this->db->query("select * from group_invitation 
	join savsoft_users on savsoft_users.uid=group_invitation.invited_by 
	join social_group on social_group.sg_id=group_invitation.sg_id where group_invitation.uid='$uid' and invitation_status='Pending' ");
	$invitations=$query->result_array();
	foreach($invitations as $k => $invitation){
	?>
	
     <div class="media" style="border-bottom:1px solid #dddddd;padding-bottom:4px;">
        <div class="media-left">
          <div class="media-object">
            <img src="https://www.gravatar.com/avatar/<?php echo md5($invitation['email']);?>?s=50" class="img-circle" alt="Name">
          </div>
        </div>
        <div class="media-body">
          <strong class="notification-title"><a href="#"><?php echo $invitation['first_name'].' '.$invitation['last_name'];?></a> <?php echo $this->lang->line('invitation_msg');?> <a href="<?php echo site_url('social_group/view/'.$invitation['sg_id']);?>"><?php echo $invitation['sg_name'];?></a></strong>
          <p class="notification-desc"><?php echo $invitation['custom_message'];?><br><small class="timestamp"><?php echo $invitation['invitation_date'];?></small></p>

          <div class="notification-meta">
            
            <a href="<?php echo site_url('social_group/accept_invitation/'.$invitation['invitation_id'].'/'.$invitation['sg_id'].'/'.$uid);?>" class="btn btn-success btn-sm" ><?php echo $this->lang->line('accept_join');?></a>
              <a href="<?php echo site_url('social_group/reject_invitation/'.$invitation['invitation_id'].'/'.$invitation['sg_id'].'/'.$uid);?>" class="btn btn-danger btn-sm" ><?php echo $this->lang->line('reject');?></a>
             
          </div>
        </div>
      </div>
   
<?php 
	
	}
	}
	}
	?>
	</div>
	
