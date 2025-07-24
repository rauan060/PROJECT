<?php
session_start();


if (!isset($_SESSION['student_code'])) {
    header("Location: login.html");
    exit();
}


if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['expire_time'])) {
    session_unset();
    session_destroy();
    header("Location: login.html?message=session_expired");
    exit();
}


$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IITU - International Information Technology University</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    
     <header class="header">
        <div class="container">
            <div class="logo">
                <img src="logo.png" alt="IITU Logo">
                <div class="logo-text">       
                </div>
            </div>

            <nav class="navbar">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="programs.html">Programs</a></li>
                    <li><a href="admissions.html">Admissions</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="chat.html">Chat</a></li>
                </ul>
            </nav>

            <div class="logout">
                <a href="auth.html" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>

            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Shaping the Future of Technology</h2>
                <p>Kazakhstan's premier institution for IT education and innovation</p>
            
            </div>
        </div>
    </section>

    
    <section class="quick-links">
        <div class="container">
            <div class="link-card">
                <i class="fas fa-graduation-cap"></i>
                <h3>Undergraduate</h3>
                <p>Bachelor's degree programs</p>
            </div>
            <div class="link-card">
                <i class="fas fa-user-graduate"></i>
                <h3>Graduate</h3>
                <p>Master's and PhD programs</p>
            </div>
            <div class="link-card">
                <i class="fas fa-calendar-alt"></i>
                <h3>Events</h3>
                <p>Upcoming university events</p>
            </div>
            <div class="link-card">
                <i class="fas fa-newspaper"></i>
                <h3>News</h3>
                <p>Latest university news</p>
            </div>
        </div>
    </section>

     
    <section class="about">
        <div class="container">
            <div class="about-content">
                <h2>About IITU</h2>
                <p>International Information Technology University (IITU) is the leading IT university in Kazakhstan, established in 2009. We provide world-class education in information technologies and prepare highly qualified specialists for the digital economy.</p>
                <p>Our university collaborates with leading international universities and IT companies to ensure our students receive the most up-to-date knowledge and practical skills.</p>
                <a href="https://iitu.edu.kz/en/articles/ob-universitete-en/o-muit-en/" class="btn btn-outline">Learn More</a>
            </div>
            <div class="about-image">
                <img src="univer.jpg" alt="IITU Building">
            </div>
        </div>
    </section>

    
    <section class="programs">
        <div class="container">
            <h2>Our Programs</h2>
            <div class="programs-grid">
                <a href="https://www.mtu.edu/cs/what/" >
                <div class="program-card">
                    <i class="fas fa-laptop-code"></i>
                    <h3>Computer Science</h3>
                    <p>Bachelor's and Master's programs in software engineering and algorithms</p>
                </div></a>
                <a href="https://www.ibm.com/think/topics/data-science">
                <div class="program-card">
                    <i class="fas fa-database"></i>
                    <h3>Data Science</h3>
                    <p>Programs in big amount of data, machine learning and of course AI


                    </p>
                </div></a>
                <a href="https://www.fortinet.com/resources/cyberglossary/what-is-cybersecurity#:~:text=Cybersecurity%3A%20Meaning%20%26%20Definition,from%20cyberattacks%20and%20unauthorized%20access.">
                <div class="program-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Cybersecurity</h3>
                    <p>Specialized programs in information security. Very demanded</p>
                </div></a>
                <a href="https://www.techtarget.com/searchnetworking/definition/telecommunications-telecom">
                <div class="program-card">
                    <i class="fas fa-network-wired"></i>
                    <h3>Telecommunications</h3>
                    <p>Networking and communication technologies. Media-profession</p>
                </div></a>
            </div>
        </div>
    </section>

   
    <footer class="footer">
        <div class="container">
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> Manas St 34/1, Almaty 050040</p>
                <p><i class="fas fa-phone"></i> +7 (727) 320 00 00</p>
                <p><i class="fas fa-envelope"></i> info@iitu.edu.kz</p>
            </div>
            
            <div class="footer-column">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="https://www.instagram.com/iitu_kz/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/InternationalITUniversity/"><i class="fab fa-facebook"></i></a>
                    <a href="https://x.com/iitukz"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/channel/UC3W6lVUpOeB3U66NsxTzPYA"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Project of Rauan, Aruzhan and Miras</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>