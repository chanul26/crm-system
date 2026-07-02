# CRM System

A fully functional CRM (Customer Relationship Management) system built with Laravel 10.

## Features

- Admin authentication (register, login, logout)
- Welcome email on registration
- Customer management (create, edit, delete, status toggle)
- Proposal management (create, edit, delete, status management)
- Invoice management (create, edit, delete, send via email)
- Stripe payment integration (customers can pay invoices online)
- Automatic invoice status update after payment
- Transaction history

## Tech Stack

- **Backend:** Laravel 10, PHP 8.2
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS, Alpine.js
- **Email:** Mailtrap (for testing)
- **Payments:** Stripe
- **Build Tool:** Vite

## Requirements

- PHP 8.1+
- Composer
- Node.js & npm
- MySQL
- Stripe account (for payments)
- Mailtrap account (for email testing)

## Local Setup Instructions

### 1. Clone the repository
```bash
git clone https://github.com/chanul26/crm-system.git
cd crm-system
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Install frontend dependencies
```bash
npm install
```

### 4. Create environment file
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure `.env` file
Open `.env` and update these values:
```env
APP_NAME="CRM System"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_system
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="admin@crm-system.com"
MAIL_FROM_NAME="CRM System"

STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
STRIPE_WEBHOOK_SECRET=your_stripe_webhook_secret
```

### 6. Create the database
Create a MySQL database called `crm_system` then run:
```bash
php artisan migrate
```

### 7. Start the development servers

Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

Terminal 3 (for Stripe webhooks):
```bash
stripe listen --forward-to http://127.0.0.1:8000/stripe/webhook
```

### 8. Visit the app