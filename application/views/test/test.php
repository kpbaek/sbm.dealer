<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/js/jqgrid/css/ui.jqgrid.css"></link>	
 
	<script src="/lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<form name="searchForm">
<input type="text" name="page">
<a href="javascript:gridReload();" id="search">page</a>
</form>
<table id="list2"></table>
<div id="pager2"></div>


<script type="text/javascript">

	jQuery("#list2").jqGrid({
	   	url:'/test/main/server',
		datatype: "json",
	   	colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
	   	colModel:[
	   		{name:'id',index:'id', width:55, align:"right"},
	   		{name:'invdate',index:'invdate', width:90},
	   		{name:'name',index:'name asc, invdate', width:100},
	   		{name:'amount',index:'amount', width:80, align:"right"},
	   		{name:'tax',index:'tax', width:80, align:"right"},		
	   		{name:'total',index:'total', width:80,align:"right"},		
	   		{name:'note',index:'note', width:150, sortable:false}		
	   	],
        mtype: "POST",
	   	rowNum:10,
	   	rowList:[10,20,30],
	   	pager: '#pager2',
	    viewrecords: true,
	    autowidth: false,
	    width:700,
	    height:220,
	    sortname: 'id',
	    sortorder: "desc",
	    caption:"부품관리"
	});
	jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false});


    function gridReload() {
        var page = document.searchForm.page.value;
        jQuery("#list2").jqGrid('setGridParam', {url:"/test/main/server",page:page}).trigger("reloadGrid");
    }
    
    var timeoutHnd;
    var flAuto = false;


    function doSearch(ev) {
        if (!flAuto)
            return;
        //	var elem = ev.target||ev.srcElement;
        if (timeoutHnd)
            clearTimeout(timeoutHnd)
        timeoutHnd = setTimeout(gridReload, 500)
    }

</script>

</html>