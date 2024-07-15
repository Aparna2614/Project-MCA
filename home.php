<?php
session_start();
require 'loadenv.php';

// Assuming you have a database connection established
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$blog_dbname = getenv('BLOG_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $blog_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest announcement from blog
$sql = "SELECT id, title FROM blog ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include EmailJS script -->
   
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("<?php echo getenv('EMAILJS_PUBLIC_KEY'); ?>");
        })();
    </script>


    <title>The Story Telling Museum</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
      
    <header class="navbar">
        <div class="bar" style="height: 6.5vh; border-spacing: 10rem;">
            <p id="heading">тнє ѕтσяу тєℓℓιηg мυѕєυм</p>
            <ul>
                <li><a href="home.php">🄷🄾🄼🄴</a></li>
                <li><a href="vdo.php">🅅🄸🄳🄴🄾🅂</a></li>
                <li><a href="storyteller.php">🅂🅃🄾🅁🅈 🅃🄴🄻🄻🄴🅁</a></li>
                <li><a href="contact.php">🄲🄾🄽🅃🄰🄲🅃 🅄🅂</a></li>
                <li><a href="login.php"><img src="img/admin.png"></a></li>
            </ul>
      
          </div>
    </header>
   
    <div class="text">
      <h2> 𝕎𝔼𝕃ℂ𝕆𝕄𝔼 𝕐𝕆𝕌 𝔸𝕃𝕃 </h2> 
        <p>ƭɦε ѵเ૨ƭµαℓ ɱµรεµɱ ƭσµ૨</p>
    </div>

    <div class="img">
        <img src="img/art12.jpg" alt="Art 12">
        <img src="img/art4.jpg" alt="Art 4">
        <img src="img/art10.jpg" alt="Art 10">
        <img src="img/art6.jpg" alt="Art 6">
        <img src="img/art8.jpg" alt="Art 8">
        <img src="img/art1.jpg" alt="Art 1">
        
    </div>
    <div class="text1">
        <h4>𝚃𝚑𝚎 𝚅𝚒𝚛𝚝𝚞𝚊𝚕 𝚂𝚝𝚘𝚛𝚢𝚝𝚎𝚕𝚕𝚒𝚗𝚐 𝙼𝚞𝚜𝚎𝚞𝚖 𝚜𝚝𝚊𝚗𝚍𝚜 𝚊𝚜 𝚊 𝚟𝚒𝚋𝚛𝚊𝚗𝚝 𝚍𝚒𝚐𝚒𝚝𝚊𝚕 𝚝𝚛𝚒𝚋𝚞𝚝𝚎 𝚝𝚘 𝚝𝚑𝚎 𝚛𝚒𝚌𝚑 𝚊𝚗𝚍 𝚍𝚒𝚟𝚎𝚛𝚜𝚎 𝚌𝚞𝚕𝚝𝚞𝚛𝚊𝚕 𝚑𝚎𝚛𝚒𝚝𝚊𝚐𝚎 𝚘𝚏 𝙸𝚗𝚍𝚒𝚊. 𝙰𝚜 𝚊 𝚕𝚊𝚗𝚍 𝚘𝚏 𝚖𝚢𝚛𝚒𝚊𝚍 𝚝𝚛𝚊𝚍𝚒𝚝𝚒𝚘𝚗𝚜, 𝚕𝚊𝚗𝚐𝚞𝚊𝚐𝚎𝚜, 𝚊𝚗𝚍 𝚑𝚒𝚜𝚝𝚘𝚛𝚒𝚎𝚜, 𝙸𝚗𝚍𝚒𝚊 𝚑𝚊𝚜 𝚊 𝚞𝚗𝚒𝚚𝚞𝚎 𝚜𝚝𝚘𝚛𝚢 𝚝𝚘 𝚝𝚎𝚕𝚕 𝚝𝚑𝚛𝚘𝚞𝚐𝚑 𝚒𝚝𝚜 𝚊𝚗𝚌𝚒𝚎𝚗𝚝 𝚊𝚛𝚝 𝚘𝚏 𝚜𝚝𝚘𝚛𝚢𝚝𝚎𝚕𝚕𝚒𝚗𝚐. 𝚃𝚑𝚎 𝚅𝚒𝚛𝚝𝚞𝚊𝚕 𝚂𝚝𝚘𝚛𝚢𝚝𝚎𝚕𝚕𝚒𝚗𝚐 𝙼𝚞𝚜𝚎𝚞𝚖 𝚊𝚕𝚜𝚘 𝚞𝚗𝚍𝚎𝚛𝚜𝚌𝚘𝚛𝚎𝚜 𝚝𝚑𝚎 𝚒𝚖𝚙𝚘𝚛𝚝𝚊𝚗𝚌𝚎 𝚘𝚏 𝚙𝚛𝚎𝚜𝚎𝚛𝚟𝚒𝚗𝚐 𝙸𝚗𝚍𝚒𝚊'𝚜 𝚒𝚗𝚝𝚊𝚗𝚐𝚒𝚋𝚕𝚎 𝚌𝚞𝚕𝚝𝚞𝚛𝚊𝚕 𝚑𝚎𝚛𝚒𝚝𝚊𝚐𝚎 𝚒𝚗 𝚝𝚑𝚎 𝚍𝚒𝚐𝚒𝚝𝚊𝚕 𝚊𝚐𝚎. 𝚃𝚑𝚛𝚘𝚞𝚐𝚑 𝚒𝚗𝚝𝚎𝚛𝚊𝚌𝚝𝚒𝚟𝚎 𝚍𝚒𝚜𝚙𝚕𝚊𝚢𝚜 𝚊𝚗𝚍 𝚍𝚒𝚐𝚒𝚝𝚊𝚕 𝚜𝚝𝚘𝚛𝚢𝚝𝚎𝚕𝚕𝚒𝚗𝚐 𝚙𝚕𝚊𝚝𝚏𝚘𝚛𝚖𝚜, 𝚝𝚑𝚎 𝚖𝚞𝚜𝚎𝚞𝚖 𝚎𝚗𝚜𝚞𝚛𝚎𝚜 𝚝𝚑𝚊𝚝 𝚝𝚑𝚎𝚜𝚎 𝚝𝚊𝚕𝚎𝚜 𝚛𝚎𝚖𝚊𝚒𝚗 𝚊𝚌𝚌𝚎𝚜𝚜𝚒𝚋𝚕𝚎 𝚊𝚗𝚍 𝚎𝚗𝚐𝚊𝚐𝚒𝚗𝚐 𝚏𝚘𝚛 𝚏𝚞𝚝𝚞𝚛𝚎 𝚐𝚎𝚗𝚎𝚛𝚊𝚝𝚒𝚘𝚗𝚜.</h4>
    </div>
    <div class="mail">
        <div class="container">
            <h1>Want to share your stories too ? <br>Connect with Us <hr></h1>
            <h2>𝕰𝖓𝖙𝖊𝖗 𝖞𝖔𝖚𝖗 𝖊𝖒𝖆𝖎𝖑 𝖍𝖊𝖗𝖊✍</h2>
           
            <div class="email">
                <input id="email" type="text" placeholder="Enter Your Email" autocomplete="off">
            </div>
            
            <div class="email-verify">
                <input id="otp-input" type="text" placeholder="Enter Code" autocomplete="off">
                <button id="btn-verify-otp">Verify</button>
            </div>
            <div class="btn-send-otp">
                <button id="send-otp" onclick="SendOTP()">Send OTP</button>
            </div>  
        </div>

        
    </div> 

        <div class="new_footer_top">
             <div class="footer_bg">
                    <div class="footer_bg_one"></div>
                    <div class="footer_bg_two"></div>
                    <div class="row">
                            <h3 class="f-title f_600 t_color f_size_18">Contact Us</h3>
                            <div class="f_social_icon">
                                <a href="#">𝓔-𝓶𝓪𝓲𝓵</a>
                                <a href="#">𝓊𝓃𝒾𝓋𝑒𝓇𝓈𝒾𝓉𝓎</a>
                                <a href="#">𝐹𝒶𝒸𝑒𝒷𝑜𝑜𝓀</a>
                                <div class="col-md-2 agileinfo_footer_grid agileinfo_footer_grid1">
                                    <h4>Call Us : +919999999
                                    <p>DEPARTMENT  <br> UNIVERSITY OF JAMMU</p></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </footer>
   <script>
        function closeAnnouncement() {
            var announcementBar = document.querySelector('.announcement-bar');
            announcementBar.style.display = 'none';
        }
        
    </script>
    
    <script>
     document.getElementById('send-otp').addEventListener('click', function(event) {
        event.preventDefault();

        // Generate OTP
        var otp = Math.floor(1000 + Math.random() * 9000); // Generate random 4-digit OTP

        // Store OTP in session for verification (optional)
        sessionStorage.setItem('otp', otp);

        // Send email via EmailJS
        var templateParams = {
            to_email: document.getElementById('email').value,
            otp: otp
        };
        //replace it with your service_id and template_id
        emailjs.send('service_id', 'template_id', templateParams)
            .then(function(response) {
                console.log('Email sent successfully:', response);
                alert('OTP sent successfully to your email.');
            }, function(error) {
                console.error('Failed to send email:', error);
                alert('Failed to send OTP. Please try again later.');
            }, 
            function(error) {
                console.error('Failed to send email:', error);
                alert('Failed to send OTP. Please try again later.');
            });
    });

    document.getElementById('btn-verify-otp').addEventListener('click', function() {
        var enteredOTP = document.getElementById('otp-input').value;
        var storedOTP = sessionStorage.getItem('otp');

        if (enteredOTP === storedOTP) {
            alert('OTP verified successfully!');
            // Here you can submit the form to subscribe.php or perform other actions
            document.getElementById('subscribe-form').submit();
        } else {
            alert('Incorrect OTP. Please try again.');
        }
    });
</script>
</body>
</html>
