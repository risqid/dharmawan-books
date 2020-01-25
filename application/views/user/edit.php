<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	
	<div class="row">
		<div class="col-lg-8">
			
			<?php echo form_open_multipart('user/edit');?>
			<input type="hidden" class="form-control" id="email" name="email" value="<?= $user['id']; ?>">
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label">Full Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" required placeholder="Fullname">
					<?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="address" class="col-sm-2 col-form-label">Address</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="address" name="address" value="<?= $address['address']; ?>" required placeholder="alamat / kelurahan">
					<?= form_error('address','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="sub_district" class="col-sm-2 col-form-label">Sub District</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="sub_district" name="sub_district" value="<?= $address['sub_district']; ?>" required placeholder="kecamatan">
					<?= form_error('sub_district','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="city" class="col-sm-2 col-form-label">City</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="city" name="city" value="<?= $address['city']; ?>" required placeholder="kota / kabupaten">
					<?= form_error('city','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="province" class="col-sm-2 col-form-label">Province</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="province" name="province" value="<?= $address['province']; ?>" required placeholder="provinsi">
					<?= form_error('province','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="country" class="col-sm-2 col-form-label">country</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="country" name="country" value="<?= $address['country']; ?>" required placeholder="negara">
					<?= form_error('country','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="phone" name="phone" value="<?= $address['phone']; ?>" required placeholder="phone">
					<?= form_error('phone','<small class="text-danger pl-3">','</small>'); ?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Picture</div>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-3">
							<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
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