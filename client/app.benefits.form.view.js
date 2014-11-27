jQuery(document).ready(function($){	

	Benefits.renderView = function(dedId){
	
		$(".right").html("");
		var frmBenefits = new ui.widget.Form("benefits-form","../index.php");
		frmBenefits.register(((!!dedId)?'edit':'new'),'benefit');
		frmBenefits.addId('id','');
		
		frmBenefits.onSubmit(function(){
			
			$("body").mask('saving...');
			frmBenefits.valid(true);
		});
		
		frmBenefits.onComplete(function(jsonResult){
			
			$("body").unmask();
			
			if(jsonResult.msg == "Succeded")
				Benefits.renderView();
			else alert("Failure :: Update Unsuccessful!");	
		});
		
		var txtName = new TextBox("name",'name');
		txtName.val("Name");
		txtName.css({color:"#ccc",fontFamily:"Arial"});
		txtName.focus(function(){
		
			if($(this).val() == "Name")
				$(this).val("");
			
			$(this).css({color:"#000"});
		});
		
		txtName.blur(function(){
			
			if($(this).val() == ''){
			
				$(this).val("Name");
				$(this).css({color:'#ccc'});
			}
		});
		
		var txtDefaultAmt = new TextBox("amt",'amt');
		txtDefaultAmt.val("Amount");
		txtDefaultAmt.css({color:"#ccc",fontFamily:"Arial"});
		txtDefaultAmt.focus(function(){
		
			if($(this).val() == "Amount")
				$(this).val("");
			
			$(this).css({color:"#000"});
		});
		
		txtDefaultAmt.blur(function(){
			
			if($(this).val() == ''){
			
				$(this).val("Amount");
				$(this).css({color:'#ccc'});
			}
		});
		
		var txtDescr = new TextArea("descr",'descr');
		txtDescr.setRows(5);
		txtDescr.setCols(60);
		txtDescr.css({color:"#ccc",fontFamily:"Arial"});
		txtDescr.val("Description");
		txtDescr.focus(function(){
		
			if($(this).val() == "Description")
				$(this).val("");
			
			$(this).css({color:"#000"});
		});
		
		txtDescr.blur(function(e){

			if($(this).val() == ''){
			
				$(this).val("Description");
				$(this).css({color:'#ccc'});
			}
		});
		
		var chkPerc = new CheckBox('perc','perc',false,1);
		var spanPerc = $("<span></span>");
		spanPerc.append(chkPerc);
		spanPerc.append("<b>&nbsp;Percentage?</b>"); 
		
		var chkDeduction = new CheckBox('deduct','deduct',false,1);
		var spanDeduction = $("<span></span>");
		spanDeduction.append(chkDeduction);
		spanDeduction.append("<b>&nbsp;Deduction?</b>");
		chkDeduction.click(function(){
		
			var spanEl = $($($('table tr'))[5]).find('td span');
			var chkEl = spanEl.find('input');
			
			if(this.checked){
				
				chkEl.attr('checked',false);
				spanEl.hide(100);
			}	
			else	spanEl.show(100);
		});
		
		var chkTaxable = new CheckBox('taxable','taxable',false,1);
		var spanTaxable = $("<span></span>");
		spanTaxable.append(chkTaxable);
		spanTaxable.append("<b>&nbsp;Taxable?</b>");
		
		var chkActive = new CheckBox('active','active',false,1);
		var spanActive = $("<span></span>");
		spanActive.append(chkActive);
		spanActive.append("<b>&nbsp;Active?</b>");
		
		frmBenefits.cellAlignment("left");
		frmBenefits.addRow();
		frmBenefits.add(txtName);
		frmBenefits.addRow();
		frmBenefits.add(txtDefaultAmt);
		frmBenefits.addRow();
		frmBenefits.add(txtDescr);
		frmBenefits.addRow();
		frmBenefits.add(spanPerc);
		frmBenefits.addRow();
		frmBenefits.add(spanDeduction);
		frmBenefits.addRow();
		frmBenefits.add(spanTaxable);
		frmBenefits.addRow();
		frmBenefits.add(spanActive);
		frmBenefits.addRow();
		frmBenefits.addDefaultButtons(EnumFormButtonAlign.SecondCell);
		frmBenefits.addRow();
		frmBenefits.add(Benefits.renderViews());
		
		frmBenefits.getForm().appendTo(".right");
		$($('#benefits-form table').get(0)).width("100%");
		
		Benefits.renderFlexiGrid();
		Benefits.Employee.renderFlexiGrid();
		
		$("#tabsBenefits").tabs();
		
		$('#reset-benefits-form').val('New');
		$('#reset-benefits-form').click(function(e){
		
			txtDefaultAmt.val("");
			txtName.val("");
			txtDescr.val("");
			
			txtDefaultAmt.blur();
			txtName.blur();
			txtDescr.blur();
			
			$('#active').attr('checked',false);
			$('#perc').attr('checked',false);
			$('#deduct').attr('checked',false);
			$('#taxable').attr('checked',false);
			$('#taxable').parent().show(100);
			
			$('#form-mode').val('new');
			
			e.preventDefault();
		});
	}
});