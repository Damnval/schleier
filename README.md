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

## Create DataBase 

Go to your sql and create a DB named 'veritas'

## Run migration

```bash
php artisan migrate --seed
```

## Run and test Coding Exam

```bash
php -S localhost:8000 -t public
```
Go to browser and type http://localhost:8000/

### Coding Style

PSR-2/ SOLID


