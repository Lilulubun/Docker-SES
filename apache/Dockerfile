# Use base image Ubuntu
FROM ubuntu:latest

# Install Apache, PHP, and mysqli
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-mysqli && \
    apt-get clean

# Set the Render PORT environment variable to Apache
ENV PORT=80

# Update Apache to listen on Render's PORT
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copy the contents of webfolder into the web root
COPY ./webfolder/* /var/www/html/

# Ensure correct permissions for web files
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html
# Expose the specified port
EXPOSE ${PORT}

# Command to start Apache in the foreground
CMD ["apachectl", "-D", "FOREGROUND"]
