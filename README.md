
# 🌩️ OnCloudOTP-SaaS

**OnCloudOTP-SaaS** is a SaaS application that delivers secure, flexible, and fast OTP (One-Time Password) emails for user verification workflows. Designed for modern businesses needing reliable identity verification.

---

## 🔧 Tech Stack

- **PHP** – Backend logic & server-side scripting
- **Bootstrap CSS** – Responsive, mobile-first UI
- **PHPMailer** – Secure and flexible email delivery library

---

## 🚀 Features

- ⚡ Lightning-fast OTP email delivery  
- 🔒 Strong security for user verification  
- 📦 Flexible pricing/package structures  
- 📊 Smart dashboard for tracking OTP activities  
- 🛠️ Developer-friendly structure with documentation  
- 🤝 Customer support enabled integration  

---

## 📁 Project Structure

```
Check-api/                 # OTP verification APIs
Database/                  # SQL schema and scripts
home/
  index.php                # Main landing page
  login/
    config.php             # Database/email config
    create-acc.php         # Account creation
    home-pg.php
    index.php              # Login page
    redirect.php
    script.js
    style.css
    verify.php
    cus-verify/
      cs-verify.php
      redirect.php
      resend.php
      mail/                # Custom OTP email handlers
    mail/
      sender.php           # PHPMailer integration
      ...
    otp/
    src/
    user-interface/
    user-logo/
  pg/
    footer.php
    nav.php
  src/
    style.css
    font/
    img/
    logo/
```

---

## 🛠️ Getting Started

1. **Clone the repository:**
   ```sh
   git clone https://github.com/kbimsara/OnCloudOTP-SaaS.git
   ```

2. **Set up the database:**
   - Import the SQL file from `Database/otp-cloud.sql` into your MySQL server.

3. **Configure the application:**
   - Update email and database settings in `home/login/config.php`.

4. **Run the application:**
   - Host the project on a PHP server (e.g., XAMPP, Apache).
   - Access the main page via `home/index.php`.

---

## 📧 Sending OTP Emails

- The project uses [PHPMailer](home/login/mail/PHPMailer/README.md) for sending emails.
- Email templates are located in:
  - `home/login/mail/OTP Mail/`
  - `home/login/cus-verify/mail/OTP Mail/`

---

## 🔐 Security

- Please review [PHPMailer security notices](home/login/mail/PHPMailer/SECURITY.md) for best practices.
- Always keep dependencies up to date.

---

## 📝 License

This project is distributed under the [LGPL 2.1](home/login/mail/PHPMailer/LICENSE) license.

---

## 🤝 Contributing

Pull requests and suggestions are welcome!  
Please open an issue for any bugs or feature requests.

---

## 🎨 UI Design Credit

UI Design credit goes to [@kavishannip](https://github.com/kavishannip)
