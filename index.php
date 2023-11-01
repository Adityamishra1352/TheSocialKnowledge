<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge</title>
    <link rel="stylesheet" href="assets/css/homepage.css">
    <meta name="description"
        content="Learn C++ from quality blogs with proper guidelines and solved examples at Social Knoeledge.">
    <meta name="keywords" content="C++, coding, courses, tutorials, blogs, examples, Course Master">
    <meta name="author" content="Aditya Mishra">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="The Social Knowledge">
    <meta property="og:description"
        content="Learn C++ from quality blogs with proper guidelines and solved examples at Social Knowledge.">
    <meta property="og:image" content="walling-XLqiL-rz4V8-unsplash.jpg">
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="shortcut icon" href="assets/images/websitelogo.jpg" type="image/png">
    <link rel="stylesheet" href="assets/css/chatbot.css">
</head>

<body>
    <div class="page">
        <nav>
            <h4>The Social Knowledge</h4>
            <!-- <a href="assets/courses/courses.php">Courses</a> -->
            <a href="assets/sorting_visualizer/index.php">Sorting Visualizer</a>
            <a href="assets/test/test.php">Test</a>
            <a href="assets/test/codingBlock.php">Practise Coding</a>
            <button onclick="window.location.href=(`contactus.php`)" class="contactus">Our Team</button>
            <?php
            session_start();
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                echo '<a href="assets/accounts/login.php"><button class="login">Log in</button></a>
            <a href="assets/accounts/signup.php"><button class="signup">Sign Up</button></a>';
            } else {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                    echo '<a href="assets/accounts/admin/admin.php"><button class="login">Admin Panel</button></a>';
                } elseif (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                    echo '<a href="assets/accounts/organiser/organiser.php"><button class="login">Organiser Panel</button></a>';
                } else {
                    echo '<a href="assets/accounts/dashboard.php"><button class="login">Dashboard</button></a>';
                }
            }
            ?>

            <button onclick="window.location.href=(`feedback.php`)" class="feedback">Feedback</button>
        </nav>
        <div class="learn">
            <section class="description">
                <h1>Learn C++ From The Blogs AnyTime, <br>AnyWhere</h1>
                <p>Finding quality blogs with proper guidelines about coding is really hard. <br> We provide quality
                    courses with solved examples.</p>
            </section>
            <section class="image">
                <img src="assets/images/971.jpg" alt="">
            </section>
        </div>
    </div>
    <div class="helpButton">
        <button class="chat_btn">
            <i class="fas fa-comment"></i>
        </button>
    </div>
    <section class="help" id="help">
        <div class="helpHeader">
            <h2>The Social Knowledge</h2>
            <button class="cross_btn">
            Close
        </button>
        </div>
        <div class="helpBody">
            <form action="assets/chatbot.php" method="post">
                <input type="text" class="name" name="name" placeholder="Name*" required>
                <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                <textarea name="query" id="query" cols="30" rows="10" placeholder="Enter Your Query*" required></textarea>
                <input type="hidden" name="location" value="../index.php">
                <div class="buttons">
                    <button class="helpsubmit_btn">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <script src="assets/javascript/help.js"></script>
</body>

</html>