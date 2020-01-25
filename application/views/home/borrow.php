<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<div class="row">
		<div class="col-lg-7 mb-4">
			<div class="alert alert-info" role="alert">Only available for member in Semarang town</div>
			<form action="<?= base_url('home/borrowinformation'); ?>" method="post">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="<?= $user['name'];?>" placeholder="masukkan nama" required readonly>
					<?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class="form-control" id="address" name="address" value="<?= $address['address']; ?>" placeholder="mauskkan alamat / kelurahan" required readonly>
					<?= form_error('address','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<div class="form-group">
					<label for="sub_district">Sub_district</label>
					<input type="text" class="form-control" id="sub_district" name="sub_district" value="<?= $address['sub_district']; ?>" placeholder="masukkan kecamatan" required readonly>
					<?= form_error('sub_district','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<input type="text" class="form-control" id="phone" name="phone" value="<?= $address['phone']; ?>" placeholder="masukkan nomor HP" required readonly>
					<?= form_error('phone','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<div class="form-group">
					<label for="time">Time</label>
					<input type="text" class="form-control" id="time" name="time" value="2" placeholder="input in weeks" required>
					<?= form_error('time','<small class="text-danger pl-3">','</small>'); ?>
				</div>
				<input type="hidden" class="form0123456789-control" id="shipping_address_id" name="shipping_address_id" value="<?= $address['id']; ?>">
				<input type="hidden" class="form-control" id="book_id" name="book_id" value="<?= $book['id']; ?>">
				<input type="hidden" class="form-control" id="price" name="price" value="<?= $book['price']; ?>">
				<div class="form-groups">
					<button type="submit" class="btn btn-primary">Use this address</button>
					<a href="<?= base_url('user/edit'); ?>" class="btn btn-primary"> Edit Address</a>
				</div>
			</form>
		</div>
	</div>
	
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->