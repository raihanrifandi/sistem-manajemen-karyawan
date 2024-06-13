<?php

include 'config/koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Dropdown
$karyawanResult = mysqli_query($conn, "SELECT id_karyawan, nama_karyawan FROM karyawan WHERE id_jabatan = 7");
$karyawanOptions = [];
while ($row = mysqli_fetch_assoc($karyawanResult)) {
    $karyawanOptions[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAKAR - Proyek</title>
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
            min-width: 1450px;
            
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
        .btn.viewButton {
            background-color: #1e90ff; 
            border-color: #1e90ff;
            color: white; 
        }

        .btn.viewButton .fas {
            color: white; 
        }

        .btn.viewButton:hover {
            background-color: #0075eb; 
            border-color: #0075eb; 
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <!-- SIDEBAR -->
        <section id="sidebar">
            <a href="#" class="brand">
                <i class='bx bxs-id-card'></i>
                <span class="text">SIMAKAR</span>
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
                <li>
                    <a href="departemen_page.php">
                        <i class='bx bxs-doughnut-chart' ></i>
                        <span class="text">Departemen</span>
                    </a>
                </li>
                <li class="active">
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
                <!-- Page Title -->
                
                <!-- Page Title -->

                <!-- Tables -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-wrapper">
                                <div class="table-header">
                                    <h3>Data Proyek</h3>
                                    <button id="addButton" class="btn btn-primary">Tambah Data +</button>
                                </div>
                                <hr>
                                <table id="proyekTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Proyek</th>
                                            <th>Nama Proyek</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Manajer Proyek</th>
                                            <th>Budget</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="proyekTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tables -->

            <!-- View Data Pop Up -->
            <div id="viewModal" class="modal fade" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="viewModalLabel">Detail Proyek</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Daftar Anggota Tim:</h5>
                            <ul id="view_team_members"></ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

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
                            <form id="tambahProyekForm">
                                <div class="form-group">
                                    <label for="id_proyek" class="form-label">ID Proyek<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="id_proyek" name="id_proyek">
                                    </div>
                                <div class="form-group">
                                    <label for="nama_proyek">Nama Proyek <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Mulai <span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                                </div>
                                <div class="form-group">
                                    <label for="id_karyawan">Manajer Proyek <span style="color: red;">*</span></label>
                                    <select class="form-control" id="id_karyawan" name="id_karyawan">
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <?php foreach ($karyawanOptions as $karyawan) { ?>
                                        <option value="<?php echo $karyawan['id_karyawan']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="budget_proyek">Budget<span style="color: red;">*</span></label>
                                    <input type="text" id="budget_proyek" name="budget_proyek" class="form-control" placeholder="Rp." required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" value="Aktif" readonly>
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
                            <form id="editJabatanForm">
                                <div class="form-group">
                                    <label for="edit_id_proyek" class="form-label">ID Proyek<span style="color: red;">*</span></label>
                                    <input type="text" readonly class="form-control" id="edit_id_proyek" name="edit_id_proyek">
                                    </div>
                                <div class="form-group">
                                    <label for="edit_nama_proyek">Nama Proyek <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="edit_nama_proyek" name="edit_nama_proyek" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_tanggal_mulai">Tanggal Mulai <span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="edit_tanggal_mulai" name="edit_tanggal_mulai">
                                </div>
                                <div class="form-group">
                                    <label for="edit_id_karyawan">Manajer Proyek <span style="color: red;">*</span></label>
                                    <select class="form-control" id="edit_id_karyawan" name="edit_id_karyawan">
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <?php foreach ($karyawanOptions as $karyawan) { ?>
                                        <option value="<?php echo $karyawan['id_karyawan']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_budget_proyek">Budget<span style="color: red;">*</span></label>
                                    <input type="text" id="edit_budget_proyek" name="edit_budget_proyek" class="form-control" placeholder="Rp." required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_status">Status</label>
                                    <select class="form-control" id="edit_status" name="edit_status">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
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
        var table = $('#proyekTable').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50],
            "searching": true,
            "paging": true,
            "info": true,
            "scrollX": true,
            "ajax": {
                "url": "php/proyek/read.php",
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [
                { "data": null, "render": function(data, type, row, meta) {
                    return meta.row + 1;
                }},
                { "data": "id_proyek" },
                { "data": "nama_proyek" },
                { "data": "deskripsi" },
                { "data": "tanggal_mulai" },
                { "data": "tanggal_selesai" },
                { "data": "manajer_proyek" },
                { "data": "budget_proyek" },
                { "data": "status", "render": function(data, type, row) {
                    if (data === "Aktif") {
                        return '<span class="badge badge-pill badge-warning">' + data + '</span>';
                    } else if (data === "Selesai") {
                        return '<span class="badge badge-pill badge-success">' + data + '</span>';
                    }
                    return data;
                }},
                { "data": null, "render": function(data, type, row) {
                    return `
                        <button class='btn btn-sm btn-primary viewButton' data-id='${row.id_proyek}'><i class='fas fa-eye'></i></button>
                        <button class='btn btn-sm btn-primary editButton' data-id='${row.id_proyek}' data-nama_proyek='${row.nama_proyek}' data-deskripsi='${row.deskripsi}' data-tanggal_mulai='${row.tanggal_mulai}' data-tanggal_selesai='${row.tanggal_selesai}' data-manajer_proyek='${row.manajer_proyek}' data-budget_proyek='${row.budget_proyek}' data-status='${row.status}'><i class='fas fa-edit'></i></button>
                        <button class='btn btn-sm btn-danger deleteButton' data-id='${row.id_proyek}'><i class='fas fa-trash'></i></button>
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
            var formData = $('#tambahProyekForm').serialize();
            console.log(formData);
            $.ajax({
                url: 'php/proyek/create.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#addModal').modal('hide');
                    $('#tambahProyekForm')[0].reset();
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
            const idProyek = $(this).data('id'); 
            const namaProyek = $(this).data('nama_proyek');
            const deskripsi = $(this).data('deskripsi');
            const tanggalMulai = $(this).data('tanggal_mulai'); 
            const manajerProyek = $(this).data('manajer_proyek');
            const budgetProyek = $(this).data('budget_proyek');
            const status = $(this).data('status');
            const namaKaryawan= $(this).closest('tr').find('td:eq(6)').text();
            console.log(namaKaryawan);
            console.log(budgetProyek);

            $('#edit_id_proyek').val(idProyek);
            $('#edit_nama_proyek').val(namaProyek);
            $('#edit_deskripsi').val(deskripsi);
            $('#edit_tanggal_mulai').val(tanggalMulai);
            $('#edit_id_karyawan').val('');

            $('#edit_id_karyawan option').filter(function() {
                return $(this).text() === namaKaryawan;
            }).prop('selected', true);

            $('#edit_budget_proyek').val(budgetProyek);
            $('#edit_status').val(status);

            $('#editModal').modal('show');
        });

        // UPDATE OPERATION LOGIC
        $('#updateButton').click(function() {
            const idProyek = $('#edit_id_proyek').val(); 
            const namaProyek = $('#edit_nama_proyek').val();
            const deskripsi = $('#edit_deskripsi').val();
            const tanggalMulai = $('#edit_tanggal_mulai').val();; 
            const manajerProyek =  $('#edit_id_karyawan').val(); ;
            const budgetProyek = $('#edit_budget_proyek').val();
            const status = $('#edit_status').val();

            $.ajax({
                url: 'php/proyek/update.php',
                type: 'POST',
                data: {
                    action: 'update',
                    id_proyek: idProyek,
                    nama_proyek: namaProyek,
                    deskripsi: deskripsi,
                    tanggal_mulai: tanggalMulai,
                    manajer_proyek: manajerProyek,
                    budget_proyek: budgetProyek,
                    status: status
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
                url: 'php/proyek/delete.php',
                type: 'POST',
                data: {
                    id_proyek: deleteId
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

        $(document).on('click', '.viewButton', function() {
            const idProyek = $(this).data('id');

            $.ajax({
                url: 'php/proyek/details.php',
                type: 'GET',
                data: {
                    id_proyek: idProyek
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    const project = data.project;
                    const teamMembers = data.team;

                    $('#view_id_proyek').text(project.id_proyek);
                    $('#view_nama_proyek').text(project.nama_proyek);
                    $('#view_deskripsi').text(project.deskripsi);
                    $('#view_tanggal_mulai').text(project.tanggal_mulai);
                    $('#view_tanggal_selesai').text(project.tanggal_selesai);
                    $('#view_manajer_proyek').text(project.manajer_proyek);
                    $('#view_budget_proyek').text(project.budget_proyek);
                    $('#view_status').text(project.status);

                    $('#view_team_members').empty();
                    teamMembers.forEach(member => {
                        $('#view_team_members').append('<li>' + member + '</li>');
                    });

                    $('#viewModal').modal('show');
                },
                error: function(error) {
                    console.log('Error fetching project details', error);
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