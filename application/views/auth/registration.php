<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" name="name" required placeholder="Full name" autofocus value="<?= set_value('name'); ?>">
                <?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="email" name="email" required placeholder="Email Address" value="<?= set_value('email'); ?>">
                <?= form_error('email','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="address" name="address" required placeholder="address" value="<?= set_value('address'); ?>">
                <?= form_error('address','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="sub_district" name="sub_district" required placeholder="sub_district" value="<?= set_value('sub_district'); ?>">
                <?= form_error('sub_district','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="city" name="city" required placeholder="city" value="<?= set_value('city'); ?>">
                <?= form_error('city','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="province" name="province" required placeholder="province" value="<?= set_value('province'); ?>">
                <?= form_error('province','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="country" name="country" required placeholder="country" value="<?= set_value('country'); ?>">
                <?= form_error('country','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="phone" name="phone" required placeholder="phone" value="<?= set_value('phone'); ?>">
                <?= form_error('phone','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="password1" name="password1" required placeholder="Password at least 4 chatacters">
                  <?= form_error('password1','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="password2" name="password2" required placeholder="Repeat Password">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
              Register Account
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="forgot-password.html">Forgot Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>