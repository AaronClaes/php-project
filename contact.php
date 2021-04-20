<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 0px 6px grey;">
    <div class="container-fluid text-center ">
    <img class="logo" src="img/gg-logo.png" alt="logo">



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: center; margin-left:-4%;">
            <div class="navbar-nav">
            <a class="nav-link " aria-current="page" href="home.php">Home</a>
            
                <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
                
                <a class="nav-link " href="about.php">About Us</a>
                <a class="nav-link" href="login.php">Login</a>
            </div>
        </div>
    </div>
</nav>
<body>
    <div class="row" style="--bs-gutter-x: 0rem;">
        <div class="bg-image p-3 text-center shadow-1-strong col-md  text-white flex-item-left" style="background-color:#7a7f84 ;
       width: 80vh; background-size: 50%; background-repeat: no-repeat; ">
            <h1 class="mb-3 h2">Contact us</h1>

            <p>you can contact us using the form or calling us on this number </p>
            <p>0495429542</p>
        </div>

        
        
      

        <div class="col-md wrapper" ">
            <form action="mailto:elias.valienne@hotmail.com" method="POST">
                <div class="form-outline" style="margin-top: 2%;">
                    <label class="form-label" for="typeText">Name input</label>
                    <input placeholder="Your name" type="text" name="name" method="POST" enctype="multipart/form-data" name="EmailForm" type="text" id="typeText" size="19" class="form-control" required />

                </div>

                <div class="form-outline">
                    <label class="form-label" for="typeEmail">Email input</label>
                    <fieldset>
                        <input placeholder="Your Email Adress" action="?go" method="post" type="text" name="email" id="typeEmail" class="form-control" required />
                    </fieldset>
                </div>

                <div class="form-outline">
                    <label class="form-label" for="textAreaExample">Message</label>
                    <textarea placeholder="Type your Message Here...." class="form-control" id="textAreaExample" rows="4" required></textarea>

                </div>
                <button id="submit" data-submit="...Sending" name="submit" type="submit" class="btn btn-outline-secondary" data-mdb-ripple-color="dark" value="send">
                    Submit
                </button>
            </form>
        </div>

        <footer class="footer bg-light text-center text-lg-start top">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
</body>

</html>