# agency-backend README.md

# A&Y Digital Marketing Agency Backend

This project serves as the backend for the A&Y Digital Marketing Agency, built using PHP and MySQL. It handles contact form submissions and manages leads effectively.

## Project Structure

```
agency-backend
├── src
│   ├── api
│   │   └── contact.php          # Handles JSON-based AJAX submissions
│   ├── config
│   │   ├── database.php         # Database connection settings
│   │   ├── email.php            # PHPMailer configuration
│   │   └── config.php           # General configuration settings
│   ├── includes
│   │   ├── db_functions.php      # Functions for database operations
│   │   └── validation.php        # Input validation and sanitization
│   ├── logs
│   │   └── error.log            # Error logging
│   └── contact_process.php       # Processes contact form submissions
├── composer.json                 # Composer dependencies
├── .env.example                  # Environment variables template
├── .gitignore                    # Git ignore file
└── README.md                     # Project documentation
```

## Setup Instructions

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd agency-backend
   ```

2. **Install dependencies**:
   Make sure you have Composer installed, then run:
   ```bash
   composer install
   ```

3. **Configure environment variables**:
   Copy `.env.example` to `.env` and fill in your database credentials and email settings.

4. **Set up the database**:
   Create a MySQL database and run the necessary SQL scripts to create the `leads` table.

5. **Run the application**:
   You can use a local server like XAMPP or MAMP to run the PHP application.

## Usage

- The contact form submissions are processed by `contact_process.php`.
- JSON-based AJAX submissions can be handled through `src/api/contact.php`.

## Logging

Errors are logged in `src/logs/error.log` for debugging purposes.

## License

This project is licensed under the MIT License.