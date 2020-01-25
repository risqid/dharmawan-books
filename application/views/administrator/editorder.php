<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<div class="row">
		<div class="col-lg-8">
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('administrator/order'); ?>" method="post">
				<div class="form-group row">
					<label for="id" class="col-sm-3 col-form-label">Order ID</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="id" name="id" value="<?= $user_order[0]['id']; ?>" readonly >
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="user_id" class="col-sm-3 col-form-label">User ID</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="user_id" name="user_id" value="<?= $user_order[0]['user_id']; ?>" readonly >
					</div>
				</div>
				<div class="form-group row">
					<label for="book_id" class="col-sm-3 col-form-label">Book ID</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="book_id" name="book_id" value="<?= $user_order[0]['book_id']; ?>" readonly >
					</div>
				</div>
				<div class="form-group row">
					<label for="date" class="col-sm-3 col-form-label">User ID</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="date" name="date" value="<?= date('d F Y', $user_order[0]['date']); ?>" readonly >
					</div>
				</div> -->
				<div class="form-group row">
					<label for="payment_status" class="col-sm-3 col-form-label">Payment Status</label>
					<div class="col-sm-8">
						<select name="payment_status" id="payment_status" class="form-control" autofocus required>
							<option value="<?= $user_order[0]['payment_status']; ?>">change status</option>
							<option value="pending">pending</option>
							<option value="paid">paid</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="delivery_status" class="col-sm-3 col-form-label">Delivery Status</label>
					<div class="col-sm-8">
						<select name="delivery_status" id="delivery_status" class="form-control" required>
							<option value="<?= $user_order[0]['delivery_status']; ?>">change status</option>
							<option value="on proccess"><p>on process</p></option>
							<option value="on the way">on the way</option>
							<option value="delivered">delivered</option>
						</select>
					</div>
				</div>
			<!-- 	<div class="form-group row">
					<label for="total" class="col-sm-3 col-form-label">Total</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="total" name="total" value="<?= $user_order[0]['total']; ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="shipping_address_id" class="col-sm-3 col-form-label">Shipping Address Id</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="shipping_address_id" name="shipping_address_id" value="<?= $user_order[0]['shipping_address_id']; ?>" readonly>
					</div>
				</div> -->
				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit"  class="btn btn-primary" onclick="return confirm('Are you sure you have edited this form?')">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content