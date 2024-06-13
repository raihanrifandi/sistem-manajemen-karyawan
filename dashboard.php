<?php
include 'card.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/page.css">
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
 /* Modal styles */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 10px;
        }
        .modal-header h2 {
            font-size: 18px;
            margin: 0;
        }
        .modal-body {
            padding: 32px 0;
            margin: 8px 18px;
        }
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding-top: 10px;
            border-top: 1px solid #e5e5e5;
        }
        .modal-footer button {
            margin-left: 10px;
        }
        .modal-backdrop {
            z-index: 2000; 
        }
        .modal {
            z-index: 2050; 
        }
</style>
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
                <a href="proyek_page.php">
                    <i class='bx bxs-package'></i>
                    <span class="text">Proyek</span>
                </a>
            </li>
            <li>
                <a href="karyawan_page.php">
                    <i class='bx bxs-user' ></i>
                    <span class="text">Karyawan</span>
                </a>
            </li>
            <li>
                <a href="tim_proyek_page.php">
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
                        <i class='bx bxs-group' ></i>
                        <span class="text">
                            <h3><?php echo $total_karyawan; ?></h3>
                            <p>Karyawan</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-package' ></i>
                        <span class="text">
                            <h3><?php echo $total_proyek; ?></h3>
                            <p>Proyek</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-doughnut-chart' ></i>
                        <span class="text">
                            <h3><?php echo $total_departemen; ?></h3>
                            <p>Departemen</p>
                        </span>
                    </li>
                </ul>
            </main>
    </section>

    <!-- Logout Modal -->
    <div id="logoutModal" class="modal fade" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin logout?
                        </div>
                        <div class="modal-footer">
                            <a href="php/login/logout.php" class="btn btn-primary">Iya</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>


    



   
<script src="scripts/sidebar.js"></script>
</body>
</html>