let currentId = 1;

// Fungsi untuk mengambil nilai currentId dari local storage atau menginisialisasinya jika belum ada
function initializeCurrentId() {
    let storedId = localStorage.getItem('currentId');
    if (storedId) {
        currentId = parseInt(storedId, 10);
    } else {
        currentId = 1;
    }
}

// Fungsi untuk menyimpan currentId ke local storage
function saveCurrentId() {
    localStorage.setItem('currentId', currentId);
}

// Inisialisasi currentId saat halaman dimuat
initializeCurrentId();

function generateKaryawanID() {
    let paddedId = String(currentId).padStart(4, '0');
    let employeeId = `EMP-${paddedId}`;
   
    currentId++;
    // Simpan currentId yang baru ke local storage
    saveCurrentId();
    
    return employeeId;
}
