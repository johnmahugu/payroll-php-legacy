jQuery(document).ready(function($){
		
	Employee.renderView = function(){
	
		$(".right").html("");
		
		var tblEmployee = new ui.Table('employee');
		var tableEmployee = tblEmployee.getTable();
		tableEmployee.css({display:'none'});
		tableEmployee.appendTo($(".right"));
		
		Employee.renderFlexiGrid();
	};
	
	Employee.renderFlexiGrid = function(){
		
		$("#employee").flexigrid({

			url: '../index.php?action=employee',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'left'},
				{display: 'EmployeeNo.', name : 'no', width : 180, sortable : true, align: 'left'},
				{display: 'Surname', name : 'surname', width : 180, sortable : true, align: 'left'},
				{display: 'Othernames', name : 'othernames', width : 180, sortable : true, align: 'left'},
				{display: 'Post', name : 'post', width : 180, sortable : true, align: 'left'},
				{display: 'Active', name : 'post', width : 180, sortable : true, align: 'left'}],
			buttons : [
				{name: 'Add', bclass: '', onpress : function(){Employee.renderFormsView();}},
				{name: 'Delete', bclass: '', onpress : function(){
				
					if(confirm('Delete?'))
						$.getJSON('../index.php',{action:'employee',mode:'delete',id:$(".trSelected").attr('alt')},function(json){
						
							$(".pReload").click();
						});
				}},
				{separator: true}
			],
			searchitems : [
				{display: 'EmployeeNo.', name : 'name'},
				{display: 'Surname', name : 'surname', isdefault: true},
				{display: 'Othernames', name : 'othernames', isdefault: true},
				{display: 'Post', name : 'post', isdefault: true},
				{display: 'Active', name : 'active', isdefault: true}],
			sortname: "name",
			sortorder: "asc",
			usepager: true,
			title: 'Employees',
			useRp: false,
			rp: 15,
			showTableToggleBtn: false,
			width: $('.right').width()-10,//700,
			onRowClick:function(){
			
				Employee.renderFormsView($(this).attr('alt'));
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#employee").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	};
}); 