<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<div class="row">
		<div class="col-lg-8">
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('menu/submenu'); ?>" method="post">
				<div class="form-group">
					<input type="hidden" class="form-control" id="id" name="id" required value="<?= $subMenu['id']; ?>">
				</div>
				<div class="form-group row">
					<label for="submenu" class="col-sm-2 col-form-label">Submenu</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="submenu" name="submenu" required value="<?= $subMenu['submenu']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="menu" class="col-sm-2 col-form-label">Menu</label>
					<div class="col-sm-8">
						<select name="menu_id" id="menu_id" class="form-control">
						<option value="<?= $currentMenu['id']; ?>">Select Menu</option>
						<?php foreach ($menu as $m) : ?>
						<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
						<?php endforeach ?>
					</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="url" class="col-sm-2 col-form-label">URL</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="url" name="url" value="<?= $subMenu['url']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="icon" class="col-sm-2 col-form-label">Icon</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="icon" name="icon" value="<?= $subMenu['icon']; ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label for="is_active" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-8">
						<input class="form-check-input mx-1" type="checkbox" value="1" name="is_active" id="is_active" checked>
						<label class="form-check-label mx-4" for="is_active">
							Active?
						</label>
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit"  class="btn btn-primary">Edit Submenu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->