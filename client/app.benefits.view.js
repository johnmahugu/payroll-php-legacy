jQuery(document).ready(function($){

	Benefits.renderFlexiGrid = function(){
		
		var deductFlex = $("#benefit").flexigrid({

			url: '../index.php?action=benefit',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'left'},
				{display: 'Name.', name : 'name', width : 180, sortable : true, align: 'left'},
				{display: 'Amount/Perc(%)', name : 'damt', width : 180, sortable : true, align: 'right'},
				{display: 'Description', name : 'descr', width : 180, sortable : true, align: 'left'},
				{display: 'Percentage', name : 'descr', width : 60, sortable : true, align: 'left'},
				{display: 'Deduct', name : 'descr', width : 45, sortable : true, align: 'left'},
				{display: 'Taxable', name : 'taxable', width : 45, sortable : true, align: 'left'},
				{display: 'Active', name : 'descr', width : 45, sortable : true, align: 'left'}],
			buttons : [
				{name: 'Delete', bclass: '', onpress : function(){
				
					if(!!$(".trSelected").attr('alt'))
						if(confirm("Delete?")){
						
							$('BODY').mask("deleting...");
							$.getJSON('../index.php',{action:'benefit',mode:'delete',id:$(".trSelected").attr('alt')},function(json){
							
								$('BODY').unmask();
								Benefits.renderView();
							});
						}	
				}},
				{separator: true}
			],
			sortname: "name",
			sortorder: "asc",
			title: 'Benefits',
			showTableToggleBtn: false,
			singleClick:true,
			maskAjaxRequest:true,
			maskAjaxRequestMsg:'Loading...',
			onRowClick:function(){
			
				$("#name").css({color:"#000"});
				$("#amt").css({color:"#000"});
				$("#descr").css({color:"#000"});
				
				$('#form-mode').val('edit');
				$('#id').val($(this).attr('alt'));
				$("#name").val($($($(this).children().get(1)).html()).html());
				$("#amt").val($($($(this).children().get(2)).html()).html());
				$("#descr").val($($($(this).children().get(3)).html()).html());
				$('#perc').attr('checked',($($($(this).children().get(4)).html()).html()) == 'True');
				$('#deduct').attr('checked',($($($(this).children().get(5)).html()).html()) == 'True');
				$('#taxable').attr('checked',($($($(this).children().get(6)).html()).html()) == 'True');
				$('#active').attr('checked',($($($(this).children().get(7)).html()).html()) == 'Active');
				
				if($('#deduct').attr('checked')){	
					
					$('#taxable').attr('checked',false);
					$('#taxable').parent().hide(100);
				}	
				else{
				
					$('#taxable').parent().show(100);
				}	

			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#benefit").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	};
})