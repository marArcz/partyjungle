<aside class="sidebar-wrapper">
    <div class="sidebar">
        <div class="sidebar-header">
            <button class="btn border-0" type="button">
                <i class="bx bx-menu bx-sm text-light"></i>
            </button>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <img src="../assets/images/ban_img1.png" alt="" class="img-fluid">
                </div>
            </div>
            <p class="text-center my-2 text-light">
                <small style="font-size: 11px;">Ordering Management System</small>
            </p>
        </div>
        <hr class="bg-light text-light">
        <ul class="nav sidebar-nav mt-4">
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "dashboard" ? "active" : "" ?>">
                <a href="dashboard.php" class="nav-link">
                    <i class='bx bxs-tachometer bx-sm'></i>
                    <span class="label">Dashboard</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "orders" ? "active" : "" ?>">
                <a href="orders.php" class="nav-link">
                    <i class='bx bxs-time bx-sm'></i>
                    <span class="label">Orders</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "messages" ? "active" : "" ?>">
                <a href="messages.php" class="nav-link">
                    <i class='bx bxs-chat bx-sm'></i>
                    <span class="label">
                        Messages
                    </span>
                    <span style="font-size:12px" class="badge text-bg-light px-2 py-1 rounded-pill ms-2">
                        <small>4</small>
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "products" ? "active" : "" ?>">
                <a href="products.php" class="nav-link">
                    <i class='bx bxs-package bx-sm'></i>
                    <span class="label">
                        Products
                    </span>

                </a>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "categories" ? "active" : "" ?>">
                <a href="categories.php" class="nav-link">
                    <i class='bx bxs-category bx-sm'></i>
                    <span class="label">
                        Categories
                    </span>

                </a>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "reports" ? "active" : "" ?>">
                <a href="dashboard.php" class="nav-link">
                    <i class='bx bxs-folder-open bx-sm'></i>
                    <span class="label">
                        Reports
                    </span>

                </a>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "personnel" ? "active" : "" ?>">
                <a href="dashboard.php" class="nav-link">
                    <i class='bx bxs-truck bx-sm'></i>
                    <span class="label">
                        Delivery Personnel
                    </span>

                </a>
            </li>
            <li class="nav-item px-4 text-light opacity-50 mb-2">
                <small>SYSTEM</small>
            </li>
            <li class="nav-item w-100 mb-4 <?php echo $active_page == "settings" ? "active" : "" ?>">
                <a href="dashboard.php" class="nav-link">
                    <i class='bx bxs-cog bx-sm'></i>
                    <span class="label">
                        System Settings
                    </span>

                </a>
            </li>
        </ul>
    </div>
</aside>