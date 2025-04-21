<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Complaint Form</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mui/material@5.0.0-alpha.36/dist/material-ui.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #2C3E50, #bdc3c7);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-direction: row;
            gap: 10px;
            width: 100%;
            max-width: 1200px;
        }
        .complaint-form, .tips {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .complaint-form {
            flex: 2;
            border-top: 5px solid #2980b9;
        }
        .tips {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .complaint-form h2, .tips h2 {
            color: #1A3365;
            text-align: center;
            margin-bottom: 30px;
            font-size: 30px;
        }
        .tips h2 {
            color: #1A3365;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #2C3E50;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #bdc3c7;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f4f6f7;
            transition: border 0.3s ease;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #2980b9;
            outline: none;
            background-color: #ffffff;
        }
        .form-group textarea {
            resize: vertical;
        }
        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .button-group button {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            flex: 1;
            max-width: 180px;
            transition: background-color 0.3s;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        #submitButton {
            background-color: #3498db;
        }

        #clearButton {
            background-color: #e74c3c;
        }

        #cancelButton {
            background-color: #7f8c8d;
        }

        #submitButton:hover {
            background-color: #2980b9;
        }

        #clearButton:hover {
            background-color: #c0392b;
        }

        #cancelButton:hover {
            background-color: #95a5a6;
        }
        .submit-btn, .cancel-btn {
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 48%;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .submit-btn {
            background-color: #1A3365;
        }
        .submit-btn:hover {
            background-color: #14274e;
        }
        .cancel-btn {
            background-color: #e74c3c;
        }
        .cancel-btn:hover {
            background-color: #c0392b;
        }
        /* Modal (Map Popup) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }
        .modal-content {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            margin: 0; /* Remove default margin */
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 900px;
            max-height: 80vh; /* Limit the height of the modal */
            overflow-y: auto; /* Enable vertical scrolling for overflow content */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .modal-header {
            font-size: 24px;
            color: #2980b9;
            margin-bottom: 15px;
        }
        .close {
            color: #aaa;
            font-size: 30px;
            font-weight: bold;
            float: right;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
        }
        .icon-btn {
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 14px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon-btn:hover {
            background-color: #1f6f91;
        }
        /* Flexbox for Latitude and Longitude with Button */
        .lat-lon-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }
        .lat-lon-group input {
            flex: 1;
        }
        .tips {
            flex: 1;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .tips h2 {
            color: #1A3365;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            font-weight: 700;
        }
        .tips ul {
            list-style-type: disc;
            padding-left: 20px;
            color: #2C3E50;
            font-size: 16px;
            line-height: 1.6;
        }
        .tips ul li {
            margin-bottom: 10px;
        }
        /* Error Messages */
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        .error {
            border-color: #e74c3c !important;
        }
        /* Responsive Styles */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
            .complaint-form, .tips {
                width: 100%;
                padding: 20px;
            }
            .form-group label {
                font-size: 14px;
            }
            .form-group input, .form-group select, .form-group textarea {
                font-size: 14px;
            }
            .button-group button {
                font-size: 14px;
                padding: 10px;
            }
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
            .complaint-form, .tips {
                width: 90%;
                padding: 25px;
            }
            .complaint-form h2, .tips h2 {
                font-size: 26px;
            }
            .form-group label {
                font-size: 14px;
            }
            .form-group input, .form-group select, .form-group textarea {
                font-size: 14px;
            }
            .form-column {
                width: 100%;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .button-group {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }
            .button-group button {
                width: 100%;
            }
        }
        @media (max-width: 480px) {
            .submit-btn, .cancel-btn {
                width: 100%;
                padding: 12px;
                font-size: 16px;
            }
            .complaint-form h2, .tips h2 {
                font-size: 20px;
            }
            .form-group label {
                font-size: 12px;
            }
            .form-group input, .form-group select, .form-group textarea {
                font-size: 12px;
            }
            .button-group button {
                font-size: 12px;
                padding: 8px;
            }
        }
        .clear-btn {
        padding: 16px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 48%;
        color: #ffffff;
        background-color: #f39c12; 
        align-items: center;
        justify-content: center;
    }
    
    .clear-btn:hover {
        background-color: #e67e22; 
    }
        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }
        #snackbar.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }
        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .form-column {
            flex: 1;
            min-width: 300px;
        }
        .form-column .form-group {
            margin-bottom: 20px;
        }
        .full-width {
            flex: 1 1 100%;
        }
        .form-group.full-width {
            margin-top: 10px; /* Reduced gap above */
        }
        .complaint-form-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .form-column {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        .lat-lon-group {
            display: flex;
            justify-content: space-between;
        }
        .lat-lon-group div {
            flex: 1;
            margin-right: 10px;
        }
        .lat-lon-group div:last-child {
            margin-right: 0;
        }
        .icon-btn {
            align-self: flex-start;
        }
    </style>
</head>
<body>
    <div id="snackbar"></div> <!-- Snackbar for alerts -->

    <?php
    $message = ""; // Initialize message variable
    $messageType = ""; // Initialize message type (success or error)

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'db_connection.php'; // Ensure this file contains the database connection logic

        // Retrieve form data
        $complaintName = $_POST['complaintName'];
        $dateFiled = $_POST['dateFiled'];
        $expectedTime = $_POST['expectedTime'];
        $complaintType = $_POST['complaintType'];
        $description = $_POST['description'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $statusComplaint = "Pending";
        $remarks = "";

        if (empty($complaintName) || empty($dateFiled) || empty($complaintType) || empty($description)) {
            $message = "Error: All required fields must be filled.";
            $messageType = "error";
        } elseif (!isset($_FILES['supportingDocuments']) || $_FILES['supportingDocuments']['error'][0] !== UPLOAD_ERR_OK) {
            $message = "Error: File upload failed. Please try again.";
            $messageType = "error";
        } else {
            // Generate a unique ComplaintID
            $complaintID = "CMP" . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Retrieve the uploaded file
            $evidence = file_get_contents($_FILES['supportingDocuments']['tmp_name'][0]);

            // Insert data into the database
            $sql = "INSERT INTO tblcomplaint (ComplaintID, ComplaintName, DateFiled, ComplaintType, Evidence, ExpectedTime, Description, Latitude, Longitude, StatusComplaint, Remarks)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssss", $complaintID, $complaintName, $dateFiled, $complaintType, $evidence, $expectedTime, $description, $latitude, $longitude, $statusComplaint, $remarks);

            if ($stmt->execute()) {
                $message = "Complaint submitted successfully!";
                $messageType = "success";
            } else {
                $message = "Error: There was an issue submitting your complaint.";
                $messageType = "error";
            }

            $stmt->close();
            $conn->close();
        }
    }
    ?>

    <div class="container">
        <div class="tips">
            <h2>Tips for Filing Complaints</h2>
            <ul>
                <li>Provide a clear and concise description of your complaint.</li>
                <li>Include specific details such as dates, times, and locations.</li>
                <li>Attach any supporting documents or evidence to strengthen your case.</li>
                <li>Ensure your contact information is accurate for follow-up communication.</li>
                <li>Be respectful and professional when describing your concerns.</li>
            </ul>
        </div>

        <div class="complaint-form">
            <h2>Resident Complaint Form</h2>
            <div class="complaint-form-wrapper">
                <form action="" method="POST" id="complaintForm" enctype="multipart/form-data">
                    <div class="form-container">
                        <div class="form-column">
                            <div class="form-group">
                                <label for="complaintName">Complaint Name</label>
                                <input type="text" id="complaintName" name="complaintName" required>
                                <div class="error-message" id="complaintNameError">Complaint name is required.</div>
                            </div>
                            <div class="form-group">
                                <label for="dateFiled">Date Filed</label>
                                <input type="date" id="dateFiled" name="dateFiled" required>
                                <div class="error-message" id="dateFiledError">Date filed is required.</div>
                            </div>
                            <div class="form-group">
                                <label for="expectedTime">Expected Resolution Time</label>
                                <input type="date" id="expectedTime" name="expectedTime">
                            </div>
                            <div class="form-group">
                                <label for="complaintType">Complaint Type</label>
                                <input type="text" id="complaintType" name="complaintType" required>
                                <div class="error-message" id="complaintTypeError">Complaint type is required.</div>
                            </div>
                        </div>
                        <div class="form-column">
                            <div class="form-group ">
                                <div>
                                    <label for="latitude">Location of Latitude</label>
                                    <input type="text" id="latitude" name="latitude" readonly>
                                </div>
                                <div>
                                    <label for="longitude">Location of Longitude</label>
                                    <input type="text" id="longitude" name="longitude" readonly>
                                </div>
                            </div>
                            <button type="button" id="openMapBtn" class="icon-btn" style="display: flex; margin-left: 80px; align-items: center; gap: 8px; padding: 10px 15px; border-radius: 8px; background-color: #2980b9; color: white; font-size: 16px; border: none; cursor: pointer; transition: background-color 0.3s ease;">
                                <i class="material-icons" style="font-size: 20px;">map</i>
                                Open Map
                            </button>
                        </div>
                        <div class="form-group full-width">
                        <div class="form-group">
                                <label for="description">Details</label>
                                <textarea id="description" name="description" rows="4" required></textarea>
                                <div class="error-message" id="descriptionError">Details are required.</div>
                            </div>
                            <label for="supportingDocuments">Attach Supporting Documents or Evidence</label>
                            <input type="file" id="supportingDocuments" name="supportingDocuments[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <small class="text-muted">Accepted formats: JPG, PNG, PDF, DOC, DOCX. Max size: 5MB per file.</small>
                        </div>
                    </div>

                    <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                    <label for="agreeTerms">I agree to the <a href="privacy_policy.php" style="color: #007bff; text-decoration: underline;">Data Privacy Policy</a>.</label>

                    <!-- Add spacing -->
                    <div style="margin-top: 20px;"></div>
                    <div class="button-group">
                        <button type="submit" id="submitButton" class="mui-btn mui-btn--raised mui-btn--primary">
                            <span class="material-icons">send</span>
                            Submit
                        </button>
                        <button type="reset" id="clearButton" class="mui-btn mui-btn--raised mui-btn--danger">
                            <span class="material-icons">clear</span>
                            Clear
                        </button>
                        <button type="button" id="cancelButton" onclick="window.location.href='Resident_Panel.php'" class="mui-btn mui-btn--raised mui-btn--accent">
                            <span class="material-icons">cancel</span>
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

    <!-- Modal (Map Popup) -->
    <div id="mapModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="closeModal">&times;</span>
                <h2>Choose a Location</h2>
            </div>
            <div id="map"></div>    
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Geocoder Plugin JS -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    

    <script>
        // Map and Modal Logic
        var modal = document.getElementById("mapModal");
        var btn = document.getElementById("openMapBtn");
        var span = document.getElementById("closeModal");
        var map;

        btn.onclick = function () {
            modal.style.display = "block";

            // Initialize the map if it doesn't exist
            if (!map) {
                map = L.map('map').setView([17.023637009910445, 121.6313123765849], 15); // Default center: Starting point

                // Replace the tile layer with a more detailed one
                L.tileLayer("https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png", {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a>',
                    maxZoom: 19
                }).addTo(map);

                var marker = L.marker([17.023637009910445, 121.6313123765849]).addTo(map);

                // Add Geocoder Control
                L.Control.geocoder({
                    defaultMarkGeocode: false
                }).on('markgeocode', function (e) {
                    var lat = e.geocode.center.lat;
                    var lon = e.geocode.center.lng;

                    // Update Latitude and Longitude fields
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lon;

                    // Update marker position
                    marker.setLatLng([lat, lon]);
                    map.setView([lat, lon], 15);
                }).addTo(map);

                // On map click
                map.on('click', function (e) {
                    var lat = e.latlng.lat;
                    var lon = e.latlng.lng;

                    // Update Latitude and Longitude fields
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lon;

                    // Update marker position
                    marker.setLatLng([lat, lon]);
                });
            }

            // Fix map size
            setTimeout(() => {
                map.invalidateSize();
            }, 200);
        };

        span.onclick = function () {
            modal.style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        // Form Validation
        document.getElementById('complaintForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Reset errors
            document.querySelectorAll('.error-message').forEach(function (el) {
                el.style.display = 'none';
            });
            document.querySelectorAll('.error').forEach(function (el) {
                el.classList.remove('error');
            });

            // Validate fields
            let isValid = true;

            if (!document.getElementById('complaintName').value.trim()) {
                document.getElementById('complaintNameError').style.display = 'block';
                document.getElementById('complaintName').classList.add('error');
                isValid = false;
            }

            if (!document.getElementById('dateFiled').value) {
                document.getElementById('dateFiledError').style.display = 'block';
                document.getElementById('dateFiled').classList.add('error');
                isValid = false;
            }

            if (!document.getElementById('complaintType').value.trim()) {
                document.getElementById('complaintTypeError').style.display = 'block';
                document.getElementById('complaintType').classList.add('error');
                isValid = false;
            }

            if (!document.getElementById('description').value.trim()) {
                document.getElementById('descriptionError').style.display = 'block';
                document.getElementById('description').classList.add('error');
                isValid = false;
            }

            if (!document.getElementById('agreeTerms').checked) {
                alert('Error: You must agree to the Data Privacy Policy.');
                isValid = false;
            }

            if (isValid) {
                showSnackbar("Complaint submitted successfully!", true);
                this.submit();
            } else {
                showSnackbar("Error: Please fill out all required fields.", false);
            }
        });

        function clearForm() {
            document.getElementById('complaintForm').reset(); // Reset the form
            document.querySelectorAll('.error-message').forEach(function (el) {
                el.style.display = 'none'; // Hide error messages
            });
            document.querySelectorAll('.error').forEach(function (el) {
                el.classList.remove('error'); // Remove error styling
            });
        }

        // Snackbar function
        function showSnackbar(message, isSuccess = false) {
            const snackbar = document.getElementById('snackbar');
            snackbar.innerHTML = `
                <span class="material-icons">
                    ${isSuccess ? 'check_circle' : 'error'}
                </span>
                ${message}
            `;
            snackbar.style.backgroundColor = isSuccess ? '#4CAF50' : '#F44336'; // Green for success, red for error
            snackbar.className = 'show';

            // Hide the snackbar after 3 seconds
            setTimeout(() => {
                snackbar.className = snackbar.className.replace('show', '');
            }, 3000);
        }

        // Display PHP message in snackbar
        <?php if (!empty($message)): ?>
            showSnackbar("<?php echo $message; ?>", "<?php echo $messageType; ?>" === "success");
        <?php endif; ?>
    </script>
</body>
</html>