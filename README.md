<img width="200" height="200" alt="ThinkVerse Logo" src="https://github.com/user-attachments/assets/4e36b827-cbd1-452b-8e10-839ed109e848" />

ThinkVerse is a simple blog app designed to provide a simple platform for creators and readers. It aims to solve the problem of complex user interfaces by offering a clean, easy-to-use experience for content creation and discovery.

## 📚 Key Features

- **User Authentication**
- **Admin and User Dashboard**
- **Blog Content Management**
- **Categorization & Tags**
- **Greedy Algorithm for Blogs Recommendations**
- **User Profiles**

## 🛠️ Tech Stack
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4061F5?style=for-the-badge&logo=livewire&logoColor=white)
![Laravel Blade](https://img.shields.io/badge/Laravel%20Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## Prerequisites

Before you begin, ensure you have the following software installed on your system

- ![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white) - For Version Control

- ![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white) - PHP Dependency Manager

- ![Node.js](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white) - For Front-end

- ![Laragon](https://img.shields.io/badge/Laragon-00ADD8?style=for-the-badge&logoColor=white&logo=laragon) - Development Environment


## Installation and Setup (Using Laragon)

Follow these steps to get **ThinkVerse** running on your local machine using Laragon.

### 1. Clone the Repository

Clone the project to your computer's `laragon/www` directory.

```bash
cd C:\laragon\www
git clone https://github.com/vee309bajracharya/ThinkVerse-BlogApp.git  
```
### 2. Configure Laragon Virtual Host
- Right-click on the Laragon icon in the system tray.
- Navigate to Menu > Apache > hosts.
- Laragon will automatically detect the new project folder. Select thinkverse-blogapp.test to create a virtual host.

### 3. Install PHP & Node Dependencies
Open the Laragon terminal within the ThinkVerse-BlogApp folder and run the following commands:

```bash
composer install
npm install
npm run dev
```

### 4. Configure Environment File
Create your environment file from the example provided.
```bash
cp .env.example .env
php artisan key:generate
```
Now, open the newly created .env file and update the variables to match your Laragon database settings

### 5. Run Database Migrations
Create a database in your Laragon environment with the name you specified (example: thinkverse_db). Then, run the migrations to create the database tables.
```bash
php artisan migrate
```

### 6. Run the Application
The application should now be accessible in your web browser at http://thinkverse-blogapp.test
