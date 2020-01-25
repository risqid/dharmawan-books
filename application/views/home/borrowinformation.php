<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	
	<?= $this->session->flashdata('message'); ?>
	<a href="<?= base_url('home/borrowed'); ?>" class="btn btn-primary btn-icon-split btn-lg">
		<span class="text">Get Borrow ID</span>
	</a>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->