jQuery(document).ready(function($){
		
	Dept.renderView = function(){
	
		$(".right").html("");
		
		var tblDept = new ui.Table('depts');
		var tableDept = tblDept.getTable();
		tableDept.css({display:'none'});
		tableDept.appendTo($(".right"));
		
		Dept.renderFlexiGrid();
	};
	
	Dept.renderFlexiGrid = function(){
		
		$("#depts").flexigrid({

			url: '../index.php?action=dept',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'left'},
				{display: 'Name', name : 'name', width : 180, sortable : true, align: 'left'},
				{display: 'Descr', name : 'descr', width : 180, sortable : true, align: 'left'}],
			buttons : [
				{name: 'Add', bclass: '', onpress : function(){Dept.renderFormView();}},
				{separator: true},
				{name: 'Delete', bclass: '', onpress : function(){
				
					if(confirm('Delete?'))
						$.getJSON('../index.php',{action:'dept',mode:'delete',id:$('.trSelected').attr('alt')},function(){
						
							$(".pReload").click();
						});
				}}
			],
			searchitems : [
				{display: 'Name', name : 'name'},
				{display: 'Descr', name : 'descr', isdefault: true}],
			sortname: "name",
			sortorder: "asc",
			usepager: true,
			title: 'Departments',
			useRp: false,
			rp: 15,
			showTableToggleBtn: false,
			width: $('.right').width()-10,//700,
			onRowClick:function(){
			
				Dept.renderFormView($(this).attr('alt'));
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#depts").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	};
}); 