<?php
$host = 'localhost';
$dbname = 'dbibim';
$username = 'root';
$password = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Panel</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #2C3E50, #bdc3c7); 
            padding: 20px;
            flex-direction: column;
        }

        /* MUI Card Styling */
        .mui-card {
            background-color: #FFFFFF;
            color: #333;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s;
            margin-bottom: 20px;
        }
        .mui-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .mui-card h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #1A3365;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mui-card h2 .material-icons {
            margin-right: 8px;
            font-size: 28px;
        }

        /* Input Group Styling */
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .input-group select:focus {
            border-color: #1A3365;
            outline: none;
            box-shadow: 0 0 5px rgba(26, 51, 101, 0.3);
        }

        /* Button Styling */
        .mui-button {
            width: 100%;
            padding: 12px;
            background-color: #1A3365;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mui-button .material-icons {
            margin-right: 8px;
            font-size: 20px;
        }

        .mui-button:hover {
            background-color: #14274E;
        }

        .mui-button.cancel {
            background-color: #ccc;
            color: #333;
        }

        .mui-button.cancel:hover {
            background-color: #b3b3b3;
        }

        /* Contact Us Section */
        .mui-contact-card {
            background-color: #FFFFFF;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .mui-contact-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #1A3365;
        }

        .mui-contact-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .mui-contact-card a {
            color: #1976D2;
            text-decoration: none;
            font-weight: bold;
        }

        .mui-contact-card a:hover {
            text-decoration: underline;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .mui-card, .mui-contact-card {
                padding: 20px;
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .mui-card h2, .mui-contact-card h3 {
                font-size: 18px;
            }

            .mui-button {
                padding: 10px;
                font-size: 14px;
            }

            .mui-button .material-icons {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <!-- Resident Panel -->
    <div class="mui-card">
        <h2><span class="material-icons">person</span> Resident Panel</h2>
        <form id="residentForm">
            <div class="input-group">
                <label for="services">Select Service</label>
                <select id="services" onchange="navigateService()">
                    <option value="">-- Choose an option --</option>
                    <option value="certifications">Certifications</option>
                    <option value="complaints">Complaints</option>
                </select>
            </div>
            <button type="button" class="mui-button cancel" onclick="window.location.href='index.php'">
                <span class="material-icons">cancel</span> Cancel
            </button>
        </form>
    </div>

    <!-- Contact Us -->
    <div class="mui-contact-card">
        <h3><span class="material-icons">contact_support</span> Contact Us</h3>
        <p>If you have any questions or need further assistance, please feel free to contact us:</p>
        <p>Email: <a href="mailto:district01@gmail.com">district01@gmail.com</a></p>
        <p>Phone: <a href="tel:+63927654123">+6392 7654 123</a></p>
    </div>

    <script>
        function navigateService() {
            const service = document.getElementById("services").value;
            if (service === "certifications") {
                window.location.href = 'BarangayCertificationReq.php'; //C:\xampp\htdocs\IBIM_LandingPage\BarangayCertificationReq.php
            } else if (service === "complaints") {
                window.location.href = 'Resident_complaint.php';
            }
        }
    </script>
<footer style="position: fixed; bottom: 0; left: 0; width: 100%; height: auto; background-color: #f8f9fa; padding: 10px 0; box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; align-items: center;">
        <div class="social-icons" style="text-align: center; margin-top: 10px; display: flex; justify-content: center; gap: 15px;">
            <a href="https://facebook.com" target="_blank" style="color: #3b5998; font-size: 20px;"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank" style="color: #1da1f2; font-size: 20px;"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank" style="color: #e4405f; font-size: 20px;"><i class="fab fa-instagram"></i></a>
            <a href="https://linkedin.com" target="_blank" style="color: #0077b5; font-size: 20px;"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div style="text-align: center; margin-top: 5px; font-size: 14px; color: #2C3E50;">
            &copy; 2025 District 1 San Manuel, Isabela | All Rights Reserved<br>
            <span style="font-weight: bold;">IBIM-GIS Version 1.0</span>
        </div>
    </footer>

    <style>
        @media (max-width: 768px) {
            footer {
                padding: 15px 10px;
            }
            .social-icons {
                flex-wrap: wrap;
                gap: 10px;
            }
            .social-icons a {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            footer {
                padding: 10px 5px;
            }
            .social-icons a {
                font-size: 16px;
            }
            footer div {
                font-size: 12px;
            }
        }
    </style>
</body>
</html>
