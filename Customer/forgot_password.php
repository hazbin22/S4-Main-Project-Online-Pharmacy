<!DOCTYPE html>
<html>
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
 
  <style>
    .logout-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .logout-button:hover {
        background-color: #0056b3;
    }
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    }

    .container {
        text-align: center;
        margin: 0 auto;
        margin-top: 0px;
        max-width: 400px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        margin-top: 20px;
        text-align: left; /* Align the form elements to the left */
    }

    label {
        display: block;
        margin-bottom: 5px; /* Adjust the space between label and input */
        font-weight: bold; /* Make the label text bold */
    }

    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #4caf50;
        margin-left: 150px;
        text-align:center;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }


</style>

</head>

<body>

    <div class="container">
        <h2>Forgot Password</h2>
        <form action="forgot_password_process.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Send Link</button>
        </form>
    </div>

</body>
</html>