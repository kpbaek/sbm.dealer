		
<?php 
if (isset($_SESSION['ss_user']['uid'])){
?>
		<ul id="menu" class="filetree treeview-famfamfam">
			<li><span class="folder">수주관리</span>
				<ul>
<?php
	if($_SESSION['ss_user']['auth_grp_cd']!="UD"){
?> 
					<li><span class="folder">신청서</span>
						<ul>
							<li><span class="file"><a href="/index.php/admin/manage?managetabs=0">딜러관리</a></span></li>
<?php
		if($_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['auth_grp_cd']=="WA"){
?> 
							<li><span class="file"><a href="/index.php/admin/manage?managetabs=1">담당자관리</a></span></li>
<?php 
		}
?>
							</ul>
					</li>
<?php 
	}
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
	if($_SESSION['ss_user']['auth_grp_cd']!="UD"){
?> 
					<li><span class="folder">사내문서</span>
						<ul>
							<li><span class="file"><a href="/index.php/admin/docs?doctabs=0">생산의뢰서</a></span></li>
							<li><span class="file"><a href="/index.php/admin/docs?doctabs=1">출고전표</a></span></li>
							<li><span class="file"><a href="/index.php/admin/docs?doctabs=2">부품출고의뢰서</a></span></li>
							</ul>
					</li>
					<li><span class="folder">외부발송문서</span>
						<ul>
							<li><span class="file"><a href="/index.php/admin/outer?outertabs=0">Proforma Invoice</a></span></li>
							<li><span class="file"><a href="/index.php/admin/outer?outertabs=1">Invoice</a></span></li>
							<li><span class="file"><a href="/index.php/admin/outer?outertabs=2">Packing List</a></span></li>
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
					</li>
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
		
		