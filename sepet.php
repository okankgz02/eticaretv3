<?php include 'header.php'?>


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Anasayfa</a></li>
				<li class="active">Alışveriş</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Ürün</td>
						<td class="description"></td>
						<td class="price">Fiyat</td>
						<td class="quantity">Miktar</td>
						<td class="total">Toplam</td>
						<td></td>
					</tr>
				</thead>
				<tbody>


					<?php 
					$kullanici_id=$kullanicicek['kullanici_id'];
					$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
					$sepetsor->execute(array(
						'id' => $kullanici_id
					));

					while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

						$urun_id=$sepetcek['urun_id'];
						$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
						$urunsor->execute(array(
							'urun_id' => $urun_id
						));

						$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
						$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
						?>

						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $uruncek["urun_ad"]?></a></h4>
								<p>Ürün ID: <?php echo $uruncek["urun_id"]?></p>
							</td>
							<td class="cart_price">
								<p><?php echo $uruncek["urun_fiyat"]?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>

									<input class="cart_quantity_input" type="text" name="urun_adet" value="<?php echo $sepetcek["urun_adet"];?>
									" disabled="true" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo $sepetcek["urun_adet"]*$uruncek["urun_fiyat"] ?> $</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>

						?

					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="chose_area">
					<ul class="user_option">
						<li>
							<input type="checkbox">
							<label>İndirimli Kupon Kodu</label>
						</li>
						<li>
							<input type="checkbox">
							<label>Use Gift Voucher</label>
						</li>
						<li>
							<input type="checkbox">
							<label>Estimate Shipping & Taxes</label>
						</li>
					</ul>
					<ul class="user_info">
						<li class="single_field">
							<label>Country:</label>
							<select>
								<option>United States</option>
								<option>Bangladesh</option>
								<option>UK</option>
								<option>India</option>
								<option>Pakistan</option>
								<option>Ucrane</option>
								<option>Canada</option>
								<option>Dubai</option>
							</select>

						</li>
						<li class="single_field">
							<label>Region / State:</label>
							<select>
								<option>Select</option>
								<option>Dhaka</option>
								<option>London</option>
								<option>Dillih</option>
								<option>Lahore</option>
								<option>Alaska</option>
								<option>Canada</option>
								<option>Dubai</option>
							</select>

						</li>
						<li class="single_field zip-field">
							<label>Zip Code:</label>
							<input type="text">
						</li>
					</ul>
					<a class="btn btn-default update" href="">Get Quotes</a>
					<a class="btn btn-default check_out" href="">Continue</a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Toplam <span><?php echo $toplam_fiyat; ?></span></li>
						<li>Vergi <span>$2</span></li>
						<li>Maliyet <span>22</span></li>
						<li>Ödemeniz <span>$61</span></li>
					</ul>
					<a class="btn btn-default update" href="">Update</a>
					<a class="btn btn-default check_out" href="">Ödeme Sayfası</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->
<?php include 'footer.php' ?>