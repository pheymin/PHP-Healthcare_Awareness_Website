<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="container">
        <h1>Login As</h1>
        <div class="flex flex-row mb-12 center">
            <div id="doctor" class="acc-type">
                <img src="images/doctor_avatar.png" alt="Doctor Avatar" class="image">
                <div class="overlay">
                    <div class="text">Doctor</div>
                </div>
            </div>
            <div id="member" class="acc-type">
                <img src="images/visitor_avatar.png" alt="Visitor Avatar" class="image">
                <div class="overlay">
                    <div class="text">Member</div>
                </div>
            </div>
            <div id="admin" class="acc-type">
                <img src="images/admin_avatar.png" alt="Admin Avatar" class="image">
                <div class="overlay">
                    <div class="text">Admin</div>
                </div>
            </div>
        </div>

        <h2 class="mb-12"><span>Fill in Information</span></h2>
        <form action="php/login.php" method="POST">
            <div class="grid grid-container mb-6">
                <div class="col">
                    <label htmlFor="email">
                        Email address
                    </label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autoComplete="email" required />
                    </div>
                </div>

                <div class="col">
                <label htmlFor="password">
                        Password
                    </label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autoComplete="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one digit, and one special character" required />
                        <span id="toggle-password">
                            <i class="fa-regular fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="col-span-6">
                    <a href="signup.php">No account? Sign up</a>
                </div>
                <input type="hidden" id="acc-type" name="acc-type">
                <div class="col-span-6" style="justify-self: end;">
                    <button type="submit" name="submit" class="btn-secondary">Login</button>
                </div>
            </div>
        </form>
        <h2 class="mb-12"><span>OR</span></h2>
        <div class="flex flex-row mb-12 center">
            <button id="guest-btn">Continue as Guest</a>
        </div>
    </div>
    <script src="js/signup.js"></script>
    <script>
        $(document).ready(function() {
            $("#guest-btn").click(function() {
                window.location.href = "index.php";
            });
        });
    </script>
</body>

</html>