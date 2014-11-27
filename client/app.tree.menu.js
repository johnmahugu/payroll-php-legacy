jQuery(document).ready(function($){

	App.TreeMenu.renderView = function(){

		$("#tree").treeview({
			collapsed: false,
			animated: "medium",
			control:"#sidetreecontrol",
			persist: "location"
		});
		
		$("#tree").show();
	}		
});	