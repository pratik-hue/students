<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        form {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.5s ease;
        }

        form::before,
        form::after {
            content: '';
            position: absolute;
            background: linear-gradient(45deg, #ff4500, #ffd700);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            opacity: 0.1;
        }

        form::before {
            top: -150px;
            left: -150px;
        }

        form::after {
            bottom: -150px;
            right: -150px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: none;
            border-bottom: 2px solid #ddd;
            transition: border-bottom-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-bottom-color: #ff0000;
        }

        button {
            background-color: #ffd700;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ffcc00;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <h1>User Registration</h1>
    <form id="registrationForm" method="post" action="http://127.0.0.1:8000/api/register">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="enrollmentNumber">Enrollment Number:</label>
        <input type="text" id="enrollmentNumber" name="enrollment_number" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="qualification">Qualification:</label>
        <input type="text" id="qualification" name="qualification" required>

        <label for="course">Course Pursuing:</label>
        <input type="text" id="course" name="course" required>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" id="contactNumber" name="contact_number" required>

        <button type="submit">Register</button>
    </form>
</body>
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
    formData.append('name', document.getElementById('name').value);

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

</html>
