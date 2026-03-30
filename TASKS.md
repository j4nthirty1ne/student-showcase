# 👥 Team Tasks & Responsibilities

This document outlines the main tasks, focus areas, and responsibilities for each team member working on the Student Project Showcase.

---

## 🔐 Task 1: User, Auth, Profile, Admin Foundation

**Team Member:** [Name TBD]  
**Priority:** 🔴 HIGH - System Foundation  
**Status:** In Progress

### 📌 Main Focus
This member handles the **core system foundation** that every other feature depends on:
- Authentication system
- User management
- User profiles
- Roles & permissions
- Admin access control

---

## 📋 Detailed Responsibilities

### 1️⃣ Authentication Module
Build the complete authentication system.

**Tasks:**
- [ ] User registration page & logic
  - [ ] Create registration form (Blade)
  - [ ] Create AuthController register method
  - [ ] Validate registration input (UpdateProfileRequest)
  - [ ] Hash passwords securely
  - [ ] Store in database

- [ ] User login page & logic
  - [ ] Create login form
  - [ ] Create login controller method
  - [ ] Session/auth protection
  - [ ] Remember-me functionality (optional)

- [ ] Logout functionality
  - [ ] Destroy session
  - [ ] Redirect to home

- [ ] Password handling
  - [ ] Password reset flow
  - [ ] Password change in profile
  - [ ] Password validation rules

- [ ] Session/Auth protection
  - [ ] Auth middleware
  - [ ] Guest middleware
  - [ ] Protect routes

---

### 2️⃣ User Management
Handle user database structure and logic.

**Tasks:**
- [ ] Users table migration
  - [ ] id (primary key)
  - [ ] name
  - [ ] email (unique)
  - [ ] password (hashed)
  - [ ] role (student/admin/etc)
  - [ ] status (active/inactive)
  - [ ] timestamps (created_at, updated_at)

- [ ] Create User Model
  - [ ] Model relationships
  - [ ] Fillable attributes
  - [ ] Accessors/mutators

- [ ] Role field implementation
  - [ ] Enum: student, admin
  - [ ] Role checking methods
  - [ ] Default role: student

- [ ] Active/Inactive status
  - [ ] Status field in DB
  - [ ] Logic to check active status
  - [ ] Deactivate user functionality

---

### 3️⃣ Profile Module
User profile viewing and editing.

**Tasks:**
- [ ] View profile page
  - [ ] Create view: `resources/views/student/profile/show.blade.php`
  - [ ] Display user info: name, email, bio, skills
  - [ ] Show profile image
  - [ ] Add edit button (if owner)

- [ ] Edit profile page
  - [ ] Create form: `resources/views/student/profile/edit.blade.php`
  - [ ] Pre-fill current data
  - [ ] Submit button

- [ ] Update bio
  - [ ] Bio field in profiles table
  - [ ] Edit functionality
  - [ ] Character limit validation

- [ ] Update skills
  - [ ] Skills field in profiles table (JSON or text)
  - [ ] Add/remove skills UI
  - [ ] Edit functionality

- [ ] Upload profile image
  - [ ] File upload validation (jpg, png, max 2MB)
  - [ ] Store in storage/
  - [ ] Display in profile & navbar
  - [ ] Replace old image

---

### 4️⃣ Authorization & Middleware
Control access based on roles.

**Tasks:**
- [ ] Admin middleware
  - [ ] Create: `app/Http/Middleware/AdminMiddleware.php`
  - [ ] Check if user role is 'admin'
  - [ ] Redirect if not admin
  - [ ] Apply to admin routes

- [ ] Student route protection
  - [ ] Auth middleware on student routes
  - [ ] Redirect unauthenticated users to login
  - [ ] Apply to: `/student/*`, `/profile/*`

- [ ] Role checking methods
  - [ ] User::isAdmin() method
  - [ ] User::isStudent() method
  - [ ] Use in controllers & views

- [ ] Policy basics
  - [ ] Create ProfilePolicy
  - [ ] Only owner can edit own profile
  - [ ] Admins can view/edit all

---

### 5️⃣ Admin Foundation
Basic admin structure and dashboard.

**Tasks:**
- [ ] Admin login access
  - [ ] Only admins can access `/admin/*`
  - [ ] Admin middleware protection
  - [ ] Redirect non-admins

- [ ] Admin dashboard basic counts
  - [ ] Total users count
  - [ ] Total projects count
  - [ ] Total categories count
  - [ ] Display on dashboard

- [ ] View all users
  - [ ] Create endpoint: `admin.users.index`
  - [ ] Query all users
  - [ ] Paginate results (10 per page)

- [ ] Basic user list page logic
  - [ ] Create: `resources/views/admin/users/index.blade.php`
  - [ ] Display user table
  - [ ] Columns: ID, Name, Email, Role, Status, Actions
  - [ ] Show/Edit/Delete buttons
  - [ ] Filter by role (optional)
  - [ ] Search by name/email (optional)

---

## 📁 Main Files Owned

### Controllers
```
app/Http/Controllers/
├── AuthController.php              # Register, login, logout
├── Student/
│   ├── ProfileController.php        # View, edit profile
│   └── DashboardController.php      # Student dashboard
└── Admin/
    ├── DashboardController.php      # Admin dashboard with counts
    └── UserManagementController.php # List, show, edit, delete users
```

### Middleware
```
app/Http/Middleware/
├── AdminMiddleware.php             # Check admin role
└── Authenticate.php                # Session protection (may already exist)
```

### Models
```
app/Models/
├── User.php                        # Main user model
└── Profile.php                     # User profile (if separate)
```

### Requests (Validation)
```
app/Http/Requests/
├── RegisterRequest.php             # Validate registration input
├── LoginRequest.php                # Validate login input
└── UpdateProfileRequest.php        # Validate profile updates
```

### Views
```
resources/views/
├── auth/
│   ├── register.blade.php
│   └── login.blade.php
├── student/
│   ├── dashboard.blade.php
│   └── profile/
│       ├── show.blade.php
│       └── edit.blade.php
└── admin/
    ├── dashboard.blade.php
    └── users/
        └── index.blade.php
```

### Routes
```
routes/
├── auth.php          # Auth routes (register, login, logout)
├── web.php           # Home, public routes
├── student.php       # Student routes (protected by auth)
└── admin.php         # Admin routes (protected by admin middleware)
```

---

## 🗄️ Database Tables Handled

### Main Table: `users`
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('student', 'admin', 'teacher') DEFAULT 'student',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Secondary Table: `profiles` (optional separate table)
```sql
CREATE TABLE profiles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT FOREIGN KEY,
    bio TEXT,
    skills JSON,
    profile_image VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Related Table: `admin_logs` (Admin activity tracking)
- Basic logging of admin actions (optional)
- Who deleted/edited users
- When actions happened

---

## 🎯 Definition of Done (Checklist)

Before marking tasks complete:

- [ ] Code written and tested locally
- [ ] Created branch: `feature/auth-foundation`
- [ ] All database migrations created
- [ ] Models created with relationships
- [ ] Controllers created with CRUD logic
- [ ] Views created (Blade templates)
- [ ] Routes defined
- [ ] Middleware applied
- [ ] Form validation working
- [ ] Error handling implemented
- [ ] Tests written (if required)
- [ ] Pull Request created
- [ ] Code reviewed by team
- [ ] All feedback addressed
- [ ] Merged to main

---

## 📊 Progress Tracker

| Component | Status | Notes |
|-----------|--------|-------|
| User Model | ⬜ Not Started | |
| Users Table Migration | ⬜ Not Started | |
| Auth Controller | ⬜ Not Started | |
| Register Flow | ⬜ Not Started | |
| Login Flow | ⬜ Not Started | |
| Profile Model | ⬜ Not Started | |
| Profile Controller | ⬜ Not Started | |
| Admin Middleware | ⬜ Not Started | |
| Admin Dashboard | ⬜ Not Started | |
| User Management | ⬜ Not Started | |
| Policies | ⬜ Not Started | |

---

## 🚀 Getting Started

### Quick Start Commands
```bash
# 1. Create feature branch
git checkout -b feature/auth-foundation

# 2. Create User model & migration
php artisan make:model User -m

# 3. Create controllers
php artisan make:controller AuthController
php artisan make:controller Student/ProfileController
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/UserManagementController

# 4. Create middleware
php artisan make:middleware AdminMiddleware

# 5. Create requests/form validation
php artisan make:request RegisterRequest
php artisan make:request LoginRequest
php artisan make:request UpdateProfileRequest

# 6. Create policies
php artisan make:policy ProfilePolicy --model=Profile
```

---

## 📞 Questions or Blockers?

- Ask team in Slack
- Create an issue on GitHub
- Review GIT_WORKFLOW.md for collaboration flow
- Check documentation in this repo

---

## 🔗 Related Documentation

- 📘 [Git Workflow](GIT_WORKFLOW.md) - How to collaborate
- 🏗️ [Project Structure](README.md) - General project layout
- 🧪 [Testing Guide](TESTING.md) - How to write tests (if exists)