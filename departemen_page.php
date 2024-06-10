<?php
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
    <title>SIMAKAR - Departemen</title>
    <link rel="stylesheet" href="assets/page.css">
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
        .table-wrapper {
            margin: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%; 
            min-width: 1065px; 
            
        }
        .btn-primary {
            background-color: #005BA7;
            border-color: #005BA7;
        }
        .btn-primary:hover {
            background-color: #004a8b;
            border-color: #004a8b;
        }
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-header h3 {
            font-size: 18px;
            color: #333333;
            margin: 0;
        }
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
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #sidebar {
            z-index: 1040; 
        }

        .modal-backdrop {
            z-index: 1050; 
        }

        .modal {
            z-index: 1060; 
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <!-- SIDEBAR -->
        <section id="sidebar">
            <a href="#" class="brand">
                <i class='bx bxs-id-card'></i>
                <span class="text">Simakar</span>
            </a>
            <ul class="side-menu top">
                <li>
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
                <li class="active">
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
                <!-- Page Title -->
                
                <!-- Page Title -->

                <!-- Tables -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-wrapper">
                                <div class="table-header">
                                    <h3>Data Departemen</h3>
                                    <button id="addButton" class="btn btn-primary">Tambah Data +</button>
                                </div>
                                <hr>
                                <table id="departemenTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Departemen</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="departemenTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tables -->

            <!-- The Modal -->
            <!-- Tambah Data Pop Up -->
            <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="addModalLabel">Tambah</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="tambahDepartemenForm">
                                <div class="form-group">
                                    <label for="departemen">Departemen <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="departemen" name="departemen" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="saveButton" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Data Pop Up -->
            <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="editModalLabel">Edit</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDepartemenForm">
                                <input type="hidden" id="editIdDepartemen" name="id_departemen">
                                <div class="form-group">
                                    <label for="editDepartemen">Departemen <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="editDepartemen" name="departemen" required>
                                </div>
                                <div class="form-group">
                                    <label for="editDeskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="4"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateButton" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hapus Data Pop Up -->
            <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center">
                        <div class="modal-body">
                            <i class="fa fa-circle-exclamation fa-3x text-warning mb-3"></i>
                            <h4>Apakah Anda ingin menghapus <br> data ini?</h4>
                            <button type="button" id="confirmDeleteButton" class="btn btn-danger mt-3">Iya</button>
                            <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>

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

             <!-- The Modal -->
    </div>

    <!-- jQuery and DataTables Scripts -->
    <script>
    $(document).ready(function() {
        var table = $('#departemenTable').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50],
            "searching": true,
            "paging": true,
            "info": true,
            "ajax": {
                "url": "php/departemen/read.php",
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [
                { "data": null, "render": function(data, type, row, meta) {
                    return meta.row + 1;
                }},
                { "data": "nama_departemen" },
                { "data": "deskripsi" },
                { "data": null, "render": function(data, type, row) {
                    return `
                        <button class='btn btn-sm btn-primary editButton' data-id='${row.id_departemen}' data-nama_departemen='${row.nama_departemen}' data-deskripsi='${row.deskripsi}'><i class='fas fa-edit'></i></button>
                        <button class='btn btn-sm btn-danger deleteButton' data-id='${row.id_departemen}'><i class='fas fa-trash'></i></button>
                    `;
                }}
            ],
            "drawCallback": function(settings) {
                $('#entriesInfo').text(`Showing ${settings._iDisplayStart + 1} to ${settings._iDisplayStart + settings._iDisplayLength} of ${settings.fnRecordsDisplay()} entries`);
            }
        });

        // CREATE OPERATION BUTTON
        $('#addButton').on('click', function () {
            $('#addModal').modal('show');
        });

        // CREATE OPERATION LOGIC
        $('#saveButton').on('click', function () {
            var formData = $('#tambahDepartemenForm').serialize();
            console.log(formData);
            $.ajax({
                url: 'php/departemen/create.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#addModal').modal('hide');
                    $('#tambahDepartemenForm')[0].reset();
                    Swal.fire({
                        title: 'Data Berhasil Disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown);
                }
            });
        });

        // UPDATE OPERATION BUTTON
        $(document).on('click', '.editButton', function() {
            const idDepartemen = $(this).data('id'); // $(this).data('id'); ini tidak perlu diubah ya, cukup penamaan variabelnya saja
            const departemen = $(this).data('nama_departemen');
            const deskripsi = $(this).data('deskripsi');

            console.log(departemen);

            $('#editIdDepartemen').val(idDepartemen);
            $('#editDepartemen').val(departemen);
            $('#editDeskripsi').val(deskripsi);

            $('#editModal').modal('show');
        });

        // UPDATE OPERATION LOGIC
        $('#updateButton').click(function() {
            const idDepartemen = $('#editIdDepartemen').val();
            const departemen = $('#editDepartemen').val();
            const deskripsi = $('#editDeskripsi').val();

            $.ajax({
                url: 'php/departemen/update.php',
                type: 'POST',
                data: {
                    action: 'update',
                    id_departemen: idDepartemen,
                    nama_departemen: departemen,
                    deskripsi: deskripsi
                },
                success: function(response) {
                    $('#editModal').modal('hide');
                    Swal.fire({
                        title: 'Perubahan Berhasil Disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    table.ajax.reload(null, false);
                },
                error: function(error) {
                    console.log('Error updating data', error);
                }
            });
        });

        // DELETE OPERATION BUTTON
        let deleteId;
        $(document).on('click', '.deleteButton', function() {
            deleteId = $(this).data('id'); 
            $('#deleteModal').modal('show');
            console.log(deleteId);
        });


        // DELETE OPERATION LOGIC
        $('#confirmDeleteButton').click(function() {
            $.ajax({
                url: 'php/departemen/delete.php',
                type: 'POST',
                data: {
                    id_departemen: deleteId
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    Swal.fire({
                            title: 'Data Berhasil Dihapus',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    table.ajax.reload(null, false);
                },
                error: function(error) {
                    console.log('Error deleting data', error);
                }
            });
        });

        // CLOSE POP UP
        $('.close, .btn-secondary').click(function() {
            $('#addModal').modal('hide');
            $('#editModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
    });
</script>
<script src="scripts/sidebar.js"></script>
</body>
</html>