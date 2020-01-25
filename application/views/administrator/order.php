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

			<table class="table table-hover border-left-primary">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Order ID</th>
						<th scope="col">User ID</th>
						<th scope="col">Book ID</th>
						<th scope="col">Date</th>
						<th scope="col">Payment Status</th>
						<th scope="col">Delivery Status</th>
						<th scope="col">Total</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($user_order as $uo) :?>
					<tr>
						<th scope="row"><?= $i; ?></th>
						<td><?= $uo['id']; ?></td>
						<td><?= $uo['user_id']; ?></td>
						<td><?= $uo['book_id']; ?></td>
						<td><?= date('d F Y', $uo['date']); ?></td>
						<td><?= $uo['payment_status']; ?></td>
						<td><?= $uo['delivery_status']; ?></td>
						<td><?= $uo['total']; ?></td>
						<td>
							<a href="<?= base_url('administrator/editorder/').$uo['id'];  ?>" class="badge badge-success">Update</a>
							<a href="<?= base_url('administrator/deleteorder/').$uo['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete this order?')">Delete</a>
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
