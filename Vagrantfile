# -*- mode: ruby -*-
# vi: set ft=ruby :
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.box_url = "https://atlas.hashicorp.com/bento/boxes/ubuntu-16.04"

  config.vm.network :forwarded_port, guest: 80, host: 2240
  config.vm.network :private_network, ip: "192.168.22.40"

  config.vm.provider :virtualbox do |vb|
    vb.name = "osintics"
    vb.customize ["modifyvm", :id, "--memory", "2048"]
    vb.customize ["modifyvm", :id, "--ostype", "Ubuntu_64"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
end
  config.vm.provision "shell", inline: <<-shell

  	sudo hostname osintics.app
  	sudo chown -R vagrant:vagrant ./storage
  	sudo apt-get update
  	sudo apt-get install software-properties-common
  	sudo apt-get install curl php-cli php-mbstring git unzip
  	sudo apt-get install -y unzip vim git-core curl wget build-essential python-software-properties
  	sudo add-apt-repository -y ppa:nginx/stable
  	sudo apt-get update
  	sudo apt-get install -y nginx
  	sudo apt-get install php7.0-fpm php7.0-mbstring php7.0-xml php7.0-mysql php7.0-common php7.0-gd php7.0-json php7.0-cli php7.0-curl
  	sudo apt-get update
	sudo sed -i 's/www-data/vagrant/g' /etc/php/7.0/fpm/pool.d/www.conf
  	sudo rm /etc/nginx/sites-enabled/default
  	cp  /vagrant/nginx_conf_laravel  /etc/nginx/sites-available/$(hostname)
  	sed -i 's/hostname/'$(hostname)'/g' /etc/nginx/sites-available/$(hostname)
  	sudo ln -s /etc/nginx/sites-available/$(hostname) /etc/nginx/sites-enabled/$(hostname)
	sudo sed -i 's/www-data/vagrant/g' /etc/nginx/nginx.conf
  	sudo service nginx restart
	sudo wget https://getcomposer.org/installer
	sudo mv composer.phar /usr/local/bin/composer
	sudo rm installer
  shell
end