# SIMPELMAS - Sistem Pengaduan & Laporan Masyarakat

SIMPELMAS is a PHP Native-based web application for public complaints and reports. This application enables members of the public to report issues, staff to process complaints, and administrators to manage the entire system.

This website has three user roles: Members of the Public (reporters), Staff, and Admins. Each role has different access rights in accordance with its function.

## Feature

- Submit a complaint by uploading supporting photos
- Track the status of complaints (New, In Progress, Closed)
- Discuss issues via the comments feature on each complaint
- Dashboard for agents and administrators
- Manage complaint categories
- Print reports in PDF format
- Manage user data (administrators only)
- Update profile and password


## Technology Used

- Frontend: HTML, CSS, Tailwind CSS, JavaScript
- Backend: PHP Native
- Database: MySQL
- Web Server: Apache (XAMPP / Laragon)

## How to Run This Project

### 1. Clone the repository

```bash
git clone https://github.com/gusalitt/simpelmas.git
cd simpelmas
```

### 2. Install dependencies

```bash
pnpm install
```

### 3. Copy .env.example file to .env file

```bash
cp .env.example .env
```

### 4. Edit the file .env

Open the `.env` file and adjust the following settings: 

```env
APP_URL="http://localhost/simpelmas"

DB_CONNECTION="mysql"
DB_HOST="localhost"
DB_PORT="3306"
DB_NAME="your_database_name"
DB_USERNAME="root"
DB_PASSWORD=""

ENCRYPTION_KEY="your_encryption_key"
```

### 5. Create the database

Create a new database in MySQL with the name `DB_NAME` as set in `.env` file.

### 6. Run migration and seeder

```bash
cd app/Database/
php migrate.php && php seed.php
```

### 7. Access the app

Open the browser and go to the following address:

```
http://localhost/simpelmas
```