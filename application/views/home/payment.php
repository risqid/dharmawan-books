<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	
	<div class="card mb-3" style="max-width: 840px;">
		<div class="row no-gutters">
			<div class="col">
				<div class="card-body">
					<h5 class="card-title">Your Order Details</h5>
					<dl class="row">
						<dt class="col-sm-3">Order ID</dt>
						<dd class="col-sm-9">: #<?= $order_id['id']; ?></dd>
						<dt class="col-sm-3">Name</dt>
						<dd class="col-sm-9">: <?= $user['name']; ?></dd>
						<dt class="col-sm-3">Date</dt>
						<dd class="col-sm-9">: <?= date('d F Y', $order_information['date']); ?></dd>
						<dt class="col-sm-3">Item</dt>
						<dd class="col-sm-9">
						<dl class="row">
							<dt class="col-sm-2">Title</dt>
							<dd class="col-sm-9">: <?= $book['title']; ?></dd>
							<dt class="col-sm-2">Price</dt>
							<dd class="col-sm-9">: <?= $book['price']; ?></dd>
						</dl>
						</dd>
						<dt class="col-sm-3">Payment Status</dt>
						<dd class="col-sm-9">: <?= $order_information['payment_status']; ?></dd>
						<dt class="col-sm-3">Delivery Status</dt>
						<dd class="col-sm-9">: <?= $order_information['delivery_status']; ?></dd>
						<dt class="col-sm-3">Total</dt>
						<dd class="col-sm-9">: <?= $book['price']; ?></dd>
						<dt class="col-sm-3">Shipping Address</dt>
						<dd class="col-sm-9">: <?= $address['address'].' '.$address['sub_district'].' '.$address['city'].' '.$address['province'] ; ?></dd>
						<dt class="col-sm-3">Phone Number</dt>
						<dd class="col-sm-9">: <?= $address['phone']; ?></dd>
					</dl>
					<br>
					<div class="alert alert-primary" role="alert">
						<p>Plesae save your <strong>Order ID</strong>, you gonna need it to confirm your payment</p>
						<p>Transfer to BNI account within 1x24 hours. Muhammad Risqi Dharmawan : 0987654321 </p>
						<p>Confirm your order in My Order page</p>
					</div>
				</div>
			</div>

		</div>

	</div>
	<a href="<?= base_url('home'); ?>" class="btn btn-primary mt-4">Continue looking for book</a>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content