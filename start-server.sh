docker pull nimmis/apache-php7
docker run -d -p 8080:80 -v $PWD:/var/www/html nimmis/apache-php7