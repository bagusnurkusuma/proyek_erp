<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>
    <style>
        /* Custom styling for the testimonials */
        .testimonial-item {
            text-align: center;
            padding: 20px;
            color: black;
            margin: auto;
            width: 100%;
            height: 100%;
        }

        .testimonial-item img {
            display: block;
            margin: auto; /* Center the image horizontally */
            max-width: 100%;
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px; /* Adjust as needed */
        }

        /* Ensure the scroller is centered within the container */
        .testimonial-scroller {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Set the background color to black for the carousel */
        #testimonialCarousel {
            background-color: transparent;
            margin: auto;
            border: 1px solid grey;
            border-radius: 20px;
        }
    </style>
</head>

<?php include "../asset_default/side_bar.php" ?>

<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="content">
                <div class="page-title">
                </div>

                <!-- page content -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Store Profile</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                    <button onclick="window.location.href='store_page.php'" class="btn btn-secondary">Edit</button>
                            </li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content text-dark">

                        <div class="text-center">
                            <div class="text-center">

                            <h1 style="font-weight:bold;">Nama Toko</h1>
                            <h5>Jl. Terusan Candi Mendut 9B</h5><br>
                            <img src="../asset_design/production/images/toko.png" class="" style="width:30%;"><br>
                            <h5 class="w-50 mx-auto mt-5">Warung madura adalah tempat yang menyediakan berbagai macam kebutuhan. Melayani dengan sepenuh hati dan hati uang ikhlas</h5><br>
                            <h3 style="color:#BC8700; font-weight:bold;">Visi</h3><br>
                            <h5>Menjadi toko yang menyediakan kebutuan sehari hari yang berkualitas tinggi dan maju</h5><br>
                            <h3 style="color:#BC8700; font-weight:bold;">Misi</h3><br>

                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="card mt-3" style="width: 100%; height: 150px; border :1px solid black; border-radius:20px;">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                            <h6 class="card-title">Sedia Barang Sehari hari</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card mt-3" style="width: 100%; height: 150px; border :1px solid black; border-radius:20px;">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                            <h6 class="card-title">Melayani dengan baik</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-3">
                                <div class="col-md-3">
                                    <div class="card" style="width: 100%; height: 150px; border :1px solid black; border-radius:20px;">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                            <h6 class="card-title">Partnership yang ramah</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <h3 style="color:#BC8700; font-weight:bold;">Motto</h3><br>
                            <h5 class="font-italic">"Belanja nyaman, semua kebutuhan ada"</h5><br><br>
                            <h3 style="color:#BC8700; font-weight:bold;">Superioritas</h3><br>
                            <h5 class="font-weight-normal">Kenapa harus kami?</h5><br>
                            <h5 class="font-weight-bold"> 1. Pilihan luas dan beragam</h5>
                            <h5 class="w-50 mx-auto">Menawarkan beragam produk yang sesuai dengan berbagai selera dan kebutuhan, memberikan pelanggan banyak opsi untuk dipilih.</h5><br>
                            <h5 class="font-weight-bold"> 2. Harga yang terjangkau</h5>
                            <h5 class="w-50 mx-auto">Harga yang bersaing di pasaran, menjadikan produk kami menjadi pilihan yang ekonomis bagi pelanggan.</h5><br>
                            <h5 class="font-weight-bold"> 3. Produk berkualitas tinggi</h5>
                            <h5 class="w-50 mx-auto">Kami fokus pada kualitas tinggi dalam setiap produk kami, menjamin kepuasan dan kepercayaan pelanggan terhadap produk yang mereka beli.</h5><br>

                            <div class="container">
                                <h3 style="color:#BC8700; font-weight:bold; margin-top:100px;">Testimoni</h3><br>
                                <div id="testimonialCarousel" class="slick-carousel text">
                                    <!-- Testimonial Items -->
                                    <div class="testimonial-item">
                                        <img src="../asset_design/production/images/prod-1.jpg" alt="">
                                        <h1>Testimonial 1</h1>
                                        <p>Customer 1</p>
                                    </div>
                                    <div class="testimonial-item">
                                        <img src="../asset_design/production/images/prod-2.jpg" alt="">
                                        <h1>Testimonial 2</h1>
                                        <p>Customer 2</p>
                                    </div>
                                    <div class="testimonial-item">
                                        <img src="../asset_design/production/images/prod-5.jpg" alt="">
                                        <h1>Testimonial 3</h1>
                                        <p>Customer 3</p>
                                    </div>
                                    <div class="testimonial-item">
                                        <img src="../asset_design/production/images/prod-1.jpg" alt="">
                                        <h1>Testimonial 1</h1>
                                        <p>Customer 1</p>
                                    </div>
                                    <div class="testimonial-item">
                                        <img src="../asset_design/production/images/prod-2.jpg" alt="">
                                        <h1>Testimonial 2</h1>
                                        <p>Customer 2</p>
                                    </div>
                                    <div class="testimonial-item">
                                        <img src="../asset_design/production/images/prod-5.jpg" alt="">
                                        <h1>Testimonial 3</h1>
                                        <p>Customer 3</p>
                                    </div>
                                    <!-- Add more testimonials as needed -->
                                </div>
                            </div>

                            <h3 style="color:#BC8700; font-weight:bold; margin-top:100px;">Contact Us</h3><br>

                            <div class="row justify-content-center mt-3">
                                <div class="col-md-1">
                                    <a href="#">
                                    <div class="card text-center" style="width: 100%; background-color: #C5C27D;">
                                        <div class="card-body">
                                            <i class="fa fa-envelope fa-2x"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a href="#">
                                    <div class="card text-center" style="width: 100%; background-color: #C5C27D;">
                                        <div class="card-body">
                                            <i class="fa fa-twitter fa-2x"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a href="#">
                                    <div class="card text-center" style="width: 100%; background-color: #C5C27D;">
                                        <div class="card-body">
                                            <i class="fa fa-link fa-2x"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a href="#">
                                    <div class="card text-center" style="width: 100%; background-color: #C5C27D;">
                                        <div class="card-body">
                                            <i class="fa fa-phone fa-2x"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a href="#">
                                    <div class="card text-center" style="width: 100%; background-color: #C5C27D;">
                                        <div class="card-body">
                                            <i class="fa fa-instagram fa-2x"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--page content -->

            </div>
        </div>
    </div>
</body>
<script>
        $(document).ready(function(){
            $('#testimonialCarousel').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1
            });
        });
    </script>
</html>