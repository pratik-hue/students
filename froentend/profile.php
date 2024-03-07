<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        #userProfile {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            transition: transform 0.3s ease;
        }

        #userProfile:hover {
            transform: scale(1.05);
        }

        p {
            margin-bottom: 10px;
            color: #333;
        }

        button {
            background-color: #2196F3;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1565C0;
        }

        .editable-input {
            display: none;
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
        }

        .edit-mode .editable-input {
            display: block;
        }

        .edit-mode .editable-text {
            display: none;
        }
    </style>
</head>
<body>
    <h1>User Profile</h1>
    <div id="userProfile">
        <p><strong>Name:</strong> <span class="editable-text" id="name"></span><input type="text" class="editable-input" id="nameInput" value="John Doe"></p>
        <p><strong>Email:</strong> <span class="editable-text" id="email"></span><input type="email" class="editable-input" id="emailInput" value="user@example.com"></p>
        <p><strong>Enrollment Number:</strong> <span class="editable-text" id="enrollmentNumber"></span><input type="text" class="editable-input" id="enrollmentNumberInput" value="123456789"></p>
        <p><strong>Qualification:</strong> <span class="editable-text" id="qualification"></span><input type="text" class="editable-input" id="qualificationInput" value="Bachelor's Degree"></p>
        <p><strong>Course:</strong> <span class="editable-text" id="course"></span><input type="text" class="editable-input" id="courseInput" value="Computer Science"></p>
        <p><strong>Contact Number:</strong> <span class="editable-text" id="contactNumber"></span><input type="text" class="editable-input" id="contactNumberInput" value="+1234567890"></p>
    </div>
    <button id="updateButton">Update Profile</button>

    <!-- Updated script block -->
<script>
    $(document).ready(function() {
        // Function to fetch user profile data
        function fetchUserProfile() {
            $.ajax({
                url: 'http://127.0.0.1:8000/api/user-profile',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    // Display user details on the page
                    $('#name').text(response.user.name);
                    $('#email').text(response.user.email);
                    $('#enrollmentNumber').text(response.user.enrollment_number);
                    $('#qualification').text(response.user.qualification);
                    $('#course').text(response.user.course);
                    $('#contactNumber').text(response.user.contact_number);

                    // Populate input boxes with user data
                    $('#nameInput').val(response.user.name);
                    $('#emailInput').val(response.user.email);
                    $('#enrollmentNumberInput').val(response.user.enrollment_number);
                    $('#qualificationInput').val(response.user.qualification);
                    $('#courseInput').val(response.user.course);
                    $('#contactNumberInput').val(response.user.contact_number);
                },
                error: function(error) {
                    console.error('Error fetching user profile:', error.responseJSON.message);
                }
            });
        }

        // Fetch user profile data on page load
        fetchUserProfile();

        // Add event listener for the update button
        $('#updateButton').click(function() {
            if ($('#userProfile').hasClass('edit-mode')) {
                // Save changes
                const updatedUser = {
                    name: $('#nameInput').val(),
                    email: $('#emailInput').val(),
                    enrollment_number: $('#enrollmentNumberInput').val(),
                    qualification: $('#qualificationInput').val(),
                    course: $('#courseInput').val(),
                    contact_number: $('#contactNumberInput').val()
                };

                // Send the updated data to the server
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/update-profile',
                    type: 'POST', // Change this to the appropriate HTTP method
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    data: updatedUser,
                    success: function(response) {
                        // Update the displayed details with the saved changes
                        fetchUserProfile();

                        // Toggle back to display mode
                        $('#userProfile').removeClass('edit-mode');
                        $('#updateButton').text('Update Profile');
                    },
                    error: function(error) {
                        console.error('Error updating user profile:', error.responseJSON.message);
                        // You may want to add error handling here
                    }
                });
            } else {
                // Toggle edit mode
                $('#userProfile').addClass('edit-mode');
                $('#updateButton').text('Save Changes');
            }
        });
    });
</script>

</body>
</html>
