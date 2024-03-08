
**Version 2: project**

Your main outcome is to have a working docker image deployed on AWS and running on Fargate.

**Project Files**
**1. Create an HTML file named "index.html"** inside the "version2" folder with some additional functionality. Our file has a form that sends a POST request to a php file for processing.

**2. Create a php file (server-side scripting)**: 
To process the inputs when we submit the form. Because we will use php, we will need to set up a Docker file that can create a web server and php-enabled image. 

    **Key points:**
The form action attribute is set to "login.php". This means that when the form is submitted, the browser will send the form data to the "login.php" file for processing.

The form method attribute is set to "post". This indicates that the form data will be sent to the server using the HTTP POST method, which is suitable for handling sensitive data like passwords.

The form contains input fields for the username and password, both marked as required, ensuring that the user must fill them out before submitting the form.

Finally, there's a submit button labeled "Login" that the user can click to submit the form.

Your HTML login form is ready to send data to the "login.php" file for processing when submitted by the user.

    **Key points:**

The script checks if the request method is POST using $_SERVER["REQUEST_METHOD"].

It retrieves the username and password from the form data using $_POST.

Basic input validation is performed to ensure that both the username and password fields are not empty.

It checks if the provided username and password match the admin credentials ("admin" and "admin123").

If the credentials match, it echoes "Welcome, This is Admin!".

If the credentials do not match or if the request method is not POST, it redirects the user back to the login form (index.html).

**3. Build the custom docker image**

a) Create the dockerfile

a) Run the build commands: docker build -t my-php-app .

b) Ensure you can see your new custom image (docker images): docker images

c) Run the Image to confirm it works: docker run -d -p 8096:80 my-php-app


**4. Create an Amazon ECS Cluster**

Log in to the AWS Management Console and navigate to the Amazon ECS service.

Click on "Clusters" in the left sidebar and then click "Create Cluster".

Choose the cluster type (e.g., "Networking only" or "Fargate") and configure the cluster settings.

Follow the prompts to create the cluster.

**5. Upload/Push Your Image to AWS ECR**

a) Log in to the AWS Management Console and navigate to the Amazon ECR service.

b) Click on "Repositories" in the left sidebar and then click "Create repository".

c) Give your repository the same name as your Docker image (e.g., "my-php-app").

d) Follow the prompts to create the repository.

e) Once the repository is created, click on its name to open it.

f) Click on "View push commands" to see how to push your Docker image to ECR.

g) Run the provided commands to authenticate with ECR and push your Docker image.

h) Push to AWS

i) Push commands for my-php-app

j) Retrieve an authentication token and authenticate your Docker client to your registry.

**Use the AWS CLI:**

aws ecr-public get-login-password --region us-east-1 | docker login --username AWS --password-stdin public.ecr.aws/f1w9i4v0

**Tag your image so you can push the image to this repository:**

docker tag my-php-app:new public.ecr.aws/f1w9i4v0/my-php-app:latest

**Run the following command to push this image to your newly created AWS repository:**

docker push public.ecr.aws/f1w9i4v0/my-php-app:latest

**Set Up an Amazon ECS Task Definition**

a) In the Amazon ECS console, navigate to "Task Definitions" in the left sidebar and click "Create new Task Definition".

b) Choose the launch type as "Fargate" and configure your task definition settings.

c) In the container definition section, specify the Docker image URI from the repository you just created in ECR.

d) Configure other container settings as needed.

e) Review and create your task definition.


