<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            background-color: #e6e6cc; /* Cream color */
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        form {
            background-color: #001a33; /* Neavy color */
            color: #fff; /* Text color */
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
            animation: backgroundAnimation 5s infinite alternate;
        }

        form::before {
            top: -150px;
            left: -150px;
        }

        form::after {
            bottom: -150px;
            right: -150px;
        }

        @keyframes backgroundAnimation {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.1);
            }
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
            background-color: transparent; /* Make background transparent */
            color: #fff; /* Text color */
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
    <h1>User Login</h1>
    <form id="loginForm">
        <label for="enrollmentNumber">Enrollment Number:</label>
        <input type="text" id="enrollmentNumber" name="enrollment_number" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('enrollment_number', document.getElementById('enrollmentNumber').value);
            formData.append('password', document.getElementById('password').value);

            fetch('http://127.0.0.1:8000/api/login', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Login failed');
                }
            })
            .then(data => {
                alert('Login successful');
                // Store the token in localStorage
                localStorage.setItem('token', data.token);
                // Redirect to home page
                window.location.href = 'profile.php';
            })
            .catch(error => {
                alert('Login failed');
                console.error(error);
            });
        });
    </script>
</body>
</html>
