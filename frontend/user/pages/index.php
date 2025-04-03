<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pateldham Hostel Management</title>
    <link rel="stylesheet" href="../CSS/index.css">
    
</head>
<body>
   
    <header>
        <div class="logo">
        <a href="index.php"><h1>Pateldham </h1></a>
        </div>
        <div class="auth-buttons">
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Sign Up</a>
        </div>
    </header>

    
    <main>
        <div class="description">
            <h2>Welcome to Pateldham Hostel</h2>
            <p>We offer the best accommodation for students with all essential amenities to make your stay comfortable and enjoyable.</p>
        </div>
        <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 5</div>
                <img src="../../../photos/image1.png" style="width:100%">
                <div class="text">Caption Text</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 5</div>
                <img src="../../../photos/image2.jpeg" style="width:100%">
                <div class="text">Caption Two</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 5</div>
                <img src="../../../photos/image3.jpeg" style="width:100%">
                <div class="text">Caption Three</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">4 / 5</div>
                <img src="../../../photos/image4.jpeg" style="width:100%">
                <div class="text">Caption Four</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">5 / 5</div>
                <img src="../../../photos/image5.jpeg" style="width:100%">
                <div class="text">Caption Five</div>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </main>

 
    <footer>
        <p>© 2024 Pateldham Hostel Management. All rights reserved.</p>
    </footer>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }

            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            slides[slideIndex - 1].style.display = "block";  
            dots[slideIndex - 1].className += " active";
        }

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        setInterval(() => {
            showSlides(slideIndex += 1);
        }, 2000);
    </script>
</body>
</html>
