# Gunakan base image Ubuntu
FROM ubuntu:latest
# Install Apache, PHP, dan mysqli
RUN apt-get update && \
apt-get install -y apache2 php libapache2-mod-php php-mysqli && \
apt-get clean \
chmod -R 755 ./webfolder

# Copy file website ke dalam container
COPY ./webfolder /var/www/html
# Expose port 80 agar server web bisa diakses
EXPOSE 80
# Command untuk menjalankan Apache
CMD ["apachectl", "-D", "FOREGROUND"]
