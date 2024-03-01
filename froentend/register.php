<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>User Registration</h1>
    <form id="registrationForm" method="post" action="http://127.0.0.1:8000/api/register">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="enrollmentNumber">Enrollment Number:</label>
        <input type="text" id="enrollmentNumber" name="enrollment_number" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="qualification">Qualification:</label>
        <input type="text" id="qualification" name="qualification" required><br><br>

        <label for="course">Course Pursuing:</label>
        <input type="text" id="course" name="course" required><br><br>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" id="contactNumber" name="contact_number" required><br><br>

        <button type="submit">Register</button>
    </form>

    <script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Create FormData object
    const formData = new FormData();
    formData.append('email', document.getElementById('email').value);
    formData.append('enrollment_number', document.getElementById('enrollmentNumber').value);
    formData.append('password', document.getElementById('password').value);
    formData.append('qualification', document.getElementById('qualification').value);
    formData.append('course', document.getElementById('course').value);
    formData.append('contact_number', document.getElementById('contactNumber').value);

    // Send POST request to registration endpoint
    fetch('http://127.0.0.1:8000/api/register', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            alert('Registration successful');
            // Redirect to login page or any other page
        } else {
            throw new Error('Registration failed');
        }
    })
    .catch(error => {
        alert('Registration failed');
        console.error(error);
    });
});

    </script>
</body>
</html>
