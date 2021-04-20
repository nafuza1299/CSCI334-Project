echo "Enable UFW"
useradd -m -s /bin/bash test
echo "test:w3ewsdgw" | chpasswd
usermod -aG sudo test
ufw allow OpenSSH
echo "Y" | ufw enable

echo "Install LEMP"
echo "nginx"
apt update -y
apt install nginx -y
ufw allow 'Nginx HTTP'

echo "mysql"
apt install mysql-server -y

echo "php"
add-apt-repository universe -y
apt install php-fpm php-mysql -y

echo "composer"
apt install curl php-cli php-mbstring git unzip -y
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php --install-dir=/usr/local/bin --filename=composer

echo "step 1"
apt install php-mbstring php-xml php-bcmath -y

echo "step 2"
set -e
echo -e "\n Create a LARAVEL sql user"
mysql -e "source /root/CSCI334-Project/laravel.sql";

echo "Create Laravel"
# sudo -u test -H sh -c "cd /home/test/; composer create-project --prefer-dist laravel/laravel website"
mv /root/CSCI334-Project/website /home/test

echo "Edit Laravel .env"
cd /home/test/website;
ip_addr=$(hostname -I); 
sed -i -e "s|{{ IP_ADDR }}|http://$ip_addr|g" .env

echo "setup laravel in nginx"
mv /home/test/website /var/www/website
sudo chown -R $USER:www-data /var/www/website/storage
sudo chown -R $USER:www-data /var/www/website/bootstrap/cache
sudo chmod -R 775 /var/www/website/storage
sudo chmod -R 775 /var/www/website/bootstrap/cache
ip_addr=$(hostname -I); 
sed -i -e "s|{{ IP_ADDR }}|$ip_addr|g" /root/CSCI334-Project/website_test
sudo cp /root/CSCI334-Project/website_nginx /etc/nginx/sites-available
sudo ln -s /etc/nginx/sites-available/website_nginx /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
