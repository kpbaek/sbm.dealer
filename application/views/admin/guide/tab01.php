<?php
require $_SERVER ["DOCUMENT_ROOT"] . '/include/user/auth.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
html {
	font-family: Calibri, Arial, Helvetica, sans-serif;
	font-size: 11pt;
	background-color: white
}

table {
	page-break-after: always;
}
</style>

</head>

<body>

	<div id="가이드_메뉴권한_9772" align=center>

		<table border=1 cellpadding=0 cellspacing=0 width=827>
			<col width=105>
			<col width=190>
			<col width=289>
			<col width=243>
			<tr>
				<td align='center'><spanmso-spacerun:yes'>&nbsp;</span>메뉴 구분</td>
				<td align='center'>주요 업무</td>
				<td align='center'>세부내용</td>
				<td align='center'>사용자</td>

			</tr>
			<tr>
				<td align='center' rowspan=3>신청서</td>
				<td>To be a Dealer</td>
				<td>딜러가입 신청</td>
				<td></td>
			</tr>
			<tr>
				<td>딜러관리</td>
				<td>딜러정보관리(배송국가 및 담당자 지정)</td>
				<td>영업팀</td>
			</tr>
			<tr>
				<td>담당자관리</td>
				<td>담당자 승인 및 이메일 설정</td>
				<td>관리자</td>
			</tr>
			<tr>
				<td align='center' rowspan=4>주문서</td>
				<td>장비</td>
				<td>장비 주문서 작성</td>
				<td rowspan=2>딜러</td>
			</tr>
			<tr>
				<td>부품</td>
				<td>부품 주문서 작성</td>
			</tr>
			<tr>
				<td rowspan=2>주문내역</td>
				<td>주문서 수정, 확정 및 취소, 문서작성</td>
				<td rowspan=2>영업팀, 관리자</td>
			</tr>
			<tr>
				<td>문서발송(사내발송, 외부발송)</td>
			</tr>
			<tr>
				<td align='center' rowspan=5>발송내역</td>
				<td rowspan=5>발송문서조회</td>
				<td>주문서(장비,부품), Packing List</td>
				<td>영업팀</td>
			</tr>
			<tr>
				<td>Proforma Invoice, Commercial Invoice</td>
				<td>영업팀, 재무회계팀</td>
			</tr>
			<tr>
				<td>생산의뢰서</td>
				<td>영업팀, 생산팀, 품질팀, SW1팀, SW2팀</td>
			</tr>
			<tr>
				<td>출고전표</td>
				<td>영업팀, 생산팀, 품질팀</td>
			</tr>
			<tr>
				<td>부품출고의뢰서</td>
				<td>영업팀, 품질팀, 구매자재팀</td>
			</tr>
			<tr>
				<td align='center'>Product</td>
				<td>부품관리</td>
				<td>부품정보 관리(부품내역, 장비분해도)</td>
				<td>SBM User</td>
			</tr>
		</table>
		<p>

		<table border=1 cellpadding=0 cellspacing=0 width=827><tr>
				<td align='center'>문서발송구분</td>
				<td align='center'>문서</td>
				<td align='center'>수신팀</td>
				<td align='center'>수신자</td>

			</tr>
			<tr>
				<td align='center' rowspan=23>사내발송</td>
				<td rowspan=17>생산의뢰서</td>
				<td rowspan=5>구매자재팀</td>
				<td>김민욱</td>
			</tr>
			<tr>
				<td>우충효</td>
			</tr>
			<tr>
				<td>유혜미</td>
			</tr>
			<tr>
				<td>이후섭</td>
			</tr>
			<tr>
				<td>전준성</td>
			</tr>
			<tr>
				<td rowspan=8>S/W 1팀</td>
				<td>곽현수</td>
			</tr>
			<tr>
				<td>나경진</td>
			</tr>
			<tr>
				<td>송명남</td>
			</tr>
			<tr>
				<td>안병곤</td>
			</tr>
			<tr>
				<td>오유곤</td>
			</tr>
			<tr>
				<td>이장원</td>
			</tr>
			<tr>
				<td>이준호</td>
			</tr>
			<tr>
				<td>최영재</td>
			</tr>
			<tr>
				<td rowspan=4>S/W 2팀</td>
				<td>박대일</td>
			</tr>
			<tr>
				<td>박성식</td>
			</tr>
			<tr>
				<td>신종옥</td>
			</tr>
			<tr>
				<td>이주용</td>
			</tr>
			<tr>
				<td rowspan=2>부품출고의뢰서</td>
				<td>구매자재팀</td>
				<td>우충효</td>
			</tr>
			<tr>
				<td>품질관리팀</td>
				<td>신홍균</td>
			</tr>
			<tr>
				<td rowspan=4>출고전표</td>
				<td>구매자재팀</td>
				<td>우충효</td>
			</tr>
			<tr>
				<td rowspan=3>품질관리팀</td>
				<td>김광래</td>
			</tr>
			<tr>
				<td>박대희</td>
			</tr>
			<tr>
				<td>신홍균</td>
			</tr>
			<tr>
				<td align='center' rowspan=4>외부발송</td>
				<td>주문서</td>
				<td rowspan=4>영업팀</td>
				<td rowspan=4>담당자, 딜러</td>
			</tr>
			<tr>
				<td>Proforma Invoice</td>
			</tr>
			<tr>
				<td>Commercial Invoice</td>
			</tr>
			<tr>
				<td>Packing List</td>
			</tr>
		</table>

	</div>
</body>

</html>



