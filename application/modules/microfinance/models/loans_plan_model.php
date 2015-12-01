<?php

class Loans_plan_model extends CI_Model 
{	


	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}
	
	/*
	*	Retrieve all loans_plan
	*
	*/
	public function all_loans_plan()
	{
		$this->db->where('loans_plan_status = 1');
		$query = $this->db->get('loans_plan');
		
		return $query;
	}
	/*
	*	Retrieve all compounding_periods
	*
	*/
	public function get_compounding_periods()
	{
		$query = $this->db->get('compounding_period');
		
		return $query;
	}

	/*
	*	Retrieve all interest scheme
	*
	*/
	public function get_interest_scheme()
	{
		$query = $this->db->get('loans_plan_interest_scheme');
		// print_r($query);
		return $query;
	}
	
	public function get_installment_types()
	{
		$query = $this->db->get('loan_plan_installment_type');
		return $query;
	}
	/*
	*	Retrieve all parent loans_plan
	*
	*/
	public function all_parent_loans_plan($order = 'loans_plan_name')
	{
		$this->db->where('loans_plan_status = 1 AND loans_plan_parent = 0');
		$this->db->order_by($order, 'ASC');
		$query = $this->db->get('loans_plan');
		
		return $query;
	}
	/*
	*	Retrieve all children loans_plan
	*
	*/
	public function all_child_loans_plan()
	{
		$this->db->where('loans_plan_status = 1 AND loans_plan_parent > 0');
		$this->db->order_by('loans_plan_name', 'ASC');
		$query = $this->db->get('loans_plan');
		
		return $query;
	}
	
	/*
	*	Retrieve all loans_plan
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_loans_plan($table, $where, $per_page, $page, $order = 'loans_plan_name', $order_method = 'ASC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('loans_plan.*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new loans_plan
	*	@param string $image_name
	*
	*/
	public function add_loans_plan()
	{
		$data = array(
			'loans_plan_name'                           =>$this->input->post('loans_plan_name'),
			'loans_plan_installment_type'               =>$this->input->post('installment_type'),
			'loans_plan_grace_period_min'               =>$this->input->post('grace_period_minimum'),
			'loans_plan_grace_period_max'               =>$this->input->post('grace_period_maximum'),
			'loans_plan_grace_period_default'           =>$this->input->post('grace_period_default'),
			'loans_plan_grace_period_interest'          =>$this->input->post('charge_interest_over_grace_period'),
			'loans_plan_interest_scheme'                =>$this->input->post('interest_scheme'),
			'loans_plan_funding_line'                   =>$this->input->post('funding_line'),
			'loans_plan_min_amount'                     =>$this->input->post('minimum_loan_amount'),
			'loans_plan_max_amount'                     =>$this->input->post('maximum_loan_amount'),
			'loans_plan_custom_amount'                  =>$this->input->post('custom_loan_amount'),
			'loans_plan_annual_min_interest'            =>$this->input->post('annual_minimum_interest'),
			'loans_plan_annual_max_interest'            =>$this->input->post('annual_maximum_interest'),
			'loans_plan_annual_custom_interest'         =>$this->input->post('annual_custom_interest'),
			'loans_plan_min_installments'               =>$this->input->post('minimum_number_of_installments'),
			'loans_plan_max_installments'               =>$this->input->post('maximum_number_of_installments'),
			'loans_plan_custom_installments'            =>$this->input->post('custom_number_of_installments'),
			// 'loans_plan_entry_fees_id'               =>$this->session->userdata('personnel_id'),
			'loans_plan_late_fee_on_total_min'          =>$this->input->post('minimum_late_fee_on_total_loan'),
			'loans_plan_late_fee_on_total_max'          =>$this->input->post('maximum_late_fee_on_total_loan'),
			'loans_plan_late_fee_on_total_custom_value' =>$this->input->post('custom_late_fee_on_total_loan'),
			'loans_plan_lfoop_min'                      =>$this->input->post('minimum_late_fee_on_overdue_principal'),
			'loans_plan_lfoop_max'                      =>$this->input->post('maximum_late_fee_on_overdue_principal'),
			'loans_plan_lfoop_custom_value'             =>$this->input->post('custom_late_fee_on_overdue_principal'),
			'loans_plan_lfoolb_min'                     =>$this->input->post('minimum_late_fee_on_olb'),
			'loans_plan_lfoolb_max'                     =>$this->input->post('maximum_late_fee_on_olb'),
			'loans_plan_lfoolb_custom_value'            =>$this->input->post('custom_late_fee_on_olb'),
			'loans_plan_lfooverdue_min'                 =>$this->input->post('minimum_late_fee_on_overdue_interest'),
			'loans_plan_lfooverdue_max'                 =>$this->input->post('maximum_late_fee_on_overdue_interest'),
			'loans_plan_lfooverdue_custom_value'        =>$this->input->post('custom_late_fee_on_overdue_interest'),
			'atr_fees_min'                              =>$this->input->post('atr_minimum_fees'),
			'atr_fees_max'                              =>$this->input->post('atr_maximum_fees'),
			'atr_fees_custom_value'                     =>$this->input->post('atr_custom_fees'),
			'apr_fees_min'                              =>$this->input->post('apr_minimum_fees'),
			'apr_fees_max'                              =>$this->input->post('apr_maximum_fees'),
			'apr_fees_custom_value'                     =>$this->input->post('apr_custom_fees'),
			'use_line_of_credit'                        =>$this->input->post('use_line_of_credit'),
			'max_number_of_tranches'                    =>$this->input->post('maximum_number_of_tranches'),
			'min_number_of_tranches'                    =>$this->input->post('minimum_number_of_tranches'),
			'custom_number_of_tranches'                 =>$this->input->post('custom_number_of_tranches'),
			'total_amout_of_loc_min'                    =>$this->input->post('minimum_line_of_credit_amount'),
			'total_amout_of_loc_max'                    =>$this->input->post('maximum_line_of_credit_amount'),
			'total_amout_of_loc_custom_value'           =>$this->input->post('custom_line_of_credit_amount'),
			'number_of_installments_min'                =>$this->input->post('minimum_number_of_installments'),
			'number_of_installments_max'                =>$this->input->post('maximum_number_of_installments'),
			'number_of_installments_custom_value'       =>$this->input->post('custom_number_of_installments'),
			// 'credit_insurance_min'                   =>$this->session->userdata('personnel_id'),
			// 'credit_insurance_max'                   =>$this->session->userdata('personnel_id'),
			// 'credit_insurance_custom_value'          =>$this->session->userdata('personnel_id'),
			'use_gc'                                    =>$this->input->post('use_gc'),
			'min_gc'                                    =>$this->input->post('min_gc'),
			'set_separate_gc'                           =>$this->input->post('set_separate_gc'),
			'min_guarantors'                            =>$this->input->post('min_guarantors'),
			'min_collaterals'                           =>$this->input->post('min_collateral'),
			'use_compulsory_savings'                    =>$this->input->post('use_compulsory_savings'),
			'compulsory_savings_min'                    =>$this->input->post('compulsory_savings_minimum'),
			'compulsory_savings_max'                    =>$this->input->post('compulsory_savings_maximum'),
			'compulsory_savings_custom_value'           =>$this->input->post('compulsory_savings_custom'),

		);
		
		if($this->db->insert('loans_plan', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing loans_plan
	*	@param string $image_name
	*	@param int $loans_plan_id
	*
	*/
	public function edit_loans_plan($loans_plan_id)
	{
		$data = array(
			'loans_plan_name'=>$this->input->post('loans_plan_name'),
			'loans_plan_min_opening_balance'=>$this->input->post('loans_plan_min_opening_balance'),
			'loans_plan_min_account_balance'=>$this->input->post('loans_plan_min_account_balance'),
			'charge_withdrawal'=>$this->input->post('charge_withdrawal'),
			'compounding_period_id'=>$this->input->post('compounding_period_id'),
			'modified_by'=>$this->session->userdata('personnel_id')
		);
		
		$this->db->where('loans_plan_id', $loans_plan_id);
		if($this->db->update('loans_plan', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single loans_plan's children
	*	@param int $loans_plan_id
	*
	*/
	public function get_sub_loans_plan($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('loans_plan');
		$this->db->select('*');
		$this->db->where('loans_plan_parent = '.$loans_plan_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single loans_plan's details
	*	@param int $loans_plan_id
	*
	*/
	public function get_loans_plan($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('loans_plan');
		$this->db->select('*');
		$this->db->where('loans_plan_id = '.$loans_plan_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing loans_plan
	*	@param int $loans_plan_id
	*
	*/
	public function delete_loans_plan($loans_plan_id)
	{
		//delete children
		if($this->db->delete('loans_plan', array('loans_plan_parent' => $loans_plan_id)))
		{
			//delete parent
			if($this->db->delete('loans_plan', array('loans_plan_id' => $loans_plan_id)))
			{
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated loans_plan
	*	@param int $loans_plan_id
	*
	*/
	public function activate_loans_plan($loans_plan_id)
	{
		$data = array(
				'loans_plan_status' => 1
			);
		$this->db->where('loans_plan_id', $loans_plan_id);
		

		if($this->db->update('loans_plan', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated loans_plan
	*	@param int $loans_plan_id
	*
	*/
	public function deactivate_loans_plan($loans_plan_id)
	{
		$data = array(
				'loans_plan_status' => 0
			);
		$this->db->where('loans_plan_id', $loans_plan_id);
		
		if($this->db->update('loans_plan', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve gender
	*
	*/
	public function get_gender()
	{
		$this->db->order_by('gender_name');
		$query = $this->db->get('gender');
		
		return $query;
	}
	
	/*
	*	Retrieve title
	*
	*/
	public function get_title()
	{
		$this->db->order_by('title_name');
		$query = $this->db->get('title');
		
		return $query;
	}
	
	/*
	*	Retrieve civil_status
	*
	*/
	public function get_civil_status()
	{
		$this->db->order_by('civil_status_name');
		$query = $this->db->get('civil_status');
		
		return $query;
	}
	
	/*
	*	Retrieve religion
	*
	*/
	public function get_religion()
	{
		$this->db->order_by('religion_name');
		$query = $this->db->get('religion');
		
		return $query;
	}
	
	/*
	*	Retrieve relationship
	*
	*/
	public function get_relationship()
	{
		$this->db->order_by('relationship_name');
		$query = $this->db->get('relationship');
		
		return $query;
	}
	
	/*
	*	Select get_job_titles
	*
	*/
	public function get_job_titles()
	{
		$this->db->select('*');
		$this->db->order_by('job_title_name', 'ASC');
		$query = $this->db->get('job_title');
		
		return $query;
	}
	
	/*
	*	get a single loans_plan's details
	*	@param int $loans_plan_id
	*
	*/
	public function get_emergency_contacts($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('loans_plan_emergency');
		$this->db->select('*');
		$this->db->where(array('loans_plan_emergency.loans_plan_id' => $loans_plan_id, 'loans_plan_emergency.relationship_id' => 'relationship.relationship_id'));
		$this->db->order_by('loans_plan_emergency_fname');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single loans_plan's details
	*	@param int $loans_plan_id
	*
	*/
	public function get_loans_plan_dependants($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('loans_plan_dependant');
		$this->db->select('*');
		$this->db->where(array('loans_plan_dependant.loans_plan_id' => $loans_plan_id, 'loans_plan_dependant.relationship_id' => 'relationship.relationship_id'));
		$this->db->order_by('loans_plan_dependant_fname');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single loans_plan's details
	*	@param int $loans_plan_id
	*
	*/
	public function get_loans_plan_jobs($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('loans_plan_job');
		$this->db->select('loans_plan_job.*');
		$this->db->order_by('employment_date', 'DESC');
		$this->db->where(array('loans_plan_job.loans_plan_id' => $loans_plan_id));
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_leave_types()
	{
		$table = "leave_type";
		$where = "leave_type_status = 0";
		$items = "leave_type_id, leave_type_name";
		$order = "leave_type_name";
		
		$this->db->where($where);
		$this->db->order_by($order);
		$result = $this->db->get($table);
		
		return $result;
	}
	
	/*
	*	get a single loans_plan's leave details
	*	@param int $loans_plan_id
	*
	*/
	public function get_loans_plan_leave($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('leave_duration, leave_type');
		$this->db->select('leave_duration.*, leave_type.leave_type_name');
		$this->db->order_by('start_date', 'DESC');
		$this->db->where(array('leave_duration.loans_plan_id' => $loans_plan_id, 'leave_duration.leave_type_id' => 'leave_type.leave_type_id'));
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single loans_plan's roles
	*	@param int $loans_plan_id
	*
	*/
	public function get_loans_plan_roles($loans_plan_id)
	{
		//retrieve all users
		$this->db->from('loans_plan_section, section');
		$this->db->select('loans_plan_section.*, section.section_name, section.section_position');
		$this->db->order_by('section_position', 'ASC');
		$this->db->where(array('loans_plan_section.loans_plan_id' => $loans_plan_id, 'loans_plan_section.section_id' => 'section.section_id'));
		$query = $this->db->get();
		
		return $query;
	}
}
?>