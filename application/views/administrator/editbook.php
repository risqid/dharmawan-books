<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	
	<div class="row">
		<div class="col-lg-8">
			<?php echo form_open_multipart('administrator/index');?>
			<input type="hidden" class="form-control" id="id" name="id" value="<?= $book['id']; ?>">
			<div class="form-group row">
				<label for="title" class="col-sm-2 col-form-label">title</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" value="<?= $book['title']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="author" class="col-sm-2 col-form-label">Author</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="author" name="author" value="<?= $book['author']; ?>">
					<?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="price" class="col-sm-2 col-form-label">Price</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="price" name="price" value="<?= $book['price']; ?>">
					<?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Picture</div>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-3">
							<img src="<?= base_url('assets/img/book/') . $book['image'] ?>" class="img-thumbnail">
						</div>
						<div class="col-sm-9">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="image" name="image">
								<label class="custom-file-label" for="image">Choose file</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row justify-content-end">
				<div class="col-sm-10">
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