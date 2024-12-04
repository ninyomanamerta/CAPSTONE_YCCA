<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .profile-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-size: 16px;
            font-weight: 600;
        }

        .form-control {
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4CAF50;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
            width: 100%;
            margin-top: 20px;
        }

        .save-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
            width: 100%;
            margin-top: 20px;
        }

        .delete-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h2 class="text-center mb-4">Edit Profil</h2>

        <form id="editProfileForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control" value="John Doe" required>
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="number" id="nip" name="nip" class="form-control" value="123456789" required>
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control" value="Manager" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="johndoe@example.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password baru">
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Konfirmasi password">
            </div>

            <button type="submit" class="save-btn">Simpan Perubahan</button>
        </form>

        <!-- Button to delete account -->
        <button class="delete-btn" onclick="confirmDelete()">Hapus Akun</button>
    </div>

    <script>
        function confirmDelete() {
            if (confirm("Apakah Anda yakin ingin menghapus akun ini? Data tidak dapat dikembalikan!")) {
                // Process the delete action (you can add the logic here for deleting the account)
                alert("Akun telah dihapus.");
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
