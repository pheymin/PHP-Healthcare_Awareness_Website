<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/donate.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php";
    if (isset($_SESSION['acc_type']) && ($_SESSION['acc_type'] == 'doctor' || $_SESSION['acc_type'] == 'admin')) {
        header("Location: index.php");
        exit();
    }    
    
    ?>
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">Donate</h1>
        </div>
    </div>

    <div class="container row mb-12">
        <div class="bg-white rounded px-4 space-y-6">
            <div class="mt-3">
                <p class="inline-block border rounded-pill py-1 px-4">Donation</p>
                <h2 class="mb-4">Supporting Communities through Your Generous Donations</h2>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <img class="img-fluid rounded w-75 align-self-end" src="images/donate-2.jpg" alt="Mission">
                    <img class="img-fluid rounded w-40 bg-white pt-3 pe-3" src="images/donate-1.jpg" alt="Mission" style="margin-top: -25%;">
                </div>
            </div>
            <div class="mb-6">
                <p>At Healthcare4MYS, we appreciate your support in making a difference. Your generous donations help us empower communities by providing inclusive health education and accessible support. Together, we can transform lives and create a positive impact on individuals' well-being.</p>
            </div>
        </div>

        <div class="bg-white rounded">
            <div class="bg-primary px-4 py-1 rounded-top flex text-white">
                <h2>Your Donation</h2>
            </div>
            <form id="donate-form" action="php/donate.php" method="POST">
                <div class="space-y-6 px-4 mb-6">
                    <div class="mt-3 space-y-4">
                        <div class="sub-header">
                            <h4>Donate</h4>
                        </div>
                        <div class="center space-x-4">
                            <a id="one-time-donate" class="type-btn">One-time donate</a>
                            <a id="monthly-donate" class="type-btn">Monthly donate</a>
                            <input type="hidden" id="type" name="type" require>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="sub-header">
                            <h4>Amount</h4>
                        </div>
                        <div class="row">
                            <a id="10" class="amount-btn">RM10</a>
                            <a id="20" class="amount-btn">RM20</a>
                        </div>
                        <div class="row">
                            <a id="50" class="amount-btn">RM50</a>
                            <a id="100" class="amount-btn">RM100</a>
                        </div>
                        <input type="hidden" id="amount" name="amount">
                        <div class="flex">
                            <label for="amount">Other amount</label>
                            <input type="number" id="other-amount" name="other-amount">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="sub-header">
                            <h4>Donator</h4>
                        </div>
                        <div>
                            <label for="name">Show my name as:</label>
                            <input type="text" id="display-name" name="display-name" class="mt-2" require>
                        </div>
                        <div>
                            <label for="event">Please direct my donation to:</label>
                            <select name="event" id="event" class="mt-2" require></select>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="sub-header">
                            <h4>Payment Method</h4>
                        </div>
                        <div class="row">
                            <div id="card" class="payment">
                                <p><i class="fas fa-credit-card me-2"></i> Card Payments</p>
                            </div>
                            <div id="ewallet" class="payment">
                                <p><i class="fas fa-wallet me-2"></i> E-Wallet Payments</p>
                            </div>
                        </div>
                        <input type="hidden" id="payment" name="payment" require>
                    </div>
                    <div class="flex">
                        <button type="submit" name="add-donate" class="btn-secondary ml-auto">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="js/donate.js"></script>
</body>

</html>