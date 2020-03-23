 <div class="container">

   
 <h3> Edit Account Type</h3>
   
 

  <div class="row">
     <form method="post" action="<?php echo site_url('account/update_account/'.$account_id);?>">
	
<div class="col-md-8">
<br> 
 <div class="login-panel panel panel-default">
		<div class="panel-body"> 
	
	
	
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		
		
							 

			
			 
			
			
			 
			
			
<div class="form-group">
<label>Name</label>
<input type="text" name="name" value="<?php echo $result['account_name'];?>" class="form-control" >
</div>
			<div class="form-group">
			<label>Users</label><br>
				 
			 <label class="checkbox-inline">
      <input type="checkbox" value="Add" name="users[]" <?php if(in_array('Add',explode(',',$result['users']))){ echo 'checked'; } ?> >Add
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Edit" name="users[]" <?php if(in_array('Edit',explode(',',$result['users']))){ echo 'checked'; } ?>>Edit
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="View" name="users[]" <?php if(in_array('View',explode(',',$result['users']))){ echo 'checked'; } ?> >view
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List" name="users[]" <?php if(in_array('List',explode(',',$result['users']))){ echo 'checked'; } ?> >List 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="users[]" <?php if(in_array('List_all',explode(',',$result['users']))){ echo 'checked'; } ?> >List All
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Myaccount" name="users[]" <?php if(in_array('Myaccount',explode(',',$result['users']))){ echo 'checked'; } ?> >My Account
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="users[]" <?php if(in_array('Remove',explode(',',$result['users']))){ echo 'checked'; } ?>>Remove
    </label>
    
    </div>
    <div class="form-group">
			<label>Quiz</label><br>
			<label class="checkbox-inline">
      <input type="checkbox" value="Attempt" name="quiz[]" <?php if(in_array('Attempt',explode(',',$result['quiz']))){ echo 'checked'; } ?> >Attempt
    </label>	 
			 <label class="checkbox-inline">
      <input type="checkbox" value="Add" name="quiz[]" <?php if(in_array('Add',explode(',',$result['quiz']))){ echo 'checked'; } ?> >Add
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Edit" name="quiz[]" <?php if(in_array('Edit',explode(',',$result['quiz']))){ echo 'checked'; } ?> >Edit
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="View" name="quiz[]" <?php if(in_array('View',explode(',',$result['quiz']))){ echo 'checked'; } ?> >view
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Assign" name="quiz[]" <?php if(in_array('Assign',explode(',',$result['quiz']))){ echo 'checked'; } ?> >Assign
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List" name="quiz[]" <?php if(in_array('List',explode(',',$result['quiz']))){ echo 'checked'; } ?> >List 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="quiz[]" <?php if(in_array('List_all',explode(',',$result['quiz']))){ echo 'checked'; } ?> >List All
    </label>
    
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="quiz[]" <?php if(in_array('Remove',explode(',',$result['quiz']))){ echo 'checked'; } ?> >Remove
    </label>
    
    </div>
    
    
    <div class="form-group">
     <label>Result</label><br>
			
		
    <label class="checkbox-inline">
      <input type="checkbox" value="View" name="result[]"  <?php if(in_array('View',explode(',',$result['results']))){ echo 'checked'; } ?> >view
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List" name="result[]"  <?php if(in_array('List',explode(',',$result['results']))){ echo 'checked'; } ?> >List 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="result[]"  <?php if(in_array('List_all',explode(',',$result['results']))){ echo 'checked'; } ?> >List All
    </label>
   
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="result[]"  <?php if(in_array('Remove',explode(',',$result['results']))){ echo 'checked'; } ?> >Remove
    </label>
    
    </div>
    <div class="form-group">
        <label>Questions</label><br>
			
       <label class="checkbox-inline">
      <input type="checkbox" value="Add" name="questions[]" <?php if(in_array('Add',explode(',',$result['questions']))){ echo 'checked'; } ?> >Add
    </label>
       <label class="checkbox-inline">
      <input type="checkbox" value="Edit" name="questions[]" <?php if(in_array('Edit',explode(',',$result['questions']))){ echo 'checked'; } ?> >Edit
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="View" name="questions[]"  <?php if(in_array('View',explode(',',$result['questions']))){ echo 'checked'; } ?> >view
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="list" name="questions[]" <?php if(in_array('list',explode(',',$result['questions']))){ echo 'checked'; } ?> >List 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="questions[]" <?php if(in_array('List_all',explode(',',$result['questions']))){ echo 'checked'; } ?> >List All
    </label>
    
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="questions[]" <?php if(in_array('Remove',explode(',',$result['questions']))){ echo 'checked'; } ?> >Remove
    </label>
    </div> 
    
    
    
    
    
    
    
    
        <div class="form-group">
        <label><?php echo $this->lang->line('social_group');?> </label><br>
			
       <label class="checkbox-inline">
      <input type="checkbox" value="Add" name="social_group[]" <?php if(in_array('Add',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Add
    </label>
       <label class="checkbox-inline">
      <input type="checkbox" value="Edit" name="social_group[]" <?php if(in_array('Edit',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Edit
    </label>
      <label class="checkbox-inline">
      <input type="checkbox" value="Edit_all" name="social_group[]" <?php if(in_array('Edit_all',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Edit All
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Join" name="social_group[]"  <?php if(in_array('Join',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Join
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="social_group[]" <?php if(in_array('Remove',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Remove 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove_all" name="social_group[]" <?php if(in_array('Remove_all',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Remove All
    </label>
    
      <label class="checkbox-inline">
      <input type="checkbox" value="Invite" name="social_group[]" <?php if(in_array('Invite',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Invite 
    </label>
  
     <label class="checkbox-inline">
      <input type="checkbox" value="Add_other" name="social_group[]" <?php if(in_array('Add_other',explode(',',$result['social_group']))){ echo 'checked'; } ?> >Add other 
    </label>
  
    </div> 
    
    
      <div class="form-group">
			<label>Study Material</label><br>
			 
			 <label class="checkbox-inline">
      <input type="checkbox" value="Add" name="study_material[]" <?php if(in_array('Add',explode(',',$result['study_material']))){ echo 'checked'; } ?> >Add
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Edit" name="study_material[]" <?php if(in_array('Edit',explode(',',$result['study_material']))){ echo 'checked'; } ?> >Edit
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="View" name="study_material[]" <?php if(in_array('View',explode(',',$result['study_material']))){ echo 'checked'; } ?> >view
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List" name="study_material[]" <?php if(in_array('List',explode(',',$result['study_material']))){ echo 'checked'; } ?> >List 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="study_material[]" <?php if(in_array('List_all',explode(',',$result['study_material']))){ echo 'checked'; } ?> >List All
    </label>
    
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="study_material[]" <?php if(in_array('Remove',explode(',',$result['study_material']))){ echo 'checked'; } ?> >Remove
    </label>
    
    </div>
   
      <div class="form-group">
			<label>Assignment</label><br>
			 
			 <label class="checkbox-inline">
      <input type="checkbox" value="Add" name="assignment[]" <?php if(in_array('Add',explode(',',$result['assignment']))){ echo 'checked'; } ?> >Add
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Edit" name="assignment[]" <?php if(in_array('Edit',explode(',',$result['assignment']))){ echo 'checked'; } ?> >Edit
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="View" name="assignment[]" <?php if(in_array('View',explode(',',$result['assignment']))){ echo 'checked'; } ?> >view
      
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List" name="assignment[]" <?php if(in_array('List',explode(',',$result['assignment']))){ echo 'checked'; } ?> >List 
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="assignment[]" <?php if(in_array('List_all',explode(',',$result['assignment']))){ echo 'checked'; } ?> >List All
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="Submit" name="assignment[]" <?php if(in_array('Submit',explode(',',$result['assignment']))){ echo 'checked'; } ?> >Submit
    </label>
    
    <label class="checkbox-inline">
      <input type="checkbox" value="Remove" name="assignment[]" <?php if(in_array('Remove',explode(',',$result['assignment']))){ echo 'checked'; } ?> >Remove
    </label>
    
    </div>
   


      <div class="form-group">
			<label>Appointment</label><br>
			 
			 <label class="checkbox-inline">
      <input type="checkbox" value="List" name="appointment[]" <?php if(in_array('List',explode(',',$result['appointment']))){ echo 'checked'; } ?> >Create/List
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" value="List_all" name="appointment[]" <?php if(in_array('List_all',explode(',',$result['appointment']))){ echo 'checked'; } ?> >List all
    </label>
    
    
    </div>
   
        
   
    
     <div class="form-group">
        <label>Setting</label><br>
        <label class="checkbox-inline">
      <input type="checkbox" value="All" name="setting" <?php if(in_array('All',explode(',',$result['setting']))){ echo 'checked'; } ?> >All
        </div>
    
   
	<button class="btn btn-info" type="submit"><?php echo $this->lang->line('submit');?></button>
 
		</div>
</div>
 
 
 
 
</div>
      </form>
</div>

 



</div>
