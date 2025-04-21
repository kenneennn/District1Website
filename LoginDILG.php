<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department of the Interior and Local Government</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="dilg_panel_login.css">
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background:  linear-gradient(to bottom, #A62C2C, #D3CA79); 
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            transition: background 0.5s ease-in-out;
            font-family: 'Poppins', sans-serif; /* Ensure consistent modern font */
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            gap: 2rem;
            align-items: center; /* Align items vertically */
        }

        .left-column {
            flex: 1;
            padding: 2rem;
            color: #fff;
            text-align: left; /* Align text to the left */
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .left-column h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .testimonial-carousel p {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin-top: 1.5rem;
        }

        .feature-list li {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-list li::before {
            content: "✔";
            color: #ffcc00;
            font-weight: bold;
        }

        .right-column {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem; /* Add padding for spacing */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
        }

        .login-container {
            background: linear-gradient(135deg, #FF8C42, #FF5733); /* Lighter orange gradient */
            border-radius: 15px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: 2px solid #A62C2C;
            margin: auto; /* Center the login container */
        }

        .login-container:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        }

        .login-container h2 {
            color: #153D7D;
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 2rem; /* Larger font size for the heading */
            font-weight: 700; /* Bold heading */
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .input-group input {
            width: 375px; /* Reduced width for input fields */
            padding: 1rem; /* Increase padding for better usability */
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 1rem;
            transition: border-color 0.3s, background-color 0.3s;
            outline: none;
            background: rgba(255, 255, 255, 0.9); /* Slightly opaque background */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .input-group input:focus {
            border-color: #26457c; /* Highlight border on focus */
            background-color: #f0f8ff; /* Light blue background on focus */
        }

        .input-group button {
            position: absolute;
            right: 10px;
            bottom: 10px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            width: 30px; /* Maintain container width */
            height: 30px; /* Maintain container height */
            display: flex;
            align-items: center;
            justify-content: center; /* Center the icon inside the container */
            visibility: hidden; /* Hide the container */
        }

        .input-group button .material-icons {
            visibility: visible; /* Keep the icon visible */
            font-size: 1.2rem;
            color: #333;
            transition: color 0.3s ease-in-out;
            width: 16px; /* Adjust the width of the icon */
            text-align: center;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 5%;
        }

        button {
            width: 48%;
            padding: 0.9rem; /* Increase padding for better clickability */
            border: none;
            border-radius: 8px; /* Rounded corners */
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-weight: 600; /* Bold text for buttons */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
        }

        .login-button {
            background-color: #E83F25;
            color: white;
        }

        .login-button:hover {
            background-color: #19345a;
            transform: translateY(-2px); /* Slight lift on hover */
        }

        .cancel-button {
            background-color: #A62C2C;
            color: white;
        }

        .cancel-button:hover {
            background-color: #c9302c;
            transform: translateY(-2px); /* Slight lift on hover */
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .left-column, .right-column {
                width: 100%;
                text-align: center; /* Center text on smaller screens */
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }

            button {
                width: 100%;
            }
        }

        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #222; /* Darker background color */
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: visibility 0.5s, bottom 0.5s, opacity 0.5s;
        }

        #snackbar.show {
            visibility: visible;
            bottom: 30px;
            opacity: 1;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        .info-section {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
            text-align: center;
            margin-top: 2rem;
        }

        .info-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .info-section p {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .info-section a {
            color: #ffcc00;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .info-section a:hover {
            text-decoration: underline;
            color: #ff9900;
        }

        .cube-loader {
            position: relative;
            width: 75px;
            height: 75px;
            transform-style: preserve-3d;
            transform: rotateX(-30deg);
            animation: animate 4s linear infinite;
        }

        @keyframes animate {
            0% {
                transform: rotateX(-30deg) rotateY(0);
            }

            100% {
                transform: rotateX(-30deg) rotateY(360deg);
            }
        }

        .cube-loader .cube-wrapper {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        .cube-loader .cube-wrapper .cube-span {
            position: absolute;
            width: 100%;
            height: 100%;
            transform: rotateY(calc(90deg * var(--i))) translateZ(37.5px);
            background: linear-gradient(
                to bottom,
                hsl(330, 3.13%, 25.1%) 0%,
                hsl(177.27, 21.71%, 32.06%) 5.5%,
                hsl(176.67, 34.1%, 36.88%) 12.1%,
                hsl(176.61, 42.28%, 40.7%) 19.6%,
                hsl(176.63, 48.32%, 43.88%) 27.9%,
                hsl(176.66, 53.07%, 46.58%) 36.6%,
                hsl(176.7, 56.94%, 48.91%) 45.6%,
                hsl(176.74, 62.39%, 50.91%) 54.6%,
                hsl(176.77, 69.86%, 52.62%) 63.4%,
                hsl(176.8, 76.78%, 54.08%) 71.7%,
                hsl(176.83, 83.02%, 55.29%) 79.4%,
                hsl(176.85, 88.44%, 56.28%) 86.2%,
                hsl(176.86, 92.9%, 57.04%) 91.9%,
                hsl(176.88, 96.24%, 57.59%) 96.3%,
                hsl(176.88, 98.34%, 57.93%) 99%,
                hsl(176.89, 99.07%, 58.04%) 100%
            );
        }

        .cube-top {
            position: absolute;
            width: 75px;
            height: 75px;
            background: hsl(330, 3.13%, 25.1%) 0%;
            transform: rotateX(90deg) translateZ(37.5px);
            transform-style: preserve-3d;
        }

        .cube-top::before {
            content: '';
            position: absolute;
            width: 75px;
            height: 75px;
            background: hsl(176.61, 42.28%, 40.7%) 19.6%;
            transform: translateZ(-90px);
            filter: blur(10px);
            box-shadow: 0 0 10px #323232,
                        0 0 20px hsl(176.61, 42.28%, 40.7%) 19.6%,
                        0 0 30px #323232,
                        0 0 40px hsl(176.61, 42.28%, 40.7%) 19.6%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="left-column">
            <h1>Empowering Barangay Management</h1>
            <div class="testimonial-carousel">
                <p id="testimonial">"This system has revolutionized how we manage our barangay!"</p>
                <p id="author">- Barangay Captain</p>
            </div>
            <ul class="feature-list">
                <li>✔ Real-time Mapping</li>
                <li>✔ Resident Profiling</li>
                <li>✔ Secure Document Requests</li>
            </ul>
        </div>
            <div class="login-container">
                <h2>
                    <img src="LogoImage/DILGLOGO.png" alt="DILG Logo" style="height: 60px; vertical-align: middle; margin-right: 10px;">
                    <img src="LogoImage/BPlogo.png" alt="BP Logo" style="height: 80px; vertical-align: middle; margin-right: 10px;">
                    DILG LOGIN
                </h2>
                <form id="loginForm" onsubmit="return false;">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password"  required>
                        <button type="button" id="togglePassword">
                            <span class="material-icons">visibility</span>
                        </button>
                    </div>
                    <div id="errorMessage" style="color: red; margin-bottom: 1rem;"></div>
                    <div class="button-group">
                        <button type="button" class="login-button" onclick="validateLogin()">
                            <span class="material-icons">login</span> Login
                        </button>
                        <button type="button" class="cancel-button" onclick="window.location.href='index.php'">
                            <span class="material-icons">cancel</span> Cancel
                        </button>
                    </div>
                </form>
            </div>

    </div>

    <div class="info-section">
        <h3>Welcome to DILG Portal</h3>
        <p>Access your dashboard and manage your account.</p>
        <p>For support, contact us at <a href="mailto:district01@gmail.com.ph">district01@gmail.com.ph</a></p>
    </div>

    <div id="snackbar"></div>
    <script>
        function showSnackbar(message, isSuccess = false, isWarning = false) {
            const snackbar = document.getElementById('snackbar');
            const icon = isSuccess ? 'check_circle' : isWarning ? 'warning' : 'error';
            snackbar.innerHTML = `<span class="material-icons">${icon}</span> ${message}`;
            snackbar.className = 'show';
            snackbar.style.backgroundColor = isSuccess ? '#4CAF50' : isWarning ? '#FF9800' : '#F44336';
            setTimeout(() => { snackbar.className = snackbar.className.replace('show', ''); }, 3000);
        }

        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', passwordFieldType);
            this.querySelector('span').textContent = passwordFieldType === 'password' ? 'visibility' : 'visibility_off';
        });

        async function validateLogin() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = '';

            if (!username || !password) {
                showSnackbar('Please complete all input fields.', false, true);
                return;
            }

            try {
                const response = await fetch('validate_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, password }),
                });
                const data = await response.json();

                if (data.success) {
                    if (data.accountType === 'DILG') {
                        showSnackbar('Login successful!', true);
                        setTimeout(() => { window.location.href = 'DILG_dashboard.php'; }, 1000);
                    } else {
                        showSnackbar('Unauthorized access!');
                    }
                } else {
                    showSnackbar('Invalid username or password.');
                }
            } catch (error) {
                console.error(error);
                showSnackbar('An error occurred. Please try again.');
            }
        }

        document.querySelector('.cancel-button').addEventListener('click', function () {
            showSnackbar('Action cancelled.', false, true);
        });

        const testimonials = [
            { text: "This system has revolutionized how we manage our barangay!", author: "- Barangay Captain" },
            { text: "Smart GIS has made resident profiling so much easier.", author: "- Barangay Secretary" },
            { text: "Secure document requests have saved us so much time!", author: "- Barangay Treasurer" }
        ];

        let currentTestimonial = 0;

        function updateTestimonial() {
            const testimonialElement = document.getElementById('testimonial');
            const authorElement = document.getElementById('author');
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            testimonialElement.textContent = testimonials[currentTestimonial].text;
            authorElement.textContent = testimonials[currentTestimonial].author;
        }

        setInterval(updateTestimonial, 5000);
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
