# **Student Score Converter**

Student Score Converter is a **Laravel-based project** that provides **Student Score Converter system**.

---

## **🚀 Features**
✅ **Convert Students Scores** (Takes a CSV file and return JSON response of the formatted data)  

---

# **📌 Setup Instructions**

### **🔹 Prerequisites**
Ensure you have the following installed:
- **PHP 8.2+**
- **Composer**
- **MySQL or MariaDB**
- **Laravel 12+**

---

### **🔹 Installation Steps**

#### **1️⃣ Clone the repository**
```bash
git clone https://github.com/MoEmam203/student_score_converter
cd student_score_converter
```

#### **2️⃣ Install dependencies**
```bash
composer install
```

#### **3️⃣ Set up environment variables**
Copy the example environment file:
```bash
cp .env.example .env
```
Generate a new application key:
```bash
php artisan key:generate
```

#### **4️⃣ Configure the database**
Edit the `.env` file to match your database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_score_converter
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

#### **5️⃣ Run Migrations**
```bash
php artisan migrate
```
This will **create the necessary database tables and insert seed data**.

#### **6️⃣ Clear Cache**
```bash
php artisan config:clear
php artisan cache:clear
```

#### **7️⃣ Put File in correct folder**
Put csv file in storage/app/public folder 
and make sure the name of the file same as in StudentScoreConverterController (scores (1).csv)

```bash
php artisan storage:link
```

#### **8️⃣ Start the development server**
```bash
php artisan serve
```

#### **9️⃣ Access the application**
Visit the following URL in your browser:

```
http://127.0.0.1:8000/student-score-converter
```

You should see the data formatted as you want 

---