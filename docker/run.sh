docker build -t upload-labs .
docker run -d -p 80:80 upload-labs:latest
