</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kasirss 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="index.php?page=user&act=logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php
    if (isset($_GET['alert']) && $_GET['alert'] == "success1") {
    ?>
        Swal.fire({
            icon: 'success',
            title: 'Penambahan Berhasil',
            text: 'Anda telah berhasil menambahkan data'
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "success2") { ?>
        Swal.fire({
            icon: 'success',
            title: 'Update Berhasil',
            text: 'Anda telah berhasil mengupdate data'
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "err1") { ?>
        Swal.fire({
            icon: "warning",
            title: 'Isi dulu bg!',
            showConfirmButton: false,
            timer: 2500
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "err2") { ?>
        Swal.fire({
            icon: "error",
            title: 'Opss engga bisa',
            text: 'Anda Tidak Memiliki Izin Untuk Halaman Ini!',
            showConfirmButton: false,
            timer: 3000
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "err3") { ?>
        Swal.fire({
            icon: "error",
            title: 'Password Salah',
            text: 'Password yang Anda Masukkan Salah!',
            showConfirmButton: false,
            timer: 3000
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "hapus") { ?>
        Swal.fire({
            icon: "success",
            title: 'Items telah dihapus!',
            showConfirmButton: false,
            timer: 1500
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "pass") { ?>
        Swal.fire({
            icon: "success",
            title: 'Berhasil Mengganti Password!',
            showConfirmButton: false,
            timer: 1500
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "passConf") { ?>
        Swal.fire({
            icon: "success",
            title: 'Silahkan Mengganti Password!',
            showConfirmButton: false,
            timer: 1500
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "passNCof") { ?>
        Swal.fire({
            icon: 'error',
            title: 'Konfirmasi password tidak cocok!',
            text: 'Silakan coba lagi.',
            showConfirmButton: false,
            timer: 3000
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "userno") { ?>
        Swal.fire({
            icon: 'error',
            title: 'Username Sudah Ada!',
            text: 'Silakan coba lagi.',
            showConfirmButton: false,
            timer: 3000
        });
    <?php } elseif (isset($_GET['alert']) && $_GET['alert'] == "berhasil") { ?>
        Swal.fire({
            icon: 'success',
            title: 'Anda Masuk',
            showConfirmButton: false,
            timer: 2500
        });
    <?php } ?>
</script>