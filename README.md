# OnCloudOTP-SaaS

OnCloudOTP-SaaS is a SaaS application designed to provide secure, flexible, and fast OTP (One-Time Password) delivery via email for user verification processes.

## Features

- Lightning-fast OTP email delivery
- Strong security for user verification
- Flexible packages for different business needs
- Smart dashboard for tracking OTP activities
- Customer support and documentation

## Project Structure

```
Check-api/           # API endpoints for OTP verification
Database/            # Database schema and SQL files
home/
  index.php          # Main landing page
  login/             # Login and account creation
    config.php
    create-acc.php
    home-pg.php
    index.php
    redirect.php
    script.js
    style.css
    verify.php
    cus-verify/
      cs-verify.php
      redirect.php
      resend.php
      mail/
    mail/
      sender.php
      ...
    otp/
      ...
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

## Getting Started

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/OnCloudOTP-SaaS.git
   ```

2. **Set up the database:**
   - Import the SQL file from `Database/otp-cloud.sql` into your MySQL server.

3. **Configure the application:**
   - Update email and database settings in `home/login/config.php`.

4. **Run the application:**
   - Host the project on a PHP server (e.g., XAMPP, Apache).
   - Access the main page via `home/index.php`.

## Sending OTP Emails

- The project uses [PHPMailer](home/login/mail/PHPMailer/README.md) for sending emails.
- Email templates are located in `home/login/mail/OTP Mail/` and `home/login/cus-verify/mail/OTP Mail/`.

## Security

- Please review [PHPMailer security notices](home/login/mail/PHPMailer/SECURITY.md) for best practices.
- Always keep dependencies up to date.

## License

This project is distributed under the [LGPL 2.1](home/login/mail/PHPMailer/LICENSE) license.

## Contributing

Pull requests and suggestions are welcome! Please open an issue for any bugs or feature requests.

## Authors

-
