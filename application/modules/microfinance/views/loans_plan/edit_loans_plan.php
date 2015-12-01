<?php
//loans_plan data
$row = $loans_plan->row();

$loans_plan_onames = $row->loans_plan_onames;
$loans_plan_fname = $row->loans_plan_fname;
$loans_plan_email = $row->loans_plan_email;
$loans_plan_phone = $row->loans_plan_phone;
//echo $gender_id;
//repopulate data if validation errors occur
$validation_error = validation_errors();
				
if(!empty($validation_error))
{
	$loans_plan_onames =set_value('loans_plan_onames');
	$loans_plan_fname =set_value('loans_plan_fname');
	$loans_plan_dob =set_value('loans_plan_dob');
	$loans_plan_email =set_value('loans_plan_email');
	$loans_plan_phone =set_value('loans_plan_phone');
	$loans_plan_address =set_value('loans_plan_address');
	$civil_status_id =set_value('civil_status_id');
	$loans_plan_locality =set_value('loans_plan_locality');
	$title_id =set_value('title_id');
	$gender_id =set_value('gender_id');
	$loans_plan_username =set_value('loans_plan_username');
	$loans_plan_kin_fname =set_value('loans_plan_kin_fname');
	$loans_plan_kin_onames =set_value('loans_plan_kin_onames');
	$loans_plan_kin_contact =set_value('loans_plan_kin_contact');
	$loans_plan_kin_address =set_value('loans_plan_kin_address');
	$kin_relationship_id =set_value('kin_relationship_id');
	$job_title_id =set_value('job_title_id');
	$staff_id =set_value('staff_id');
}
?>
		<div class="row">
        	<div class="col-md-2">
            	<img src="<?php echo base_url().'assets/img/avatar.jpg';?>" class="img-responsive img-thumbnail" />
            </div>
            
            <div class="col-md-7">
            	<h2><?php echo $loans_plan_fname.' '.$loans_plan_onames;?></h2>
                <p>
                    <i class="fa fa-phone"/></i>
                    <span id="mobile_phone"><?php echo $loans_plan_phone;?></span>
                    <i class="fa fa-envelope"/></i>
                    <span id="work_email"><?php echo $loans_plan_email;?></span>
                </p>
            </div>
            
        	<div class="col-md-3">
            	<a href="<?php echo site_url();?>microfinance/loans_plan" class="btn btn-info pull-right">Back to loans_plan</a>
            </div>
        </div>
        
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                    
                    <div class="row">
                    	<div class="col-md-12">
                        	<div class="tabs">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a class="text-center" data-toggle="tab" href="#general"><i class="fa fa-user"></i> General details</a>
									</li>
									<li>
										<a class="text-center" data-toggle="tab" href="#account"><i class="fa fa-lock"></i> Account details</a>
									</li>
									<li>
										<a class="text-center" data-toggle="tab" href="#emergency">Next of kin contacts</a>
									</li>
									<li>
										<a class="text-center" data-toggle="tab" href="#dependants">Dependants</a>
									</li>
									<li>
										<a class="text-center" data-toggle="tab" href="#job">Employer</a>
									</li>
									<li>
										<a class="text-center" data-toggle="tab" href="#history">History</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="general">
										<?php echo $this->load->view('edit/about', '', TRUE);?>
									</div>
									<div class="tab-pane" id="account">
										<?php echo $this->load->view('edit/account', '', TRUE);?>
									</div>
									<div class="tab-pane" id="emergency">
										<?php echo $this->load->view('edit/emergency', '', TRUE);?>
									</div>
									<div class="tab-pane" id="dependants">
										<?php echo $this->load->view('edit/dependants', '', TRUE);?>
									</div>
									<div class="tab-pane" id="job">
										<?php echo $this->load->view('edit/jobs', '', TRUE);?>
									</div>
									<div class="tab-pane" id="history">
										<?php echo $this->load->view('edit/history', '', TRUE);?>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </section>