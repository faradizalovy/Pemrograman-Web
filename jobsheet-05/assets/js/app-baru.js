// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Konfirmasi hapus (front-end only, belum ke server) =====
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : "data ini";
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
            }
        });
    });
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    const counter = document.getElementById("table-counter");

    if (!input || !table || !counter) return;

    function updateCounter() {
        const rows = table.querySelectorAll("tbody tr");
        let jumlahTampil = 0;

        rows.forEach(function (row) {
            if (row.style.display !== "none") {
                jumlahTampil++;
            }
        });

        counter.textContent =
            "Menampilkan " + jumlahTampil + " dari " + rows.length + " buku";
    }

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            const judul = row.querySelector("td");

            if (!judul) return;

            const teksJudul = judul.textContent.toLowerCase();
            row.style.display =
                teksJudul.includes(keyword) ? "" : "none";
        });

        updateCounter();
    });

    updateCounter();
}


// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);

    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;

    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;

    if (next && next.classList.contains("error")) {
        next.remove();
    }
}


// ===== Refactor validasi menggunakan array dan forEach =====
function initValidasiForm() {
    const form = document.getElementById("form-tambah");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const fields = [
            {
                id: "judul",
                message: "Judul wajib diisi."
            },
            {
                id: "pengarang",
                message: "Pengarang wajib diisi."
            },
            {
                id: "tahun",
                message: "Tahun terbit wajib diisi."
            }
        ];

        fields.forEach(function (field) {
            const input = document.getElementById(field.id);

            if (!input) return;

            hapusError(input);

            if (input.value.trim() === "") {
                tampilkanError(input, field.message);
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});
