<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends CI_Controller {

	public function __construct()
	{
		// Constructor to auto-load HybridAuthLib
		parent::__construct();
		 $this->load->database();
	   $this->load->library('HybridAuthLib');
	}

	public function index()
	{
		// Send to the view all permitted services as a user profile if authenticated
		$login_data['providers'] = $this->hybridauthlib->getProviders();
		foreach($login_data['providers'] as $provider=>$d) {
			if ($d['connected'] == 1) {
				$login_data['providers'][$provider]['user_profile'] = $this->hybridauthlib->authenticate($provider)->getUserProfile();
			}
		}

		$this->load->view('hauth/home', $login_data);
	}

	public function login($provider,$model="",$id="", $opt_choice=""){
	    
		log_message('debug', "controllers.HAuth.login($provider) called");

		try{
			
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider)){
				
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				
				$service = $this->hybridauthlib->authenticate($provider);
				
				if ($service->isUserConnected()){
					log_message('debug', 'controller.HAuth.login: user authenticated.');
					$user_profile = $service->getUserProfile();
					log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
					$data['user_profile'] = $user_profile;

					// $this->load->view('hauth/done',$data);					 
					if($provider == "Google"){
						$this->load->model("user_model");	 
						$status=$this->user_model->login2($user_profile->email,$user_profile->displayName,$user_profile->photoURL );
						if($status['status']=='1'){
							$this->load->helper('url');
							// row exist fetch userdata
							$user=$status['user'];
			
			
							// validate if user assigned to paid group
							if($user['price'] > '0'){
								
								// user assigned to paid group now validate expiry date.
								if($user['subscription_expired'] <= time()){
									// eubscription expired, redirect to payment page
									
									redirect('payment_gateway/subscription_expired/'.$user['uid']);
									
								}
								
							}
							$user['base_url']=base_url();
							// creating login cookie
							$this->session->set_userdata('logged_in', $user);
							// redirect to dashboard
							/*if($user['su']=='1'){
							 redirect('home_user');
				 
							}else{
								$burl=$this->config->item('base_url').'index.php/home_user';
							 header("location:$burl");

							}*/
							if($model=='quiz'){
								redirect('quiz/validate_quiz/'.$id);
								}
							else if($model=='quiz1'){
								$this->db->where("content_id",$id);
								$this->db->where("model","quiz");
								$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
								 redirect('page/quiz/'.$permalink);
								}	 
								else if($model=='question'){
										$this->db->where("content_id",$id);
										$this->db->where("model","qbank");
										$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
										if(!$opt_choice){
											redirect("page/question/".$permalink."/notsolved");
										}	
										else{
											redirect("page/question/".$permalink."/notsolved/".$opt_choice);
										}
									}
									else{
										redirect("home_user");
									}
						}else if($status['status']=='0'){
								 
								// invalid login
								// try to auth wp
								if($this->config->item('wp-login')){
								 
									if($this->authentication($username, $password)){
										   
										$this->verifylogin($username, $password);
									}else{
										$this->load->helper('url');
										$this->session->set_flashdata('message', $status['message']);
										$burl=$this->config->item('base_url');
										header("location:$burl");
									}
								}else{
		        
									$this->load->helper('url');
									$this->session->set_flashdata('message', $status['message']);
									redirect('home');
								}
		        
			
						}else if($status['status']=='2'){
							$this->load->helper('url');		 
							// email not verified
							$this->session->set_flashdata('message', $status['message']);
							redirect('home');
						}else if($status['status']=='3'){
                        $this->load->helper('url');

			 
							// email not verified
							$this->session->set_flashdata('message', $status['message']);
							redirect('home');
						}
		
						// end login redirect
					
					
					}
					
					
					if($provider == "Facebook"){
								
						$this->load->model("user_model");
				 
						$status=$this->user_model->login2($user_profile->identifier,$user_profile->displayName,$user_profile->photoURL);
						if($status['status']=='1'){
							$this->load->helper('url');
							// row exist fetch userdata
							$user=$status['user'];
						
						
							// validate if user assigned to paid group
							if($user['price'] > '0'){
								
								// user assigned to paid group now validate expiry date.
								if($user['subscription_expired'] <= time()){
									// eubscription expired, redirect to payment page	
									redirect('payment_gateway/subscription_expired/'.$user['uid']);	
									}		
							}
							$user['base_url']=base_url();
							// creating login cookie
							$this->session->set_userdata('logged_in', $user);
							// redirect to dashboard
							/*if($user['su']=='1'){
							 redirect('home_user');
								 
							}else{
								$burl=$this->config->item('base_url').'index.php/home_user';
							 header("location:$burl");
							}*/
							if($model=='quiz'){
								redirect('quiz/validate_quiz/'.$id);
							 }	
							 else if($model=='quiz1'){
								$this->db->where("content_id",$id);
								$this->db->where("model","quiz");
								$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
								redirect('page/quiz/'.$permalink);
							}	 			 
							else if($model=='question'){
								$this->db->where("content_id",$id);
								$this->db->where("model","qbank");
								$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
								if(!$opt_choice){
									redirect("page/question/".$permalink."/notsolved");
								}	
								else{
									redirect("page/question/".$permalink."/notsolved/".$opt_choice);
								}
							}
							else{
								redirect("home_user");
							}
						
						}else if($status['status']=='0'){
						 
						// invalid login
						// try to auth wp
							if($this->config->item('wp-login')){
							 
								if($this->authentication($username, $password)){
									$this->verifylogin($username, $password);
								}else{
									$this->load->helper('url');
									$this->session->set_flashdata('message', $status['message']);
									$burl=$this->config->item('base_url');
									header("location:$burl");
								}
							}else{
								
								$this->load->helper('url');
								$this->session->set_flashdata('message', $status['message']);
								redirect('home');
							}
								
							
						}else if($status['status']=='2'){
							$this->load->helper('url');
							// email not verified
							$this->session->set_flashdata('message', $status['message']);
							redirect('home');
						}else if($status['status']=='3'){
							$this->load->helper('url');

							// email not verified
							$this->session->set_flashdata('message', $status['message']);
							redirect(home);
						}				
					// end login redirect					
					
					}
	
				}
				else{ // Cannot authenticate user
				    
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
		
	}


public function logout()
{
$this->load->library('HybridAuthLib');

  $this->HybridAuthLib->logoutAllProviders();
  
     redirect('home');
}
	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));
		log_message('error', '00000000000000000000000000000000000000');
		log_message('error', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
