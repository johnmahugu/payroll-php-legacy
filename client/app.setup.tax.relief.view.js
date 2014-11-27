jQuery(document).ready(function($){
	
	Setup.TaxRelief.renderFlexiGrid = function(){
		
		$("#taxrelief").flexigrid({

			url: '../index.php?action=taxrelief',
			dataType: 'json',
			colModel : [
				{display: '#', name : '#', sortable : true, align: 'right'},
				{display: 'Name', name : 'lbound', width : 180, sortable : true, align: 'left'},
				{display: 'Monthly', name : 'ubound', width : 180, sortable : true, align: 'right'},
				{display: 'Annually', name : 'amount', width : 180, sortable : true, align: 'right'},
				{display: 'Active', name : 'active', width : 180, sortable : true, align: 'right'}],
			buttons : [
				{name: 'Update', bclass: '', onpress : function(){
				
					$('BODY').mask('saving....');
					
					var result = [];
					
					$('.due-update').each(function(i,e){
						
						result[i] = {
						'id':$(e).attr('alt'),	
						'name':$($(e).children().eq(1).html()).html(),
						'monthly':$($(e).children().eq(2).html()).html(),
						'annual':$($(e).children().eq(3).html()).html(),
						'active':$($(e).children().eq(4).html()).html()};
					});
						
					$.post('../index.php',{action:'taxrelief',mode:'update',rs:result},function(data){
					
						var json = $.parseJSON(data);
						
						if(json.msg == 'Succeded')
							$('#taxrelief tr td div').css({backgroundColor:'transparent'});
						else
							alert("Update Failed!");
							
						$('BODY').unmask();	
					});
				}}
			],
			title: 'Tax Relief Rates',
			onRowClick:function(){
			
			},
			onSuccess:function(){
			
				$("BODY").unmask('');
				
				$('#taxrelief td').each(function(i,e){
				
					if(!$(this).attr('alt')){
					
						var value = $($(e).html()).html();
						
						if(value == 'False' || value == 'True'){
						
							var editor = new ComboBox('active','active')
							editor.addOption('False','False');
							editor.addOption('True','True');
							
						}
						else{
							
							var editor = $(document.createElement("INPUT"));
							editor.attr('type','text');
							editor.css({float:'right'});
						}	
						
						editor.val(value);
						editor.hide();
						editor.blur(function(){
						
							$(this).hide();
							$($(this).siblings().get(0)).show();
							$($(this).siblings().get(0)).html($(this).val());
						});
						
						$(this).append(editor);
						$(this).dblclick(function() {
					  
							editor.show();
							editor.focus();
							$($(this).get(0).parentNode).addClass('due-update');
							$($($(this).children()).get(0)).hide();
							$($($(this).children()).first()).css({backgroundColor:'#ccc'});
						});
					}
				});
			},
			onSubmit: function addFormData(){
			
				var dt = $('#sform').serializeArray();
				$("#taxrelief").flexOptions({params: dt});

				return true;
			},
			height: 200
		});
	}
});