jQuery(document).ready(function($){	

	Dept.renderFormView = function(deptId){
	
		$(".right").html("");
		if(!!deptId)
			$("body").mask("Waiting...");
		
		var txtName = new TextBox('name','name');
		txtName.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtDescr = new TextArea('descr','descr');
		txtDescr.setRows(10);
		txtDescr.setCols(30);
		
		var frmDept = new ui.widget.Form("dept-form","../index.php");
		frmDept.register(((!!deptId)?'edit':'new'),'dept');
		
		if(!!deptId)
			$.getJSON('../index.php',{action:'dept','id':deptId},function(dept){
			
				frmDept.addId('id',dept.id);
				txtName.val(dept.name);
				txtDescr.html(dept.descr);
				
				$("body").unmask();
			});

		frmDept.onSubmit(function(){
			
			if(!!$('#name').val()){
				
				$("body").mask('Saving Department...');
				frmDept.valid(true);
			}	
			else	$('#name').css({backgroundColor:'pink'});	
		});
		
		frmDept.onComplete(function(jsonResult){
			
			$("body").unmask();
			Dept.renderView();
		});
		
		frmDept.addRow();
		frmDept.add("Dept.",txtName);
		frmDept.addRow();
		frmDept.add("Description",txtDescr);
		frmDept.addDefaultButtons();
		frmDept.getForm().appendTo($(".right"));
	}
});	