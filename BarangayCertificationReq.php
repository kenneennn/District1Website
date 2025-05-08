<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification Request</title>
    <link rel="icon" type="image/x-icon" href="LogoImage\IBIMLOGO.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }
        h2 {
            color: #1A3365;
            text-align: center;
            margin-bottom: 30px;
            font-size: 30px;
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
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #bdc3c7;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f4f6f7;
            transition: border 0.3s ease;
        }
        .form-group input:focus, .form-group textarea:focus {
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
            margin-top: 50px;
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
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        .error {
            border-color: #e74c3c !important;
        }
        .faqs {
            flex: 1;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .faqs h2 {
            color: #1A3365;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8em;
            font-weight: 700;
        }
        .faq h5 {
            font-size: 18px;
            color: #2980b9;
            margin-bottom: 10px;
        }
        .faq p {
            font-size: 16px;
            color: #2C3E50;
            line-height: 1.6;
        }
        .certification-form {
            flex: none; 
            width: 100%; 
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #ffffff;
            padding: 30px;  
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            min-height: 80vh; 
            display: flex;
            flex-direction: column;
        }

        #snackbar {
            visibility: hidden;
            max-width: 500px;
            width: auto;
            margin-left: auto;
            margin-right: auto;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            transform: translateX(-50%);
            bottom: 30px;
            font-size: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 30px;
            }
            .certification-form {
                padding: 20px;
                min-height: auto;
            }
            .faqs {
                width: 100%;
            }
            .button-group {
                flex-direction: column;
                gap: 10px;
            }
            .button-group button {
                max-width: 100%;
            }
            #snackbar {
                min-width: 200px;
                font-size: 15px;
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 24px;
            }
            .form-group input, .form-group textarea {
                font-size: 14px;
                padding: 10px;
            }
            .button-group button {
                font-size: 14px;
                padding: 10px;
            }
            .faqs h2 {
                font-size: 20px;
            }
            .faq h5 {
                font-size: 16px;
            }
            .faq p {
                font-size: 14px;
            }
            .certification-form {
                padding: 15px;
                box-shadow: none;
            }
            .certification-form h2 {
                font-size: 20px;
            }
            #snackbar {
                min-width: 150px;
                font-size: 13px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div id="snackbar"></div> <!-- Snackbar for alerts -->

    <?php
    $message = ""; // Initialize message variable
    $messageType = ""; // Initialize message type (success or error)

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'db_connection.php';

        // Retrieve form data
        $requestDate = $_POST['requestDate'];
        $certificationType = $_POST['certificationType'];
        $purposeOfCertification = $_POST['purposeOfCertification'];
        $requestedBy = $_POST['requestedBy'];
        $emailInformation = $_POST['emailInformation'];

        if (empty($requestDate) || empty($certificationType) || empty($purposeOfCertification) || empty($requestedBy) || empty($emailInformation) || empty($_FILES['validID']['tmp_name'])) {
            $message = "Error: All fields are required.";
            $messageType = "error";
        } elseif (empty($_POST['agreeTerms'])) {
            $message = "Error: You must agree to the Data Privacy Policy.";
            $messageType = "error";
        } elseif (!isset($_FILES['validID']) || $_FILES['validID']['error'] !== UPLOAD_ERR_OK) {
            $message = "Error: File upload failed. Please try again.";
            $messageType = "error";
        } elseif ($_FILES['validID']['size'] > 2 * 1024 * 1024) { // Check file size (2MB limit)
            $message = "Error: File size exceeds the 2MB limit.";
            $messageType = "error";
        } else {
            // Generate a unique RequestID
            $requestID = "REQ" . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Retrieve the uploaded file
            $validID = file_get_contents($_FILES['validID']['tmp_name']);

            // Update the SQL query to include the ValidID column
            $sql = "INSERT INTO tblrequestcert (RequestID, RequestDate, CertificationType, PurposeofCertification, RequestedBy, EmailInformation, ValidID, ApprovalStatus, ApprovalDate)
                    VALUES ('$requestID', '$requestDate', '$certificationType', '$purposeOfCertification', '$requestedBy', '$emailInformation', ?, 'Pending', NULL)";

            // Prepare and bind the parameter for the LONGBLOB
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $validID);

            // Execute the query
            if ($stmt->execute()) {
                $message = "Certification request submitted successfully!";
                $messageType = "success";
            } else {
                $message = "Error: There was an issue submitting your request.";
                $messageType = "error";
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        }
    }
    ?>

    <script>
        // Snackbar function
        function showSnackbar(message, isSuccess = false) {
            const snackbar = document.getElementById('snackbar');
            snackbar.innerHTML = `
                <span class="material-icons">
                    ${isSuccess ? 'check_circle' : 'error'}
                </span>
                ${message}
            `;
            snackbar.style.backgroundColor = isSuccess ? '#4CAF50' : '#F44336'; 
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

    <div class="container">
        <div class="faqs">
            <h2>Frequently Asked Questions</h2>
            <div class="faq">
                <h5>How long does it take to process a certification request?</h5>
                <p>Certification requests are typically processed within 3-5 business days, depending on the type of certification and completeness of the submitted requirements.</p>
            </div>
            <div class="faq">
                <h5>What documents are required for a certification request?</h5>
                <p>You need to provide a valid ID, a filled-out request form, and any additional documents specific to the type of certification you are requesting.</p>
            </div>
            <div class="faq">
                <h5>Can I request a certification online?</h5>
                <p>Yes, you can submit your certification request online through this portal. Make sure to upload all required documents and provide accurate information.</p>
            </div>
            <div class="faq">
                <h5>How will I know if my certification is ready?</h5>
                <p>You will receive an email notification once your certification is ready for pickup or delivery.</p>
            </div>
        </div>
        <div class="certification-form">
            <h2>Certification Request Form</h2>
            <form action="" method="POST" id="certificationRequestForm" enctype="multipart/form-data">
                <div class="form-group" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; max-width: 100%; width: 100%;">
                    <label for="certificationType">Certification Type</label>
                    <select id="certificationType" name="certificationType" class="form-control" style="width: 100%; max-width: 100%;">
                        <option value="">&#9660; Select Certification Type</option>
                        <option value="Certificate of Residency">Certificate of Residency</option>
                        <option value="Barangay Clearance">Barangay Clearance</option>
                        <option value="Certificate of Indigency">Certificate of Indigency</option>
                    </select>
                    <span id="certificationTypeError" class="error-message">Certification type is required.</span>
                </div>
                <div class="form-group">
                    <input type="date" id="requestDate" name="requestDate" placeholder="Request Date">
                    <span id="requestDateError" class="error-message">Request date is required.</span>
                </div>
                <div class="form-group">
                    <textarea id="purposeOfCertification" name="purposeOfCertification" placeholder="Purpose of Certification"></textarea>
                    <span id="purposeOfCertificationError" class="error-message">Purpose is required.</span>
                </div>
                <div class="form-group">
                    <input type="text" id="requestedBy" name="requestedBy" placeholder="Requested By">
                    <span id="requestedByError" class="error-message">Requester name is required.</span>
                </div>
                <div class="form-group">
                    <input type="email" id="emailInformation" name="emailInformation" placeholder="Email">
                    <span id="emailInformationError" class="error-message">Email is required.</span>
                </div>
                <div class="form-group">
                    <label for="validID">Upload Valid ID</label> <!-- Added label -->
                    <input type="file" class="form-control" id="validID" name="validID" accept="image/*" required>
                    <small class="text-muted">Accepted formats: JPG, PNG. Max size: 2MB.</small>
                    <span id="validIDError" class="error-message">Valid ID is required.</span>
                </div>

                <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                <label for="agreeTerms">I agree to the <a href="privacy_policy.php" id="privacyPolicyLink" style="color: #007bff; text-decoration: underline;">Data Privacy Policy</a>.</label>
                
                <!-- Add spacing -->
                <div style="margin-top: 20px;"></div>

                <div class="button-group">
                    <button type="submit" id="submitButton">
                        <span class="material-icons">send</span>
                        Submit
                    </button>
                    <button type="button" id="clearButton">
                        <span class="material-icons">clear</span>
                        Clear
                    </button>
                    <button type="button" id="cancelButton" onclick="window.location.href='Resident_Panel.php'">
                        <span class="material-icons">cancel</span>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#certificationRequestForm').on('submit', function (event) {
                event.preventDefault();

                // Reset error messages
                $('.error-message').hide();
                $('input, textarea').removeClass('error');

                // Validate form fields
                let isValid = true;

                if ($('#certificationType').val().trim() === '') {
                    $('#certificationTypeError').show();
                    $('#certificationType').addClass('error');
                    isValid = false;
                }
                if ($('#requestDate').val().trim() === '') {
                    $('#requestDateError').show();
                    $('#requestDate').addClass('error');
                    isValid = false;
                }
                if ($('#purposeOfCertification').val().trim() === '') {
                    $('#purposeOfCertificationError').show();
                    $('#purposeOfCertification').addClass('error');
                    isValid = false;
                }
                if ($('#requestedBy').val().trim() === '') {
                    $('#requestedByError').show();
                    $('#requestedBy').addClass('error');
                    isValid = false;
                }
                if ($('#emailInformation').val().trim() === '') {
                    $('#emailInformationError').show();
                    $('#emailInformation').addClass('error');
                    isValid = false;
                }
                if ($('#validID').get(0).files.length === 0) {
                    $('#validIDError').show();
                    $('#validID').addClass('error');
                    isValid = false;
                }
                if (!$('#agreeTerms').is(':checked')) {
                    alert('Error: You must agree to the Data Privacy Policy.');
                    isValid = false;
                }

                if (isValid) {
                    showSnackbar("Form submitted successfully!", true);
                    this.submit(); // Allow form submission
                } else {
                    showSnackbar("Error: Please fill out all required fields.", false);
                }
            });
        });
    </script>

</body>
</html>