<?php
// Include the database connection
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Get the role (User or Vendor)

    // SQL query to insert the collected data into the signup table
    $sql = "INSERT INTO signup (name, username, email, password, role) VALUES ('$name', '$username', '$email', '$password', '$role')";

    // Execute the query and check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        // Redirect based on role
        if ($role == 'User') {
            header('Location: order_page_dash.php');
        } else {
            header('Location: index_dash.php');
        }
        exit; // Add exit to prevent further output
    } else {
        // Handle error
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up Form</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css'>
  <link rel="stylesheet" href="login_style.css">
  <script>
    // JavaScript for password validation
    function validatePassword() {
      const passwordField = document.querySelector('.password');
      const password = passwordField.value;
      const message = document.getElementById('passwordMessage');

      let errors = [];

      if (password.length < 8) errors.push("Password must be at least 8 characters long.");
      if (!/[A-Z]/.test(password)) errors.push("Password must include at least one uppercase letter.");
      if (!/[a-z]/.test(password)) errors.push("Password must include at least one lowercase letter.");
      if (!/\d/.test(password)) errors.push("Password must include at least one number.");
      if (!/[!@#$%^&*(),.?\":{}|<>]/.test(password)) errors.push("Password must include at least one special character.");

      if (errors.length > 0) {
        message.innerHTML = errors.join('<br>');
        message.style.color = "red";
        return false;
      } else {
        message.textContent = "";
        return true;
      }
    }

    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById("signupForm");
      form.addEventListener("submit", function(event) {
        if (!validatePassword()) {
          event.preventDefault();
        }
      });

      const togglePassword = document.getElementById('togglePassword');
      const passwordField = document.querySelector('.password');

      togglePassword.addEventListener('click', () => {
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        togglePassword.classList.toggle('bx-hide');
        togglePassword.classList.toggle('bx-show');
      });
    });
  </script>
</head>

<body style="background-color: white">
<img style="position: absolute; top: 0px; left: 0px;" src="images/dots.png" alt="Image" class="bottom-right-image">

<div class="container" style="background-color: #00c6a9">
  <header style="color: white">Sign Up Form</header>
  <form id="signupForm" action="signup.php" method="post">
    <div class="field name-field">
      <div class="input-field">
        <input style="background-color: white" type="text" placeholder="Enter your Name" class="name" name="name" required />
      </div>
    </div>

    <div class="field username-field">
      <div class="input-field">
        <input style="background-color: white" type="text" placeholder="Enter your Username" class="username" name="username" required />
      </div>
    </div>

    <div class="field email-field">
      <div class="input-field">
        <input style="background-color: white" type="email" placeholder="Enter your Email" class="email" name="email" required />
      </div>
    </div>

    <div class="field create-password">
      <div class="input-field">
        <input style="background-color: white" type="password" placeholder="Password" class="password" name="password" required />
        <i style="color: #00c6a9" class="bx bx-hide show-hide" id="togglePassword"></i>
      </div>
    </div>

    <!-- New Role Selection Field -->
    <div class="field role-field">
      <div class="input-field">
        <label for="role" style="color: white; margin-right: 10px;">Select Role:</label>
        <select id="role" name="role" style="background-color: white; padding: 8px; border-radius: 9px;  font-family: 'Courier New', Courier, monospace;">
          <option value="User">User</option>
          <option value="Vendor">Vendor</option>
        </select>
      </div>
    </div>

    <div class="input-field button">
      <input style="background-color: white; color: #00c6a9;" type="submit" value="Signup Now" />
    </div>
  </form>
  <p id="passwordMessage" class="password-message"></p>
</div>

<img style="position: absolute; bottom: 0px; right: 0px;" src="images/contact-img.jpg" alt="Image" class="bottom-right-image">
</body>

</html>
