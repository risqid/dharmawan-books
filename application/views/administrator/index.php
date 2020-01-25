<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<div class="row">
		<div class="col-lg">
			<?php if(validation_errors()) : ?>
			<div class="alert alert-danger" role="alert">
				<?= validation_errors(); ?>
			</div>
			<?php endif ?>
			<?= $this->session->flashdata('message') ; ?>
			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBookModal">Add New Book</a>
			<table class="table table-hover  border-left-primary">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Title</th>
						<th scope="col">Author</th>
						<th scope="col">Price</th>
						<th scope="col">Image</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($book as $b) :?>
					<tr>
						<th scope="row"><?= $i; ?></th>
						<td><?= $b['title']; ?></td>
						<td><?= $b['author']; ?></td>
						<td><?= $b['price']; ?></td>
						<td><?= $b['image']; ?></td>
						<td>
							<a href="<?= base_url('administrator/editbook/').$b['id']; ?>" class="badge badge-success" >edit</a>
							<a href="<?= base_url('administrator/deletebook/').$b['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete this book?')">delete</a>
						</td>
					</tr>
					<?php $i++ ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- New Book Modal -->
<div class="modal fade" id="newBookModal" tabindex="-1" role="dialog" aria-labelledby="newBookModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="newBookModalLabel">Add New Book</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php echo form_open_multipart('administrator/index');?>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" class="form-control" id="title" name="title" placeholder="Title" autofocus required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="author" name="author" placeholder="Author" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
				</div>
				<div class="form-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="image" name="image" required>
						<label class="custom-file-label" for="image">Choose file</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
		</form>
	</div>
</div>
</div>