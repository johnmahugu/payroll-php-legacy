jQuery(document).ready(function($){	

	Role.renderFormView = function(roleId){
	
		$(".right").html("");
		if(!!roleId)
			$("body").mask("Waiting...");
		
		var txtName = new TextBox('name','name');
		txtName.focus(function(){
		
			$(this).css({backgroundColor:'#fff'});
		});
		
		var txtDescr = new TextArea('descr','descr');
		txtDescr.setRows(10);
		txtDescr.setCols(30);
		
		var frmRole = new ui.widget.Form("role-form","../index.php");
		frmRole.register(((!!roleId)?'edit':'new'),'role');
		
		if(!!roleId)
			$.getJSON('../index.php',{action:'role','id':roleId},function(role){
			
				frmRole.addId('id',role.id);
				txtName.val(role.name);
				txtDescr.html(role.descr);
				
				$("body").unmask();
			});

		frmRole.onSubmit(function(){
			
			if(!!$('#name').val()){
				
				$("body").mask('Saving Role...');
				frmRole.valid(true);
			}	
			else	$('#name').css({backgroundColor:'pink'});	
		});
		
		frmRole.onComplete(function(jsonResult){
			
			$("body").unmask();
			Role.renderView();
		});
		
		frmRole.addRow();
		frmRole.add("Role",txtName);
		frmRole.addRow();
		frmRole.add("Description",txtDescr);
		frmRole.addDefaultButtons();
		frmRole.getForm().appendTo($(".right"));
	}
});	