<?php

session_start();
require_once('../../server/bootstrap.php');

if(!$_SESSION['isLoggedIn'])
	exit("<p style='background-color:pink;border:1px #000 solid;padding:5px;'><b>&nbsp;Error :: Please Login!</b></p>");

echo("<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/transitional.dtd'>"); 
echo("<html xmlns='http://www.w3.org/1999/xhtml' dir='ltr'>"); 
echo("<head profile='http://gmpg.org/xfn/11'>"); 
echo("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>"); 
echo("<meta name='description' content='description'/>"); 
echo("<meta name='keywords' content='keywords'/>");  
echo("<meta name='author' content='author'/>");  
echo("<title>Payroll System</title>"); 
echo("<head>");
/*******Basic Info*******/
echo("<script src='../../client/js/jquery.js' type='text/javascript'></script>");
echo("<style>");
echo("table caption{cursor:pointer;}");
echo("table tr td, caption{border:1px #000 solid;}");
//echo(".borderless {border:none;}");
//echo(".borderless {border:1px #000 solid; border-radius:15px;}");
echo("</style>");
echo("</head>");
echo("<body>");

$count = 0;
while($count <= count($_REQUEST['employees'])-1){///WHILE PAYSLIP/PAY REPORT

echo("<div width='50%'>");

$employee = Doctrine::getTable("Employee")->find($_REQUEST['employees'][$count++]);	
		
$payDetails = $employee->PayDetails[$employee->PayDetails->count()-1];

$enumBool = array('False','True');
$isBenefit = array('Benefit','Deduction');
$payBenefit = $payDetails->PayBenefit;

$payeScheme = Doctrine::getTable("Paye")->findAll();
$taxReliefTypes = Doctrine::getTable("Relief")->findAll();
$salary = $payDetails->gross_salary;

echo("<table width='50%' id='employee'>");
echo("<caption class='borderless' style='background-color:#eee;'><b>Employee Pay Report</b></caption>");
echo(sprintf("<tr><td width='%s' align='right'><b>Name</b></td><td>%s, %s</td></tr>",'10%',$employee->surname,$employee->othernames)); 
echo(sprintf("<tr><td width='%s' align='right'><b>Salary</b></td><td align='right'>%s</td></tr>",'10%',number_format($payDetails->gross_salary,2)));
echo("</table>");
/*******Basic Info*******/

/*******Non Taxable Earnings*******/
$cummulativeNonTaxableDeductions = 0;
$cummulativeNonTaxableEarnings = 0;
$arrBenDed = array();
		
foreach($payBenefit as $payEarning){

	if(!(bool)$payEarning->Benefit->taxable){
	
		$Earning = $payEarning->Benefit;
		
		if((bool)$Earning->perc)
			$EarningAmount = ($Earning->damt/100 * $salary);
		else
			$EarningAmount = $Earning->damt;
		
		if((bool)$payEarning->Benefit->deduct)
			$cummulativeNonTaxableDeductions += $EarningAmount;
		else
			$cummulativeNonTaxableEarnings += $EarningAmount;
		
		$arrBenDedBool = array('Earning','Deduction');	
		$arrBenDed[$arrBenDedBool[(bool)$payEarning->Benefit->deduct]] .= sprintf("<tr><td nowrap>%s</td><td align='right'>%s</td></tr>",$Earning->name,number_format($EarningAmount,2));
	}					
}

if(!empty($arrBenDed['Earning'])){

	echo("<table width='50%' id='nontaxearn'>");
	echo("<caption><b>Non Taxable Earnings</b></caption>");
	echo("<thead><tr><th align='left'>Name</th><th width='1%'>Amount</th></tr></thead>");
	echo($arrBenDed['Earning']);
	echo(sprintf("<tfoot><tr><td nowrap><b>Total Non Taxable Earnings</b></td><td align='right' width='%s'>%s</td></tr></tfoot>",'1%',number_format($cummulativeNonTaxableEarnings,2)));
	echo("</table>");
}
/*******Non Taxable Earnings*******/

/*******Non Taxable Deductions*******/
if(!empty($arrBenDed['Deduction'])){

	echo("<table width='50%' id='nontaxded'>");
	echo("<caption><b>Non Taxable Deductions</b></caption>");
	echo("<thead><tr><th align='left'>Name</th><th>Amount</th></tr></thead>");
	echo($arrBenDed['Deduction']);
	echo(sprintf("<tfoot><tr><td nowrap><b>Total Non Taxable Deductions</b></td><td align='right' width='%s'>%s</td></tr></tfoot>",'1%',number_format($cummulativeNonTaxableDeductions,2)));
	echo("</table>");
}
/*******Non Taxable Deductions*******/
$taxableSalary = 0;
$taxableSalary = $salary - ($cummulativeNonTaxableEarnings + $cummulativeNonTaxableDeductions);

/*******Taxable Earnings*******/
$taxableEarnings = '';
$cummulativeTaxableEarning  = 0;

foreach($payBenefit as $payEarning){

	if((bool)$payEarning->Benefit->taxable){
		
		$Earning = $payEarning->Benefit;

		if((bool)$Earning->perc)
			$EarningAmount = ($Earning->damt/100 * $salary);
		else
			$EarningAmount = $Earning->damt;

		$taxableEarnings .= sprintf("<tr><td nowrap>%s</td><td align='right' width='%s'>%s</td></tr>",$Earning->name,'1%',number_format($EarningAmount,2));
		
		$cummulativeTaxableEarning += $EarningAmount;
	}					
}

if(!empty($taxableEarnings)){

	echo("<table width='50%' id='taxearn'>");
	echo("<caption><b>Taxable Earnings</b></caption>");
	echo("<thead><tr><th align='left'>Name</th><th>Amount</th></tr></thead>");
	echo($taxableEarnings);
	echo(sprintf("<tfoot><tr><td nowrap><b>Total Taxable Earnings</b></td><td align='right' width='%s'>%s</td></tr></tfoot>",'1%',number_format($cummulativeTaxableEarning,2)));
	echo("</table>");
}
/*******Taxable Earnings*******/

$taxableSalary += $cummulativeTaxableEarning;

/*******Paye*******/
$paye = '';
$tax = 0;

foreach($payeScheme as $payeEntry){

	$mlbound = $payeEntry->mlbound;
	$mubound = $payeEntry->mubound;
	$rate = $payeEntry->rate;
	
	$taxableSalary -= $tax;
	
	if($taxableSalary>=$mlbound){
	
		if($taxableSalary>$mubound){
			
			$displayMLBound = number_format($mlbound,2);
			$displayMUBound = number_format($mubound,2);
			$displayRate = number_format($rate,2);
			$displayTax = number_format($rate/100 * ($mubound - $mlbound),2);
			$displayTaxAfterRelief = number_format($tax += ($rate/100 * ($mubound - $mlbound)),2);
			
			if($tax<=0){
			
				$tax = 0;
				$displayTaxAfterRelief = "0.00";
			}
		}
		else{
			
			$displayMLBound = number_format($mlbound,2);
			$displayMUBound = "Above";
			$displayRate = number_format($rate,2);
			$displayTax = number_format($rate/100 * ($salary - $mlbound),2);
			$displayTaxAfterRelief = number_format($tax += ($rate/100 * ($salary - $mlbound)),2);
		}
		
		$paye .= sprintf("<tr><td align='right'>%s</td><td align='right'>%s</td><td align='right'>%s</td><td align='right'>%s</td><td align='right'>%s</td></tr>",$displayMLBound,$displayMUBound,$displayRate,$displayTax,$displayTaxAfterRelief);			
	}				
}	

if(!empty($paye)){

	echo("<table width='50%' id='paye'>");
	echo("<caption><b>PAYE</b></caption>");
	echo("<thead><tr><th>Lower Bound</th><th>Upper Bound</th><th>Rate(%)</th><th>Tax</th><th width='1%' nowrap>Cummulative Tax</th></tr></thead>");		
	echo($paye);
	echo(sprintf("<tfoot style='display:none'><tr><td nowrap><b>Total Tax</b></td><td align='right' width='%s'>%s</td></tr></tfoot>",'1%',number_format($tax,2)));
	echo("</table>");
}
/*******Paye*******/
$cummulativeRelief = 0;
$relief = '';

foreach($taxReliefTypes as $taxReliefType){

	if((bool)$taxReliefType->active){
	
		$cummulativeRelief += $taxReliefType->monthly;
		
		$relief .= sprintf("<tr><td align='left'>%s</td><td align='right' width='%s'>%s</td></tr>",$taxReliefType->name,'1%',$taxReliefType->monthly);			
	}
}

if(!empty($relief)){

	echo("<table width='50%' id='relief'>");
	echo("<caption><b>Tax Relief</b></caption>");
	echo("<thead><tr><th align='left'>Name</th><th>Amount</th></tr></thead>");		
	echo($relief);
	echo(sprintf("<tfoot style='display:none'><tr><td nowrap><b>Total Tax Relief</b></td><td align='right' width='%s'>%s</td></tr></tfoot>",'1%',number_format($cummulativeRelief,2)));
	echo("</table>");
}

$postTaxSalary = $salary - ($tax - $cummulativeRelief);
$postTaxSalary = $postTaxSalary - $cummulativeNonTaxableDeductions;
$postTaxSalary = $postTaxSalary + $cummulativeNonTaxableEarnings;
$netSalary = $postTaxSalary + $cummulativeTaxableEarning;

echo("<table width='50%' id='salo'>");
echo(sprintf("<tfoot><tr><td class='borderless'><b>Net Salary</b></td><td class='borderless' width='%s'>%s</td></tr></tfoot>",'1%',number_format($netSalary,2)));
echo("</table>");
echo("</div>");
echo("</br>");
echo("</br>");

}///WHILE PAYSLIP/PAY REPORT
echo("</body>");
?>
<script>

jQuery(document).ready(function($){

	$('div').each(function(){

		var parentDiv = $(this);
		$(this).find('#employee caption').toggle(function(){

			parentDiv.find('thead, tbody').not('#employee thead, #employee tbody').hide();
			parentDiv.find('#paye tfoot').show();
			parentDiv.find('#relief tfoot').show();
			
			$(this).html("<b>Employee Pay Slip</b>");
			
		},function(){
		
			parentDiv.find('thead, tbody').not('#employee thead, #employee tbody').show();
			parentDiv.find('#paye tfoot').hide();
			parentDiv.find('#relief tfoot').hide();
			
			$(this).html("<b>Employee Pay Report</b>");
		});
	});

	$('table').not('#employee').each(function(i,e){

		$(this).find('caption').toggle(function(){

			$(this).parent().find('thead, tbody').hide();
			
			if($(this).parent().attr('id') == 'paye' || $(this).parent().attr('id') == 'relief')
				$(this).parent().find('tfoot').show();
			
		},function(){
		
			$(this).parent().find('thead, tbody').show();
			
			if($(this).parent().attr('id') == 'paye' || $(this).parent().attr('id') == 'relief')
				$(this).parent().find('tfoot').hide();
		});
	});
});
	
</script>
<?php
echo("</html>");
?>