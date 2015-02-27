	function deleteOptionElements(slbObj){ 
		if(slbObj){
			 for(i=slbObj.length-1;i>-1;i--){ 
				 	slbObj.remove(i); 
			 } 
		}
	} 
	
	function addOptionElement(slbObj,value,text){ 
		if(slbObj){
			slbObj.add(new Option(text, value, false)); 
		}
	} 
		 
	//선택 옵션항목을 제거 
	function deleteOptionSelElements(sel){ 
	    sel.options[sel.selectedIndex]=null; 
	}
	
	function getCodeCombo(cd, selObj, sVal) {
		var opt = "";
	    if (cd == "") {
	        deleteOptionElements(selObj);
//	        addOptionElement(selObj, "", "----------------------");
	        return;
	    }
		var targetUrl = '/index.php/common/main/listCode?cd=' + cd;
	    $.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
	    	deleteOptionElements(selObj);
	        addOptionElement(selObj, "", "select");
			if(result['cdAttr']!=null){
		    	for(var i=0; i<result['cdAttr'].length; i++){
		    		var value = result['cdAttr'][i]['value'];
	            	addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
		    		if(value == sVal){
		    			selObj.selectedIndex = (i+1);
		    		}
				}
			}
	    });
	}
	
	function setCodeRadio(name, sVal) {
 		  $('input:radio[name=' + name + ']:input[value='+ sVal+']').prop("checked", true);

	}
	
	function getOXCombo(selObj, sVal) {
		deleteOptionElements(selObj);
        addOptionElement(selObj, "O", "O");
        addOptionElement(selObj, "X", "X");
		for(i=0;i<selObj.length;i++){ 
    		if(selObj.options[i].value == sVal){
    			selObj.selectedIndex = i;
    		}
		} 
	}
	
	function getYNCombo(selObj, sVal) {
		addOptionElement(selObj, "Y", "Y");
		addOptionElement(selObj, "N", "N");
		for(i=0;i<selObj.length;i++){ 
			if(selObj.options[i].value == sVal){
				selObj.selectedIndex = i;
			}
		} 
	}
	
	function getCodeImgCombo(cd, selObj, sVal) {
		var opt = "";
		if (cd == "") {
			deleteOptionElements(selObj);
//	        addOptionElement(selObj, "", "----------------------");
			return;
		}
		var targetUrl = '/index.php/common/main/listCodeImg?cd=' + cd;
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
//				alert(result['opt'][i]);
	    		var value = result['cdAttr'][i]['value'];
	    		var text = result['cdAttr'][i]['text'];
				var opt = new Option(text, value);
//				$(opt).data("image", "/images/common/dropdown/00E0/00E00004.png");
				$(opt).data("image", result['opt'][i]['image']);
				selObj.add(opt);
	    		if(value == sVal){
	    			selObj.options[(i+1)].selected = "selected";
	    		}
			}
			$(selObj).msDropdown({roundedBorder:false});
			
		});
	}
	
	function getWorkerCombo(atcd, selObj, sVal) {
		var opt = "";
	    if (atcd == "") {
	        deleteOptionElements(selObj);
//	        addOptionElement(selObj, "", "----------------------");
	        return;
	    }
		var targetUrl = '/index.php/common/main/listWorker?atcd=' + atcd;
	    $.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
	    	deleteOptionElements(selObj);
	        addOptionElement(selObj, "", "select");
			if(result['cdAttr']!=null){
		    	for(var i=0; i<result['cdAttr'].length; i++){
		    		var value = result['cdAttr'][i]['value'];
	            	addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
		    		if(value == sVal){
		    			selObj.selectedIndex = (i+1);
		    		}
				}
			}
	    });
	}
	
	function getDealerCombo(selObj, sVal) {
		var targetUrl = '/index.php/common/user/listDealerByWorker';
		$.getJSON(targetUrl, function(result){
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getCntryCombo(selObj, sVal) {
		deleteOptionElements(selObj);
		var targetUrl = '/index.php/common/user/listCntry';
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getDealerCntryCombo(dealer_seq, selObj, sVal) {
		deleteOptionElements(selObj);
		var targetUrl = '/index.php/common/user/listDealerCntry?dealer_seq=' + dealer_seq;
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getOrderCntryCombo(pi_no, selObj, sVal) {
		deleteOptionElements(selObj);
		var targetUrl = '/index.php/common/user/listOrderCntry?pi_no=' + pi_no;
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getModelCombo(atcd, selObj, sVal) {
		var opt = "";
		var targetUrl = '/index.php/common/main/listModel?atcd=' + atcd;
	    $.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
	    	deleteOptionElements(selObj);
	        addOptionElement(selObj, "", "select");
	    	for(var i=0; i<result['cdAttr'].length; i++){
	    		var value = result['cdAttr'][i]['value'];
            	addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
	    		if(value == sVal){
	    			selObj.selectedIndex = (i+1);
	    		}
			}
	    });
	}
	
	function getUserPiCombo(selObj, sVal) {
		var opt = "";
		var targetUrl = '/index.php/common/user/listUserPiNo';
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "New");
			if(result['cdAttr']!=null){
				for(var i=0; i<result['cdAttr'].length; i++){
					var value = result['cdAttr'][i]['value'];
					addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
					if(value == sVal){
						selObj.selectedIndex = (i+1);
					}
				}
			}
		});
	}
	
	function getRcpntDocsCombo(selObj, sVal) {
		var opt = "";
		var targetUrl = '/index.php/common/user/listRcpntDocs';
		$.getJSON(targetUrl, function(result){
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getOrderPiCombo(dealer_seq, selObj, sVal) {
		var opt = "";
		var targetUrl = '/index.php/common/user/listOrderPiNo?dealer_seq=' + dealer_seq;
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "New");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getOrderPaymentCombo(pi_no, selObj, sVal) {
		var opt = "";
		var targetUrl = '/index.php/common/user/listOrderPayment?pi_no=' + pi_no;
		$.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);
			deleteOptionElements(selObj);
			addOptionElement(selObj, "", "select");
			for(var i=0; i<result['cdAttr'].length; i++){
				var value = result['cdAttr'][i]['value'];
				addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
				if(value == sVal){
					selObj.selectedIndex = (i+1);
				}
			}
		});
	}
	
	function getCodeMultiCombo(cd, selObj, selAr) {
		var targetUrl = '/index.php/common/main/listCode?cd=' + cd;
	    $.getJSON(targetUrl, function(result){
//	    	$('#postdata').append(result['cd']['name'] + ":" + cd);

	    	for(var i=0; i<result['cdAttr'].length; i++){
	    		var opt = $("<option />", {
	                value: result['cdAttr'][i]['value'],
	                text: result['cdAttr'][i]['text']
	            });
	    		opt.prop("selected", false);
	            selObj.append(opt);
			}
			selObj.multipleSelect("refresh");
			selObj.multipleSelect("setSelects", selAr);
		});
	}

	function getListMultiCombo(listOpt, selObj, selAr) {

	    for(var i=0; i<listOpt.length; i++){
	    	var opt = $("<option />", {
	        	value: listOpt[i][0],
	        	text: listOpt[i][1]
	    	});
	    	opt.prop("selected", false);
	    	selObj.append(opt);
		}
		selObj.multipleSelect("refresh");
		selObj.multipleSelect("setSelects", selAr);
	}

	function fncOnlyNumber(selObj){
		var value = selObj.value.match('/[^0-9]/g');
		if(value==null){
			selObj.value=selObj.value.replace(/[^0-9]/gi,"");
		}
	}
	
	function fncOnlyDecimal(selObj) { 
		if(event.keyCode!="190"){
		    if((event.keyCode<48) || (event.keyCode>57)){
				selObj.value=selObj.value.replace(/[^0-9.]/gi,"");
		    }
		}
		if(isNaN(selObj.value)){
			selObj.value="";
//			selObj.value=selObj.value.replace(/./gi,"");
		}
	}

	function fncValidEmail(val)
	{ 
		var email = val;
	    var re=/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i; 
	    return re.test(email);
	}
	
    function fncDisplayDiv(targetDiv, isDisplay) {
        if(isDisplay){
     	   targetDiv.style.display="";    
        }else{
      	   targetDiv.style.display="none";    
        }
 	}
    
    function fncCrtSndMail(params){
    	var params;
    	if(params.sndmail_atcd=="00700111"){
    		params = {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "po_no":params.po_no};
    	}else if(params.sndmail_atcd=="00700112"){
    		params = {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "swp_no":params.swp_no};
    	}
    	$.ajax({
            type: "POST",
            url: "/index.php/common/main/readMail",
            async: false,
            dataType: "json",
            data: params,
            cache: false,
            success: function(result, status, xhr){
            	var qryInfo = result.qryInfo;
	    		params.ctnt = qryInfo.ctnt;
//	            $("#resultDiv").html(params.ctnt); // test
//	    		return;
		    	if(params.sndmail_atcd=="00700111"){
					fncCrtEqpSndMail(params);
		    	}else if(params.sndmail_atcd=="00700112"){
		    		fncCrtPartSndMail(params);
		    	}
            },
	        error:function(){
                return false;
			}
    	});
    }
    
    function fncCrtEqpSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "po_no":params.po_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
        			return false;
    			}else{
//    				$("#resultDiv").html(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql2);
        			return false;
    			}else{
//    				$("#resultDiv").append(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql3);
        			return false;
    			}else{
//		        	$("#resultDiv").append(qryInfo.result3 + ":" + qryInfo.sql3);
    				fncSndMail(qryInfo.sndmail_seq);
			    	fncDisplayDiv(addFormDiv, false);
    	            $("#resultDiv").html("<b>The order is completed! We sent you order information mail.</b><p>"); 
    				$("#resultDiv").append(qryInfo.ctnt);
					alert("success!");
    			}
    		},
    		error:function(){
    			alert("err");
    			return false;
    		}
    	});
    }
    
    function fncCrtPackingSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//    				$("#resultDiv").html(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql2);
    				return false;
    			}else{
//    				$("#resultDiv").append(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql3);
        			return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql4);
    				return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    			}
    			if(qryInfo.result5==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql5);
    				return false;
    			}else{
    				fncSndMail(qryInfo.sndmail_seq);
    				fncDisplayDiv(saveFormDiv, false);
//    				$("#resultDiv").html("<b>The Packing is completed! We sent you packing information mail.</b><p>"); 
//    				$("#resultDiv").append(qryInfo.ctnt);
    				$('#btnExcel').attr('disabled',false);
    				alert("success!\n운송사에는 Excel을 다운로드하여 별도로 송부하시기 바랍니다.");
    			}
    		},
    		error:function(){
    			alert("err");
    			return false;
    		}
    	});
    }
    
    function fncCrtPartSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "swp_no":params.swp_no
//			  	,"ctnt":params.ctnt
    		},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
        			return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql2);
        			return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql3);
        			return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql4);
        			return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    				fncSndMail(qryInfo.sndmail_seq);
			    	fncDisplayDiv(orderDiv, false);
    	            $("#resultDiv").html("<b>The order is completed! We sent you order information mail.</b><p>"); 
    				$("#resultDiv").append(qryInfo.ctnt);
					alert("success!");
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtPiSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql2 error:" + qryInfo.sql2);
    				return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql3 error:" + qryInfo.sql3);
    				return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql4 error:" + qryInfo.sql4);
    				return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    			}
    			if(qryInfo.result5==false)
    			{
    				$("#resultDiv").html("sql5 error:" + qryInfo.sql5);
    				return false;
    			}else{
//		        	alert(qryInfo.result5 + ":" + qryInfo.sql5);
    				$("#resultDiv").html(qryInfo.ctnt);
    				fncDisplayDiv(resultDiv, true);
					fncSndMail(qryInfo.sndmail_seq);
					alert("success!");
//    				$("#resultDiv").html("<b>We sent worker the PI Information mail.</b><p>"); 
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtCiSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql2 error:" + qryInfo.sql2);
    				return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql3 error:" + qryInfo.sql3);
    				return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql4 error:" + qryInfo.sql4);
    				return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    			}
    			if(qryInfo.result5==false)
    			{
    				$("#resultDiv").html("sql5 error:" + qryInfo.sql5);
    				return false;
    			}else{
//		        	alert(qryInfo.result5 + ":" + qryInfo.sql5);
    				$("#resultDiv").html(qryInfo.ctnt);
    				fncDisplayDiv(resultDiv, true);
    				fncSndMail(qryInfo.sndmail_seq);
    				alert("success!");
//    				$("#resultDiv").html("<b>We sent worker the CI Information mail.</b><p>"); 
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtPrdSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "po_no":params.po_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql2 error:" + qryInfo.sql2);
    				return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql3 error:" + qryInfo.sql3);
    				return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql4 error:" + qryInfo.sql4);
    				return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    				$("#resultDiv").html(qryInfo.ctnt);
    				fncDisplayDiv(resultDiv, true);
    				fncSndMail(qryInfo.sndmail_seq);
    				alert("success!");
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtPartSndMail(params){
    	
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "swp_no":params.swp_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql2 error:" + qryInfo.sql2);
    				return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql3 error:" + qryInfo.sql3);
    				return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql4 error:" + qryInfo.sql4);
    				return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    				$("#resultDiv").html(qryInfo.ctnt);
    				fncDisplayDiv(resultDiv, true);
    				fncSndMail(qryInfo.sndmail_seq);
    				alert("success!");
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtSlipSndMail(params){
    	
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
//    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no},
    		data: params,
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql2 error:" + qryInfo.sql2);
    				return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql3 error:" + qryInfo.sql3);
    				return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    			}
    			if(qryInfo.result4==false)
    			{
    				$("#resultDiv").html("sql4 error:" + qryInfo.sql4);
    				return false;
    			}else{
//		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    				$("#resultDiv").html(qryInfo.ctnt);
    				fncDisplayDiv(resultDiv, true);
    				fncSndMail(qryInfo.sndmail_seq);
    				alert("success!");
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtFwdSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtSndMail",
    		async: false,
    		dataType: "json",
    		data: {"wrk_tp_atcd":params.wrk_tp_atcd, "sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "email_fwd":params.email_fwd},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#resultDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
    			}
    			if(qryInfo.result2==false)
    			{
    				$("#resultDiv").html("sql2 error:" + qryInfo.sql2);
    				return false;
    			}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    			}
    			if(qryInfo.result3==false)
    			{
    				$("#resultDiv").html("sql3 error:" + qryInfo.sql3);
    				return false;
    			}else{
//		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    				$("#resultDiv").html(qryInfo.ctnt);
    				fncDisplayDiv(resultDiv, true);
    				fncSndMail(qryInfo.sndmail_seq);
    				alert("success!");
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncCrtReSndMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/crtReSndMail",
    		async: false,
    		dataType: "json",
    		data: {"sndmail_seq":params.sndmail_seq, "email_fwd":params.email_fwd},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			if(qryInfo.result==false)
    			{
    				$("#sndMailDiv").html("sql error:" + qryInfo.sql);
    				return false;
    			}else{
    				$("#sndMailDiv").append(qryInfo.ctnt);
    				fncReSndMail(qryInfo.sndmail_seq);
    				alert("success!");
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncSndMail(sndmail_seq){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/sndMailResult",
    		async: false,
    		dataType: "text",
//    		data: {"sndmail_seq":sndmail_seq, "atcd":"local"}, // test
    		data: {"sndmail_seq":sndmail_seq},
    		cache: false,
    		success: function(result, status, xhr){
    			if(xhr.status=="200"){
//    				alert(result);
    				return true;
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncReSndMail(sndmail_seq){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/reSndMailResult",
    		async: false,
    		dataType: "text",
//    		data: {"sndmail_seq":sndmail_seq, "atcd":"local"}, // test
    		data: {"sndmail_seq":sndmail_seq},
    		cache: false,
    		success: function(result, status, xhr){
    			if(xhr.status=="200"){
//    				alert(result);
    				return true;
    			}
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncReadMail(params){
    	$.ajax({
            type: "POST",
            url: "/index.php/common/main/readMail",
            async: false,
            dataType: "json",
            data: {"sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no},
            cache: false,
            success: function(result, status, xhr){
            	var qryInfo = result.qryInfo;
	            $("#resultDiv").append(qryInfo.ctnt); 
            },
	        error:function(){
                return false;
			}
    	});
    }
    
    function fncReadReqMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/readMail",
    		async: false,
    		dataType: "json",
    		data: {"sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "po_no":params.po_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			$("#resultDiv").append(qryInfo.ctnt); 
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    function fncReadPartReqMail(params){
    	$.ajax({
    		type: "POST",
    		url: "/index.php/common/main/readMail",
    		async: false,
    		dataType: "json",
    		data: {"sndmail_atcd":params.sndmail_atcd, "pi_no":params.pi_no, "swp_no":params.swp_no},
    		cache: false,
    		success: function(result, status, xhr){
    			var qryInfo = result.qryInfo;
    			$("#resultDiv").append(qryInfo.ctnt); 
    		},
    		error:function(){
    			return false;
    		}
    	});
    }
    
    
    
    /*
    ' ------------------------------------------------------------------
   ' Function    : fc_chk_byte(aro_name)
    ' Description : 입력한 글자수를 체크
   ' Argument    : Object Name(글자수를 제한할 컨트롤)
    ' Return      : 
    ' ------------------------------------------------------------------
   */
	function fnc_chk_byte(aro_name, ari_max) {
	
		var ls_str = aro_name.value; // 이벤트가 일어난 컨트롤의 value 값
		var li_str_len = ls_str.length; // 전체길이
	
		// 변수초기화
		var li_max = ari_max; // 제한할 글자수 크기
		var i = 0; // for문에 사용
		var li_byte = 0; // 한글일경우는 2 그밗에는 1을 더함
		var li_len = 0; // substring하기 위해서 사용
		var ls_one_char = ""; // 한글자씩 검사한다
		var ls_str2 = ""; // 글자수를 초과하면 제한할수 글자전까지만 보여준다.
	
		for (i = 0; i < li_str_len; i++) {
			// 한글자추출
			ls_one_char = ls_str.charAt(i);
	
			// 한글이면 2를 더한다.
			if (escape(ls_one_char).length > 4) {
				li_byte += 2;
			}
			// 그밗의 경우는 1을 더한다.
			else {
				li_byte++;
			}
	
			// 전체 크기가 li_max를 넘지않으면
			if (li_byte <= li_max) {
				li_len = i + 1;
			}
		}
	
		// 전체길이를 초과하면
		if (li_byte > li_max) {
			alert(li_max + " 글자를 초과 입력할수 없습니다. \n 초과된 내용은 자동으로 삭제 됩니다. ");
			ls_str2 = ls_str.substr(0, li_len);
			aro_name.value = ls_str2;
	
		}
		aro_name.focus();
	}

	function fnc_commify(n) {
		var reg = /(^[+-]?\d+)(\d{3})/; // 정규식
		n += ''; // 숫자를 문자열로 변환
	
		while (reg.test(n)) {
			n = n.replace(reg, '$1' + ',' + '$2');
		}
		return n;
	}
