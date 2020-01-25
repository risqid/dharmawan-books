<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<div class="row">
		<div class="col-lg-8">
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('menu'); ?>" method="post">
				<input type="hidden" class="form-control" id="id" name="id" value="<?= $menu['id'];?>" readonly>
				<div class="form-group row">
					<label for="menu" class="col-sm-2 col-form-label">Menu</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="menu" name="menu" required value="<?= $menu['menu']; ?>">
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit"  class="btn btn-primary">Change Menu Name</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->