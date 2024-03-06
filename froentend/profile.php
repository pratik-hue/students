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
    </style>
</head>
<body>
    <h1>User Profile</h1>
    <div id="userProfile"></div>
    <button id="updateButton">Update Profile</button>

    <script>
        // Fetch user profile data
        $(document).ready(function() {
            $.ajax({
                url: 'http://127.0.0.1:8000/api/user-profile',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    // Display user details on the page
                    $('#userProfile').html('<p><strong>Name:</strong> ' + response.user.name + '</p>' +
                        '<p><strong>Email:</strong> ' + response.user.email + '</p>' +
                        '<p><strong>Enrollment Number:</strong> ' + response.user.enrollment_number + '</p>' +
                        '<p><strong>Qualification:</strong> ' + response.user.qualification + '</p>' +
                        '<p><strong>Course:</strong> ' + response.user.course + '</p>' +
                        '<p><strong>Contact Number:</strong> ' + response.user.contact_number + '</p>');
                },
                error: function(error) {
                    console.error('Error fetching user profile:', error.responseJSON.message);
                }
            });
        });

        // Add event listener for the update button
        $('#updateButton').click(function() {
            // Redirect to the update profile page or trigger the necessary functionality
            // window.location.href = 'update-profile.php';
            console.log('Update button clicked!');
        });
    </script>
</body>
</html>
