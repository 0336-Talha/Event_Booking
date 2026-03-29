# Event Booking System

A Laravel-based web application for managing events and seat reservations. Authenticated users can create events, book seats, and cancel their bookings.

---

## Project Description

This application allows users to:

- Register, login, and logout securely
- Authenticated User can Create, view, update, and delete events
- Book seats for events created by other users
- Cancel their own bookings (seats are automatically restored)
- View paginated lists of all events and their own bookings

Seat availability is managed automatically — when a booking is made, available seats decrease; when a booking is cancelled, seats are restored.

---

## Tech Stack

- **Framework:** Laravel 10+
- **Database:** MySQL
- **Frontend:** Bootstrap 5
- **Auth:** Laravel built-in authentication

---

## Installation Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/event-booking-system.git
cd event-booking-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install && npm run build
```

---

## Environment Setup

### 4. Copy Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database in `.env`

Open `.env` and update these values:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_booking
DB_USERNAME=root
DB_PASSWORD=your_password

APP_TIMEZONE=Asia/Karachi

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=

---

## Database Migration Steps

### 7. Create the Database

In MySQL, run:

```sql
CREATE DATABASE event_booking;
```

### 8. Run Migrations

```command
php artisan migrate
```

This will create the following tables:

- `users` — registered users
- `events` — event listings with seat info
- `bookings` — seat reservations linked to users and events

---

## Seeder Usage

### 9. Seed the Database

```Command
php artisan db:seed
```

Or run fresh migrations with seeders in one command:

```Command
php artisan migrate:fresh --seed
```

This will create:

- **2 test users** (Ali and Talha)
- **5 events** created by Ali
- **8 fake events** created by Talha (using Faker)

---

## Test Login Credentials

| Role          | Name       | Email          | Password    |
| ------------- | ---------- | -------------- | ----------- |
| Event Creator | Ali Khan   | ali@test.com   | password123 |
| Booking User  | Talha Khan | talha@test.com | password123 |

---

## Application Flow

### How Users Interact with the System

Users register or log in to access the system. After login they can browse paginated events, create their own events, and manage their bookings from the dashboard. Users can only edit or delete events they created. Unauthenticated users are redirected to the login page.

### How Event Booking Works

A user browses events created by others and books seats by entering the desired number. A booking is saved with status `booked`. The user can cancel it from the My Bookings page — status changes to `cancelled`. A Delete button then appears to permanently remove the cancelled booking. Users cannot book their own events.

### How Seat Availability is Handled

Each event has `total_seats` and `available_seats`. When a booking is made, `available_seats` decreases by the seats booked. When cancelled, those seats are restored. Booking more than the available seats is blocked at the validation layer.

---

## Running the Application

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---
