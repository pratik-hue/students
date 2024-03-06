<!-- profile.php (or your profile view file) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>User Profile</h1>
    <div id="userProfile"></div>

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
                    $('#userProfile').html('<p>Name: ' + response.user.name + '</p>' +
                       '<p>Email: ' + response.user.email + '</p>' +
                       // Add more fields as needed
                       '');
                },
                error: function(error) {
                    console.error('Error fetching user profile:', error.responseJSON.message);
                }
            });
        });
    </script>
</body>
</html>
