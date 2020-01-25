<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<div class="col-lg">
			<table class="table table-hover border-left-primary">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Order ID</th>
						<th scope="col">Name</th>
						<th scope="col">Book</th>
						<th scope="col">Payment Status</th>
						<th scope="col">Delivery Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($user_order as $uo) :?>
					<tr>
						<th scope="row"><?= $i; ?></th>
						<td><?= $uo['id']; ?></td>
						<td><?= $user['name']; ?></td>
						<td><?= $uo['title']; ?></td>
						<td><?= $uo['payment_status']; ?></td>
						<td><?= $uo['delivery_status']; ?></td>
						<td>
							<a href="<?= base_url('home/confirm/').$uo['id']; ?>" class="badge badge-success">confirm</a>
							<a href="<?= base_url('home/cancelorder/').$uo['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to cancel this order?')">cancel</a>
						</td>
					</tr>
					<?php $i++ ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<?php echo form_open_multipart('home/paymentconfirmation');?>
			<div class="form-group row">
				<label for="orders_id" class="col-sm-3 col-form-label">Order ID</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="orders_id" name="orders_id" required placeholder="input your order id">
					<?= form_error('orders_id','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="file" class="col-sm-3 col-form-label">File</label>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-9">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="file" name="file" required>
								<label class="custom-file-label" for="file">Choose file</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row justify-content-end">
				<div class="col-sm-9">
					<button type="submit"  class="btn btn-primary">Upload</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->