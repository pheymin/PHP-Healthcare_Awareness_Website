<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="container-fluid page-header py-12 mb-12">
        <div class="container py-12">
            <h1 class="text-white">About Us</h1>
        </div>
    </div>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="flex">
                    <div class="flex flex-col">
                        <img class="img-fluid rounded w-75 align-self-end" src="images/mission-1.jpg" alt="Mission">
                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="images/mission-2.jpg" alt="Mission" style="margin-top: -25%;">
                    </div>
                </div>
                <div>
                    <p class="inline-block border rounded-pill py-1 px-4">Our Mission</p>
                    <h2 class="mb-4">Empowering Communities through Inclusive Health Education and Accessible Support</h2>
                    <p>At Healthcare4MYS, we are on a mission to revolutionize healthcare accessibility. Our platform aims to empower individuals with a comprehensive range of health resources while fostering community support. We strive to transform lives by providing accessible information and collaborative spaces.</p>
                    <p>By breaking down barriers to healthcare knowledge, we envision a healthier, more informed society where everyone can actively engage in their well-being journey. Join us as we work towards building a united community committed to the betterment of individual and collective health.</p>
                    <p><i class="far fa-check-circle me-3"></i>Quality health care</p>
                    <p><i class="far fa-check-circle me-3"></i>Only Qualified Doctors</p>
                    <p><i class="far fa-check-circle me-3"></i>Medical Research Professionals</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5 px-lg-0" style="background-color: #1148d6;">
        <div class="row mx-lg-0 text-white align-center">
            <div class="p-lg-10 ps-lg-0">
                <p class="inline-block border rounded-pill py-1 px-4" style="border: #fff 1px solid !important;">Our Vision</p>
                <h2 class="mb-4">A Holistic Health Ecosystem: Inspiring a World of Informed Well-being</h2>
                <p>At Healthcare4MYS, our vision is to create a holistic health ecosystem that inspires individuals globally to prioritize and actively pursue informed well-being. We envision a world where healthcare is accessible, information is empowering, and communities collaborate seamlessly to foster a culture of lifelong health. </p>
                <p>Through technological innovation and a commitment to inclusivity, we strive to be the catalyst for positive change, shaping a future where every person has the resources and knowledge to live a healthier and happier life.</p>
            </div>
            <div class="bg-white">
                <img class="img-fluid" src="images/vision.jpg" alt="Mission">
            </div>
        </div>
    </div>

    <div class="py-5 h-screen">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <p class="inline-block border rounded-pill py-1 px-4">Team</p>
                <h1>Our Team</h1>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="images/team-1.jpg" alt="Member 1">
                        </div>
                        <div class="team-text bg-white center p-2">
                            <p>Member 1</p>
                            <div class="team-social center">
                                <a class="btn btn-square" href=""><i class="fas fa-envelope"></i></a>
                                <a class="btn btn-square" href=""><i class="fas fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="images/team-3.jpg" alt="Member 2">
                        </div>
                        <div class="team-text bg-white center p-2">
                            <p>Member 2</p>
                            <div class="team-social center">
                                <a class="btn btn-square" href=""><i class="fas fa-envelope"></i></a>
                                <a class="btn btn-square" href=""><i class="fas fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="images/team-2.jpg" alt="Member 3">
                        </div>
                        <div class="team-text bg-white center p-2">
                            <p>Member 3</p>
                            <div class="team-social center">
                                <a class="btn btn-square" href=""><i class="fas fa-envelope"></i></a>
                                <a class="btn btn-square" href=""><i class="fas fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>