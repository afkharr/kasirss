<?php
if ($_SESSION['user']['role'] == "super_admin" || $_SESSION['user']['role'] == "admin") {
    echo "<script>
    window.location = 'index.php?alert=err2';
    </script>";
}
?>

<?php
include_once "database/class/transaksi.php";
include_once "database/class/member.php";
include_once "database/class/barang.php";
$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$member = Member::getInstance($pdo);
$barang = Barang::getInstance($pdo);

$kodeNota = $transaksi->generateKodeNota();

$memberUmum = $member->getUmum();
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaksi</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container-fluid">

        <!-- BARISAN PERTAMA -->
        <div class="row">
            <!-- BAGIAN PERTAMA -->
            <div class="col-lg-4">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="tanggal" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-9">
                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="kasir" class="col-sm-3 col-form-label">Kasir</label>
                        <div class="col-9">
                            <input type="text" name="kasir" class="form-control" value="<?= $_SESSION['user']['nama'] ?>" id="kasir" data-kasirid="<?= $_SESSION['user']['id_user'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="member" class="col-sm-3 col-form-label">Member</label>
                        <div class="col-9">
                            <select name="member" id="member" class="form-control">
                                <option value="<?= $memberUmum ?>">Umum</option>
                                <?php foreach ($member->getAll() as $row): ?>
                                    <?php if ($row['nama'] != 'Umum'): ?>
                                        <option value="<?= $row['id_member'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KEDUA -->
            <div class="col-lg-4">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="barang" class="col-sm-3 col-form-label">Barang</label>
                        <div class="col-9">
                            <select name="barang" id="barang" class="form-control">
                                <option value="">-Pilih Barang-</option>
                                <?php foreach ($barang->getAll() as $row): ?>
                                    <option data-harga="<?= $row['harga_barang'] ?>" value="<?= $row['id_barang'] ?>"><?= $row['nama_barang'] ?> - Rp. <?= $row['harga_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="qty" class="col-sm-3 col-form-label">Qty</label>
                        <div class="col-9">
                            <input type="number" name="qty" class="form-control" id="qty">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="btnTambahBarang" class="col-sm-3 col-form-label"></label>
                        <div class="col-9">
                            <button id="btnTambahBarang" class="btn btn-primary"> Tambahkan </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KETIGA -->
            <div class="col-lg-4">
                <div class="card card-outline card-warning p-3">
                    <div class="text-right">
                        <p>Invoice <span><b><?= $kodeNota ?></b></span></p>

                        <h3 class="display-1" id="total_harga_1"><b>0</b></h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR BARISAN PERTAMA -->

        <!-- BARISAN KEDUA -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR BARISAN KEDUA -->

        <!-- BARISAN KETIGA -->
        <div class="row mt-2">
            <!-- BAGIAN PERTAMA -->
            <div class="col-lg-3">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="subtotal" class="col-sm-5 col-form-label">Sub Total</label>
                        <div class="col-7">
                            <input type="number" name="subtotal" class="form-control" id="subtotal" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="diskon" class="col-sm-5 col-form-label">Diskon</label>
                        <div class="col-7">
                            <input type="number" name="diskon" class="form-control" id="diskon">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="total_keseluruhan" class="col-sm-5 col-form-label">Total Keseluruhan</label>
                        <div class="col-7">
                            <input type="number" name="total_keseluruhan" class="form-control" id="total_keseluruhan" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KEDUA -->
            <div class="col-lg-3">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="nominal" class="col-sm-5 col-form-label">Nominal</label>
                        <div class="col-7">
                            <input type="number" oninput="hitungTotal()" name="nominal" class="form-control" id="nominal">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="kembalian" class="col-sm-5 col-form-label">Kembalian</label>
                        <div class="col-7">
                            <input type="number" name="kembalian" class="form-control" id="kembalian" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KETIGA -->
            <div class="col-lg-3">
                <div class="card card-outline card-warning p-3">
                    <div class="form-group row mb-3">
                        <label for="catatan" class="col-sm-4 col-form-label">Catatan</label>
                        <div class="col-8">
                            <textarea name="catatan" id="catatan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN KEEMPAT -->
            <div class="col-lg-3">
                <div class="form-group row mb-3">
                    <div class="d-flex flex-column align-items-center col-12">
                        <!-- Cancel Button with Icon -->
                        <button class="btn btn-warning mb-2 col-4 d-flex align-items-center justify-content-center" id="btnBatalkan">
                            <i class="fas fa-times"></i> <!-- Font Awesome icon -->
                            <span class="ms-2">Batalkan</span>
                        </button>

                        <!-- Process Button with Icon -->
                        <button class="btn btn-outline-success mb-2 col-6 d-flex align-items-center justify-content-center py-1" id="btnProses" style="font-size: 0.9rem;">
                            <i class="fas fa-check"></i> <!-- Font Awesome icon -->
                            <span class="ms-1">Proses</span>
                        </button>

                        <!-- Back Button with Icon -->
                        <a href="index.php?page=transaksi" class="btn btn-outline-success col-6 d-flex align-items-center justify-content-center py-1" id="btnKembali" style="font-size: 0.9rem;">
                            <i class="fas fa-arrow-left"></i> <!-- Font Awesome icon -->
                            <span class="ms-1">Kembali</span>
                        </a>

                    </div>
                </div>
            </div>


        </div>
        <!-- AKHIR BARISAN KETIGA -->


    </div>
</section>

<script>
    document.getElementById('btnTambahBarang').addEventListener('click', function(event) {
        event.preventDefault();

        // Ambil nilai dari form
        var barangSelect = document.getElementById('barang');
        var selectedBarangText = barangSelect.options[barangSelect.selectedIndex].text.split(' - ')[0]; // Ambil nama barang saja
        var selectedBarangValue = barangSelect.value;
        var selectedBarangHarga = barangSelect.options[barangSelect.selectedIndex].dataset.harga;
        var qty = document.getElementById('qty').value;

        // Pastikan barang dan qty terisi
        if (selectedBarangValue === "" || qty === "") {
            alert("Barang dan qty harus diisi.");
            return;
        }

        // Periksa apakah barang sudah ada di tabel
        var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
        var existingRow = null;
        for (var i = 0, row; row = table.rows[i]; i++) {
            if (row.cells[1].dataset.barangId === selectedBarangValue) {
                existingRow = row;
                break;
            }
        }

        // Tambahkan baris baru atau perbarui qty jika sudah ada
        if (existingRow) {
            var newQty = parseInt(existingRow.cells[3].innerText) + parseInt(qty);
            existingRow.cells[3].innerText = newQty;
            existingRow.cells[4].innerText = calculateTotal(selectedBarangHarga, newQty);
        } else {
            var total = calculateTotal(selectedBarangHarga, qty);

            // Tambahkan baris ke tabel
            var newRow = table.insertRow();
            newRow.innerHTML = `
        <td>${table.rows.length + 1}</td>
        <td data-barang-id="${selectedBarangValue}">${selectedBarangText}</td>
        <td>Rp. ${selectedBarangHarga}</td>
        <td>${qty}</td>
        <td>Rp. ${total}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm btnEditQty">Edit</button>
            <button type="button" class="btn btn-danger btn-sm btnHapusBarang">Hapus</button>
        </td>
        `;
        }

        // Tambahkan event listener untuk tombol hapus dan edit
        table.querySelectorAll('.btnHapusBarang').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });

        table.querySelectorAll('.btnEditQty').forEach(function(button) {
            button.addEventListener('click', function() {
                var row = this.closest('tr');
                var currentQty = row.cells[3].innerText;
                barangSelect.value = row.cells[1].dataset.barangId;
                document.getElementById('qty').value = currentQty;

                // Hapus baris yang sedang di-edit dari tabel
                row.remove();
            });
        });

        // Reset form input
        barangSelect.value = "";
        document.getElementById('qty').value = "";
        hitungTotal();
    });

    function calculateTotal(harga, qty) {
        return harga * qty;
    }

    // Fungsi untuk menghitung subtotal, diskon, dan total keseluruhan
    function hitungTotal() {
        var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
        var subtotal = 0;

        // Hitung subtotal
        for (var i = 0, row; row = table.rows[i]; i++) {
            var total = parseInt(row.cells[4].innerText.replace('Rp. ', '').replace(/,/g, ''));
            subtotal += total;
        }

        // Ambil nilai diskon
        var diskon = document.getElementById('diskon').value ? parseInt(document.getElementById('diskon').value) : 0;

        // Hitung total keseluruhan setelah diskon
        var totalKeseluruhan = subtotal - diskon;

        // Update nilai di form
        document.getElementById('subtotal').value = subtotal;
        document.getElementById('total_keseluruhan').value = totalKeseluruhan;

        // Update nilai total harga yang ditampilkan
        document.getElementById('total_harga_1').innerText = `${totalKeseluruhan}`;

        // Update nilai kembalian
        let nominal = document.getElementById('nominal').value
        if (nominal >= totalKeseluruhan) {
            document.getElementById('kembalian').value = (nominal - totalKeseluruhan);
        }
    }

    // Tambahkan event listener untuk input diskon
    document.getElementById('diskon').addEventListener('input', hitungTotal);

    document.getElementById('btnProses').addEventListener('click', function(event) {
        event.preventDefault();

        // Ambil nilai dari form transaksi
        const transaksi = {
            tanggal: document.getElementById('tanggal').value,
            id_kasir: document.getElementById('kasir').dataset.kasirid, // pastikan id kasir tersedia
            id_member: document.getElementById('member').value,
            invoice: "<?= $kodeNota ?>", // atau kode nota yang telah di-generate
            subtotal: document.getElementById('subtotal').value,
            total_keseluruhan: document.getElementById('total_keseluruhan').value,
            nominal: document.getElementById('nominal').value,
            diskon: document.getElementById('diskon').value,
            kembalian: document.getElementById('kembalian').value,
            catatan: document.getElementById('catatan').value
        };

        // Ambil nilai dari tabel transaksi_Details
        const transaksiDetails = [];
        const tableRows = document.querySelectorAll('#myTable tbody tr');
        tableRows.forEach(row => {
            const detail = {
                id_barang: row.cells[1].dataset.barangId,
                qty: row.cells[3].innerText,
                harga: row.cells[2].innerText.replace('Rp. ', '').replace('.', ''),
                total_harga: row.cells[4].innerText.replace('Rp. ', '').replace('.', '')
            };
            transaksiDetails.push(detail);
        });

        // Gabungkan data transaksi dan transaksiDetails
        const data = {
            transaksi: transaksi,
            transaksiDetails: transaksiDetails
        };

        // Kirim data ke server menggunakan AJAX
        fetch('page/transaksi/tambah.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Transaksi berhasil disimpan! ID Transaksi: ' + result.id_transaksi);
                    // Setelah transaksi berhasil, buka halaman cetak di tab baru
                    window.open('index.php?cetak=cetak&id_transaksi=' + result.id_transaksi, '_blank');
                } else {
                    alert('Gagal menyimpan transaksi: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada server.');
            });

    });



    document.getElementById('btnBatalkan').addEventListener('click', function(event) {
        event.preventDefault();
        location.reload(); // Reload halaman
    });
</script>