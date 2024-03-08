**Version 1: project**

Your main outcome is to have a shareable working docker image hosted on the docker Hub

Try a sample container docker pull sampson101/web-app:1.2 docker run –d –p 900:80 sampson101/web-app:1.2

**Project Files**

1. Create a simple HTML file named "index.html" inside the "version1" folder. The HTML file will be a basic login form you would like to display. Use the source code of the running container sampson101/web-app:1.2

2. **Create a Dockerfile in the "version1" folder**. Dockerfiles are what tell docker how it should build your image (environments). 

      Use an official Nginx image as the base image
      FROM nginx:alpine

      Copy the HTML file from the current directory into the container at /usr/share/nginx/html
      COPY index.html /usr/share/nginx/html

      Expose port 80 to allow external access to the web server running inside the container
      EXPOSE 80

3. **Build first custom docker image**
   
i) Run the following command to build the Docker image: docker build -t kali-static-webpage:new . 

ii) Run a container using the built image: docker run -d -p 8097:80 --name kaliapp kali-static-webpage:new

4.  **Push the image to a docker hub repo**

a) Log in to Docker Hub using the docker login command: docker login

b) Tag your local Docker image with your Docker Hub username and the repository name: docker tag kali-static-webpage:new raskip/kali-static-webpage:new

c) Push the tagged image to Docker Hub: docker push raskip/kali-static-webpage:new

5.  **Push the image to the Github repo**

a) Add GitHub Repository as Remote git remote add origin https://github.com/Alexraskip/docker-web-app.git

b) Add all the files in the directory to the staging area, commit them, and push them to your GitHub repository git add . git commit -m "Initial commit: Add docker-web-app files" git push -u origin master
