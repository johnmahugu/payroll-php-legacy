jQuery(document).ready(function($){

	Employee.getEmployeeWidget = function(empId,payDetails){
	
		var frmEmployee = Employee.renderFormView(empId);
		var frmEmployeePayrollDetails = Employee.PayrollDetails.renderView(empId,payDetails);
		
		var testTabs = new ui.Tabs('tabsEmployee');
		testTabs.newTab('tabEmployeeDetails',"Employee Details",frmEmployee.getForm());
		testTabs.newTab('tabPayrollDetails',"Payroll Details",frmEmployeePayrollDetails.getForm());
		testTabs.getTabs().appendTo('.right');

		$($('table')[1]).find('tr:nth-child(3) td:nth-child(2)').attr('align','right');	
		$("#tabsEmployee").tabs();
		
		$( "#dob" ).datepicker({maxDate:"-18Y"});
		$( "#start" ).datepicker({minDate:"0D"});
		$( "#end" ).datepicker({minDate:"+1D"});
	}
	
	Employee.renderFormsView = function(empId){
	
		$('BODY').mask("Loading Employee Details...");
		if(!!empId)
			$.getJSON('../index.php',{action:'payroll',employee:empId},function(payDetails){
			
				Employee.getEmployeeWidget(empId,payDetails);
			});
		else	Employee.getEmployeeWidget("",{id:'',salary:'',hasnhif:'',benefits:{}});
	}	
});

