<div class="shop__sidebar">
	<aside class="wedget__categories poroduct--cat">
		<h3 class="wedget__title">Book Categories</h3>
		<ul>
			<?php
				$sql = "SELECT * FROM category WHERE sub_category = 0";
				$cat_res = mysqli_query($db,$sql);
				while($rowCAT = mysqli_fetch_assoc($cat_res)){
					$totalBooks = 0;
					$cat_id = $rowCAT['cat_id'];
					$cat_name = $rowCAT['cat_name'];
					$subSql = "SELECT * FROM category WHERE sub_category = '$cat_id'";
					$res_subCat = mysqli_query($db,$subSql);
					if(mysqli_num_rows($res_subCat) > 0){
						while($rowSUB = mysqli_fetch_assoc($res_subCat)){
							$sub_cat = $rowSUB['cat_id'];
							$sub_books = $db->query("SELECT * FROM books WHERE bk_cat = '$sub_cat'")->num_rows;
							$totalBooks += $sub_books; 
						}
					}
					else{
						$cat_books = $db->query("SELECT * FROM books WHERE bk_cat = '$cat_id'")->num_rows;
						$totalBooks += $cat_books; 
					}
					?>
						<li><a href="shop-grid.php?action=Category&cat_id=<?=$cat_id?>"><?=$cat_name;?> <span>(<?=$totalBooks?>)</span></a></li>
					<?php
				}
			?>
		</ul>
	</aside>
	
	
	<aside class="wedget__categories poroduct--tag">
		<h3 class="wedget__title">Book Tags</h3>
		<ul>
			<?php
				$sql = "SELECT bk_meta FROM books";
				$resMeta = mysqli_query($db,$sql);
				while($rowMt = mysqli_fetch_assoc($resMeta)){
					$metas   = explode(' ',$rowMt['bk_meta']);
					foreach($metas as $meta){
						?>
							<li><a href="shop-grid.php?action=Meta&meta_tag=<?=$meta?>"><?=strtoupper($meta)?></a></li>
						<?php
					}
				}
			?>
			
		</ul>
	</aside>
	
</div>