<?php
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="'.site_url().'microfinance/loans/loans_plan_name/'.$order_method.'/'.$page.'">Name</a></th>
						<th><a href="'.site_url().'microfinance/loans/loans_plan_installment_type/'.$order_method.'/'.$page.'">Installment Type</a></th>
						<th><a href="'.site_url().'microfinance/loans/loans_plan_min_amount/'.$order_method.'/'.$page.'">Min amount</a></th>
						<th><a href="'.site_url().'microfinance/loans/loans_plan_max_amount/'.$order_method.'/'.$page.'">Max amount</a></th>
						<th>Custom Amount</th>
						<th><a href="'.site_url().'microfinance/loans/loans_plan_more/'.$order_method.'/'.$page.'">More Information</a></th>
						<th><a href="'.site_url().'microfinance/loans/loans_plan_status/'.$order_method.'/'.$page.'">Status</a></th>
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
				  
			';
			
			//get all administrators
			$administrators = $this->users_model->get_active_users();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$loans_plan_id = $row->loans_plan_id;
				$loans_plan_name = $row->loans_plan_name;
				$loans_plan_min_amount = number_format($row->loans_plan_min_amount, 0);
				$loans_plan_max_amount = number_format($row->loans_plan_max_amount, 0);
				$loans_plan_status = $row->loans_plan_status;
				$loans_plan_installment_type = $row->loans_plan_installment_type;
				$loans_plan_custom_amount = $row->loans_plan_custom_amount;
				$loans_plan_grace_period_min = $row->loans_plan_grace_period_min;
				$loans_plan_grace_period_max = $row->loans_plan_grace_period_max;
				$loans_plan_grace_period_default = $row->loans_plan_grace_period_default;
				$loans_plan_grace_period_interest = $row->loans_plan_grace_period_interest;
				$loans_plan_funding_line = $row->loans_plan_funding_line;
				$loans_plan_interest_scheme = $row->loans_plan_interest_scheme;
				$loans_plan_annual_min_interest = $row->loans_plan_annual_min_interest;
				$loans_plan_annual_max_interest = $row->loans_plan_annual_max_interest;
				$loans_plan_annual_custom_interest = $row->loans_plan_annual_custom_interest;
				$loans_plan_min_installments = $row->loans_plan_min_installments;
				$loans_plan_max_installments = $row->loans_plan_max_installments;
				$loans_plan_custom_installments = $row->loans_plan_custom_installments;

				// fees
				// $loans_plan_entry_fees_name = $row->loans_plan_entry_fees_name;
				// $loans_plan_entry_fees_min = $row->loans_plan_entry_fees_min;
				// $loans_plan_entry_fees_max = $row->loans_plan_entry_fees_max;
				// $loans_plan_entry_fees_value = $row->loans_plan_entry_fees_value;
				// $loans_plan_entry_fees_rate = $row->loans_plan_entry_fees_rate;

				// late fees
				$loans_plan_late_fee_on_total_min = $row->loans_plan_late_fee_on_total_min;
				$loans_plan_late_fee_on_total_max = $row->loans_plan_late_fee_on_total_max;
				$loans_plan_late_fee_on_total_custom_value = $row->loans_plan_late_fee_on_total_custom_value;

				$loans_plan_lfoop_min = $row->loans_plan_lfoop_min;
				$loans_plan_lfoop_max = $row->loans_plan_lfoop_max;
				$loans_plan_lfoop_custom_value = $row->loans_plan_lfoop_custom_value;

				$loans_plan_lfoolb_min = $row->loans_plan_lfoolb_min;
				$loans_plan_lfoolb_max = $row->loans_plan_lfoolb_max;
				$loans_plan_lfoolb_custom_value = $row->loans_plan_lfoolb_custom_value;	

				$loans_plan_lfooverdue_min = $row->loans_plan_lfooverdue_min;
				$loans_plan_lfooverdue_max = $row->loans_plan_lfooverdue_max;
				$loans_plan_lfooverdue_custom_value = $row->loans_plan_lfooverdue_custom_value;

				$apr_fees_min = $row->apr_fees_min;
				$apr_fees_max = $row->apr_fees_max;
				$apr_fees_custom_value = $row->apr_fees_custom_value;
				$atr_fees_min = $row->atr_fees_min;
				$atr_fees_max = $row->atr_fees_max;
				$atr_fees_custom_value = $row->atr_fees_custom_value;

				// line of credit
				$use_line_of_credit = $row->use_line_of_credit;
				$max_number_of_tranches = $row->max_number_of_tranches;
				$total_amout_of_loc_min = $row->total_amout_of_loc_min;
				$total_amout_of_loc_max = $row->total_amout_of_loc_max;
				$total_amout_of_loc_custom_value = $row->total_amout_of_loc_custom_value;
				$number_of_installments_min = $row->number_of_installments_min;
				$number_of_installments_max = $row->number_of_installments_max;
				$number_of_installments_custom_value = $row->number_of_installments_custom_value;

				//guarantees
				$use_gc = $row->use_gc;
				$min_gc = $row->min_gc;
				$set_separate_gc= $row->set_separate_gc;
				$min_guarantors = $row->min_guarantors;
				$min_collaterals = $row->min_collaterals;
				$use_compulsory_savings = $row->use_compulsory_savings;
				$compulsory_savings_min = $row->compulsory_savings_min;
				$compulsory_savings_max = $row->compulsory_savings_max;
				$compulsory_savings_custom_value = $row->compulsory_savings_custom_value;

				//credit insurance 
				$credit_insurance_min = $row->credit_insurance_min;
				$credit_insurance_max = $row->credit_insurance_max;
				$credit_insurance_custom_value = $row->credit_insurance_custom_value;

				//create deactivated status display
				if($loans_plan_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'microfinance/activate-loans-plan/'.$loans_plan_id.'" onclick="return confirm(\'Do you want to activate '.$loans_plan_name.'?\');" title="Activate '.$loans_plan_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($loans_plan_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'microfinance/deactivate-loans-plan/'.$loans_plan_id.'" onclick="return confirm(\'Do you want to deactivate '.$loans_plan_name.'?\');" title="Deactivate '.$loans_plan_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				if($use_line_of_credit == 1){
					$uloc = "checked";
				}else{
					$uloc="";
				};

				if ($use_gc) {
					$ugc = "checked";
				} else {		
					$ugc = "";
				}
				if($set_separate_gc){
					$ssg = "checked";
				}else{
					$ssg = "";
				}
				if ($use_compulsory_savings) {
					$ucs = "checked";
				} else {
					$ucs = "";
				}
				
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$loans_plan_name.'</td>
						<td>'.$loans_plan_installment_type.'</td>
						<td>'.$loans_plan_min_amount.'</td>
						<td>'.$loans_plan_max_amount.'</td>
						<td>'.$loans_plan_custom_amount.'</td>
						<td><a class="more" href="#more'.$loans_plan_id.'" data-toggle="modal">more</a>
							<div id="more'.$loans_plan_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">'.$loans_plan_name.'</h4>
										</div>
										<div class="modal-body">
										<ul class="nav nav-tabs">
											<li role="presentation" class="active"><a href="#general" data-toggle="tab">General</a></li>
											<li role="presentation" ><a href="#fees" data-toggle="tab">Fees</a></li>
											<li role="presentation"><a href="#exotic" data-toggle="tab">Exotic Installments</a></li>
											<li role="presentation"><a href="#line" data-toggle="tab">Line of Credit</a></li>
											<li role="presentation"><a href="#guarantee" data-toggle="tab">Guarantees</a></li>
											<li role="presentation"><a href="#credit" data-toggle="tab">Credit</a></li>
										</ul>
	
										<!-- Tab panes -->
										  <div class="tab-content">
										  	<div role="tabpanel" class="tab-pane active" id="general">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h3 class="panel-title">Grace Period</h3>
													</div>
													<div class="panel-body">
												  		<table class="table table-bordered">
												  			<thead>
																<tr>
																  <th>
																		Grace Period Mininum
																  </th>
																   <th>
																		Grace Period Maximum
																  </th>
																  <th>
																  		Grace Period Custom/Default
																  </th>
																  <th>
																  		Charge Interest over grace period
																  </th>
																  
															  </tr>
												  			</thead>
												  			<tbody>
												  				<tr>
												  					<td>'.$loans_plan_grace_period_min.'</td>
																	<td>'.$loans_plan_grace_period_max.'</td>
																	<td>'.$loans_plan_grace_period_default.'</td>
																	<td>'.$loans_plan_grace_period_interest.'</td>
												  				</tr>
												  			</tbody>
												  		</table>
												  	</div>
												</div>
												<div class="panel panel-default">
													<div class="panel-heading">
														<h3 class="panel-title">Interest Scheme and Funding Line</h3>
													</div>
													<div class="panel-body">
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th>Interest Scheme</th>
																	<th>Funding Line</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>'.$loans_plan_interest_scheme.'</td>
																	<td>'.$loans_plan_funding_line.'</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="panel panel-default">
													<div class="panel-heading">
														<h3 class="panel-title">Annual Interest</h3>
													</div>
													<div class="panel-body">
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th>Annual Minimum Interest</th>
																	<th>Annual Maximum Interest</th>
																	<th>Annual Custom Interest</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>'.$loans_plan_annual_min_interest.'</td>
																	<td>'.$loans_plan_annual_max_interest.'</td>
																	<td>'.$loans_plan_annual_custom_interest.'</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="panel panel-default">
													<div class="panel-heading">
														<h3 class="panel-title">Number of Installments</h3>
													</div>
													<div class="panel-body">
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th>Minimum Installments</th>
																	<th>Maximum Installments</th>
																	<th>Custom Installments</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>'.$loans_plan_min_installments.'</td>
																	<td>'.$loans_plan_max_installments.'</td>
																	<td>'.$loans_plan_custom_installments.'</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>  	  	
										  	</div>

										    <div role="tabpanel" class="tab-pane" id="fees">
												<div class="panel panel-default">
												  <div class="panel-heading">
												    <h3 class="panel-title">Entry Fees</h3>
												  </div>
												  <div class="panel-body">
												     <table class="table table-bordered">
													 <thead>
													  <tr>
														  <th>
																Name
														  </th>
														   <th>
																Min
														  </th>
														  <th>
														  		Max
														  </th>
														  <th>
														  		Value
														  </th>
														  <th>
														  		Rate
														  </th>
													  </tr>
													  </thead>
													  <tbody>
														  <tr>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														  </tr>	
													  </tbody>		
													</table>
												  </div>
												</div>
												<div class="panel panel-default">
												  <div class="panel-heading">
												    <h3 class="panel-title">Late Fees (% of base per day)</h3>
												  </div>
												  <div class="panel-body">
												   <table class="table table-bordered">
													 <thead>
													  <tr>
													  	  <th>
													  	  		Name
													  	  </th>
														  <th>
																Minimum
														  </th>
														  <th>
														  		Maximum
														  </th>
														  <th>
														  		Custom Value
														  </th>
													  </tr>
													  </thead>
													  <tbody>
														  <tr>
														  	<td>On Total Loan Amount</td>
															<td>'.$loans_plan_late_fee_on_total_min.'</td>
															<td>'.$loans_plan_late_fee_on_total_max.'</td>
															<td>'.$loans_plan_late_fee_on_total_custom_value.'</td>
														  </tr>
														   <tr>
														  	<td>On Overdue Principal</td>
															<td>'.$loans_plan_lfoop_min.'</td>
															<td>'.$loans_plan_lfoop_max.'</td>
															<td>'.$loans_plan_lfoop_custom_value.'</td>
														  </tr>	
														   <tr>
														  	<td>On OLB*</td>
															<td>'.$loans_plan_lfoolb_min.'</td>
															<td>'.$loans_plan_lfoop_max.'</td>
															<td>'.$loans_plan_lfoop_custom_value.'</td>
														  </tr>	
														   <tr>
														  	<td>On Overdue <interest></interest></td>
															<td>'.$loans_plan_lfooverdue_min.'</td>
															<td>'.$loans_plan_lfooverdue_max.'</td>
															<td>'.$loans_plan_lfooverdue_custom_value.'</td>
														  </tr>		
													  </tbody>		
													</table>
												  </div>
												</div>
												
												<div class="panel panel-default">
												  <div class="panel-heading">
												    <h3 class="panel-title">Anticipated Total Repayment (ATR) and Anticipated Partial Repayment (APR) Fees</h3>
												  </div>
												  <div class="panel-body">
												     <table class="table table-bordered">
													 <thead>
													  <tr>
													  	  <th> Name</th>
														  <th>
																Minimum
														  </th>
														  <th>
														  		Maximum
														  </th>
														  <th>
														  		Custom Value
														  </th>
														  <th>
														  		Base for Fees*
														  </th>
													  </tr>
													  </thead>
													  <tbody>
														  <tr>
															<td>ATR fees</td>
															<td>'.$atr_fees_min.'</td>
															<td>'.$atr_fees_max.'</td>
															<td>'.$atr_fees_custom_value.'</td>
															<td></td>
														  </tr>
														  <tr>
															<td>APR fees</td>
															<td>'.$apr_fees_min.'</td>
															<td>'.$apr_fees_max.'</td>
															<td>'.$apr_fees_custom_value.'</td>
															<td></td>
														  </tr>		
													  </tbody>		
													</table>	
												  </div>
												</div>

										    </div>
										    <div role="tabpanel" class="tab-pane" id="exotic">
												<fieldset>
													<legend>Exotic Installments</legend>
													<div class="form-group">
													<label for="ch_exotic">
													Use exotic installments
														<input type="checkbox" name="ch_exotic">
													</label>
													</div>
													<div class="form-group">
														<label for="ch_exotic">
														Allow flexible schedules
															<input type="checkbox" name="ch_exotic">
														</label>
													</div>
												</fieldset>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="line">
												<fieldset>
													<div class="form-group">
														<label for="ch_exotic">
															<input type="checkbox" name="ch_useline" '.$uloc.'>
															Use line of credit
														</label>
													</div>
												</fieldset>
												<div class="form-horizontal"></div>
												<fieldset>
													<legend>Maximum number of tranches</legend>
													<div class="form-group">
														<label class="col-sm-6 control-label">Number of drawings under LOC	</label>
														<div class="col-sm-2">
														'.$max_number_of_tranches.'
														</div>
													</div>	
												</fieldset>
												<div class="panel panel-default">
												  <div class="panel-heading">
												    <h3 class="panel-title">Total amount of the line of credit (including disbursed amount)</h3>
												  </div>
												  <div class="panel-body">
												    <table class="table table-bordered">
													 <thead>
													  <tr>
														  <th>
																Minimum
														  </th>
														  <th>
														  		Maximum
														  </th>
														  <th>
														  		Custom Value
														  </th>
													  </tr>
													  </thead>
													  <tbody>
														  <tr>
															<td>'.$total_amout_of_loc_min.'</td>
															<td>'.$total_amout_of_loc_max.'</td>
															<td>'.$total_amout_of_loc_custom_value.'</td>
														  </tr>	
													  </tbody>		
													</table>
												  </div>
												</div>
												<div class="panel panel-default">
												  <div class="panel-heading">
												    <h3 class="panel-title">Tranche Maturity (Number of installements)</h3>
												  </div>
												  <div class="panel-body">
												    <table class="table table-bordered">
													 <thead>
													  <tr>
														  <th>
																Minimum
														  </th>
														  <th>
														  		Maximum
														  </th>
														  <th>
														  		Custom Value
														  </th>
													  </tr>
													  </thead>
													  <tbody>
														  <tr>
															<td>'.$number_of_installments_min.'</td>
															<td>'.$number_of_installments_max.'</td>
															<td>'.$number_of_installments_custom_value.'</td>
														  </tr>	
													  </tbody>		
													</table>
												  </div>
												</div>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="guarantee">
										    	<table class="table ">
										    		
										    		<tbody>
										    			<tr>
										    				<td>
																Use guarantees and collaterals
										    				</td>
										    				<td>
										    					<input class="form-control"  type="checkbox" name="ch_use_gc" '.$ugc.'>
										    				</td>
										    				
										    			</tr>
										    			<tr>
										    				<td>
										    					Minimum percentage of guarantors + collaterals
										    				</td>
										    				<td>
										    				'.$min_gc.'
										    				</td>
										    			</tr>
										    		</tbody>
										    	</table>
										    	<table class="table ">
										    		
										    		<tbody>
										    			<tr>
										    				<td>
																Set separate values for guarantees and collaterals
										    				</td>
										    				<td>
										    					<input class="form-control"  type="checkbox" name="ch_set_separate_gc" '.$ssg.'>
										    				</td>
										    				
										    			</tr>
										    			<tr>
										    				<td>
										    					Minimum percentage for guarantors
										    				</td>
										    				<td>
										    				'.$min_guarantors.'
										    				</td>
										    			</tr>
										    			<tr>
										    				<td>
										    					Minimum percentage for collaterals
										    				</td>
										    				<td>
										    				'.$min_collaterals.'
										    				</td>
										    			</tr>
										    		</tbody>
										    	</table>
										    	<table class="table table-bordered">
										    		<tbody>
														<tr>
										    				<td>
																Use compulsory savings
										    				</td>
										    				<td>
										    					<input class="form-control"  type="checkbox" name="ch_use_compulsory_saving" '.$ucs.'>
										    				</td>
										    				
										    				
										    			</tr>
										    		</tbody>

										    	</table>
										    	<table class="table table-bordered">
										    	<caption>Compulsory savings amount</caption>
										    		<thead>
										    			<tr>
															<th>Min</th>		
															<th>Max</th>		
															<th>Custom Value</th>		
										    			</tr>
										    		</thead>	
										    		<tbody>
													
										    			<tr>
										    				<td>
										    				'.$compulsory_savings_min.'
										    				</td>
										    				<td>
										    				'.$compulsory_savings_max.'
										    				</td>
										    				<td>
										    				'.$compulsory_savings_custom_value.' 
										    				</td>
										    			</tr>
										    		</tbody>
										    	</table>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="credit">
												<div class="panel panel-default">
												  <div class="panel-heading">
												    <h3 class="panel-title">Credit Insurance</h3>
												  </div>
												  <div class="panel-body">
												    <table class="table table-bordered">
													<thead>
										    			<tr>
															<th>Min</th>		
															<th>Max</th>		
															<th>Custom Value</th>		
										    			</tr>
										    		</thead>
										    		<tbody>
													
										    			<tr>
										    				<td>
										    				'.$credit_insurance_min.'
										    				</td>
										    				<td>
										    				'.$credit_insurance_max.'
										    				</td>
										    				<td>
										    				'.$credit_insurance_custom_value.'
										    				</td>
										    			</tr>
										    		</tbody>	
												    </table>
												  </div>
												</div>
										    </div>

										  </div>
										</div>
									</div>
								</div>

							</div>

						</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'microfinance/edit-loans-plan/'.$loans_plan_id.'" class="btn btn-sm btn-success" title="Edit '.$loans_plan_name.'"><i class="fa fa-pencil"></i></a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'microfinance/delete-loans-plan/'.$loans_plan_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$loans_plan_name.'?\');" title="Delete '.$loans_plan_name.'"><i class="fa fa-trash"></i></a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no loans plans";
		}
?>

						<loans_plan class="panel">
							<header class="panel-heading">						
								<h2 class="panel-title"><?php echo $title;?></h2>
							</header>
							<div class="panel-body">
                            	<?php
                                $success = $this->session->userdata('success_message');
		
								if(!empty($success))
								{
									echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
									$this->session->unset_userdata('success_message');
								}
								
								$error = $this->session->userdata('error_message');
								
								if(!empty($error))
								{
									echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
									$this->session->unset_userdata('error_message');
								}
								?>
                            	<div class="row" style="margin-bottom:20px;">
                                    <div class="col-lg-2 col-lg-offset-8">
                                        <a href="<?php echo site_url();?>microfinance/export-loans-plan" class="btn btn-sm btn-success pull-right">Export</a>
                                    </div>
                                    <div class="col-lg-2">
                                    	<a href="<?php echo site_url();?>microfinance/add-loans-plan" class="btn btn-sm btn-info pull-right">Add loans plan</a>
                                    </div>
                                </div>
								<div class="table-responsive">
                                	
									<?php echo $result;?>
							
                                </div>
							</div>
                            <div class="panel-footer">
                            	<?php if(isset($links)){echo $links;}?>
                            </div>
						</loans_plan>
