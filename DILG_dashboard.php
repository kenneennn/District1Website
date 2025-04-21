<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DILG</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mui/5.0.0/material-ui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/v4-shims.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css">
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif; 
        }   
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
             min-height: 100vh;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }
        #drawer-toggle {
            display: none;
        }
        #drawer-toggle-label {
            display: none;
        }
        #drawer {
            position: fixed;
            top: 0;
            left: 0;
            width: 80px;
            height: 100vh;
            background: linear-gradient(to bottom, #A62C2C, #D3CA79); 
            color: white;
            padding-top: 60px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5); /* Enhanced shadow */
            z-index: 2;
            transition: width 0.3s ease-in-out, opacity 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
            opacity: 0.95; /* Slightly transparent */
        }

        #drawer:hover {
            width: 280px; /* Expanded width */
            opacity: 1; /* Full opacity */
        }

        #drawer.pinned {
            width: 300px;
            opacity: 1; /* Full opacity when pinned */
        }

        #drawer.pinned ~ .content {
            margin-left: 300px; /* Adjusted margin for pinned state */
        }

        #drawer:hover ~ .content {
            margin-left: 280px;
        }

        #drawer ul {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        #drawer ul li {
            padding: 15px 20px; /* Adjusted padding for better spacing */
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.3s ease-in-out, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, text-align 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #drawer:hover ul li {
            text-align: left; /* Align text to the left when expanded */
            justify-content: flex-start;
        }

        #drawer ul li:hover {
            background: rgba(255, 255, 255, 0.15); /* Subtle hover effect */
            transform: translateX(10px); /* Smooth hover translation */
            box-shadow: 3px 3px 12px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        }

        #drawer ul li a {
            color: white; /* Updated text color to white */
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 18px; /* Increased font size */
            justify-content: center;
            width: 100%;
            padding: 10px 15px; /* Adjusted padding for better alignment */
            border-radius: 8px; /* Rounded corners for links */
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out, justify-content 0.3s ease-in-out;
        }

        #drawer:hover ul li a {
            justify-content: flex-start; /* Align icons and text to the left */
        }

        #drawer ul li a i {
            margin-right: 15px; /* Adjusted spacing between icon and text */
            font-size: 24px; /* Slightly larger icon size */
            transition: transform 0.3s ease-in-out, color 0.3s ease-in-out; /* Smooth transition for hover effects */
        }

        #drawer ul li a:hover i {
            transform: scale(1.2); /* Zoom effect on hover */
            color: #ffc107; /* Highlight icon color */
        }

        #drawer ul li a span {
            display: none;
            font-weight: bold;
            font-size: 16px; /* Adjusted font size for better readability */
            color: white; /* Updated label color to white */
        }

        #drawer:hover ul li a span {
            display: inline;
            margin-left: 10px; /* Spacing for text */
        }

        .content {
            padding: 80px 20px 50px 20px;
            flex: 1;
            margin-left: 80px;
            transition: margin-left 0.3s ease-in-out, opacity 0.3s ease-in-out; /* Added opacity transition */
        }

        #drawer:hover ~ .content,
        #drawer.pinned ~ .content {
            opacity: 1; 
        }

        @media (max-width: 768px) {
            #drawer {
                width: 60px;
            }

            #drawer:hover {
                width: 200px;
            }

            .content {
                margin-left: 60px;
            }

            #drawer:hover ~ .content {
                margin-left: 200px;
            }
        }

        .charts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .chart-box {
            width: 30%;
            min-width: 300px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3), inset 0 -3px 6px rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .footer {
            background: linear-gradient(to bottom, #A62C2C, #D3CA79); /* Changed footer background color */
            color: white; /* Ensured footer text color remains white */
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .charts-container {
                flex-direction: column;
                align-items: center;
            }

            .chart-box {
                width: 90%;
                margin-bottom: 20px;
            }

            #drawer-toggle:checked ~ #drawer-toggle-label {
                left: 210px;
            }

            .testimonial {
                width: 90%;
                margin: 10px 0;
            }

            .news-item, .event-item {
                width: 100%;
            }

            .card {
                width: 90%;
                margin-bottom: 20px;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .card i {
                margin-bottom: 10px;
                margin-right: 0;
            }

            .card-content {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .header-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .header-content img {
                height: 40px;
            }

            .header-content h1 {
                font-size: 24px;
            }

            .header-content p {
                font-size: 16px;
            }

            .logout-btn {
                font-size: 16px;
                padding: 8px 16px;
            }

            .card h3 {
                font-size: 20px;
            }

            .card p {
                font-size: 16px;
            }

            .testimonial p {
                font-size: 14px;
            }

            .testimonial .author {
                font-size: 14px;
            }

            .news-item p, .event-item p {
                font-size: 14px;
            }
        }
        .testimonials-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .testimonial {
            background: #1A5276; /* Changed icon background color */
            padding: 20px;
            margin: 20px;
            border-left: 5px solid #19345a;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 30%;
            min-width: 300px;
            flex: 1;
            box-sizing: border-box;
            transition: transform 0.3s ease-in-out;
        }

        .testimonial:hover {
            transform: translateY(-10px);
        }

        .testimonial p {
            font-size: 16px;
            font-style: italic;
            color: #333;
        }

        .testimonial .author {
            font-weight: bold;
            text-align: right;
            display: block;
            color: #19345a;
            margin-top: 10px;
        }
        @media (max-width: 768px) {
            .testimonial {
                width: 90%;
                margin: 10px 0;
            }
        }
        .card {
            background: #fcfcfc; /* Changed card background color */
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3), inset 0 -3px 6px rgba(255, 255, 255, 0.2);
            padding: 20px 30px; /* Increased padding */
            margin: 40px; 
            flex: 1;
            min-width: 300px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card h3 {
            font-size: 26px;
            margin-bottom: 10px;
            color: #19345a;
            font-weight: bold; /* Added bold font weight */
        }

        .card p {
            font-size: 20px; /* Increased font size */
            color: #333;
        }

        .card i {
            font-size: 50px; 
            background: #ff7e5f; /* Changed icon background color */
            color: white;
            padding: 20px;
            border-radius: 10px; 
            margin-right: 20px; 
        }

        .card-content {
            text-align: left;
        }
        
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .chart-box canvas {
            height: 300px;
        }

        .charts-container {
            margin-top: 1000px; 
        }
        .news-container, .charts-container, .testimonials-container {
            margin-top: 1px;
        }

        .news-item, .event-item, .card, .chart-box, .testimonial {
            margin-top: 1px;
        }
        .news-container, .events-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 40px;
            width: auto;
            max-width: 2000px;
            margin-left: 30px;
            margin-right: auto;
            margin-top: 20px;
        }
        .news-item, .event-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 48%;
            transition: transform 0.3s ease-in-out;
        }
        .news-item {
            background: #e0f7fa; /* Changed news item background color */
            border-left: 5px solid #00796b; /* Changed news item border color */
        }
        .news-item h4 {
            color: #00796b;
        }

        .event-item {
            background: #fff3e0; /* Changed event item background color */
            border-left: 5px solid #f57c00; /* Changed event item border color */
        }

        .event-item h4 {
            color: #f57c00;
        }

        .news-item p, .event-item p {
            font-size: 16px;
            color: #333;
        }

        .news-item:hover, .event-item:hover {
            transform: translateY(-10px);
        }

        @media (max-width: 768px) {
            .news-item, .event-item {
                width: 100%;
            }
        }
        #pin-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #f1f1f1; /* Match icon color */
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease-in-out, transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0; /* Initially hidden */
            pointer-events: none; /* Disable interaction when hidden */
        }

        #drawer:hover #pin-button,
        #drawer.pinned #pin-button {
            opacity: 1; /* Show when drawer is hovered or pinned */
            pointer-events: auto; /* Enable interaction when visible */
        }

        #pin-button:hover {
            color: #f4f4f4; /* Light hover color for contrast */
            transform: scale(1.1); /* Slight zoom on hover */
        }
        #drawer.pinned {
            width: 300px;
        }

        #drawer.pinned ul li {
            text-align: left; /* Ensure text stays aligned to the left */
            justify-content: flex-start; /* Align icons and text to the left */
        }

        #drawer.pinned ul li a {
            justify-content: flex-start; /* Align icons and text to the left */
        }

        #drawer.pinned ul li a span {
            display: inline; /* Ensure text is visible */
            margin-left: 15px; /* Maintain spacing for text */
        }

        #drawer.pinned ~ .content {
            margin-left: 260px;
        }

        #drawer.pinned #drawer-header h2 {
            display: block;
        }
        .snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #145a8a; /* Enhanced background color */
            color: #fff; /* Text color remains white */
            text-align: center;
            border-radius: 8px; /* Increased border radius for smoother edges */
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhanced box shadow */
            transition: visibility 0.5s, bottom 0.5s, opacity 0.5s;
            opacity: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .snackbar.show {
            visibility: visible;
            bottom: 50px;
            opacity: 1;
        }

        .snackbar button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .snackbar button:hover {
            background-color: #d32f2f;
        }

        @keyframes fadeIn {
            from { bottom: 0; opacity: 0; }
            to { bottom: 30px; opacity: 1; }
        }

        @keyframes fadeOut {
            from { bottom: 30px; opacity: 1; }
            to { bottom: 0; opacity: 0; }
        }
    </style>
</head>
<body>
    <nav id="drawer">
        <button id="pin-button"><i class="material-icons">push_pin</i></button>
        <ul>
            <li><a href="Dashboard"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a></li>
            <li><a href="KasambahayReports.php"><i class="fas fa-home"></i><span> Kasambahay Reports</span></a></li>
            <li><a href="AvaileeReports.php"><i class="fas fa-users"></i><span> Availee Reports</span></a></li>
            <li><a href="WeeklyCleanupDriveReports.php"><i class="fas fa-broom"></i><span> Weekly Cleanup Drive Reports</span></a></li>
            <li><a href="MonthlyBaRCOReport.php"><i class="fas fa-clipboard-list"></i><span> Monthly BaRCO Reports</span></a></li>
            <li><a href="CommunityPrograms.php"><i class="fas fa-hand-holding-heart"></i><span> Community Programs</span></a></li> <!-- New Element -->
        </ul>
        <ul>
            <li><a href="LoginDILG.php"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a></li>
        </ul>
        <div style="margin-top: auto; padding: 25px; text-align: center; color: black; font-size: 14px; font-style: italic;">
            <hr style="border: 1px solid black; margin-bottom: 20px;">
            &copy; 2025 District 1 San Manuel, Isabela | All Rights Reserved<br>
            <span style="font-weight: bold;">IBIM-GIS Version 1.0</span>
        </div>
    </nav>
    <div class="content">
        <div class="custom-banner" style="background: linear-gradient(135deg, #ff7e5f, #feb47b); color: white; text-align: center; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
            <img src="LogoImage/dilg-banner.jpg" alt="DILG Banner" style="max-width: 100%; height: auto; border-radius: 10px; margin-right: 20px; flex: 1; min-width: 200px;">
            <div style="flex: 2; min-width: 300px;">
                <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">Stay Updated with the Latest Insights</h2>
                <p style="font-size: 16px;">Explore the data and trends shaping our community</p>
            </div>
        </div>
        <div class="cards-container">
        </div>
        <div class="news-container">
            <div class="news-item">
                <h4>Community Clean-Up Drive</h4>
                <p>Join us for a community clean-up drive this weekend. Let's keep our neighborhood clean and green!</p>
            </div>
            <div class="news-item">
                <h4>Health and Wellness Program</h4>
                <p>Attend our health and wellness program to learn more about maintaining a healthy lifestyle.</p>
            </div>
        </div>
        <div class="events-container">
            <div class="event-item">
                <h4>Upcoming Barangay Meeting</h4>
                <p>Don't miss the upcoming barangay meeting to discuss important community issues and plans.</p>
            </div>
            <div class="event-item">
                <h4>Disaster Preparedness Workshop</h4>
                <p>Participate in our disaster preparedness workshop to learn how to stay safe during emergencies.</p>
            </div>
        </div>
    </div>
    <?php
    require_once 'db_connection.php';

    $sql1 = "SELECT PurokName, COUNT(ResidentName) as ResidentCount FROM tblresidentprofiling GROUP BY PurokName";
    $result1 = $conn->query($sql1);

    $purokNames = [];
    $residentCounts = [];
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $purokNames[] = $row['PurokName'];
            $residentCounts[] = $row['ResidentCount'];
        } 
    }

    $sqlAllPurokNames = "SELECT DISTINCT PurokName FROM tblresidentprofiling";
    $resultAllPurokNames = $conn->query($sqlAllPurokNames);

    $allPurokNames = [];
    if ($resultAllPurokNames->num_rows > 0) {
        while($row = $resultAllPurokNames->fetch_assoc()) {
            $allPurokNames[] = $row['PurokName'];
        }
    }

    $purokNames = array_unique(array_merge($allPurokNames, $purokNames));
    $residentCounts = array_pad($residentCounts, count($purokNames), 0);

    $sql2 = "SELECT SCStatus, COUNT(*) as StatusCount FROM tblresidentprofiling WHERE SCStatus IN ('NOT MEMBER', 'MEMBER') GROUP BY SCStatus";
    $result2 = $conn->query($sql2);

    $scStatuses = [];
    $statusCounts = [];
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $scStatuses[] = $row['SCStatus'];
            $statusCounts[] = $row['StatusCount'];
        }
    }

    $sql3 = "SELECT Status, COUNT(ResidentName) as StatusCount FROM tblresidentprofiling GROUP BY Status";
    $result3 = $conn->query($sql3);

    $statusLabels = [];
    $statusData = [];
    if ($result3->num_rows > 0) {
        while($row = $result3->fetch_assoc()) {
            $statusLabels[] = $row['Status'];
            $statusData[] = $row['StatusCount'];
        }
    }
    $sqlActiveResidents = "SELECT COUNT(ResidentName) as ActiveResidents FROM tblresidentprofiling WHERE Status = 'Active'";
    $resultActiveResidents = $conn->query($sqlActiveResidents);
    $activeResidents = $resultActiveResidents->fetch_assoc()['ActiveResidents'];

    $sqlTotalSeniorCitizens = "SELECT COUNT(ResidentName) as TotalSeniorCitizens FROM tblresidentprofiling WHERE SCStatus = 'MEMBER'";
    $resultTotalSeniorCitizens = $conn->query($sqlTotalSeniorCitizens);
    $totalSeniorCitizens = $resultTotalSeniorCitizens->fetch_assoc()['TotalSeniorCitizens'];

    $sqlTotalActivePrograms = "SELECT COUNT(GovernmentAssistance) as TotalActivePrograms FROM tblgovernmentassistance";
    $resultTotalActivePrograms = $conn->query($sqlTotalActivePrograms);
    $totalActivePrograms = $resultTotalActivePrograms->fetch_assoc()['TotalActivePrograms'];

    $conn->close();
    ?>
    <script>
        const purokNames = <?php echo json_encode($purokNames); ?>;
        const residentCounts = <?php echo json_encode($residentCounts); ?>;
        const scStatuses = <?php echo json_encode($scStatuses); ?>;
        const statusCounts = <?php echo json_encode($statusCounts); ?>;
        const statusLabels = <?php echo json_encode($statusLabels); ?>;
        const statusData = <?php echo json_encode($statusData); ?>;
        const activeResidents = <?php echo $activeResidents; ?>;
        const totalSeniorCitizens = <?php echo $totalSeniorCitizens; ?>;
        const totalActivePrograms = <?php echo $totalActivePrograms; ?>;

        const backgroundColors = [
            'rgba(25, 52, 90, 0.5)',
            'rgba(0, 123, 255, 0.5)',
            'rgba(40, 167, 69, 0.5)',
            'rgba(255, 193, 7, 0.5)',
            'rgba(220, 53, 69, 0.5)',
            'rgba(108, 117, 125, 0.5)'
        ];
        const borderColors = [
            'rgba(25, 52, 90, 1)',
            'rgba(0, 123, 255, 1)',
            'rgba(40, 167, 69, 1)',
            'rgba(255, 193, 7, 1)',
            'rgba(220, 53, 69, 1)',
            'rgba(108, 117, 125, 1)'
        ];

        function createChart(chartId, type, data, labels, label) {
            const ctx = document.getElementById(chartId).getContext('2d');
            new Chart(ctx, {
                type: type,
                data: {
                    labels: labels.length ? labels : ['No Data'],
                    datasets: [{
                        label: label,
                        data: data.length ? data : [0],
                        backgroundColor: backgroundColors.slice(0, labels.length),
                        borderColor: borderColors.slice(0, labels.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: label,
                            font: {
                                size: 20
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 12
                            },
                            boxPadding: 5
                        }
                    },
                    elements: {
                        bar: {
                            borderWidth: 2,
                            borderColor: 'rgba(0, 0, 0, 0.2)',
                            backgroundColor: function(context) {
                                const index = context.dataIndex;
                                const value = context.dataset.data[index];
                                return value > 50 ? 'rgba(0, 123, 255, 0.7)' : 'rgba(255, 99, 132, 0.7)';
                            },
                            hoverBackgroundColor: 'rgba(0, 123, 255, 0.9)',
                            hoverBorderColor: 'rgba(0, 0, 0, 0.5)',
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                            shadowBlur: 5,
                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('#drawer ul li a');
            const contentDiv = document.querySelector('.content');
            const drawer = document.getElementById('drawer');
            const pinButton = document.getElementById('pin-button');
            let isPinned = false;

            pinButton.addEventListener('click', function() {
                isPinned = !isPinned;
                if (isPinned) {
                    drawer.classList.add('pinned');
                    pinButton.innerHTML = '<i class="material-icons">push_pin</i>';
                } else {
                    drawer.classList.remove('pinned');
                    pinButton.innerHTML = '<i class="material-icons">push_pin</i>';
                }
            });

            drawer.addEventListener('mouseenter', function() {
                if (!isPinned) {
                    drawer.style.width = '280px';
                    drawer.style.opacity = '1'; // Smooth opacity change
                }
            });

            drawer.addEventListener('mouseleave', function() {
                if (!isPinned) {
                    drawer.style.width = '80px';
                    drawer.style.opacity = '0.9'; // Smooth opacity change
                }
            });

            function loadDefaultContent() {
                const images = [
                    'LogoImage/dilg pictures/1st.jpg',
                    'LogoImage/dilg pictures/2nd.jpg',
                    'LogoImage/dilg pictures/3rd.jpg',
                    'LogoImage/dilg pictures/4rth.jpg',
                    'LogoImage/dilg pictures/5th.jpg',
                    'LogoImage/dilg pictures/6th.jpg',
                    'LogoImage/dilg pictures/7th.jpg'
                ];

                let currentImageIndex = 0;

                contentDiv.innerHTML = `
                    <div class="custom-banner" id="banner-container" style="background: linear-gradient(to bottom, #A62C2C, #D3CA79); color: white; text-align: center; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <div style="position: relative; flex: 1; min-width: 200px;">
                            <img id="banner-image" src="${images[currentImageIndex]}" alt="DILG Banner" style="width: 100%; height: 350px; object-fit: cover; border-radius: 15px; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); border: 5px solid #ff7e5f; transition: transform 0.5s ease, box-shadow 0.5s ease;">
                            <div style="position: absolute; bottom: 10px; left: 10px; background: rgba(0, 0, 0, 0.5); color: white; padding: 10px 15px; border-radius: 8px; font-size: 16px;">DILG Highlights</div>
                        </div>
                        <div style="flex: 2; min-width: 300px;">
                            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">Stay Updated with the Latest Insights</h2>
                            <p style="font-size: 16px;">Explore the data and trends shaping our community</p>
                             <div class="news-container">
                    <div class="news-item">
                        <h4>Community Clean-Up Drive</h4>
                        <p>Join us for a community clean-up drive this weekend. Let's keep our neighborhood clean and green!</p>
                    </div>
                    <div class="news-item">
                        <h4>Health and Wellness Program</h4>
                        <p>Attend our health and wellness program to learn more about maintaining a healthy lifestyle.</p>
                    </div>
                     </div>
                <div class="events-container">
                    <div class="event-item">
                        <h4>Upcoming Barangay Meeting</h4>
                        <p>Don't miss the upcoming barangay meeting to discuss important community issues and plans.</p>
                    </div>
                    <div class="event-item">
                        <h4>Disaster Preparedness Workshop</h4>
                        <p>Participate in our disaster preparedness workshop to learn how to stay safe during emergencies.</p>
                    </div>
                </div>
                        </div>
                    </div>
                    <div class="cards-container">
                        <div class="card">
                            <i class="fas fa-users"></i>
                            <div class="card-content">
                                <h1>${activeResidents}</h1>
                                <p>Total Residents</p>
                            </div>
                        </div>
                        <div class="card">
                            <i class="fas fa-user-graduate"></i>
                            <div class="card-content">
                            <h1>${totalSeniorCitizens}</h1>
                                <p>Senior Citizens</p>
                            </div>
                        </div>
                        <div class="card">
                            <i class="fas fa-clipboard-list"></i>
                            <div class="card-content">
                             <h1>${totalActivePrograms}</h1>
                                <p>Active Programs</p>
                            </div>
                        </div>
                    </div>
                    <div class="charts-container">
                        <div class="chart-box">
                            <canvas id="chart1"></canvas>
                        </div>
                        <div class="chart-box">
                            <canvas id="chart2"></canvas>
                        </div>
                        <div class="chart-box">
                            <canvas id="chart3"></canvas>
                        </div>
                    </div>
                `;

                createChart('chart1', 'bar', residentCounts, purokNames, 'Number of Residents Per Purok');
                createChart('chart2', 'line', statusCounts, scStatuses, 'Senior Citizen Status Per Purok');  
                createChart('chart3', 'pie', statusData, statusLabels, 'Total Residents Per Status');

                setInterval(() => {
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    const bannerImage = document.getElementById('banner-image');
                    bannerImage.style.transform = 'scale(1.05)';
                    bannerImage.style.boxShadow = '0 12px 20px rgba(0, 0, 0, 0.3)';
                    setTimeout(() => {
                        bannerImage.src = images[currentImageIndex];
                        bannerImage.style.transform = 'scale(1)';
                        bannerImage.style.boxShadow = '0 8px 15px rgba(0, 0, 0, 0.2)';
                    }, 500);
                }, 3000); // Change image every 3 seconds
            }

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('href');
                    if (url === 'Dashboard') {
                        loadDefaultContent();
                    } else if (url === 'CommunityPrograms.php') {
                        // Load CommunityPrograms.php content
                        fetch(url)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.text();
                            })
                            .then(data => {
                                contentDiv.innerHTML = data;
                            })
                            .catch(error => {
                                console.error('Error loading content:', error);
                                contentDiv.innerHTML = '<p>Error loading content. Please try again later.</p>';
                            });
                    } else if (url === 'LoginDILG.php') {
                        // Show the snackbar for logout
                        snackbar.className = "snackbar show";
                    } else {
                        // Handle other links
                        fetch(url)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.text();
                            })
                            .then(data => {
                                contentDiv.innerHTML = data;
                            })
                            .catch(error => {
                                console.error('Error loading content:', error);
                                contentDiv.innerHTML = '<p>Error loading content. Please try again later.</p>';
                            });
                    }
                });
            });
            loadDefaultContent();

            const logoutLink = document.querySelector('a[href="LoginDILG.php"]');
            const snackbar = document.getElementById('snackbar');
            const confirmLogoutButton = document.getElementById('confirm-logout');
            const cancelLogoutButton = document.getElementById('cancel-logout');

            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                snackbar.className = "snackbar show";
            });

            confirmLogoutButton.addEventListener('click', function() {
                window.location.href = 'LoginDILG.php';
            });

            cancelLogoutButton.addEventListener('click', function() {
                snackbar.className = snackbar.className.replace("show", "");
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const logoutLink = document.querySelector('a[href="LoginDILG.php"]');
            const snackbar = document.createElement('div');
            snackbar.id = 'snackbar';
            snackbar.className = 'snackbar';
            snackbar.innerHTML = `
                <span>Are you sure you want to logout?</span>
                <button id="confirm-logout">Yes</button>
                <button id="cancel-logout">No</button>
            `;
            document.body.appendChild(snackbar);

            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                snackbar.classList.add('show');
            });

            document.getElementById('confirm-logout').addEventListener('click', function() {
                window.location.href = 'LoginDILG.php';
            });

            document.getElementById('cancel-logout').addEventListener('click', function() {
                snackbar.classList.remove('show');
            });
        });
    </script>
</body>
</html>
