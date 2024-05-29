<!DOCTYPE html>
<html>

<head>
    <title>Terms And Conditions</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<style>
    body {
        background-color: #F0F8FF;
        font-family: 'Poppins', sans-serif;
    }

    .terms-wrapper .terms-content {
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        background: #fff;
        padding: 5px 25px;
        border-radius: 5px;
    }

    .terms-content h1 {
        font-size: 40px;
        margin-bottom: 10px !important;
    }

    .terms-content h2 {
        font-size: 30px;
    }

    .terms-content .logo {
        width: 120px;
        height: 120px;
        display: block;
    }

    .terms-content .logo img {
        width: 100%;
        height: 100%;
    }
</style>

<body>
    <section class="terms-wrapper py-5">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">





                    <div class="terms-content">
                        <a class="logo mx-auto" href="#">
                            <img src="{{asset('assets/logo.png')}}" alt="">
                        </a>
                        <h1 class="text-center text-decoration-underline mb-2">Terms and Condition</h1>
                        <?= ($term_and_condition != null) ? $term_and_condition->term_and_condition : "" ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>