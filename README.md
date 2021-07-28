# Media Library

## Setup
1.Ensure that you have Vagrant, Virtual Box, PHP & Composer install and setup
2.Setup Homestead configuration by copying Homesteade.example.yaml to Homestead.yaml and change the following line:
folders:
    - map: {{Add Path to Project Folder on your computer}}
    - to: /home/vagrant/code
3.Add UNSPLASH_CLIENT_ID= "unsplash access key" to .env (https://unsplash.com/developers)
4.composer install
5.vagrant up
6.vagrant ssh
7.yarn install
8.art key:generate
9.php artisan migrate
10.yarn run dev
## Search page
### Search for images from unsplash
![alt text](https://github.com/WZJoyce/image-library/blob/main/image/SearchPage.png)

## Home page
### select an image to add to the image library with addition information
![alt text](https://github.com/WZJoyce/image-library/blob/main/image/HomePage.png)

## Image Library
### Store Image
![alt text](https://github.com/WZJoyce/image-library/blob/main/image/MediaLibrary.png)

