<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/page.css">
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-id-card'></i>
            <span class="text">Simakar</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="dashboard.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="jabatan_page.php">
                    <i class='bx bxs-briefcase' ></i>
                    <span class="text">Jabatan</span>
                </a>
            </li>
            <li>
                <a href="departemen_page.php">
                    <i class='bx bxs-doughnut-chart' ></i>
                    <span class="text">Departemen</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-package'></i>
                    <span class="text">Proyek</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-user' ></i>
                    <span class="text">Karyawan</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Tim Proyek</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog' ></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="" class="logout" data-toggle="modal" data-target="#logoutModal">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
        </nav>
        <!-- NAVBAR -->

        <!-- Main Content -->
        <div class="main" style="background-color: #EEEEEE">
            <main>
            <!-- Page Title -->
            <div class="head-title">
                <div class="left" style="margin-left: 16px;">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>
</main>
            <!-- Page Title -->
    </section>

<script src="scripts/sidebar.js"></script>
</body>
</html>