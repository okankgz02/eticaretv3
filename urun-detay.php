<?php include 'header.php';

$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
$urunsor->execute(array(
	'urun_id' => $_GET['urun_id']
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);


$kullanici_id=$kullanicicek['kullanici_id'];
$urun_id=$uruncek['urun_id'];

$yorumsor=$db->prepare("SELECT * FROM yorumlar where urun_id=:urun_id");
$yorumsor->execute(array(
	'urun_id' => $urun_id
));



?>





<?php 

if ($_GET['durum']=="ok") {?>

	<script type="text/javascript">
		alert("Yorum Başarıyla Eklendi");
	</script>

<?php }
?>


<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<?php include 'sidebar.php'; ?>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="images/product-details/1.jpg" alt="" />
							<h3>ZOOM</h3>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
								</div>

							</div>

							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>

					<form action="nedmin/netting/islem.php" method="POST">
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']?>">
								<h2> <?php echo $uruncek['urun_ad'] ?></h2>
								<p >Web ID :<?php echo $uruncek['urun_id'] ?></p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span><?php echo $uruncek['urun_fiyat'] ?> Tl</span>
									<label>Miktar:</label>
									<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"/>
									<input type="text" name="urun_adet" value="1" />
									<button  type="submit"  name="sepetekle" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Sepete Ekle
									</button>

								</span>

								<p><b>Stok Miktarı:</b name="urun_stok"> <?php echo $uruncek['urun_stok'] ?></p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> E-SHOPPER</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>

					</form>
				</div><!--/product-details-->

				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#details" data-toggle="tab">Ayrıntılar</a></li>
							<li><a href="#companyprofile" data-toggle="tab">Şirket Profili</a></li>

							<li class="active"><a href="#reviews" data-toggle="tab">Yorum Yaz (<?php 
								echo $say=$yorumsor->rowCount();
								?>) </a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >



								<?php 

								$kategori_id=$uruncek['kategori_id'];

								$urunaltsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by  rand() limit 3");
								$urunaltsor->execute(array(
									'kategori_id' => $kategori_id
								));

								while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) { ?>


									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/gallery1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>

								<?php } ?>

							</div>

							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i><?php echo  $_SESSION['userkullanici_mail']; ?></a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lütfen argo ifadeler yazmayın</p>

									<?php if (isset($_SESSION['userkullanici_mail'])) {?>
										<h3><p style="color:#FF4500"><b>Yorumunuz</b></p></h3>	

										<form action="nedmin/netting/islem.php" method="POST">
											<span>
												<input type="text"  placeholder="<?php echo $kullanicicek['kullanici_adsoyad']?>" disabled="true"/>
												<input type="email" placeholder="<?php echo $kullanicicek['kullanici_mail']?>" disabled="true"/>
											</span>
											<input type="hidden" name="gelen_url" value="<?php 
											echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; 

											?>">

											<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']?>">
											<input type="hidden" name="urun_id" value="<?php echo $urun_id;?>">
											<textarea name="yorum_detay" placeholder="Yorumunuzu yazın."></textarea>
											<b>Resim: </b> <img src="images/product-details/rating.png" alt="" />
											<button type="submit" name="yorumkaydet" class="btn btn-default pull-right">
												Gönder
											</button>


										</form>

									<?php }else {?>
										Yorum yapabilmeniz için  <a href="login.php"><b> giriş </b></a> yapmalısınız.
									<?php } ?>

									<hr>	
									<h4 style="color:#FF8C00">Yorumlarınız :</h4>

									<?php 

									while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {

										$ykullanici_id=$yorumcek['kullanici_id'];

										$ykullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
										$ykullanicisor->execute(array(
											'id' => $ykullanici_id
										));

										$ykullanicicek=$ykullanicisor->fetch(PDO::FETCH_ASSOC);
										?>




										<p class="dash">
											<span><b><?php echo $ykullanicicek['kullanici_adsoyad'] ?></b></span> (<?php echo $yorumcek['yorum_zaman'] ?>)<br><br>
											<?php echo $yorumcek['yorum_detay'] ?>
										</p>

										<hr>
									<?php } ?>


									<hr>

								</div>
							</div>

						</div>
					</div><!--/category-tab-->


					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center"><?php $uruncek['urun_seourl'] ?></h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	


									<?php 

									$kategori_id=$uruncek['kategori_id'];

									$urunaltsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by  rand() limit 3");
									$urunaltsor->execute(array(
										'kategori_id' => $kategori_id
									));

									while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {

										?>

										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="images/home/recommend3.jpg" alt="" />
														<h2><?php echo $urunaltcek['urun_fiyat'] ?></h2>
														<p><?php echo $urunaltcek['urun_ad'] ?></p>
														<a href="urun-<?= ($uruncek['urun_ad']).'-'.$uruncek["urun_id"]  ?>">	<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete Ekle</button></a>
													</div>
												</div>
											</div>
										</div>

									<?php } ?>


								</div>



							</div>
						</div>

					</div>
				</div><!--/recommended_items-->

			</div>
		</div>
	</div>
</section>
<?php include 'header.php'; ?>