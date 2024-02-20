
**Version 2: project**
Your main outcome is to have a working docker image deployed on AWS and running on Fargate.

**Project Files**
Create a second HTML file named "index.html" inside the "version2" folder with some additional functionality. Our file has a form that sends a POST request to a php file for processing.

**index.html**

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      width: 300px;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 16px;
      color: #555;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #007bff;
    }

    .forgot-password {
      text-align: center;
      margin-bottom: 20px;
    }

    .forgot-password a {
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <form id="loginForm" onsubmit="return validateForm()">
    <h1>Azubi Docker Form</h1>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <div id="usernameError" class="error-message"></div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <div id="passwordError" class="error-message"></div>
    <div class="forgot-password">
      <a href="#" id="forgotPasswordLink">Forgot Password?</a>
    </div>
    <input type="submit" value="Submit">
  </form>

  <script>
    function validateForm() {
      var username = document.getElementById('username').value.trim();
      var password = document.getElementById('password').value.trim();
      var usernameError = document.getElementById('usernameError');
      var passwordError = document.getElementById('passwordError');
      var isValid = true;

      // Validate username
      if (username === '') {
        usernameError.textContent = 'Username is required';
        isValid = false;
      } else {
        usernameError.textContent = '';
      }

      // Validate password
      if (password === '') {
        passwordError.textContent = 'Password is required';
        isValid = false;
      } else if (password.length < 8) {
        passwordError.textContent = 'Password must be 8 characters or more';
        isValid = false;
      } else {
        passwordError.textContent = '';
      }

      return isValid;
    }

    // Implement forgot password functionality
    var forgotPasswordLink = document.getElementById('forgotPasswordLink');
    forgotPasswordLink.addEventListener('click', function(event) {
      event.preventDefault();
      alert('Forgot Password functionality is not implemented yet.');
    });
  </script>
</body>
</html>



**Create a php file (server-side scripting) to process the inputs when we submit the form. Because we will use php, we will need to set up a Docker file that can create a web server and php-enabled image. **

**process.php**

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Process the inputs (you can add your processing logic here)

    // For demonstration purposes, let's just echo the inputs
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password;
}
?>

**Build a second custom docker image**
Using an online terminal or local. Ensure you are able to access your project files
Run the build commands
Ensure you can see your new custom image (docker images)
Run the Image to confirm it works

**Create the Dockerfile:**
Create a file named Dockerfile in the same directory as your HTML and PHP files. This Dockerfile will define the steps to create a Docker image with a web server and PHP enabled.
FROM php:7.4-apache
COPY . /var/www/html
This Dockerfile uses the official PHP Apache image (php:7.4-apache) as the base image and copies all files from the current directory to the /var/www/html directory in the container.

**Build the Docker Image:**
Navigate to the directory containing your Dockerfile and other files (index.html, process.php).

**Run the following command to build the Docker image:**
docker build -t my-php-app . (Replace my-php-app with your desired image name.)

**Run the Docker Container:**
After building the image, you can run a Docker container based on this image:
docker run -d -p 8085:80 my-php-app

**Create an Amazon ECS Cluster:**
Log in to the AWS Management Console and navigate to the Amazon ECS service.
Click on "Clusters" in the left sidebar and then click "Create Cluster".
Choose the cluster type (e.g., "Networking only" or "Fargate") and configure the cluster settings.
Follow the prompts to create the cluster.

**Upload/Push Your Image to AWS ECR:**
Log in to the AWS Management Console and navigate to the Amazon ECR service.
Click on "Repositories" in the left sidebar and then click "Create repository".
Give your repository the same name as your Docker image (e.g., "docker-web-app").
Follow the prompts to create the repository.
Once the repository is created, click on its name to open it.
Click on "View push commands" to see how to push your Docker image to ECR.
Run the provided commands to authenticate with ECR and push your Docker image.
Push to AWS
Push commands for my-php-app
Retrieve an authentication token and authenticate your Docker client to your registry.

**Use the AWS CLI:**
aws ecr-public get-login-password --region us-east-1 | docker login --username AWS --password-stdin public.ecr.aws/f1w9i4v0

**Build your Docker image using the following command. For information on building a Docker file from scratch see the instructions here . You can skip this step if your image is already built:**
docker build -t my-php-app .

**After the build completes, tag your image so you can push the image to this repository:**
docker tag my-php-app:new public.ecr.aws/f1w9i4v0/my-php-app:new

**Run the following command to push this image to your newly created AWS repository:**
docker push public.ecr.aws/f1w9i4v0/my-php-app:latest

**Set Up an Amazon ECS Task Definition**
In the Amazon ECS console, navigate to "Task Definitions" in the left sidebar and click "Create new Task Definition".
Choose the launch type as "Fargate" and configure your task definition settings.
In the container definition section, specify the Docker image URI from the repository you just created in ECR.
Configure other container settings as needed.
Review and create your task definition.

