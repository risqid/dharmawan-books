<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book-reader"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Dharmawan Books</div>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- QUERY MENU -->
  <?php
  $role_id = $this->session->userdata('role_id');
  $queryMenu = "SELECT `user_menu`.`id`, `menu` FROM `user_menu` JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id` WHERE `user_access_menu`.`role_id` = $role_id ORDER BY `user_access_menu`.`menu_id` ASC ";
  $menu = $this->db->query($queryMenu)->result_array();
  ?>
  <!-- QUERY MENU end-->
  <!-- LOOPING MENU -->
  <?php foreach ($menu as $m) : ?>
  <!-- Heading -->
  <div class="sidebar-heading">
    <?= $m['menu']; ?>
  </div>
  <!-- SIAPKAN SUB MENU SESUAI MENU -->
  <?php
  $menuId = $m['id'];
  $querySubMenu = "SELECT * FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.`menu_id`= $menuId AND `user_sub_menu`.`is_active` = 1";
  $subMenu = $this->db->query($querySubMenu)->result_array();
  ?>

  <!-- LOOPING SUB MENU -->
  <?php foreach($subMenu as $sm) : ?>
  <?php if($title == $sm['submenu']) : ?>
  <li class="nav-item active">
    <?php else : ?>
      <li class="nav-item">
    <?php endif ?>
    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
      <i class="<?= $sm['icon']; ?>"></i>
      <span><?= $sm['submenu']; ?></span></a>
    </li>
    <?php endforeach ?>
    <!-- LOOPING SUB MENU end-->
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    <?php endforeach ?>
    <!-- LOOPING MENU end -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
  <!-- End of Sidebar