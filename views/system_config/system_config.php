<script> var site_url="<?php echo site_url();?>"; </script>
<script src="<?php echo base_url('js/systemconfig.js');?> "></script>	
<div class="col-md-offset-2 col-md-8">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#mail_server" data-toggle="tab">Mail Server</a></li>
		<li><a href="#firebase"  data-toggle="tab">Firebase</a></li>
		<li><a href="#firebase1"  data-toggle="tab">Firebase1</a></li>
	</ul>

	<div class="tab-content">
		<div id="mail_server" class="tab-pane fade in active">
			<div class="col-md-offset-3">
				
				
				
					<table>
						
						<tr>
							<td style="padding:20px">SMTP Host name</td>
							<td style="padding:20px"><input type="text" class="form-control" name="host_name" id="host_name" value="<?php echo $host_name?>" required ></td>
						</tr>
						<tr>
							<td style="padding:20px">SMTP Port</td>
							<td style="padding:20px"><input type="number" class="form-control" name="port" id="port" value="<?php echo $port?>" required ></td>
						</tr>
						<tr>
							<td style="padding:20px">SMTP Username</td>
							<td style="padding:20px"><input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $user_name?>" required ></td>
						</tr>
						<tr>
							<td style="padding:20px">SMTP Password</td>
							<td style="padding:20px"><input type="password" class="form-control" name="password" id="password" value="<?php echo $password?>" required ></td>
						</tr>
				 
					</table>
					<div class="col-md-offset-2" >
						<button class="btn btn-info" id="test_connect" onclick="testconnection()">Test connection</button>
						<button class="btn btn-success" id="update_ms_config" onclick="update_ms_config()">Update</button>
					</div>
			</div>
		</div>
		<div id="firebase" class="tab-pane fade">
			<div class="col-md-12" style="padding:20px">
				<div class="row" style="padding:20px">
					<div class="col-md-2">Firebase Server key</div>
					<div class="col-md-10"><input type="text" class="form-control" name="firebase_serverkey" id="firebase_serverkey" value="<?php echo $firebase_serverkey?>" required ></div>
				</div>
				<div class="row" style="padding:20px">
					<div class="col-md-2">Firebase Topics</div>
					<div class="col-md-10"><input type="text" class="form-control" name="firebase_topic" id="firebase_topic" value="<?php echo $firebase_topic?>" required ></div>
				</div>
				<div class="row" style="padding:20px">
					<button class="btn btn-success pull-right" id="update_ms_config" onclick="update_firebase_config()">Update</button>
				</div>
			</div>
		</div>
		<div id="firebase1" class="tab-pane fade">
		<table class="table table-bordered">
			<tr style="background-color: rgb(233, 235, 238);">
			<br>
				<th>
				#
				</th>
				<th>
				App
				</th>
				<th>
				Key
				</th>
			</tr>
			<tr>
				<td>1</td>
				<td>stem_up</td>
				<td >
				key=AAAAIUedk8M:APA91bHreQ0thOuZzGPA7hNlIDthF2Edog4s638tMJdIFUs
				hMAqFrHfISm7pmMwidWFjSQ9IviMn14rwpKxFk8cu7FcGwfW2S7M0_untpzMf2cCJj7o5QbL-bz-wqlCt4HTqlI9_7vvD 
				</td>
				<td>2</td>
				<td>do</td>
				<td >
				key=AAAA0dc6mvY:APA91bEzamAftWvYzwTW7sRf7G7RxYsCtNmjrKLjfTXVbtZFNyKME0C4TM1cEoQMSh_ja9d
				URjs9WecjZCD1yW0nPK0Hhp6t1D20n96ZcVKsdWbNiJBDjEg5QRTYQFGAoNsHvJcQmcs1
				</td>
			</tr>
		</div>
	</div>	
</div>