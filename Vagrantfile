Vagrant.configure(2) do |config|

  config.vm.synced_folder ".", "/vagrant", type: "nfs", nfs_udp: false, mount_options: ["actimeo=2", "nolock"]

  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.manage_guest = false
  config.vm.hostname = "phpsw2"

  config.vm.network :private_network, ip: "192.168.3.111"

  config.vm.box = "debian/stretch64"

  config.ssh.forward_agent = true

  config.vm.provider "virtualbox" do |vb|
     vb.memory = "2048"
  end

  # Provision box with php and composer
  config.vm.provision "shell", inline: <<-SHELL
    sudo apt-get update
    sudo apt-get install -y ca-certificates apt-transport-https git zip vim curl
    wget -q https://packages.sury.org/php/apt.gpg -O- | sudo apt-key add -
    echo "deb https://packages.sury.org/php/ stretch main" | sudo tee /etc/apt/sources.list.d/php.list
    sudo apt-get update
    sudo apt-get install -y php7.3 php7.3-xml php7.3-mbstring php7.3-curl apache2 mysql-server mysql-client php7.3-mysql php7.3-intl vim htop 
    curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
    wget https://get.symfony.com/cli/installer -O - | bash
    mv ~/.symfony/bin/symfony /usr/local/bin/symfony

    mysql -e "CREATE USER IF NOT EXISTS phpsw@localhost IDENTIFIED BY 'mypass';"
    mysql -e "CREATE DATABASE IF NOT EXISTS phpsw;"
    mysql -e "GRANT ALL ON phpsw.* TO phpsw@localhost;"

   
  SHELL
end
