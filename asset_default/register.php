<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Vaganza</title>
    <!-- Web page CSS -->
    <link rel="stylesheet" href="..\asset_default\register.css">
    <!-- Font Awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <form action="#" id="login-form">
        <div class="left">
            <div class="container">
                <img src="reg.png" alt="">
            </div>
        </div>
        <div class="right">
            <div class="heading">Sign Up</div>
            <div class="connect">Masukkan detail anda untuk membuat akun</div>

            <div class="input-group">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                </div>
            </div>

            <div class="input-group">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <div class="password-input-container">
                        <input type="password" name="password" id="password" />
                        <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>
            </div>

            <label for="alamat">Alamat</label>
            <textarea rows="4" type="text" name="alamat" id="alamat"></textarea>

            <div class="input-group">
                <div>
                    <label for="phone">Telepon</label>
                    <input type="number" name="phone" id="phone" />
                </div>
                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option value="" selected disabled>Select</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Customer">Customer</option>
                        <option value="Seller">Seller</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="photo">Foto Profil</label>
                <input type="file" name="photo" id="photo" />
            </div>

            <div class="submit">
                <button type="submit">Sign Up</button>
            </div>

            <div class="login">
                <p>Sudah Punya Akun? <a href="../asset_default/login.php">Log In!</a></p>
            </div>
        </div>
    </form>
</body>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.querySelector("i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

</html>