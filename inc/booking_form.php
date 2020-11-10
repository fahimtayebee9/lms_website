<div class="booking-form mt-5 mb-4">
	<div class="booking-bg">
		<div class="form-header">
			<h2>Make your Booking</h2>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at</p>
		</div>
	</div>
	<form action="checkout.php?action=Insert" method="POST">
		<div class="row">
			<div class="col-md-12 text-center">
				<h3>Booking details</h3>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<span class="form-label">Borrow Date</span>
					<input class="form-control" type="date" name="book_from" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<span class="form-label">Return Date</span>
					<input class="form-control" type="date" name="book_to" required>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<span class="form-label">Book Name</span>
			<select class="form-control w-100" style="border-radius: 50%!important;" required id="select2bk" name="book_id">
				<option value="0">Please Select A Book</option>
				<?php
					$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : "";
					
					$catSQL = "SELECT * FROM category ORDER BY cat_name ASC";
					$res_cat = mysqli_query($db,$catSQL);
					while($rowcat = mysqli_fetch_assoc($res_cat)){
						$cat_id = $rowcat['cat_id'];
						$count_catBooks = $db->query("SELECT * FROM books WHERE bk_cat = '$cat_id' AND bk_status = 1 ORDER BY bk_name ASC")->num_rows;
						if($count_catBooks > 0){
							?>
								<optgroup label="<?=$rowcat['cat_name']?>">
							<?php
								$booksSQL = "SELECT * FROM books WHERE bk_cat = '$cat_id' AND bk_status = 1 ORDER BY bk_name ASC";
								$res_books = mysqli_query($db,$booksSQL);
								while($rowBooks = mysqli_fetch_assoc($res_books)){
									?>
										<option value="<?=$rowBooks['bk_id']?>" <?php if($book_id == $rowBooks['bk_id'] ){echo "selected";}?>><?=$rowBooks['bk_name']?></option>
									<?php
								}
							?>
								</optgroup>
							<?php
						}
					}
				?>
			</select>
			<span class="select-arrow"></span>
		</div>

		<div class="form-btn">
			<?php
				if(isset($_SESSION['rev_user'])){
					?>
						<button type="submit" name="confirm" class="submit-btn">Confirm Booking</button>
					<?php
				}
				else{
					?>
						<button class="submit-btn disabled" onclick="infobox()">Confirm Booking</button>
					<?php
				}
			?>
			
		</div>
	</form>
</div>