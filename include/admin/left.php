		
<?php 
if (isset($_SESSION['ss_user']['uid'])){
?>
		<ul id="menu" class="filetree treeview-famfamfam">
			<li><span class="folder">수주관리</span>
				<ul>
<?php
	if(strpos($_SESSION['ss_user']['auth_grp_cd'], 'A')==1 || $_SESSION['ss_user']['team_atcd']=="00600SL0"){
?> 
					<li><span class="folder">신청서</span>
						<ul>
							<li><span class="file"><a href="/index.php/admin/manage?managetabs=0">딜러관리</a></span></li>
<?php
		if(strpos($_SESSION['ss_user']['auth_grp_cd'], 'A')==1){
?> 
							<li><span class="file"><a href="/index.php/admin/manage?managetabs=1">담당자관리</a></span></li>
<?php 
		}
?>
							</ul>
					</li>
<?php 
	}
	if($_SESSION['ss_user']['auth_grp_cd']=="UD" || $_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['team_atcd']=="00600SL0"){
?>
					<li><span class="folder">주문서</span>
						<ul>
<?php
		if($_SESSION['ss_user']['auth_grp_cd']=="UD"){
?> 
							<li><span class="file"><a href="/index.php/admin/order?ordertabs=0">장비</a></span></li>
							<li><span class="file"><a href="/index.php/admin/order?ordertabs=1">부품</a></span></li>
<?php 
		}else{
?> 
							<li><span class="file"><a href="/index.php/admin/order?ordertabs=2">주문내역</a></span></li>
<?php 
		}
?>
							</ul>
					</li>
<?php
	}
	if($_SESSION['ss_user']['auth_grp_cd']!="UD"){
?> 
					<li><span class="folder">발송내역</span>
						<ul>
							<li><span class="file"><a href="/index.php/admin/history?historytabs=0">발송문서조회</a></span></li>
							</ul>
					</li>
<?php 
	}
?>
				</ul>
			</li>
<?php
	if($_SESSION['ss_user']['auth_grp_cd']!="UD"){
?> 
			<li><span class="folder">Product</span>
				<ul>
					<li><span class="file"><a href="/index.php/admin/product?producttabs=0">부품관리</a></span></li>
				</ul>
			</li>
			<li><span class="folder">가이드</span>
				<ul>
					<li><span class="file"><a href="/index.php/admin/guide?guidetabs=0">메뉴권한</a></span></li>
					<li><span class="file"><a href="/index.php/admin/guide?guidetabs=1">주문관리</a></span></li>
				</ul>
		</li>
<?php 
	}
?>
		</ul>
<?php 
}else{
?>
		<ul id="menu" class="filetree treeview-famfamfam">
			<li><span class="folder">FRONT</span>
				<ul>
					<li><span class="folder">신청서</span>
						<ul>
							<li><span class="file"><a href="/index.php/admin/client?clienttabs=0">Find a Dealer</a></span></li>
							<li><span class="file"><a href="/index.php/admin/client?clienttabs=1">To be a Dealer</a></span></li>
							</ul>
					</li>
				</ul>
			</li>
		</ul>
<?php 
}
?>
		