# Media Library

## Setup
* Ensure that you have Vagrant, Virtual Box, PHP & Composer install and setup
* Setup Homestead configuration by copying Homesteade.example.yaml to Homestead.yaml and change the following line:
folders:
    - map: {{Add Path to Project Folder on your computer}}
    - to: /home/vagrant/code
* Add UNSPLASH_CLIENT_ID= "unsplash access key" to .env (https://unsplash.com/developers)
* composer install
* vagrant up
* vagrant ssh
* yarn install
* art key:generate
* php artisan migrate
* yarn run dev
## Search page
### Search for images from unsplash
![alt text](https://github.com/WZJoyce/image-library/blob/main/image/SearchPage.png)

## Home page
### select an image to add to the media library with addition information
![alt text](https://github.com/WZJoyce/image-library/blob/main/image/HomePage.png)

## Image Library
### Store Image
![alt text](https://github.com/WZJoyce/image-library/blob/main/image/MediaLibrary.png)

