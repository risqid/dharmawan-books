<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	
	<div class="row">
		<div class="col-lg-8">
			<?php echo form_open_multipart('administrator/role');?>
			<input type="hidden" class="form-control" id="id" name="id" value="<?= $role['id']; ?>">
			<div class="form-group row">
				<label for="role" class="col-sm-1 col-form-label">Role</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="role" name="role" value="<?= $role['role']; ?>">
				</div>
			</div>
			<div class="form-group row justify-content-end">
				<div class="col-sm-11">
					<button type="submit"  class="btn btn-primary">Edit</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->