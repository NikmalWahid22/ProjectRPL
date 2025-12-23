<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/auth.css">
</head>
<body>

<div class="auth-wrapper">
  <div class="auth-card">

    <h1>Login</h1>
    <p>Masuk untuk mulai berbagi kebaikan</p>

    <form method="POST" action="process_login.php">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p style="margin-top:20px; text-align:center;">
        Belum punya akun?
        <a href="register.php">Daftar sekarang</a>
    </p>

  </div>
</div>

</body>
</html>
