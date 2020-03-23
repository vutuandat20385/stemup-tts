<?php
Class Sso_model extends CI_Model{
	//curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    function get_token($code){
		$this->load->library('Curl');
		$curl = curl_init();
		$realm="eid";
		$base = "https://eid.itrithuc.vn/auth";
		$clientid="account";
		$client_secret="87b0ec3c-5a47-4177-9b92-68d11583f052";
		$redirect="https%3A%2F%2Fdo.stem.vn%2Findex.php%2Fsso%2Fendpointlogin";
		
		$url_token=$base."/realms/".$realm."/protocol/openid-connect/token";
		$this->load->library('Curl');
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url_token,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_SSL_VERIFYHOST=>0,
			CURLOPT_SSL_VERIFYPEER=>0,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "client_id=".$clientid."&client_secret=".$client_secret."&grant_type=authorization_code&code=".$code."&redirect_uri=".$redirect,
			CURLOPT_HTTPHEADER => array(),
		));


		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		if ($err) {
			//network error or not exist account in IAM
			return array("error"=>1,"message"=>json_encode($err));
		} 
		else{
			$infaccess= json_decode($response, true);
			if($infaccess['access_token']){
				return array("error"=>0,"token"=>$infaccess);
			}
			else{
				return array("error"=>2, "message"=>json_encode($infaccess));
			}
		}
			
	}
 
    function get_info($access_token){
		$curl = curl_init();
		$realm="eid";
		$base = "https://eid.itrithuc.vn/auth";
		$url_info=$base."/realms/".$realm."/protocol/openid-connect/userinfo";
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_info,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYHOST=>0,
		  CURLOPT_SSL_VERIFYPEER=>0,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer ".$access_token,
			"cache-control: no-cache",
			
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
        if ($err) {
			//network error or not exist account in IAM
			return array("error"=>1,"message"=>json_encode($err));
		} 
		else{
			$inf= json_decode($response, true);
			if($inf['sub']){
				return array("error"=>0,"info"=>$inf);
			}
			else{
				return array("error"=>2, "message"=>json_encode($inf));
			}
		}
		curl_close($curl);
	}
	
	
	function logout($access_token, $refresh_token){
		$this->load->library('Curl');
		$curl = curl_init();
		$realm="eid";
		$base = "https://eid.itrithuc.vn/auth";
		$clientid="account";
		$client_secret="87b0ec3c-5a47-4177-9b92-68d11583f052";
		
        $url=$base."/realms/".$realm."/protocol/openid-connect/logout";
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYHOST=>0,
		  CURLOPT_SSL_VERIFYPEER=>0,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "client_id=".$clientid."&client_secret=".$client_secret."&refresh_token=".$refresh_token,
		  CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer ".$access_token,
			"Content-Type: application/x-www-form-urlencoded",
			"cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return array("error"=>1);
		} else {
		  return array("error"=>0);
		}
		
	}
	
	function login($info){
		$this->db->where('email',$info["email"]);
		$user= $this->db->get("savsoft_users")->row_array();
		if($user){
			if($user['iamid']!=$info['sub']){
				$this->db->where('email',$info["email"]);
				$this->db->update("savsoft_users", array("iamid"=>$info['sub']));
				$user['iamid']==$info['sub'];
			}
		}
		else{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$check=true;
			while($check){
				$user_code = '';
				for ($i = 0; $i < 6; $i++) {
					$user_code.= $characters[rand(0, $charactersLength - 1)];
				}
				$this->db->where('user_code', $user_code);
				 $n = $this->db->get('savsoft_users')->num_rows();
				if($n==0)
				$check=false;
			}	
			$userdata=array(
				 'email'=>$info["email"],
				 'email2'=>"",
				 "user_code"=>$user_code,
				 'password'=>md5(rand(1111,9999)),
				 'first_name'=>$info["name"],
				 'last_name'=>' ',
				 'contact_no'=>'',
				 'gid'=>$this->config->item('default_gid'),
				 'su'=>'5',
				 "iamid"=>$info['sub']
			 );
			 $this->db->insert("savsoft_users",$userdata);
			 $uid=$this->db->insert_id();
			 $this->db->where('uid',$uid);
			 $user= $this->db->get("savsoft_users")->row_array(); 
		}
		return $user;
	}
	
	function get_admin_token($username="admin",$password="abc@123"){
		$this->load->library('Curl');
		$base = "https://eid.itrithuc.vn/auth";
		$curl = curl_init();
        $url= $base."/realms/master/protocol/openid-connect/token";
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYHOST=>0,
		  CURLOPT_SSL_VERIFYPEER=>0,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "client_id=admin-cli&username=$username&password=$password&grant_type=password",
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/x-www-form-urlencoded",
			"cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
		  return array("error"=>1);
		} else {
		  return array("error"=>0,"token"=>$response['access_token']);
		}
	}
    
	
    function create_user($token,$username,$email,$password){
		$this->load->library('Curl');
		$curl = curl_init();
		$base = "https://eid.itrithuc.vn/auth";
        $url= $base."/admin/realms/stem.vn/users";
		$user= array("username"=>$username,
		             "enabled"=>true,
					 "email"=>$email,
					 "firstName"=>"",
					 "lastName"=>"",
					 "credentials"=>array(
										array(
											"type"=> "password",
											"value"=>$password
										)
					                )
					 
		       ); 
		
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,			
		  CURLOPT_SSL_VERIFYHOST=>0,
		  CURLOPT_SSL_VERIFYPEER=>0,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($user),
		  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $token",
				"Content-Type: application/json",
				"cache-control: no-cache"
			  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		   return array("error"=>1);
		} else {
		  return array("error"=>0);
		}
	}
	
	function change_password($token,$id,$password){
		$this->load->library('Curl');
		$curl = curl_init();
		$base = "https://eid.itrithuc.vn/auth";
		$url= $base."/admin/realms/stem.vn/users/$id/reset-password";
		$userinfo= array("type"=>"password",
		             "temporary"=>false,
					 "value"=>$password
		);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYHOST=>0,
		  CURLOPT_SSL_VERIFYPEER=>0,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "PUT",
		  CURLOPT_POSTFIELDS => json_encode($userinfo),
		  CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer $token",
			"cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return array("error"=>1);
		} else {
		  return array("error"=>0);
		}		
	}
  
 }
 
