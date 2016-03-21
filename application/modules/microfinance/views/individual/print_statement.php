<?php

//individual data
$row = $individual->row();

$individual_lname = $row->individual_lname;
$individual_mname = $row->individual_mname;
$individual_fname = $row->individual_fname;
$individual_email = $row->individual_email;
$individual_phone = $row->individual_phone;
$individual_number = $row->individual_number;
$outstanding_loan = $row->outstanding_loan;
$total_savings = $row->total_savings;

$today = date('jS F Y H:i a',strtotime(date("Y:m:d h:i:s")));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $contacts['company_name'];?> | Invoice</title>
        <!-- For mobile content -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- IE Support -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap/css/bootstrap.css" media="all"/>
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/stylesheets/theme-custom.css" media="all"/>
        <style type="text/css">
			.receipt_spacing{letter-spacing:0px; font-size: 12px;}
			.center-align{margin:0 auto; text-align:center;}
			
			.receipt_bottom_border{border-bottom: #888888 medium solid;}
			.row .col-md-12 table {
				border:solid #000 !important;
				border-width:1px 0 0 1px !important;
				font-size:10px;
			}
			.row .col-md-12 th, .row .col-md-12 td {
				border:solid #000 !important;
				border-width:0 1px 1px 0 !important;
			}
			.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td
			{
				 padding: 2px;
			}
			
			.row .col-md-12 .title-item{float:left;width: 130px; font-weight:bold; text-align:right; padding-right: 20px;}
			.title-img{float:left; padding-left:30px;}
			img.logo{max-height:70px; margin:0 auto;}
		</style>
    </head>
    <body class="receipt_spacing">
    	<div class="row">
        	<div class="col-xs-12">
            	<img src="<?php echo base_url().'assets/logo/'.$contacts['logo'];?>" alt="<?php echo $contacts['company_name'];?>" class="img-responsive logo"/>
            </div>
        </div>
    	<div class="row">
        	<div class="col-md-12 center-align receipt_bottom_border">
            	<strong>
                	<?php echo $contacts['company_name'];?><br/>
                    P.O. Box <?php echo $contacts['address'];?> <?php echo $contacts['post_code'];?>, <?php echo $contacts['city'];?><br/>
                    E-mail: <?php echo $contacts['email'];?>. Tel : <?php echo $contacts['phone'];?><br/>
                    <?php echo $contacts['location'];?>, <?php echo $contacts['building'];?>, <?php echo $contacts['floor'];?><br/>
                </strong>
            </div>
        </div>
        
      <div class="row receipt_bottom_border" >
        	<div class="col-md-12 center-align">
            	<strong>Member Statement</strong>
            </div>
        </div>
        
        <!-- Patient Details -->
    	<div class="row receipt_bottom_border" style="margin-bottom: 10px;">
        	<div class="col-md-4 pull-left">
            	<div class="row">
                	<div class="col-md-12">
                    	
                    	<div class="title-item">Member Name:</div>
                        
                    	<?php echo $individual_fname.' '.$individual_mname.' '.$individual_lname; ?>
                    </div>
                </div>
            	
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="title-item">Member Number:</div> 
                        
                    	<?php echo $individual_number; ?>
                    </div>
                </div>
            
            </div>
            
        	<div class="col-md-4 pull-right">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="title-item">Statement Date:</div>
                        
                    	<?php echo $today; ?>
                    </div>
                </div>
            </div>
        </div>
        
    	<div class="row receipt_bottom_border">
        	<div class="col-md-12 center-align">
            	<strong>PARTICULARS</strong>
            </div>
        </div>
        
    	<div class="row">
        	<div class="col-md-12">
            	
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Savings Account Statement</h2>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo site_url().'microfinance/individual/print_statement/'.$individual_id;?>" target="_blank" class="btn btn-primary">Print</a>
                        <!-- Adding Errors -->
                        <table class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="text-align:center" rowspan=2>#</th>
                                    <th style="text-align:center" rowspan=2>Date</th>
                                    <th rowspan=2>Type</th>
                                    <th colspan=2 style="text-align:center;">Amount</th>
                                </tr>
                                <tr>
                                    <th style="text-align:left">Debit</th>
                                    <th style="text-align:left">Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td>Savings balance b/f</td>
                                    <td></td>
                                    <td><?php echo number_format($total_savings, 2);?></td>
                                </tr> 
                                
                                <?php
                                //get all savings before date
                                $total_credit = $total_savings;
                                $result = '';
                                if($savings_payments->num_rows() > 0)
                                {
                                    $count = 1;
                                    $total_debit = 0;
                                    $total_payments = 0;
                                    foreach ($savings_payments->result() as $row2)
                                    {
                                        $savings_payment_id = $row2->savings_payment_id;
                                        $payment_amount = $row2->payment_amount;
                                        $payment_date = $row2->payment_date;
                                        $total_payments += $payment_amount;
                                        
                                        $count++;
                                        $result .= 
                                        '
                                            <tr>
                                                <td>'.$count.'</td>
                                                <td>'.date('d M Y',strtotime($payment_date)).' </td>
                                                <td>Shares deposit</td>
                                                <td></td>
                                                <td>'.number_format($payment_amount, 2).'</td>
                                            </tr> 
                                        ';
                                        $total_credit += $payment_amount;
                                    }
                                        
                                    //display loan
                                    $result .= 
                                    '
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th>Total</th>
                                            <td></td>
                                            <th>'.number_format($total_credit, 2).'</th>
                                        </tr>
                                    ';
                                }
                            
                                echo $result;
                                ?>
                            </table>
                    </div>
                </section>
                            
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Loans Account Statement</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Adding Errors -->
                        <table class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="text-align:center" rowspan=2>#</th>
                                    <th style="text-align:center" rowspan=2>Date</th>
                                    <th rowspan=2>Type</th>
                                    <th colspan=4 style="text-align:center;">Amount</th>
                                </tr>
                                <tr>
                                    <th style="text-align:left">Debit</th>
                                    <th colspan=3 style="text-align:center">Credit</th>
                                </tr>
                                <tr>
                                    <th colspan=4 style="text-align:left"></th>
                                    <th style="text-align:left">Repayment</th>
                                    <th style="text-align:left">Interest</th>
                                    <th style="text-align:left">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td>Loan balance b/f</td>
                                    <td><?php echo number_format($outstanding_loan, 2);?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> 
                            <?php
                            $last_date = '';
                            $payments = $this->individual_model->get_loan_payments($individual_id);
                            $result = '';
                            $count = 1;
                            $total_debit = $outstanding_loan;
                            $total_credit = 0;
                            $total_loans = $individual_loan->num_rows();
                            $loans_count = 0;
                            
                            if($total_loans > 0)
                            {
                                foreach ($individual_loan->result() as $row)
                                {
                                    $loans_plan_name = $row->loans_plan_name;
                                    $individual_loan_id = $row->individual_loan_id;
                                    $proposed_amount = $row->proposed_amount;
                                    $approved_amount = $row->approved_amount;
                                    $disbursed_amount = $row->disbursed_amount;
                                    $purpose = $row->purpose;
                                    $installment_type_duration = $row->installment_type_duration;
                                    $no_of_repayments = $row->no_of_repayments;
                                    $interest_rate = $row->interest_rate;
                                    $interest_id = $row->interest_id;
                                    $grace_period = $row->grace_period;
                                    $disbursed_date = date('jS d M Y',strtotime($row->disbursed_date));
                                    $disbursed = $row->disbursed_date;
                                    $created_by = $row->created_by;
                                    $approved_by = $row->approved_by;
                                    $disbursed_by = $row->disbursed_by;
                                    $loans_count++;
                                    
                                    //get all loan deductions before date
                                    if($payments->num_rows() > 0)
                                    {
                                        foreach ($payments->result() as $row2)
                                        {
                                            $loan_payment_id = $row2->loan_payment_id;
                                            $personnel_fname = $row2->personnel_fname;
                                            $personnel_onames = $row2->personnel_onames;
                                            $payment_amount = $row2->payment_amount;
                                            $payment_interest = $row2->payment_interest;
                                            $created = date('jS M Y H:i:s',strtotime($row2->created));
                                            $payment_date = $row2->payment_date;
                                            
                                            if(($payment_date <= $disbursed) && ($payment_date > $last_date))
                                            {
                                                $count++;
                                                $result .= 
                                                '
                                                    <tr>
                                                        <td>'.$count.'</td>
                                                        <td>'.date('d M Y',strtotime($payment_date)).' </td>
                                                        <td>Loan repayment</td>
                                                        <td></td>
                                                        <td>'.number_format($payment_amount, 2).'</td>
                                                        <td>'.number_format($payment_interest, 2).'</td>
                                                        <td>'.number_format(($payment_amount + $payment_interest), 2).'</td>
                                                    </tr> 
                                                ';
                                                $total_credit += $payment_amount + $payment_interest;
                                            }
                                        }
                                    }
                                    
                                    $count++;
                                    //display loan
                                    $result .= 
                                    '
                                        <tr>
                                            <td>'.$count.'</td>
                                            <td>'.date('d M Y',strtotime($disbursed)).' </td>
                                            <td>Loan disbursed</td>
                                            <td>'.number_format($disbursed_amount, 2).'</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr> 
                                    ';
                                    
                                    //check if there are any more payments
                                    if($total_loans == $loans_count)
                                    {
                                        //get all loan deductions before date
                                        if($payments->num_rows() > 0)
                                        {
                                            foreach ($payments->result() as $row2)
                                            {
                                                $loan_payment_id = $row2->loan_payment_id;
                                                $personnel_fname = $row2->personnel_fname;
                                                $personnel_onames = $row2->personnel_onames;
                                                $payment_amount = $row2->payment_amount;
                                                $payment_interest = $row2->payment_interest;
                                                $created = date('jS M Y H:i:s',strtotime($row2->created));
                                                $payment_date = $row2->payment_date;
                                                
                                                if(($payment_date > $disbursed))
                                                {
                                                    $count++;
                                                    $result .= 
                                                    '
                                                        <tr>
                                                            <td>'.$count.'</td>
                                                            <td>'.date('d M Y',strtotime($payment_date)).' </td>
                                                            <td>Loan repayment</td>
                                                            <td></td>
                                                            <td>'.number_format($payment_amount, 2).'</td>
                                                            <td>'.number_format($payment_interest, 2).'</td>
                                                            <td>'.number_format(($payment_amount + $payment_interest), 2).'</td>
                                                        </tr> 
                                                    ';
                                                    $total_credit += $payment_amount + $payment_interest;
                                                }
                                            }
                                        }
                                    }
                                    
                                    $total_debit += $disbursed_amount;
                                    $last_date = $disbursed;
                                }
                            }
                            
                            else
                            {
                                //get all loan deductions before date
                                if($payments->num_rows() > 0)
                                {
                                    foreach ($payments->result() as $row2)
                                    {
                                        $loan_payment_id = $row2->loan_payment_id;
                                        $personnel_fname = $row2->personnel_fname;
                                        $personnel_onames = $row2->personnel_onames;
                                        $payment_amount = $row2->payment_amount;
                                        $payment_interest = $row2->payment_interest;
                                        $created = date('jS M Y H:i:s',strtotime($row2->created));
                                        $payment_date = $row2->payment_date;
                                        
                                        $count++;
                                        $result .= 
                                        '
                                            <tr>
                                                <td>'.$count.'</td>
                                                <td>'.date('d M Y',strtotime($payment_date)).' </td>
                                                <td>Loan repayment</td>
                                                <td></td>
                                                <td>'.number_format($payment_amount, 2).'</td>
                                                <td>'.number_format($payment_interest, 2).'</td>
                                                <td>'.number_format(($payment_amount + $payment_interest), 2).'</td>
                                            </tr> 
                                        ';
                                        $total_credit += $payment_amount + $payment_interest;
                                    }
                                }
                            }
                                    
                            //display loan
                            $result .= 
                            '
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>'.number_format($total_debit, 2).'</th>
                                    <th></th>
                                    <th></th>
                                    <th>'.number_format($total_credit, 2).'</th>
                                </tr> 
                                <tr>
                                    <th colspan="5">Balance</th>
                                    <th></th>
                                    <th>'.number_format($total_debit - $total_credit, 2).'</th>
                                </tr> 
                            ';
                            
                            echo $result;
                            ?>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        
    	<div class="row" style="font-style:italic; font-size:11px;">
        	<div class="col-md-10 pull-left">
            	<div class="col-md-3 pull-left">
                   Prepared by: <?php //echo $served_by;?> 
                </div>
                <div class="col-md-3 pull-left">
                  Confirmed by: .....................................
                </div>
                <div class="col-md-3 pull-left">
                  Approved by: .....................................
                </div>
                <div class="col-md-3 pull-left">
                  Patient Signature : ................................
                </div>
          	</div>
        	<div class="col-md-2 pull-right">
            	<?php echo date('jS M Y H:i a'); ?> Thank you
            </div>
        </div>
    </body>
    
</html>