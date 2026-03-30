# 🚀 Quick Setup Steps for Student Project Showcase

## Prerequisites
- ✅ XAMPP installed (MySQL running)
- ✅ PHP installed
- ✅ Composer installed
- ✅ Project cloned

---

## Step 1: Navigate to Project
```bash
cd "d:\Xamp\htdocs\wct project\student-project-showcase"
```

---

## Step 2: Install Dependencies
```bash
composer install
```
**Time:** 2-3 minutes  
**What it does:** Downloads all Laravel packages

---

## Step 3: Create .env File
```bash
copy .env.example .env
```

Or manually create `.env` in project root with:
```
APP_NAME="Student Showcase"
APP_ENV=local
APP_DEBUG=true
APP_KEY=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_showcase
DB_USERNAME=root
DB_PASSWORD=
```

---

## Step 4: Generate App Key
```bash
php artisan key:generate
```

---

## Step 5: Create Database
Open phpMyAdmin (http://localhost/phpmyadmin) and:
1. Click "New"
2. Database name: `student_showcase`
3. Collation: `utf8_general_ci`
4. Click Create

---

## Step 6: Run Migrations
```bash
php artisan migrate
```

**Expected output:**
```
Migration table created successfully.
Migrating: create_users_table
Migrated: create_users_table (xxx ms)
Migrating: create_profiles_table
Migrated: create_profiles_table (xxx ms)
```

✅ Tables created!

---

## Step 7: Start Development Server
```bash
php artisan serve
```

Opens: `http://127.0.0.1:8000`

---

## Step 8: Test Registration
1. Go to `http://127.0.0.1:8000/register`
2. Create an account
3. Should redirect to student dashboard ✅

---

## 🐛 Troubleshooting

### "Class not found" error
```bash
composer dump-autoload
```

### "SQLSTATE error" (database issue)
- Check DB_DATABASE in .env
- Verify database exists in phpMyAdmin
- Run: `php artisan migrate:fresh` (deletes & recreates)

### "Route not defined"
```bash
php artisan route:list
```
Shows all registered routes

### File permissions issue (Windows)
Usually not a problem on Windows, but if needed:
```bash
php artisan cache:clear
php artisan config:clear
```

---

## ✅ You're Done!

Once complete:
- ✅ Database tables created
- ✅ App running on localhost:8000
- ✅ Registration system working
- ✅ Ready to test!

---

## 📝 Next: Commit & Push

```bash
git add .
git commit -m "Complete auth foundation implementation"
git push origin feature/auth-foundation
```

Then create PR on GitHub.

---

**Any errors? Let me know!**
