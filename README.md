VERSION1

**Try a sample container**
docker pull sampson101/web-app:1.2
docker run –d –p 900:80 sampson101/web-app:1.2


**Project Files**

**Create a simple HTML file named "index.html" inside the "version1" folder. The HTML file will be a basic login form you would like to display. * static webpage**

<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
  </head>
  <body>
    <h1>Azubi Docker Form</h1>
    <form>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username"><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br><br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>



**Create a Dockerfile in the "version1" folder. Dockerfiles are what tell docker how it should build your image (environments). thorough research is needed**

# Use an official Nginx image as the base image
FROM nginx:alpine

# Copy the HTML file from the current directory into the container at /usr/share/nginx/html
COPY index.html /usr/share/nginx/html

# Expose port 80 to allow external access to the web server running inside the container
EXPOSE 80

**Build first custom docker image**

**Run the following command to build the Docker image:**
docker build -t my-static-webpage .
my-static-webpage    latest    0696a4fbafcb   2 minutes ago   42.6MB

**Run a container using the built image.**
docker run -d -p 8084:80 my-static-webpage

**Push the image to a docker Hub repo**
Log in to Docker Hub using the docker login command: docker login

**Tag your local Docker image with your Docker Hub username and the repository name.**
docker tag my-static-webpage raskip/docker-web-page:new

**Push the tagged image to Docker Hub.**
docker push raskip/docker-web-page:new

**Add GitHub Repository as Remote**
git remote add origin https://github.com/Alexraskip/docker-web-app.git

**Add all the files in the directory to the staging area, commit them, and push them to your GitHub repository**
git add .
git commit -m "Initial commit: Add docker-web-app files"
git push -u origin main




