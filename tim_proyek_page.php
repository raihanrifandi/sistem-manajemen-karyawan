<?php

include 'config/koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Dropdown
$proyekResult = mysqli_query($conn, "SELECT p.id_proyek, p.nama_proyek, k.nama_karyawan AS manajer_proyek FROM proyek p JOIN karyawan k ON p.manajer_proyek = k.id_karyawan;");
$proyekOptions = [];
while ($row = mysqli_fetch_assoc($proyekResult)) {
    $proyekOptions[] = $row;
}

$karyawanResult = mysqli_query($conn, "
    SELECT k.id_karyawan, k.nama_karyawan
    FROM karyawan k
    JOIN jabatan j ON k.id_jabatan = j.id_jabatan
    WHERE j.nama_jabatan != 'manajer' AND k.status = 'aktif'
");

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
    <title>SIMAKAR - Tim Proyek</title>
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
            min-width: 1068px;
            
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
                <li class="active">
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
                                    <h3>Data Tim Proyek</h3>
                                    <button id="addButton" class="btn btn-primary">Tambah Data +</button>
                                </div>
                                <hr>
                                <table id="timTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Proyek</th>
                                            <th>Nama Proyek</th>
                                            <th>Manajer Proyek</th>
                                            <th>Nama Anggota</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="timTableBody">
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
                            <form id="tambahTimForm">
                                <div class="form-group">
                                    <label for="id_proyek">ID Proyek <span style="color: red;">*</span></label>
                                    <select class="form-control" id="id_proyek" name="id_proyek">
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <?php foreach ($proyekOptions as $proyek) { ?>
                                            <option value="<?php echo $proyek['id_proyek']; ?>" 
                                                    data-nama-proyek="<?php echo $proyek['nama_proyek']; ?>" 
                                                    data-manajer-proyek="<?php echo $proyek['manajer_proyek']; ?>">
                                                <?php echo $proyek['id_proyek']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_proyek">Nama Proyek <span style="color: red;">*</span></label>
                                    <input type="text" readonly class="form-control" id="nama_proyek" name="nama_proyek" required>
                                </div>
                                <div class="form-group">
                                    <label for="manajer_proyek">Manajer Proyek <span style="color: red;">*</span></label>
                                    <input type="text" readonly class="form-control" id="manajer_proyek" name="manajer_proyek" required>
                                </div>
                                <div class="form-group">
                                <label for="id_karyawan">Nama Anggota <span style="color: red;">*</span></label>
                                <select class="form-control" id="id_karyawan" name="id_karyawan">
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <?php foreach ($karyawanOptions as $karyawan) { ?>
                                        <option value="<?php echo $karyawan['id_karyawan']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
                                    <?php } ?>
                                </select>
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
        var table = $('#timTable').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50],
            "searching": true,
            "paging": true,
            "info": true,
            "scrollX": true,
            "ajax": {
                "url": "php/timProyek/read.php",
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [
                { "data": null, "render": function(data, type, row, meta) {
                    return meta.row + 1;
                }},
                { "data": "id_proyek" },
                { "data": "nama_proyek" },
                { "data": "manajer_proyek" },
                { "data": "nama_anggota" },
                { "data": null, "render": function(data, type, row) {
                    return `
                        <button class='btn btn-sm btn-danger deleteButton' data-id_timp='${row.id_timp}'><i class='fas fa-trash'></i></button>
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

        $('#id_proyek').on('change', function() {
        // Ambil data-nama-proyek dan data-manajer-proyek dari opsi yang dipilih
            var selectedOption = $(this).find('option:selected');
            var namaProyek = selectedOption.data('nama-proyek');
            var manajerProyek = selectedOption.data('manajer-proyek');
            console.log(namaProyek);
            
            // Setel nilai pada field nama_proyek dan manajer_proyek
            $('#nama_proyek').val(namaProyek);
            $('#manajer_proyek').val(manajerProyek);
        });

        // CREATE OPERATION LOGIC
        $('#saveButton').on('click', function () {
            var formData = $('#tambahTimForm').serialize();
            console.log(formData);
            $.ajax({
                url: 'php/timProyek/create.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#addModal').modal('hide');
                    $('#tambahTimForm')[0].reset();
                    var res = JSON.parse(response);
                    if (res.error) {
                        Swal.fire({
                            title: 'Error',
                            text: res.error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        $('#addModal').modal('hide');
                        $('#tambahTimForm')[0].reset();
                        Swal.fire({
                            title: 'Data Berhasil Disimpan',
                            text: res.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        table.ajax.reload();
                    }
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
        $('#timTable').on('click', '.deleteButton', function() {
            var id_timp = $(this).data('id_timp');
            console.log(id_timp);
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data anggota tim ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'php/timProyek/delete.php',
                        type: 'POST',
                        data: { id_timp: id_timp },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Terhapus!',
                                    response.message,
                                    'success'
                                );
                                table.ajax.reload();
                            } else {
                                Swal.fire(
                                    'Kesalahan!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(error) {
                            Swal.fire(
                                'Kesalahan!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
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