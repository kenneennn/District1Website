<?php
require_once 'db_connection.php';
function checkQuery($result, $conn) {
    if (!$result) {
        die("Error in query: " . $conn->error);
    } 
    return $result;
}
$leadersQuery = "SELECT Fullname, Position, Image FROM tblofficialinfo WHERE Position IN ('Chairman', 'Secretary', 'Treasurer')";
$leadersResult = $conn->query($leadersQuery);
checkQuery($leadersResult, $conn);
$kagawadQuery = "SELECT Fullname, Position, Image, Committee FROM tblofficialinfo WHERE Position = 'Kagawad'";
$kagawadResult = $conn->query($kagawadQuery);
checkQuery($kagawadResult, $conn);
function displayImage($imageData) {
    return 'data:image/jpeg;base64,' . base64_encode($imageData);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay District 1 - Municipality of San Manuel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        body, h1, h2, p, ul {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #eef2f7;
            color: #333;
            line-height: 1.6;
            margin-top: 80px;
            font-family: 'Poppins', sans-serif;
        }
        header {
            background-color: rgba(21, 61, 125, 0.8); 
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            flex-wrap: wrap;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            border-bottom: 3px solid #FFD700;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }
        header .logo {
            display: flex;
            align-items: center;
        }
        header .logo img {
            width: 70px;
            margin-right: 10px;
            transition: transform 0.3s;
        }
        header .logo img:hover {
            transform: rotate(360deg);
        }
        header .logo h1 {
            font-size: 24px;
            color: #fff;
            margin: 0;
            transition: color 0.3s;
        }
        header .logo h1:hover {
            color: #FFD700;
        }
        header .logo h2 {
            font-size: 14px;
            color: #A3D084;
            margin: 0;
            transition: color 0.3s;
        }
        header .logo h2:hover {
            color: #FFD700;
        }
        .navbar {
            flex-grow: 1;
            text-align: center;
        }
        .navbar ul {
            list-style: none;
            display: inline-flex;
            gap: 20px;
            margin: 0;
            padding: 0;
            
        }
        .navbar ul li {
            display: inline;
            border-radius: 10px;
            /* Removed background styling */
        }
        .navbar ul li a {
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            color: rgba(255, 215, 0, 0.9); /* Gold color with 90% opacity */
            font-size: 18px;
            font-weight: bold;
            padding: 10px 15px;
            transition: color 0.3s, background-color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
            gap: 8px; 
            border-radius: 10px;
        }
        .navbar ul li a i {
            font-size: 18px; /* Adjust icon size */
            
        }
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: #fff;
        }
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }
            header .logo {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }
            header .logo h1 {
                font-size: 20px;
            }
            header .logo h2 {
                font-size: 12px;
            }
            .navbar {
                width: 100%;
            }
            .navbar ul {
                display: none;
                flex-direction: column;
                gap: 10px; /* Make the dropdown background semi-transparent */
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                padding: 10px 0;
                transition: max-height 0.3s ease-in-out;
                max-height: 0;
                overflow: hidden;
            }
            .navbar ul.show {
                display: flex;
                max-height: 500px; /* Adjust as needed */
            }
            .menu-toggle {
                display: block;
                font-size: 24px;
                cursor: pointer;
                color: #fff;
                margin-right: 10px; /* Move to the left side of the logo */
                z-index: 1001; /* Ensure the toggle button stays on top */
            }
            .navbar ul li a {
                
                text-align: center; /* Center-align text */
                margin: 0 auto; /* Center the link horizontally */
                display: block; /* Ensure block-level for proper centering */
            }
        }
        @media (max-width: 480px) {
            header .logo img {
                width: 50px;
            }
            header .logo h1 {
                font-size: 18px;
            }
            header .logo h2 {
                font-size: 10px;
            }
            .navbar ul li a {
                font-size: 14px;
                padding: 8px 10px;
            }
        }
        .navbar ul li {
            display: block;
            margin: 10px 0; /* Add spacing between items */
            text-align: center; /* Center-align text */
            
        }

        .navbar ul li a {
            font-size: 16px; /* Adjust font size for better readability */
            padding: 12px 20px; /* Add padding for touch-friendly design */
            border-radius: 5px; /* Add rounded corners */
             /* Add subtle background */
            transition: background-color 0.3s, color 0.3s; /* Smooth hover effect */
        }

        .navbar ul li a:hover {
            background-color: #FFD700; /* Highlight background on hover */
            color: #153D7D; /* Change text color on hover */
        }
                
        /* Hero Section */
        .hero {
            position: relative;
            text-align: center;
            min-height: 80vh; /* Increased height */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow: hidden;
            padding: 40px 20px; /* Added padding */
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(21, 61, 125, 0.7);
            z-index: -1;
        }
        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }
        .hero .welcome-text h1 {
            font-size: 48px;
            font-weight: 700;
            color: #FFD700;
            text-shadow: 3px 3px #0b2a54;
        }
        .hero .welcome-text p {
            color: #ffffff;
            font-size: 20px;
            margin: 15px 0 25px;
        }
        .hero .btn-cta {
            background-color: #FFA500;
            color: #fff;
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }
        .hero .btn-cta:hover {
            background-color: #FF8800;
            transform: scale(1.1);
        }
        .hero .welcome-text {
            margin-top: 30px; /* Adjusted margin to move the text down */
            margin-bottom: 20px; /* Add margin to move the button up */
        }

        /* From Uiverse.io by cssbuttons-io */
        button {
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            vertical-align: middle;
            text-decoration: none;
            background: transparent;
            padding: 0;
            font-size: inherit;
            font-family: inherit;
        }

        button.learn-more {
            width: 12rem;
            height: auto;
        }

        button.learn-more .circle {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: relative;
            display: block;
            margin: 0;
            width: 3rem;
            height: 3rem;
            background: #FFD700; /* Updated color */
            border-radius: 1.625rem;
        }

        button.learn-more .circle .icon {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            background: #fff;
        }

        button.learn-more .circle .icon.arrow {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            left: 0.625rem;
            width: 1.125rem;
            height: 0.125rem;
            background: none;
        }

        button.learn-more .circle .icon.arrow::before {
            position: absolute;
            content: "";
            top: -0.29rem;
            right: 0.0625rem;
            width: 0.625rem;
            height: 0.625rem;
            border-top: 0.125rem solid #fff;
            border-right: 0.125rem solid #fff;
            transform: rotate(45deg);
        }

        button.learn-more .button-text {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.75rem 0;
            margin: 0 0 0 1.85rem;
            color: #FFD700; /* Updated color */
            font-weight: 700;
            line-height: 1.6;
            text-align: center;
            text-transform: uppercase;
        }

        button:hover .circle {
            width: 100%;
        }

        button:hover .circle .icon.arrow {
            background: #fff;
            transform: translate(1rem, 0);
        }

        button:hover .button-text {
            color: #fff;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1001;
            animation: fadeIn 0.3s ease-out;
        }
        .modal-content {
            background-color: #fff;
            width: 85%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: slideDown 0.4s ease-out;
            max-height: 80vh; /* Reduced height */
            overflow-y: auto; /* Added scroll for overflow content */
        }
        .modal-header {
            font-size: 26px;
            color: #153D7D;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .modal-body p {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 35px; /* Adjusted margin to move down */
        }
        .modal-body h3 {
            font-size: 22px;
            color: #153D7D;
            font-weight: bold;
            margin-top: 35px; /* Adjusted margin to move down */
            margin-bottom: 25px; /* Adjusted margin to move down */
        }
        .modal-footer {
            display: flex;
            justify-content: center;
        }
        .close-modal {
            background-color: #FF5E57;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .close-modal:hover {
            background-color: #ff4a42;
        }
        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
                padding: 20px;
            }
            .modal-header {
                font-size: 22px;
            }
            .modal-body p {
                font-size: 16px;
            }
            .modal-body h3 {
                font-size: 20px;
            }
            .close-modal {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
        @media (max-width: 480px) {
            .modal-content {
                width: 95%;
                padding: 15px;
            }
            .modal-header {
                font-size: 20px;
            }
            .modal-body p {
                font-size: 14px;
            }
            .modal-body h3 {
                font-size: 18px;
            }
            .close-modal {
                padding: 8px 16px;
                font-size: 12px;
            }
        }
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); }
            to { transform: translateY(0); }
        }
        /* Wobble Animation */
        @keyframes wobble {
            0%, 100% {
                transform: translateX(0%);
            }
            15% {
                transform: translateX(-25%) rotate(-5deg);
            }
            30% {
                transform: translateX(20%) rotate(3deg);
            }
            45% {
                transform: translateX(-15%) rotate(-3deg);
            }
            60% {
                transform: translateX(10%) rotate(2deg);
            }
            75% {
                transform: translateX(-5%) rotate(-1deg);
            }
        }
        .wobble {
            display: inline-block;
            animation: wobble 1s ease infinite;
        }
        /* Bounce Animation */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        .bounce {
            display: inline-block;
            animation: bounce 2s infinite;    
        }
       /* E-Governance Section */
       .e-governance {
        background: linear-gradient(135deg, #f8f9fc, #e0e0e0), url(''); 
        background-size: cover;
        background-position: center;
        border-radius: 15px;
        padding: 60px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .e-governance h2 {
        font-size: 36px; /* Larger font size */
        font-weight: bold;
        color: #FFD700; /* Gold color */
        text-shadow: 2px 2px #19345a; /* Text shadow */
        margin-bottom: 20px;
    }
    .e-governance p {
        font-size: 18px;
        color: #19345a;
        margin-bottom: 30px;
    }
    .systems {
        display: flex;
        justify-content: center;
        gap: 30px; /* Increased gap */
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .system {
        background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
        backdrop-filter: blur(10px); /* Blur effect */
        border: 2px solid rgba(21, 61, 125, 0.2); /* Light border */
        border-radius: 15px;
        padding: 30px 20px;
        text-align: center;
        width: 280px;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        z-index: 1;
    }
    .system:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }
    .system a {
        color: #153D7D; /* Updated color */
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .system a i {
        font-size: 50px; /* Increased icon size */
        margin-bottom: 20px;
        color: #FFD700; /* Gold color */
    }
    .system a span {
        font-size: 22px; /* Larger font size */
        font-weight: bold;
        margin-top: 10px;
        color: #153D7D;
    }
    .system a p {
        font-size: 18px;
        color: #19345a;
        margin-top: 8px;
    }
      /* Enhanced Officials Section */
    .barangay-officials {
        background: linear-gradient(135deg, #ffffff, #e0e0e0), url('ImagesBRGY/bubbles-bg.png'); /* Add bubble design */
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 60px 20px;
        text-align: center;
    }
    .barangay-officials h2 {
        font-size: 38px;
        margin-bottom: 45px;
        font-weight: 700;
        color: #FFD700;
        text-shadow: 2px 2px #0b2a54;
    }
    .officials-tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .officials-row {
        display: flex;
        justify-content: center;
        gap: 20px; /* Reduced gap */
        flex-wrap: wrap;
    }
    .official {
        text-align: center;
        margin: 10px;
        background: linear-gradient(135deg, #f8f9fc, #e0e0e0);
        color: #333;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
        width: 200px;
        position: relative;
        overflow: hidden;
    }
    .official:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
    .official img {
        width: 120px;
        height: 120px;
        background-color: #e0e0e0;
        border-radius: 50%;
        margin-bottom: 15px;
        border: 4px solid #FFD700;
        transition: transform 0.3s;
    }
    .official:hover img {
        transform: rotate(10deg);
    }
    .official-info {
        text-align: center;
        padding: 10px;
    }
    .official-info .name {
        font-size: 20px;
        font-weight: bold;
        color: #153D7D;
        margin-bottom: 5px;
    }
    .official-info .position {
        font-size: 16px;
        color: #19345a;
        margin-bottom: 5px;
    }
    .official-info .committee {
        font-size: 14px;
        color: #19345a;
        margin-top: 5px;
    }
    .official::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 215, 0, 0.1);
        z-index: -1;
        transition: opacity 0.3s;
    }
    .official:hover::before {
        opacity: 0.3;
    }
        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            font-weight: 500;
            position: relative;
        }
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background-color: #FFD700;
            margin-bottom: 10px;
        }
        footer .social-icons {
            margin: 10px 0;
        }
        footer .social-icons a {
            color: #FFD700;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s, transform 0.3s;
        }
        footer .social-icons a:hover {
            color: #fff;
            transform: scale(1.2);
        }
        /* Enhanced Carousel Styles */
        .carousel {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 0; /* Add padding for spacing */
        }

        .carousel .container {
            background-color: #153D7D;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            max-width: 1200px; /* Limit the width */
            margin: 0 auto; /* Center the container */
        }

        .carousel-slider {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap; /* Allow wrapping for smaller screens */
        }

        .card {
            width: 45%; /* Default width for larger screens */
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .card__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .description-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(21, 61, 125, 0.8);
            color: #FFD700;
            padding: 10px;
            text-align: center;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
        }

        .indicator {
            width: 20px;
            height: 20px;
            background-color: #FFD700;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .indicator.active {
            background-color: #FF8800;
        }

        @media (max-width: 768px) {
            .card {
                width: 90%; /* Adjust width for tablets */
                height: 300px; /* Adjust height for smaller screens */
            }

            .description-overlay {
                font-size: 14px; /* Adjust font size for smaller screens */
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%; /* Full width for mobile devices */
                height: 250px; /* Further reduce height for mobile */
            }

            .description-overlay {
                font-size: 12px; /* Smaller font size for mobile */
                padding: 6px;
            }
        }
        p{
            color: #e0e0e0;
        }
        h2{
            color: #e0e0e0;
        }
        /* Enhanced Testimonials Section */
        .testimonials {
            /* Add slight transparency */
            padding: 80px 20px; /* Increased padding */
            border-radius: 15px;
            margin-top: 40px; /* Adjusted margin */
            /* Added box shadow */
            position: relative;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.4);
        }
        .testimonials::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.2;
            z-index: -1;
        }
        .testimonials h2 {
            font-size: 36px; /* Increased font size */
            margin-bottom: 30px;
            font-weight: 700;
            color: #0b2a54;
            text-shadow: 2px 2px #e0e0e0;
        }
        .testimonials-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        .testimonial {
            display: block;
            position: relative;
            max-width: 300px;
            max-height: 320px;
            background-color: #f2f8f9;
            border-radius: 10px;
            padding: 2em 1.2em;
            margin: 12px;
            text-decoration: none;
            z-index: 0;
            overflow: hidden;
            background: linear-gradient(to bottom, #c3e6ec, #a7d1d9);
            font-family: Arial, Helvetica, sans-serif;
        }

        .testimonial:before {
            content: '';
            position: absolute;
            z-index: -1;
            top: -16px;
            right: -16px;
            background: linear-gradient(135deg, #364a60, #384c6c);
            height: 32px;
            width: 32px;
            border-radius: 32px;
            transform: scale(1);
            transform-origin: 50% 50%;
            transition: transform 0.35s ease-out;
        }

        .testimonial:hover:before {
            transform: scale(28);
        }

        .testimonial p {
            font-size: 1em;
            font-weight: 400;
            line-height: 1.5em;
            color: #452c2c;
        }

        .testimonial:hover p {
            transition: all 0.5s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .testimonial h3 {
            color: #262626;
            font-size: 1.5em;
            line-height: normal;
            font-weight: 700;
            margin-bottom: 0.5em;
        }

        .testimonial:hover h3 {
            transition: all 0.5s ease-out;
            color: #ffffff;
        }

        .go-corner {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            width: 2em;
            height: 2em;
            overflow: hidden;
            top: 0;
            right: 0;
            background: linear-gradient(135deg, #6293c8, #384c6c);
            border-radius: 0 4px 0 32px;
        }

        .go-arrow {
            margin-top: -4px;
            margin-right: -4px;
            color: white;
            font-family: courier, sans;
        }
        .testimonial:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }
        .testimonial p {
            font-size: 18px; /* Increased font size */
            color: #333;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        .testimonial h3 {
            font-size: 20px; /* Increased font size */
            color: #0b2a54;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }
        .testimonial::before {
            content: '“';
            font-size: 60px;
            color: rgba(0, 123, 255, 0.1);
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 0;
        }
        .testimonial::after {
            content: '”';
            font-size: 60px;
            color: rgba(0, 123, 255, 0.1);
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 0;
        }
        html {
            scroll-behavior: smooth;
        }
        body {
            scroll-padding-top: 80px;
        }
        .carousel-indicators {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        .indicator {
            width: 12px;
            height: 12px;
            background-color: #FFD700;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .indicator.active {
            background-color: #FF8800;
        }
        /* Container Styles */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        /* Timeline Section */
        .timeline {
            background-color: #19345a;
            padding: 60px 20px;
            text-align: center;
        }
        .timeline h2 {
            font-size: 36px;
            margin-bottom: 30px;
            font-weight: 700;
            color: #f8f9fc;
            text-shadow: 2px 2px #e0e0e0;
        }
        .timeline ul {
            --col-gap: 2rem;
            --row-gap: 2rem;
            --line-w: 0.25rem;
            display: grid;
            grid-template-columns: var(--line-w) 1fr;
            grid-auto-columns: max-content;
            column-gap: var(--col-gap);
            list-style: none;
            width: min(60rem, 90%);
            margin-inline: auto;
            text-align: center; /* Align content to the center */
        }
        .timeline ul::before {
            content: "";
            grid-column: 1;
            grid-row: 1 / span 20;
            background: rgb(225, 225, 225);
            border-radius: calc(var(--line-w) / 2);
        }
        .timeline ul li:not(:last-child) {
            margin-bottom: var(--row-gap);
        }
        .timeline ul li {
            grid-column: 2;
            --inlineP: 1.5rem;
            margin-inline: auto; /* Center each timeline item */
            grid-row: span 2;
            display: grid;
            grid-template-rows: min-content min-content min-content;
            text-align: center; /* Center text inside each item */
        }
        .timeline ul li .date {
            --dateH: 3rem;
            height: var(--dateH);
            margin-inline: calc(var(--inlineP) * -1);
            text-align: center;
            background-color: var(--accent-color);
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            display: grid;
            place-content: center;
            position: relative;
            border-radius: calc(var(--dateH) / 2) 0 0 calc(var(--dateH) / 2);
        }
        .timeline ul li .date::before {
            content: "";
            width: var(--inlineP);
            aspect-ratio: 1;
            background: var(--accent-color);
            background-image: linear-gradient(rgba(0, 0, 0, 0.2) 100%, transparent);
            position: absolute;
            top: 100%;
            clip-path: polygon(0 0, 100% 0, 0 100%);
            right: 0;
        }
        .timeline ul li .date::after {
            content: "";
            position: absolute;
            width: 2rem;
            aspect-ratio: 1;
            background: #19345a;
            border: 0.3rem solid var(--accent-color);
            border-radius: 50%;
            top: 50%;
            transform: translate(50%, -50%);
            right: calc(100% + var(--col-gap) + var(--line-w) / 2);
        }
        .timeline ul li .title,
        .timeline ul li .descr {
            background: #19345a;
            position: relative;
            padding-inline: 1.5rem;
            color: #f8f9fc;
            text-align: center; /* Center-align the title and description */
            margin: 0 auto; /* Ensure proper centering */
        }
        .timeline ul li .title {
            overflow: hidden;
            padding-block-start: 1.5rem;
            padding-block-end: 1rem;
            font-weight: 500;
        }
        .timeline ul li .descr {
            text-align: justify; /* Justify text alignment */
            padding-block-end: 1.5rem;
            font-weight: 300;
        }
        .timeline ul li .title::before,
        .timeline ul li .descr::before {
            content: "";
            position: absolute;
            width: 90%;
            height: 0.5rem;
            background: rgba(0, 0, 0, 0.5);
            left: 50%;
            border-radius: 50%;
            filter: blur(4px);
            transform: translate(-50%, 50%);
        }
        .timeline ul li .title::before {
            bottom: calc(100% + 0.125rem);
        }
        .timeline ul li .descr::before {
            z-index: -1;
            bottom: 0.25rem;
        }
        @media (min-width: 40rem) {
            .timeline ul {
                grid-template-columns: 1fr var(--line-w) 1fr;
            }
            .timeline ul::before {
                grid-column: 2;
            }
            .timeline ul li:nth-child(odd) {
                grid-column: 1;
            }
            .timeline ul li:nth-child(even) {
                grid-column: 3;
            }
            .timeline ul li:nth-child(2) {
                grid-row: 2/4;
            }
            .timeline ul li:nth-child(odd) .date::before {
                clip-path: polygon(0 0, 100% 0, 100% 100%);
                left: 0;
            }
            .timeline ul li:nth-child(odd) .date::after {
                transform: translate(-50%, -50%);
                left: calc(100% + var(--col-gap) + var(--line-w) / 2);
            }
            .timeline ul li:nth-child(odd) .date {
                border-radius: 0 calc(var(--dateH) / 2) calc(var(--dateH) / 2) 0;
            }
        }
        .timeline ul li .icon {
            font-size: 24px;
            color: #FFD700;
            margin-right: 10px;
        }
        .timeline ul li .title {
            display: flex;
            align-items: center;
        }
        .timeline ul li:nth-child(1) .icon::before {
            content: '\f015'; /* FontAwesome icon for home */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(2) .icon::before {
            content: '\f0c0'; /* FontAwesome icon for users */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(3) .icon::before {
            content: '\f013'; /* FontAwesome icon for cog */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(4) .icon::before {
            content: '\f1b3'; /* FontAwesome icon for building */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(5) .icon::before {
            content: '\f1e3'; /* FontAwesome icon for anniversary */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(6) .icon::before {
            content: '\f06c'; /* FontAwesome icon for leaf */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(7) .icon::before {
            content: '\f21e'; /* FontAwesome icon for heartbeat */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(8) .icon::before {
            content: '\f02d'; /* FontAwesome icon for book */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li:nth-child(9) .icon::before {
            content: '\f1b2'; /* FontAwesome icon for map */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
        .timeline ul li .date {
            margin-inline: calc(var(--inlineP) * -1); /* Ensure alignment */
            border-radius: calc(var(--dateH) / 2) 0 0 calc(var(--dateH) / 2); /* Keep desktop styling */
        }

        .timeline ul li .date::after {
            display: block; /* Ensure timeline markers are visible */
        }

        .timeline ul li .title,
        .timeline ul li .descr {
            padding-inline: 1.5rem; /* Maintain consistent padding */
        }
        .modal-body h4 {
            font-size: 20px;
            color: #153D7D;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .modal-body ul {
            list-style-type: disc;
            padding-left: 20px;
            text-align: left;
        }
        .modal-body ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .modal-body ul li strong {
            color: #153D7D;
        }
        /* Health Services Modal Styles */
        .modal-health {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1001;
            animation: fadeIn 0.3s ease-out;
        }
        .modal-health-content {
            background-color: #fff;
            width: 85%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: slideDown 0.4s ease-out;
            max-height: 80vh;
            overflow-y: auto;
        }
        .modal-health-header {
            font-size: 26px;
            color: #153D7D;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .modal-health-body p {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .modal-health-body h4 {
            font-size: 20px;
            color: #153D7D;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .modal-health-body ul {
            list-style-type: disc;
            padding-left: 20px;
            text-align: left;
        }
        .modal-health-body ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .modal-health-body ul li strong {
            color: #153D7D;
        }
        .modal-health-footer {
            display: flex;
            justify-content: center;
        }
        .close-modal-health {
            background-color: #FF5E57;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .close-modal-health:hover {
            background-color: #ff4a42;
        }
        .modal-emergency {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1001;
            animation: fadeIn 0.3s ease-out;
        }
        .modal-emergency-content {
            background-color: #fff;
            width: 85%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: slideDown 0.4s ease-out;
            max-height: 80vh;
            overflow-y: auto;
        }
        .modal-emergency-header {
            font-size: 26px;
            color: #153D7D;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .modal-emergency-body p {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .modal-emergency-body h4 {
            font-size: 20px;
            color: #153D7D;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .modal-emergency-body ul {
            list-style-type: disc;
            padding-left: 20px;
            text-align: left;
        }
        .modal-emergency-body ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .modal-emergency-body ul li strong {
            color: #153D7D;
        }
        .modal-emergency-footer {
            display: flex;
            justify-content: center;
        }
        .close-modal-emergency {
            background-color: #FF5E57;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .close-modal-emergency:hover {
            background-color: #ff4a42;
        }
        .map-city {
            position: absolute;
            transform: translate(-50%, -50%);
        }
        .map-city__label {
            background-color: #FFD700;
            color: #153D7D;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .map-city__sign {
            font-size: 14px;
        }
        .loader {
            width: 48px;
            height: 48px;
            display: block;
            margin: 20px auto;
            box-sizing: border-box;
            position: relative;
        }
        .loader::after {
            content: '';
            width: 48px;
            height: 48px;
            left: 0;
            bottom: 0;
            position: absolute;
            border-radius: 50% 50% 0;
            border: 15px solid red;
            transform: rotate(45deg) translate(0, 0);
            box-sizing: border-box;
            animation: animMarker 0.4s ease-in-out infinite alternate;
        }
        .loader::before {
            content: '';
            box-sizing: border-box;
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
            top: 150%;
            width: 24px;
            height: 4px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.2);
            animation: animShadow 0.4s ease-in-out infinite alternate;
        }
        @keyframes animMarker {
            0% {
                transform: rotate(45deg) translate(5px, 5px);
            }
            100% {
                transform: rotate(45deg) translate(-5px, -5px);
            }
        }
        @keyframes animShadow {
            0% {
                transform: scale(0.5);
            }
            100% {
                transform: scale(1);
            }
        }
        .carousel-map-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .map-container {
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 10px;
            position: relative;
            width: 50%;
            height: 100%;
        }
        .carousel-container {
            width: 50%;
        }
        /* Chatbot Floating Icon */
        .chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 40px;
            background: linear-gradient(135deg, #FFD700, #FFC107);
            color: #153D7D;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
            animation: bounce 2s infinite ease-in-out;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .chatbot-icon:hover {
            transform: scale(1.2);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3), 0 0 20px #FFD700;
        }

        .chatbot-icon::after {
            content: "Chat Me!";
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            background: #153D7D;
            color: #FFD700;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 1;
            visibility: visible;
        }

        .chatbot-icon i {
            font-size: 30px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        /* Chat Modal Styles */
        .chat-modal {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            max-width: 90%; /* Ensure it adapts to smaller screens */
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            z-index: 1001;
            animation: fadeIn 0.3s ease-out;
            flex-direction: column;
        }

        .chat-header {
            background: #153D7D;
            color: #FFD700;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }

        .chat-header .close-chat {
            background: none;
            border: none;
            color: #FFD700;
            font-size: 16px;
            cursor: pointer;
        }

        .chat-body {
            background: #f5f5f5;
            padding: 10px;
            height: 300px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .chat-footer {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            position: relative;
        }

        .chat-footer input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .chat-footer button {
            background: #153D7D;
            color: #FFD700;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .chat-footer button:hover {
            background: #0b2a54;
        }

        .chat-message {
            max-width: 80%;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.4;
        }

        .chat-message.user {
            background: #153D7D;
            color: #fff;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }

        .chat-message.bot {
            background: #e0e0e0;
            color: #333;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }

        /* Autofill Suggestions Box */
        #suggestionsBox {
            position: absolute;
            bottom: 60px;
            right: 20px;
            width: 90%;
            max-width: 350px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1002;
            display: none;
            overflow: hidden;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        .suggestion-item:hover {
            background: #f0f0f0;
        }

        /* Responsive Chatbot Styles */
        @media (max-width: 768px) {
            .chat-modal {
                width: 90%;
                bottom: 20px;
                right: 5%;
            }
            .chat-header {
                font-size: 14px;
                padding: 8px;
            }
            .chat-footer input {
                font-size: 14px;
                padding: 8px;
            }
            .chat-footer button {
                font-size: 14px;
                padding: 8px 10px;
            }
            .chat-message {
                font-size: 12px;
                padding: 8px;
            }
            .chatbot-icon {
                width: 60px;
                height: 60px;
                bottom: 15px;
                right: 25px;
            }
            .chatbot-icon i {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .chat-modal {
                width: 95%;
                bottom: 10px;
                right: 6.5%;
            }
            .chat-header {
                font-size: 12px;
                padding: 6px;
            }
            .chat-footer input {
                font-size: 12px;
                padding: 6px;
            }
            .chat-footer button {
                font-size: 12px;
                padding: 6px 8px;
            }
            .chat-message {
                font-size: 10px;
                padding: 6px;
            }
            .chatbot-icon {
                width: 50px;
                height: 50px;
                bottom: 10px;
                right: 20px;
            }
            .chatbot-icon i {
                font-size: 20px;
            }
        }
        /* Enhanced Chatbot Styles */
        .chat-message.bot {
            background: linear-gradient(135deg, #FFD700, #FFC107);
            color: #153D7D;
            font-weight: bold;
            padding: 12px;
            border-radius: 10px;
            text-align: left;
            line-height: 1.5;
        }

        .chat-message.user {
            background: linear-gradient(135deg, #153D7D, #0b2a54);
            color: #fff;
            font-weight: bold;
            padding: 12px;
            border-radius: 10px;
            text-align: right;
            line-height: 1.5;
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none;
        }
        .loading-overlay .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #FFD700;
            border-top: 5px solid #153D7D;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @media (max-width: 1024px) {
            .testimonials-container {
                flex-direction: column;
                align-items: center;
            }
            .testimonial {
                max-width: 90%;
                margin: 10px auto;
            }
        }
        @media (max-width: 768px) {
            .testimonials {
                padding: 40px 10px;
            }
            .testimonial {
                padding: 1.5em 1em;
            }
            .testimonial h3 {
                font-size: 18px;
            }
            .testimonial p {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .testimonial {
                max-width: 100%;
                padding: 1em;
            }
            .testimonial h3 {
                font-size: 16px;
            }
            .testimonial p {
                font-size: 14px;
            }
        }
        @media (max-width: 1024px) {
            .welcome-text {
                text-align: center;
                padding: 20px;
            }
            .welcome-text h1 {
                font-size: 36px;
            }
            .welcome-text p {
                font-size: 18px;
            }
            .welcome-text .learn-more {
                padding: 12px 24px;
                font-size: 18px;
            }
        }

        @media (max-width: 768px) {
            .welcome-text h1 {
                font-size: 28px;
            }
            .welcome-text p {
                font-size: 16px;
            }
            .welcome-text .learn-more {
                padding: 10px 20px;
                font-size: 16px;
            }
        }
        @media (max-width: 480px) {
            .welcome-text h1 {
                font-size: 24px; /* Adjust font size for better readability */
                text-align: center; /* Center-align the heading */
                line-height: 1.4; /* Improve spacing */
            }
            .welcome-text p {
                font-size: 14px;
            }
            .welcome-text .learn-more {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
        @media (max-width: 480px) {
            .timeline ul::before {
                width: 2px; /* Reduce the width of the white line for mobile view */
            }
        }
        @media (max-width: 480px) {
            .timeline ul {
                padding: 0;
                gap: 1.5rem; /* Reduce gap for better spacing */
            }

            .timeline ul li {
                width: 95%; /* Use more screen width */
                margin: 0 auto; /* Center items */
            }

            .timeline ul li .date {
                font-size: 12px; /* Adjust font size for better readability */
                padding: 0.5rem; /* Reduce padding */
            }
            .timeline ul li .title {
                font-size: 14px; /* Adjust title font size */
                padding: 0.5rem; /* Reduce padding */
            }
            .timeline ul li .descr {
                font-size: 12px; /* Adjust description font size */
                line-height: 1.4; /* Improve readability */
                padding: 0.5rem; /* Reduce padding */
            }
            .timeline ul::before {
                width: 1px; /* Further reduce the white line width */
            }
        }
        @media (max-width: 480px) {
            .timeline ul li .title {
                font-size: 16px; /* Slightly larger font for better readability */
                line-height: 1.4; /* Improve spacing */
                padding: 0.5rem; /* Adjust padding */
                text-align: center; /* Center-align the title */
            }

            .timeline ul li .descr {
                font-size: 14px; /* Slightly larger font for better readability */
                line-height: 1.5; /* Improve spacing */
                padding: 0.5rem; /* Adjust padding */
                text-align: justify; /* Justify text for better alignment */
            }
        }
        @media (max-width: 480px) {
            .welcome-text p {
                text-align: justify; /* Justify text alignment for better readability */
            }
        }
        .e-governance {
            position: relative;
            overflow: hidden;
        }

        .e-governance::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 20%, transparent 80%);
            background-size: 200px 200px;
            animation: moveBubbles 10s infinite linear;
            z-index: -1;
        }

        .barangay-officials {
            position: relative;
            overflow: hidden;
        }

        .barangay-officials::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 20%, transparent 80%);
            background-size: 200px 200px;
            animation: moveBubbles 10s infinite linear;
            z-index: -1;
        }

        @keyframes moveBubbles {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 100%;
            }
        }
        /* Ensure SVG wave visibility in mobile view */
        .hero {
            position: relative;
            overflow: hidden; /* Prevent clipping of child elements */
        }

        .hero svg {
            display: block;
            width: 100%;
            height: auto;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: -1; /* Place behind other content */
        }
    </style>
</head>
<body>
<header id="top">
    <div class="logo">
        <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
        <img src="LogoImage/logodistr1.png" alt="Barangay District 1 Logo">
        <div>
            <h1>BARANGAY DISTRICT 1</h1>
            <h2>BAYAN NG SAN MANUEL</h2>
        </div>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="#hero"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#e-governance"><i class="fas fa-cogs"></i> E-Governance</a></li>
            <li><a href="#carousel"><i class="fas fa-images"></i> Barangay Highlights</a></li>
            <li><a href="#barangay-officials"><i class="fas fa-users"></i> Barangay Officials</a></li>
            <li><a href="#timeline"><i class="fas fa-history"></i> Barangay Journey</a></li>
        </ul>
    </nav>
</header>
<section class="hero" id="hero">
    <div class="container">
        <video autoplay muted loop>
            <source src="bgvideo/d1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="testimonials">
            <div class="testimonials-container">
                <div class="testimonial">
                    <p>"Barangay District 1 is a wonderful place to live. The community is very supportive and the local government is always there to help."</p>
                    <h3>- MIKKO JOSHUA G. VIERNES</h3>
                    <div class="go-corner">
                        <div class="go-arrow">→</div>
                    </div>
                </div>
                <div class="testimonial">
                    <p>"I love the events organized by the barangay. They bring everyone together and create a strong sense of community."</p>
                    <h3>- AYANNAH AUBREY D. PINEDA</h3>
                    <div class="go-corner">
                        <div class="go-arrow">→</div>
                    </div>
                </div>
                <div class="testimonial">
                    <p>"The e-governance services have made it so much easier to access important information and services."</p>
                    <h3>- ROLLY A. VALIENTE, JR.</h3>
                    <div class="go-corner">
                        <div class="go-arrow">→</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome-text">
            <h1 class="bounce">Welcome to Barangay District 1</h1>
            <p>Your community, our home. Discover the beauty and heritage of San Manuel's Barangay District 1.</p>
            <button class="learn-more" onclick="openModal()">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">Learn More</span>
            </button>
        </div>
    </div>
    <div style="width: 100%; align-items: center; position: absolute; bottom: -70px; left: 0; right: 0;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1" d="M0,128L120,154.7C240,181,480,235,720,234.7C960,235,1200,181,1320,154.7L1440,128L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
        </svg>
    </div>
</section>
<div class="modal" id="learnMoreModal">
    <div class="modal-content">
        <div class="modal-header">About Barangay District 1</div>
        <div class="modal-body">
            <!-- Vision Section -->
            <h3>Vision</h3>
            <p>To create a harmonious and progressive community in Barangay District 1, where residents thrive together in unity, respect, and shared prosperity.</p>
            
            <!-- Mission Section -->
            <h3>Mission</h3>
            <p>To empower our community by fostering strong relationships, supporting sustainable development, and ensuring safety, well-being, and opportunities for all residents.</p>
            
            <!-- Additional Information Section -->
            <h3>Community Values</h3>
            <p>Barangay District 1 prides itself on inclusivity, resilience, and collaboration to build a better future for all community members.</p>
            
            <h3>Location</h3>
            <p>Located in the heart of San Manuel, Barangay District 1 is known for its scenic beauty and vibrant culture.</p>
        </div>
        <div class="modal-footer">
            <button class="close-modal" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>
<div class="modal modal-health" id="healthModal">
    <div class="modal-health-content">
        <div class="modal-health-header">Health Services – Barangay District 1</div>
        <div class="modal-health-body">
            <h4>General Check-ups</h4>
            <p>Routine medical assessments.</p>
            <h4>Maternal & Child Care</h4>
            <p>Prenatal, postnatal, and infant health services.</p>
            <h4>Vaccination Programs</h4>
            <p>Free immunizations for all ages.</p>
            <h4>Emergency First Aid</h4>
            <p>Immediate care for minor injuries.</p>
            <h4>Health Education</h4>
            <p>Seminars on hygiene and disease prevention.</p>
            <h4>Family Planning</h4>
            <p>Counseling and contraceptive services.</p>
            <h4>Senior Citizen Care</h4>
            <p>Regular check-ups and medication support.</p>
        </div>
        <div class="modal-health-footer">
            <button class="close-modal-health" onclick="closeHealthModal()">Close</button>
        </div>
    </div>
</div>
<div class="modal modal-emergency" id="emergencyModal">
    <div class="modal-emergency-content">
        <div class="modal-emergency-header">Emergency Contacts</div>
        <div class="modal-emergency-body">
            <h4>Philippine National Police San Manuel</h4>
            <p>Contact Number: 09357276812</p>
            <h4>Philippine National Police Aurora</h4>
            <p>Contact Number: 09171473463</p>
            <h4>Philippine National Police Roxas </h4>
            <p>Contact Number: 09171195324</p>
            <h4>Bureau of Fire Protection</h4>
            <p>Contact Number: 09762699214</p>
            <h4>Local Government Unit Rescue</h4>
            <p>Contact Number: 09357632231</p>
            <h4>Hospital</h4>
            <p>Contact Number: 09532711535</p>
        </div>
        <div class="modal-emergency-footer">
            <button class="close-modal-emergency" onclick="closeEmergencyModal()">Close</button>
        </div>
    </div>
</div>
<!-- E-Governance Section -->
<section class="e-governance" id="e-governance">
    <div class="container">
        <h2 class="e-governance">E-Governance Services</h2>
        <p style="font-size: 18px; color: #19345a; margin-bottom: 20px;">
            Explore our digital services designed to make governance more accessible and efficient for our community.
        </p>
        <div class="systems">
            <div class="system"><a href="Resident_Panel.php"><i class="fas fa-users"></i><span>Resident Panel</span><p>Access Barangay Services.</p></a></div>
            <div class="system">
                <a href="LoginDILG.php" onclick="return validateDesktopView(event)">
                    <i class="fas fa-building"></i>
                    <span>DILG Panel</span>
                    <p>Access DILG-related information and services.</p>
                </a>
            </div>
            <div class="system"><a href="Barangay_Announcement.php"><i class="fas fa-bullhorn"></i><span>Announcements</span><p>Stay updated with the latest barangay announcements.</p></a></div>
            <div class="system"><a href="#" onclick="openHealthModal()"><i class="fas fa-heartbeat"></i><span>Health Services</span><p>Access health-related services and information.</p></a></div>
            <div class="system"><a href="#" onclick="openEmergencyModal()"><i class="fas fa-phone-alt"></i><span>Emergency Contacts</span><p>Find important emergency contact numbers.</p></a></div>
        </div>
    </div>
</section>

<hr style="border: 1px solid #FFD700; margin: 40px 0;">

<!-- Community Section -->
<section class="carousel" id="carousel">
    <div class="container">
        <h2 style="font-size: 42px; font-weight: bold; color: #FFD700; text-align: center; margin-bottom: 30px; text-shadow: 3px 3px #0b2a54;">Barangay Community Highlights</h2>
        <p style="font-size: 18px; color: #e0e0e0; text-align: center; margin-bottom: 30px;">
            Discover the memorable moments and achievements of Barangay District 1 through our community highlights.
        </p>
        <div class="carousel-slider">
            <div class="slides">
                <?php 
                $images = [
                    ["src" => "ImagesBRGY/Image1.png", "title" => "Community Event", "description" => "A memorable event that brought the community together to celebrate unity and progress."],
                    ["src" => "ImagesBRGY/Image2.jpg", "title" => "Cultural Celebration", "description" => "A vibrant display of our rich cultural heritage and traditions."],
                    ["src" => "ImagesBRGY/Image3.jpg", "title" => "Youth Engagement", "description" => "Empowering the youth through various programs and activities."],
                    ["src" => "ImagesBRGY/image4.jpg", "title" => "Environmental Drive", "description" => "Promoting sustainability and environmental awareness in the community."],
                    ["src" => "ImagesBRGY/image5.jpg", "title" => "Health Program", "description" => "Ensuring the well-being of residents through health initiatives."],
                    ["src" => "ImagesBRGY/image6.jpg", "title" => "Educational Initiative", "description" => "Providing learning opportunities to enhance knowledge and skills."],
                    ["src" => "ImagesBRGY/image7.jpg", "title" => "Infrastructure Development", "description" => "Improving facilities to support community growth and development."],
                    ["src" => "ImagesBRGY/image8.jpg", "title" => "Sports Fest", "description" => "Encouraging teamwork and sportsmanship through various games and activities."]
                ];
                ?>
                <?php for ($i = 0; $i < count($images); $i += 2): ?>
                    <div class="slide" style="display: flex; gap: 20px; justify-content: center;">
                        <?php for ($j = 0; $j < 2; $j++): ?>
                            <?php if (isset($images[$i + $j])): ?>
                                <div class="card">
                                    <img class="card__image" src="<?php echo $images[$i + $j]['src']; ?>" alt="<?php echo $images[$i + $j]['title']; ?>">
                                    <!-- Description Overlay -->
                                    <div class="description-overlay">
                                        <i class="fas fa-info-circle"></i>
                                        <span><?php echo $images[$i + $j]['description']; ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="carousel-indicators">
            <?php for ($i = 0; $i < ceil(count($images) / 2); $i++): ?>
                <span class="indicator" onclick="setSlide(<?php echo $i; ?>)"></span>
            <?php endfor; ?>
        </div>
    </div>
</section>

<hr style="border: 1px solid #FFD700; margin: 40px 0;">

<!-- Barangay Officials Section -->
<section class="barangay-officials" id="barangay-officials">
    <div class="container">
        <h2>Barangay Officials</h2>
        <p style="font-size: 18px; color: #19345a; margin-bottom: 30px;">
            Meet the dedicated individuals who work tirelessly to serve and lead our community.
        </p>
        <div class="officials-tree">
            <div class="officials-row">
                <?php while ($leader = $leadersResult->fetch_assoc()): ?>
                    <div class="official">
                        <img src="<?php echo displayImage($leader['Image']); ?>" alt="<?php echo $leader['Fullname']; ?>">
                        <div class="official-info">
                            <p class="name"><?php echo $leader['Fullname']; ?></p>
                            <p class="position"><?php echo $leader['Position']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="officials-row">
                <?php while ($kagawad = $kagawadResult->fetch_assoc()): ?>
                    <div class="official">
                        <img src="<?php echo displayImage($kagawad['Image']); ?>" alt="<?php echo $kagawad['Fullname']; ?>">
                        <div class="official-info">
                            <p class="name"><?php echo $kagawad['Fullname']; ?></p>
                            <p class="position">Kagawad</p>
                            <p class="committee">Committee: <?php echo $kagawad['Committee']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

    <!-- Timeline Section -->
<section class="timeline" id="timeline">
    <div class="container">
        <h2>Barangay Journey</h2>
        <ul>
            <li style="--accent-color:#41516C">
                <div class="date">1990</div>
                <div class="title"><span class="icon"></span>Barangay District 1 Established</div>
                <div class="descr">Barangay District 1 was established, marking the beginning of a vibrant community.</div>
            </li>
            <li style="--accent-color:#FBCA3E">
                <div class="date">2000</div>
                <div class="title"><span class="icon"></span>Community Programs</div>
                <div class="descr">Introduction of the first community programs aimed at improving the quality of life for residents.</div>
            </li>
            <li style="--accent-color:#1B5F8C">
                <div class="date">2020</div>
                <div class="title"><span class="icon"></span>Infrastructure Developments</div>
                <div class="descr">Significant infrastructure developments, including new community centers and parks.</div>
            </li>
            <li style="--accent-color:#4CADAD">
                <div class="date">2021</div>
                <div class="title"><span class="icon"></span>34th Anniversary</div>
                <div class="descr">Celebrating 34 years of community, progress, and unity in Barangay District 1.</div>
            </li>
            <li style="--accent-color:#41516C">
                <div class="date">2022</div>
                <div class="title"><span class="icon"></span>Green Barangay Project</div>
                <div class="descr">Initiation of the Green Barangay project to promote environmental sustainability.</div>
            </li>
            <li style="--accent-color:#FBCA3E">
                <div class="date">2023</div>
                <div class="title"><span class="icon"></span>MIRACULOUS PILGRIM IMAGE OF OUR LADY OF THE VISITATION OF GUIBANG.</div>
                <div class="descr">The miraculous image of Our Lady of the Visitation of Guibang was brought to Barangay District 1, drawing hundreds of devotees for a solemn celebration of faith and unity.</div>
            </li>
            <li style="--accent-color:#E24A68">
                <div class="date">2023</div>
                <div class="title"><span class="icon"></span>3RD BAYANIHAN FESTIVAL 2023</div>
                <div class="descr">The 3rd Bayanihan Festival celebrated the spirit of community and cooperation with cultural performances, games, and activities that highlighted the rich traditions of Barangay District 1.</div>
            </li>
            <li style="--accent-color:#E24A68">
                <div class="date">2025</div>
                <div class="title"><span class="icon"></span>E-Governance Services</div>
                <div class="descr">Launch of the e-governance services, making it easier for residents to access important information and services.</div>
            </li>
            <li style="--accent-color:#FFD700">
                <div class="date">2025</div>
                <div class="title"><span class="icon"></span>Implementation of IBIM-GIS</div>
                <div class="descr">The IBIM-GIS (Integrated Barangay Information Management and Geographic Information System) was implemented to enhance data management, improve decision-making, and provide efficient services to the community through advanced geographic and information technologies.</div>
            </li>
        </ul>
    </div>
</section>

<footer>
    <div class="social-icons">
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    </div>
    &copy; 2025 District 1 San Manuel, Isabela | All Rights Reserved<br>
    <span style="font-weight: bold;">IBIM-GIS Version 1.0</span>
</footer>

<script>
    // Modal Control Functions
    function openModal() {
        document.getElementById("learnMoreModal").style.display = "flex";
    }
    function closeModal() {
        document.getElementById("learnMoreModal").style.display = "none";
    }
    function openHealthModal() {
        document.getElementById("healthModal").style.display = "flex";
    }
    function closeHealthModal() {
        document.getElementById("healthModal").style.display = "none";
    }
    function openEmergencyModal() {
        document.getElementById("emergencyModal").style.display = "flex";
    }
    function closeEmergencyModal() {
        document.getElementById("emergencyModal").style.display = "none";
    }
    window.onclick = function(event) {
        const learnMoreModal = document.getElementById("learnMoreModal");
        const healthModal = document.getElementById("healthModal");
        const emergencyModal = document.getElementById("emergencyModal");
        if (event.target == learnMoreModal) {
            learnMoreModal.style.display = "none";
        } else if (event.target == healthModal) {
            healthModal.style.display = "none";
        } else if (event.target == emergencyModal) {
            emergencyModal.style.display = "none";
        }
    }
</script>
<script>
    let currentSlide = 0;

    function moveSlide(direction) {
        const slides = document.querySelector('.slides');
        const totalSlides = slides.children.length;
        currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
        updateSlides(slides);
    }

    function setSlide(index) {
        currentSlide = index;
        const slides = document.querySelector('.slides');
        updateSlides(slides);
    }

    function updateSlides(slides) {
        const offset = -currentSlide * 100;
        slides.style.transform = `translateX(${offset}%)`;
        updateIndicators();
    }

    function updateIndicators() {
        const indicators = document.querySelectorAll('.indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateIndicators();
    });
</script>
<script>
function toggleMenu() {
    const navbar = document.querySelector('.navbar ul');
    if (window.innerWidth <= 768) { // Only toggle for mobile view
        navbar.classList.toggle('show');
        if (navbar.classList.contains('show')) {
            navbar.style.display = 'flex'; // Ensure the navbar is displayed
            navbar.style.flexDirection = 'column'; // Stack items vertically for mobile
            navbar.style.transition = 'max-height 0.3s ease-in-out';
            navbar.style.maxHeight = '500px'; // Smoothly expand
        } else {
            navbar.style.transition = 'max-height 0.3s ease-in-out';
            navbar.style.maxHeight = '0'; // Smoothly collapse
            setTimeout(() => navbar.style.display = 'none', 300); // Hide after transition
        }
    }
}

document.querySelectorAll('.navbar ul li a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) { // Only close the menu in mobile view
            const navbar = document.querySelector('.navbar ul');
            navbar.classList.remove('show');
            navbar.style.display = 'none'; // Ensure the navbar is hidden after selection
        }
    });
});
</script>
<script>
function validateDesktopView(event) {
    if (window.innerWidth <= 768) { // Mobile view threshold
        showSnackbar("This feature is only available on desktop view.");
        event.preventDefault(); // Prevent navigation
        return false;
    }
    return true;
}

function showSnackbar(message) {
    // Create snackbar element
    const snackbar = document.createElement("div");
    snackbar.textContent = message;
    snackbar.style.position = "fixed";
    snackbar.style.bottom = "20px";
    snackbar.style.left = "50%";
    snackbar.style.transform = "translateX(-50%)";
    snackbar.style.backgroundColor = "#FFD700"; // Updated to a lighter shade
    snackbar.style.color = "#153D7D"; // Updated to dark text color
    snackbar.style.padding = "10px 20px";
    snackbar.style.borderRadius = "5px";
    snackbar.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
    snackbar.style.zIndex = "1000";
    snackbar.style.opacity = "0";
    snackbar.style.transition = "opacity 0.3s, bottom 0.3s";
    snackbar.style.fontSize = "16px";
    snackbar.style.textAlign = "center";
    snackbar.style.maxWidth = "90%";
    snackbar.style.wordWrap = "break-word";

    // Adjust styles for smaller screens
    if (window.innerWidth <= 480) {
        snackbar.style.fontSize = "14px";
        snackbar.style.padding = "8px 16px";
    }

    // Append to body
    document.body.appendChild(snackbar);

    // Show snackbar
    setTimeout(() => {
        snackbar.style.opacity = "1";
        snackbar.style.bottom = "30px";
    }, 10);

    // Hide and remove snackbar after 3 seconds
    setTimeout(() => {
        snackbar.style.opacity = "0";
        snackbar.style.bottom = "20px";
        setTimeout(() => {
            snackbar.remove();
        }, 300);
    }, 3000);
}
</script>

<div class="chatbot-icon" onclick="toggleChatModal()">
    <i class="fas fa-robot"></i>
</div>

<div class="chat-modal" id="chatModal">
    <div class="chat-header">
        <span>Barangay Chatbot <i class="fas fa-circle" style="color: Lightgreen; margin-right: 50px; font-size: 10px;" title="Online"></i></span>
        <button class="close-chat" onclick="toggleChatModal()">Close</button>
    </div>
    <div class="chat-body" id="chatBody">
        <div class="chat-message bot">
            Welcome to Barangay District 1 Chatbot! How can I assist you today? Feel free to ask any questions about our services or community.
        </div>
    </div>
    <div class="chat-footer">
        <input type="text" id="chatInput" placeholder="Type your message..." oninput="autofillSuggestions()" onkeypress="handleKeyPress(event)">
        <button class="send-button" onclick="sendMessage()">
            <i class="fas fa-paper-plane"></i>
        </button>
        <div id="suggestionsBox"></div>
    </div>
</div>

<script>
async function fetchFAQs() {
    const response = await fetch('JSON/FrequenntlyAskedQ.json');
    return response.json();
}

function detectLanguage(query) {
    const tagalogWords = ['paano', 'saan', 'ano', 'magkano', 'ilan', 'kailan'];
    const lowerQuery = query.toLowerCase();
    return tagalogWords.some(word => lowerQuery.includes(word)) ? 'tagalog' : 'english';
}

function findRelevantQuestion(query, faqs, language) {
    const lowerQuery = query.toLowerCase();
    let exactMatch = null;
    const suggestions = [];

    faqs.categories.forEach(category => {
        category.questions.forEach(q => {
            const lowerQuestion = q.question.toLowerCase();
            if (lowerQuestion === lowerQuery) {
                exactMatch = q.answer;
            } else if (lowerQuestion.includes(lowerQuery) || lowerQuery.includes(lowerQuestion)) {
                suggestions.push(q.question);
            }
        });
    });

    if (language === 'tagalog') {
        return {
            exactMatch: exactMatch ? `Ang sagot ay: ${exactMatch}` : null,
            suggestions: suggestions.map(s => `- ${s}`)
        };
    }

    return { exactMatch, suggestions };
}

async function sendMessage() {
    const input = document.getElementById("chatInput");
    const message = input.value.trim();
    if (message) {
        appendMessage(message, "user");
        input.value = "";

        const faqs = await fetchFAQs();
        const language = detectLanguage(message);
        const { exactMatch, suggestions } = findRelevantQuestion(message, faqs, language);

        if (exactMatch) {
            const response = language === 'tagalog' ? exactMatch.tagalog_answer : exactMatch.answer;
            setTimeout(() => appendMessage(response, "bot"), 500);
        } else if (suggestions.length > 0) {
            const suggestionText = language === 'tagalog'
                ? `Pasensya na, wala akong eksaktong sagot. Baka ang ibig mong sabihin ay:\n${suggestions.join("\n")}`
                : `Sorry, I couldn't find an exact match. Did you mean:\n${suggestions.join("\n")}`;
            setTimeout(() => appendMessage(suggestionText, "bot"), 500);
        } else {
            const noMatchText = language === 'tagalog'
                ? "Pasensya na, wala akong mahanap na kaugnay na impormasyon."
                : "Sorry, I couldn't find any relevant information.";
            setTimeout(() => appendMessage(noMatchText, "bot"), 500);
        }
    }
}

function appendMessage(text, sender) {
    const chatBody = document.getElementById("chatBody");
    const messageDiv = document.createElement("div");
    messageDiv.className = `chat-message ${sender}`;
    messageDiv.innerHTML = text.replace(/\n/g, '<br>'); // Preserve line breaks
    chatBody.appendChild(messageDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function handleKeyPress(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
}

async function autofillSuggestions() {
    const input = document.getElementById("chatInput");
    const query = input.value.trim().toLowerCase();
    const suggestionsBox = document.getElementById("suggestionsBox");

    if (query.length > 0) {
        const faqs = await fetchFAQs();
        const suggestions = [];

        faqs.categories.forEach(category => {
            category.questions.forEach(q => {
                if (q.question.toLowerCase().includes(query) || q.tagalog_question.toLowerCase().includes(query)) {
                    suggestions.push(`${q.question} / ${q.tagalog_question}`);
                }
            });
        });

        suggestionsBox.innerHTML = suggestions
            .slice(0, 5) // Limit to 5 suggestions
            .map(suggestion => `<div class="suggestion-item" onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`)
            .join('');
        suggestionsBox.style.display = suggestions.length > 0 ? "block" : "none";
    } else {
        suggestionsBox.style.display = "none";
    }
}

function selectSuggestion(suggestion) {
    const input = document.getElementById("chatInput");
    input.value = suggestion;
    document.getElementById("suggestionsBox").style.display = "none";
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleChatModal() {
    const chatModal = document.getElementById("chatModal");
    if (chatModal.style.display === "flex") {
        chatModal.style.display = "none";
    } else {
        chatModal.style.display = "flex";
    }
}

const chatInput = document.getElementById("chatInput");
const chatBody = document.getElementById("chatBody");

chatInput.addEventListener("input", () => {
    const placeholderMessage = chatBody.querySelector(".chat-message.bot");
    if (placeholderMessage) {
        placeholderMessage.remove();
    }
});
</script>
<script src="https://unpkg.com/scrollreveal"></script>
<script>
    // Scroll Reveal Configuration
    ScrollReveal().reveal('.hero', {
        duration: 1000,
        origin: 'top',
        distance: '50px',
        easing: 'ease-in-out',
        reset: true
    });

    ScrollReveal().reveal('.e-governance', {
        duration: 1000,
        origin: 'left',
        distance: '50px',
        easing: 'ease-in-out',
        reset: true
    });

    ScrollReveal().reveal('.carousel', {
        duration: 1000,
        origin: 'right',
        distance: '50px',
        easing: 'ease-in-out',
        reset: true
    });

    ScrollReveal().reveal('.barangay-officials', {
        duration: 1000,
        origin: 'bottom',
        distance: '50px',
        easing: 'ease-in-out',
        reset: true
    });

    if (window.innerWidth > 768) { // Only apply ScrollReveal for desktop views
        ScrollReveal().reveal('.timeline', {
            duration: 1000,
            origin: 'top',
            distance: '50px',
            easing: 'ease-in-out',
            reset: true
        });
    }
</script>
<script>
    // Smooth scrolling for navigation links with a lagging effect, responsive for various screen sizes
    document.querySelectorAll('.navbar ul li a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                const targetPosition = targetElement.offsetTop - 80; // Adjust for fixed header height
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth' // Use native smooth scrolling for better performance
                });
            }
        });
    });
</script>
</body>
</html>