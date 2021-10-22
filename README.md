#Schleier IT Coding Exam.

This repository is a coding exam for Schleier IT that can Verify User upon register and Update Profile.

## Installation

Clone the repository 

```bash
git clone https://github.com/Damnval/schleier.git
```

## Install dependencies

Go to project folder and run 

```bash
composer install
```

## Development Setup

```bash
cp .env.example .env
```

## Sending Email setup

Go to .env and change mail variables

```bash
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=yourUserName
MAIL_PASSWORD=yourPassword
MAIL_ENCRYPTION=null
```

## Create DataBase 

Go to your sql and create a DB named 'schleier'

## Run migration

```bash
php artisan migrate
```

## Run and test Coding Exam

```bash
php -S localhost:8000 -t public
```
Go to browser and type http://localhost:8000/

### Coding Style

PSR-2/ SOLID


