	function deleteOptionElements(slbObj){ 
		 for(i=slbObj.length-1;i>-1;i--){ 
		 	slbObj.remove(i); 
		 } 
	} 
	
	function addOptionElement(slbObj,value,text){ 
		 slbObj.add(new Option(text, value, false)); 
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
	    	for(var i=0; i<result['cdAttr'].length; i++){
	    		var value = result['cdAttr'][i]['value'];
            	addOptionElement(selObj, value, result['cdAttr'][i]['text']); 
	    		if(value == sVal){
	    			selObj.selectedIndex = (i+1);
	    		}
			}
	    });
	}
	
	function setCodeRadio(name, sVal) {
 		  $('input:radio[name=' + name + ']:input[value='+ sVal+']').prop("checked", true);

	}
	
	function getOXCombo(selObj, sVal) {
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

	function fncOnlyNumber(selObj){
		var value = selObj.value.match('/[^0-9]/g');
		if(value==null){
			selObj.value=selObj.value.replace(/[^0-9]/gi,"");
		}
	}
	
	function fncOnlyDecimal(selObj) { 
		if(event.keyCode!="190"){
		    if((event.keyCode<48) || (event.keyCode>57)){
				selObj.value=selObj.value.replace(/[^0-9]/gi,"");
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
	