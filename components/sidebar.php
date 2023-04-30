<?php
include('./connections/global.php');
?><nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="./index.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php
    if ($user_type == 'superadmin') {
      echo '<li class="nav-item nav-category">Admin</li>
        <li class="nav-item">
          <a href="profile_create.php" class="nav-link">
            <i class="menu-icon mdi mdi-floor-plan"></i>
            <span class="menu-title">Create Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="admin_list.php" class="nav-link">
            <i class="menu-icon mdi mdi-floor-plan"></i>
            <span class="menu-title">View Admin</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="food_stall_list.php" class="nav-link">
            <i class="menu-icon mdi mdi-floor-plan"></i>
            <span class="menu-title">View Food Stall</span>
          </a>
        </li>';
    }
    ?>
    <li class="nav-item nav-category">User</li>
    <li class="nav-item">
      <a href="clients_list.php" class="nav-link">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item nav-category">Ticket</li>
    <li class="nav-item">
      <a href="ticket_list.php" class="nav-link">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Ticket</span>
      </a>
    </li>
    <li class="nav-item nav-category">Product</li>
    <li class="nav-item">
      <a href="./product_add.php" class="nav-link">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Add Product</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="./product_list.php" class="nav-link">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">View Product</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="./category_add.php" class="nav-link">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Add Category</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="./category_list.php" class="nav-link">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">View Category</span>
      </a>
    </li>
    <li class="nav-item nav-category">Settings</li>
    <li class="nav-item">
      <a class="nav-link" href="./profile.php">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">Profile</span>
      </a>
    </li>
  </ul>
</nav>