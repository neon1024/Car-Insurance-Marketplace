# 🚗 Car Insurance Marketplace

A full-stack web application that simulates a real-world car insurance marketplace, allowing users to provide vehicle and personal data in order to retrieve, compare, and manage insurance offers from multiple real-world insurers via their public RESTful APIs.

The application supports offer comparison, policy creation, and PDF policy generation, and is built with a strong focus on clean architecture, maintainability, and realistic business logic.

## 🧠 Engineering Focus

This project emphasizes:

Separation of concerns

Domain-driven thinking

API-first development

Readable, maintainable code

Scalability over shortcuts

It was intentionally built to reflect how software is written inside real teams, not just to “make it work”.

## ✨ Key Features
### 🧾 Insurance Offer Generation

Backend-driven generation of insurance offers based on vehicle data and predefined business rules.

### 📊 Real-World Insurer Offer Comparison

Unified comparison of insurance offers from multiple real-world insurers, normalized and presented through a single interface.

### 🚘 Vehicle & Insurance Policy Management

Full lifecycle management for vehicles and insurance policies, including validation and persistence.

### 🔄 API-First Architecture

Strict separation between frontend and backend, communicating exclusively through RESTful APIs.

### 🔐 Secure API Authentication & Validation

Centralized authentication, authorization, and request validation implemented entirely on the backend to protect business logic and data integrity.

### 🖥️ Modern, Responsive User Interface

Responsive, component-based UI built for clarity, usability, and scalability.

## 🛠️ Tech Stack
### Backend

- Laravel (PHP 8+)

- RESTful API

- PostgreSQL / SQLite

### Frontend

- Vue.js

- TypeScript

- Vite

## ⚙️ Setup & Installation
### Prerequisites

- PHP ≥ 8.x

- Composer

- Node.js ≥ 18

- npm / yarn

- PostgreSQL or SQLite

### Backend Setup

`cd backend`<br>
`composer install`<br>
`cp .env.example .env`<br>
`php artisan key:generate`<br>
`php artisan migrate`<br>
`php artisan serve`<br>

### Frontend Setup
`cd frontend`<br>
`npm install`<br>
`npm run dev`<br>

The application will be available at:

Frontend: http://localhost:5173

Backend API: http://localhost:8000

## 📌 Future Improvements

- Payment integration

- Admin panel

- Role-based access control

- Dockerized environment

- Automated tests

# 👤 Author

Ioan Robert Scumpu<br>
Software Engineering Master’s Student<br>
Full-Stack Software Engineer Intern @ Technology Reply Romania<br>
