Vagrant.configure("2") do |config|
  config.vm.box = "bento/ubuntu-20.04"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder ".", "/var/www/html/website", owner: "root", group: "www-data"

  config.vm.provision "step1-apache-mysql", type: "shell", inline: <<-SHELL
    apt-get update
    apt-get install -y apache2
    apt-get install -y mysql-server
  SHELL

  config.vm.provision "step2-php", type: "shell", inline: <<-SHELL
    apt-get update
    apt-get install -y lsb-release ca-certificates apt-transport-https software-properties-common 
    add-apt-repository ppa:ondrej/php
    apt-get update
    apt-get install -y php8.2
    apt-get install -y php8.2-cli php8.2-common php8.2-fpm php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath
    sudo systemctl restart apache2
  SHELL

  config.vm.provision "step3-chown", type: "shell", inline: "sudo chown -R vagrant:root /etc/apache2/sites-available/"

  config.vm.provision "step4-vhost-file", type: "file", source: "vagrant/apache.conf", destination: "/etc/apache2/sites-available/website.conf"
  
  config.vm.provision "step5-vhost-enable", type: "shell", inline: <<-SHELL
    sudo a2ensite website
    sudo a2dissite 000-default
    sudo systemctl reload apache2
  SHELL

  config.vm.provision "step6-phpmyadmin", type: "shell", inline: <<-SHELL
    sudo apt-get install unzip
    sudo mkdir /usr/share/phpmyadmin
    cd /usr/share/phpmyadmin
    sudo wget https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-english.zip
    sudo unzip -q phpMyAdmin-5.2.1-english.zip
    sudo rm phpMyAdmin-5.2.1-english.zip
    sudo mv phpMyAdmin-5.2.1-english/* /usr/share/phpmyadmin/
    sudo rm -rf phpMyAdmin-5.2.1-english
    sudo mysql -uroot -e "CREATE USER 'adminbsolutions'@'localhost' IDENTIFIED BY '';"
    sudo mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO 'adminbsolutions'@'localhost' WITH GRANT OPTION;"
    sudo chown -R vagrant:root /usr/share/phpmyadmin
  SHELL

  config.vm.provision "step7-phpmyadmin-config", type: "file", source: "vagrant/config.inc.php", destination: "/usr/share/phpmyadmin/"

  config.vm.provision "step8-path", type: "shell", inline: <<-SHELL
    echo 'export PATH=$PATH:/var/www/html/website/vendor/bin' >> ~/.bashrc
    echo 'cd /var/www/html/website' >> ~/.bashrc
  SHELL
end
