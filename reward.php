<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/reward.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>
    <!-- Header -->
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">Reward</h1>
        </div>
    </div>

    <!-- Coupon List -->
    <div class="container">
        <?php 
        $sql = "SELECT * FROM visitor WHERE visitor_id = '" . $_SESSION['id'] . "'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <h4>* Available point = <?php echo $row['point'] ?></h4>
        <div class="grid grid-container py-6">
            <?php
            $sql2 = "SELECT * FROM coupon";

            $result2 = $db->query($sql2);

            while ($row2 = $result2->fetch_assoc()) {
            ?>
                <div class="list col-span-6">
                    <div class="flex p-2 center">
                        <img src="images/coupon/<?php echo $row2['images'] ?>" alt="thumbnail" class="rounded-md">
                    </div>
                    <div>
                        <h2><?php echo $row2['title']; ?></h2>
                        <p><?php echo $row2['description']; ?></p>
                        <div class="flex space-x-4">
                            <div>
                                <h5>Valid from</h5>
                                <p><?php echo $row2['valid_from']; ?></p>
                            </div>
                            <div>
                                <h5>Valid to</h5>
                                <p><?php echo $row2['valid_to']; ?></p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <h5>Point needed</h5>
                                <p><?php echo $row2['point']; ?></p>
                            </div>
                            <div class="align-self-end" style="margin: 10px 0;">
                                <button class="btn-secondary" onclick="redeem(<?php echo $row2['coupon_id']; ?>)">Redeem</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($result2->num_rows == 0) { ?>
                <div class="flex flex-col center">
                    <img src="images/empty.png" alt="" style="width: 20%;">
                    <h2 class="mt-4">No coupon found</h2>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        function redeem(id) {
            $.ajax({
                url: "php/reward.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == "success") {
                        alert("Redeem success");
                        location.reload();
                    } else {
                        alert("Redeem failed");
                    }
                }
            });
        }
    </script>

</body>

</html>