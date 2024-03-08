
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
</head>
<body>
  <h2>Login Form</h2>
  <form action="login.php" method="post">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
  </form>
</body>
</html>

**Create a php file (server-side scripting) to process the inputs when we submit the form. Because we will use php, we will need to set up a Docker file that can create a web server and php-enabled image. **

**Key points:
**
The form action attribute is set to "login.php". This means that when the form is submitted, the browser will send the form data to the "login.php" file for processing.
The form method attribute is set to "post". This indicates that the form data will be sent to the server using the HTTP POST method, which is suitable for handling sensitive data like passwords.
The form contains input fields for the username and password, both marked as required, ensuring that the user must fill them out before submitting the form.
Finally, there's a submit button labeled "Login" that the user can click to submit the form.
Your HTML login form is ready to send data to the "login.php" file for processing when submitted by the user.

**process.php**

<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform basic input validation
    if (empty($username) || empty($password)) {
        echo "Both username and password are required.";
        exit();
    }

    // Check if the username and password match the admin credentials
    if ($username === "admin" && $password === "admin123") {
        echo "Welcome, This is Admin!";
    } else {
        echo "Invalid Username or Password";
    }
} else {
    // If the request method is not POST, redirect back to the login form
    header("Location: index.html");
    exit();
}
?>

**Key points:**

The script checks if the request method is POST using $_SERVER["REQUEST_METHOD"].
It retrieves the username and password from the form data using $_POST.
Basic input validation is performed to ensure that both the username and password fields are not empty.
It checks if the provided username and password match the admin credentials ("admin" and "admin123").
If the credentials match, it echoes "Welcome, This is Admin!".
If the credentials do not match or if the request method is not POST, it redirects the user back to the login form (index.html).

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
docker run -d -p 8089:80 --name myapp my-php-app

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
docker tag my-php-app:new public.ecr.aws/f1w9i4v0/my-php-app:latest

**Run the following command to push this image to your newly created AWS repository:**
docker push public.ecr.aws/f1w9i4v0/my-php-app:latest

**Set Up an Amazon ECS Task Definition**
In the Amazon ECS console, navigate to "Task Definitions" in the left sidebar and click "Create new Task Definition".
Choose the launch type as "Fargate" and configure your task definition settings.
In the container definition section, specify the Docker image URI from the repository you just created in ECR.
Configure other container settings as needed.
Review and create your task definition.


