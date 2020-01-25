<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	
	<div class="card mb-3" style="max-width: 840px;">
		<div class="row no-gutters">
			<div class="col">
				<div class="card-body">
					<h5 class="card-title">Your Borrow ID</h5>
					<dl class="row">
						<dt class="col-sm-2">Borrow ID</dt>
						<dd class="col-sm-9">: #<?= $borrow_id['id']; ?></dd>
						<dt class="col-sm-2">Name</dt>
						<dd class="col-sm-9">: <?= $user['name']; ?></dd>
						<dt class="col-sm-2">Date</dt>
						<dd class="col-sm-9">: <?= date('d F Y', $borrow_information['date']); ?></dd>
						<dt class="col-sm-2">Title</dt>
						<dd class="col-sm-9">: <?= $book['title']; ?></dd>
						<dt class="col-sm-2">Time</dt>
						<dd class="col-sm-9"><?= $borrow_information['time']; ?> weeks</dd>
						</dd>
					</dl>
					<br>
					<div class="alert alert-primary" role="alert">
						<p>Plesae save your <strong>Order ID</strong>, you gonna need it to take the book</p>
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