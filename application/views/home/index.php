<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>

	<div id="portfolio-grid" class="row no-gutter mb-3" data-aos="fade-up" data-aos-delay="200">
		<?php foreach($book as $b) : ?>
		<div class="col-4 mt-3 mb-2  ">
			<div class="item web">
				
				<div class="item-wrap fancybox">
					<div class="work-info text-gray-100">
						<h3><strong><?= $b['title']; ?></strong></h3>
						<span><strong><?= $b['author']; ?></strong></span><br>
						<span><strong>IDR <?= $b['price']; ?></strong></span>
					</div>
					<img class="img-fluid mt-2" src="<?= base_url('assets/img/book/') . $b['image']; ?>" style="height: 500px; width: 350px">
				</div>
				
			</div>
			<div class="align-items-center justify-content-between">
				<a href="<?= base_url('home/shippingaddress/').$b['id']?>" class="btn btn-primary btn-icon-split">
					<span class="text">Buy</span>
				</a>
				<a href="<?= base_url('home/borrow/').$b['id']; ?>" class="btn btn-primary btn-icon-split">
					<span class="text">Borrow</span>
				</a>
			</div>
		</div>
		<?php endforeach ?>
		
	</div>
	
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->