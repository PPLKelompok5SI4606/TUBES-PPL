<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengelolaan Sampah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #81C974;
            padding: 15px;
            color: white;
            display: flex;
            align-items: center;
        }
        .header img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }
        .profile-section {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #81C974;
        }
        .report-button {
            background-color: #81C974;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background-color: #81C974;
            color: black;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .action-button {
            background-color: #e0e0e0;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .entry-form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .submit-button {
            background-color: #81C974;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/login.png') }}" alt="login">
        <h2>Cleansweep</h2>
    </div>

    <div class="profile-section">
        <div class="profile-image" style="display: flex; justify-content: center; align-items: center; overflow: hidden;">
            <img src="{{ asset('images/user.png') }}" alt="User Profile" style="width: 200%; height: 250%; object-fit: cover;">
        </div>
        <div>
            <h3>BUDI HARIYANTO</h3>
            <button class="report-button" style="display: flex; align-items: center; gap: 8px; height: 40px; width: 200px; padding: 0 15px;">
                <img src="{{ asset('images/file.png') }}" alt="File" style="width: 50px; height: 50px; flex-shrink: 0;">
                Laporan Sampah
            </button>
        </div>
    </div>

    <div style="padding: 20px;">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jl. Merpati No. 12</td>
                    <td>Sampah menumpuk di pinggir jalan</td>
                    <td>01 April 2025</td>
                   
                    <td>
                        <div class="dropdown">
                            <button class="action-button">Pilih Status ▼</button>
                            <div class="dropdown-content">
                                <a href="javascript:void(0)" class="status-option" onclick="selectStatus(this, 'Diproses')">
                                    Diproses
                                    <div class="status-description">Laporan sudah diterima dan sedang ditangani.</div>
                                </a>
                                <a href="javascript:void(0)" class="status-option" onclick="selectStatus(this, 'Selesai')">
                                    Selesai
                                    <div class="status-description">Masalah sudah ditindaklanjuti dan selesai.</div>
                                </a>
                                <a href="javascript:void(0)" class="status-option" onclick="selectStatus(this, 'Ditolak')">
                                    Ditolak
                                    <div class="status-description">Laporan tidak valid, kurang informasi, atau bukan kewenangan.</div>
                                </a>
                                <a href="javascript:void(0)" class="status-option" onclick="selectStatus(this, 'Menunggu Konfirmasi')">
                                    Menunggu Konfirmasi
                                    <div class="status-description">Masih menunggu validasi dari pelapor atau pihak lain.</div>
                                </a>
                                <a href="javascript:void(0)" class="status-option" onclick="selectStatus(this, 'Tidak Ditemukan')">
                                    Tidak Ditemukan
                                    <div class="status-description">Lokasi dicek, tapi tidak ditemukan masalah seperti yang dilaporkan.</div>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Additional rows can be added dynamically -->
            </tbody>
        </table>

        <div class="entry-form">
            <h3>Entry Tindak Lanjut</h3>
            <p>Petugas akan dikirim ke lokasi pada tanggal 02 April 2024</p>
            <button class="submit-button" style="height: 50px; font-size: 18px; font-weight: bold;">
                <img src="{{ asset('images/verif.png') }}" alt="verif" style="width: 50px; height: 50px;">
                Simpan
            </button>
        </div>
    </div>
</body>
</html>

<head>
    <style>
        /* Existing styles remain unchanged */

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 250px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .status-description {
            font-size: 0.8em;
            color: #666;
            margin-top: 2px;
        }

        .dropdown-content a.selected {
            background-color: #81C974;
            color: white;
        }

        .dropdown-content a.selected .status-description {
            color: #f0f0f0;
        }
    </style>
</head>

<!-- Move script to just before closing body tag -->
<script>
function selectStatus(element, status) {
    const button = element.closest('.dropdown').querySelector('.action-button');
    button.textContent = status + ' ▼';
    
    const allOptions = element.closest('.dropdown-content').querySelectorAll('.status-option');
    allOptions.forEach(option => option.classList.remove('selected'));
    
    element.classList.add('selected');
}
</script>
</body>