jQuery(document).ready(function($){

	Setup.renderView = function(){
	
		$(".right").html("");
		$("BODY").mask('loading...');
		
		// var tblSetupNHIF = new ui.Table('nhif');
		// var tableSetupNHIF = tblSetupNHIF.getTable();
		// tableSetupNHIF.css({display:'none'});
				
		var tblSetupPaye = new ui.Table('paye');
		var tableSetupPaye = tblSetupPaye.getTable();
		tableSetupPaye.css({display:'none'});
		
		var tblSetupTaxRelief = new ui.Table('taxrelief');
		var tableSetupTaxRelief = tblSetupTaxRelief.getTable();
		tableSetupTaxRelief.css({display:'none'});
		
		var setupTabs = new ui.Tabs('tabsSetup');
		// setupTabs.newTab('tabNhif',"NHIF",tableSetupNHIF).click(function(e){
		
		// });
		
		var j = 0;
		setupTabs.newTab('tabPaye',"PAYE",tableSetupPaye).click(function(e){
		
			//if(j < 1)
				//$("BODY").mask('loading...');
				
			//new Setup.Paye.renderFlexiGrid();
			//j++;
		});
		
		var i = 0;
		setupTabs.newTab('tabRelief',"Relief",tableSetupTaxRelief).click(function(e){
		
			
			if(i < 1)
				$("BODY").mask('loading...');
				
			new Setup.TaxRelief.renderFlexiGrid();
			i++;
		});
		
		setupTabs.getTabs().appendTo('.right');
		
		$("#tabsSetup").tabs();
		
		new Setup.Paye.renderFlexiGrid();
		// new Setup.Nhif.renderFlexiGrid();
	} 
});