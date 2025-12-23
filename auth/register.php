<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/auth.css">
</head>
<body>

<div class="auth-wrapper">
  <div class="auth-card">

    <h1>Registrasi Akun</h1>
    <p>Daftar untuk mulai berdonasi dan membantu sesama</p>

    <form method="POST" action="process_register.php">

        <label>Nama Lengkap</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Daftar</button>
    </form>

    <p style="margin-top:20px; text-align:center;">
        Sudah punya akun?
        <a href="login.php">Login di sini</a>
    </p>

  </div>
</div>

</body>
</html>
