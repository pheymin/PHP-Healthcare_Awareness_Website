<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="container">
        <h1>Create Account</h1>
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
        </div>
        <h2 class="mb-12"><span>Fill in Information</span></h2>
        <form action="php/signup.php" method="POST">
            <div class="grid grid-container mb-12">
                <div class="col-span-6">
                    <label htmlFor="first-name">
                        First Name
                    </label>
                    <div class="mt-2">
                        <input id="first-name" name="first-name" type="first-name" autoComplete="first-name" required />
                    </div>
                </div>

                <div class="col-span-6">
                    <label htmlFor="last-name">
                        Last Name
                    </label>
                    <div class="mt-2">
                        <input id="last-name" name="last-name" type="last-name" autoComplete="last-name" required />
                    </div>
                </div>

                <div class="col-span-6">
                    <label htmlFor="email">
                        Email address
                    </label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autoComplete="email" required />
                    </div>
                </div>

                <div class="col-span-6">
                    <label htmlFor="phone">
                        Phone Number
                    </label>
                    <div class="mt-2">
                        <input type="text" name="phone" id="phone" autoComplete="phone" required pattern="\d{10,11}" title='Phone number must have 10-11 digits (without "-")' />
                    </div>
                </div>

                <div class="col-span-6">
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

                <div class="col">
                    <label htmlFor="street">
                        Street address
                    </label>
                    <div class="mt-2">
                        <input type="text" name="street" id="street" autoComplete="street" required />
                    </div>
                </div>

                <div class="col-span-4">
                    <label htmlFor="city">
                        City
                    </label>
                    <div class="mt-2">
                        <input type="text" name="city" id="city" autoComplete="address-level2" required />
                    </div>
                </div>

                <div class="col-span-4">
                    <label htmlFor="region">
                        State / Province
                    </label>
                    <div class="mt-2">
                        <select id="region" name="region" required></select>
                    </div>
                </div>

                <div class="col-span-4">
                    <label htmlFor="postal-code">
                        ZIP / Postal code
                    </label>
                    <div class="mt-2">
                        <input type="text" name="postal-code" id="postal-code" autoComplete="postal-code" required pattern="\d{5}" title="ZIP/Postal code must have 5 digits" />
                    </div>
                </div>
            </div>
            <div id="doc-info"></div>
            <input type="hidden" id="acc-type" name="acc-type">
            <button type="submit" id="submit" name="submit" class="mb-12">Sign Up</button>
        </form>
    </div>
    <script src="js/signup.js"></script>
</body>

</html>