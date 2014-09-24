<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>jQuery treeView</title>
	
	<link rel="stylesheet" href="/lib/jquery.treeview/jquery.treeview.css" />
	<link rel="stylesheet" href="/lib/jquery.treeview/screen.css" />
	
 	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="/lib/jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.ui.shake.js"></script>
</head>
<body> 
      
        <!-- 친구수--> 
        <div style="text-align:center;padding:10px;"></div> 
      
        <table class="table table-striped""> 
            <thead> 
                <tr> 
                    <th>이름</th> 
                    <th>폰</th> 
                    <th>주소</th> 
                    <th>생일</th> 
                    <th>가족</th> 
                    <th>등록일</th> 
                </tr> 
            </thead> 
            <tbody> 
                <!-- 친구 목록 노출 영역--> 
            </tbody> 
        </table>   
      
        <script type="text/javascript"> 
            $.ajax({ 
                 type: "POST"
                ,url: "/user/ajaxLogin"
                ,async: false 
                ,dataType: "json"
                ,success: response_json 
            }); 
              
            function response_json(json) 
            { 
                var friend_list = json.UnoFriendList; 
  
                //친구수
                var friend_count =friend_list.length; 
  
                $("div").html("<b>전체 친구수 : " + friend_count + " 명</b>"); 
  
                //친구수 만큼 루프를 돈다 
                $.each(friend_list, function(key){ 
  
                    //친구 1명의 정보를 가진 변수 
                    //{"UnoFriendList":[{"Friend":{친구정보}},{"Friend":{친구정보}}]} 
                    //형태이므로 friend_list 의 배열에서 각 개체를 가져온다. 
                    var friend_info = friend_list[key].Friend; 
      
                    var friend_name = friend_info.name; 
                    var friend_phone = friend_info.phone; 
                    var friend_address = friend_info.address; 
                    var friend_birth = friend_info.birth;    
  
                    //family 의 수만큼 루프를 돌아 이름을 구한다. 
                    var family_name = ""; 
                    var family_list = friend_info.family; 
  
                    //"family":{"family_name_1":"\ucc44\uc724","family_name_2":"\ucc44\ub9ac"} 
                    //idx의 값은  family_name_1 , family_name_2 가 된다.                       
                    $.each(family_list,function(idx){ 
                        family_name += family_list[idx] + "<br/>"; 
                    });                  
                      
                    var friend_date = friend_info.date; 
                                      
                    var html = "<tr>"; 
                    html += "<td>"+ friend_name +"</td>"; 
                    html += "<td>"+ friend_phone +"</td>"; 
                    html += "<td>"+ friend_address +"</td>"; 
                    html += "<td>"+ friend_birth +"</td>";                   
                    html += "<td>"+ family_name + "</td>"; 
                    html += "<td>"+ friend_date +"</td>"; 
                    html += "</tr>"; 
      
                    $("tbody").append(html);                 
                }); 
            } 
        </script> 
    </body> 



