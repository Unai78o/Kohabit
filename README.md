# Kohabit

A modern web application built with HTML, CSS, JavaScript, and MySQL.

## Project Structure

```
Kohabit/
├── index.html              # Main HTML file
├── css/
│   └── styles.css          # Stylesheet
├── js/
│   └── script.js           # JavaScript functionality
├── php/
│   ├── db_config.php       # Database configuration template
│   ├── submit_form.php     # Contact form handler
│   ├── get_data.php        # Data retrieval endpoint
│   └── save_data.php       # Data saving endpoint
├── database/
│   └── schema.sql          # Database schema
└── README.md               # This file
```

## Features

- Responsive design with modern CSS
- Smooth scrolling navigation
- Contact form with validation
- MySQL database integration
- RESTful API endpoints
- Secure database connections using PDO

## Setup Instructions

### Prerequisites

- Web server (Apache/Nginx)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Modern web browser

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Unai78o/Kohabit.git
   cd Kohabit
   ```

2. **Set up the database**
   - Create a MySQL database
   - Import the database schema:
     ```bash
     mysql -u your_username -p kohabit_db < database/schema.sql
     ```

3. **Configure database connection**
   - Copy the example configuration file:
     ```bash
     cp php/config.example.php php/config.php
     ```
   - Edit `php/config.php` and update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'kohabit_db');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     ```

4. **Configure web server**
   - Point your web server document root to the project directory
   - Ensure PHP is enabled
   - For Apache, make sure `.htaccess` is enabled (if needed)

5. **Access the application**
   - Open your browser and navigate to `http://localhost/` or your configured domain
   - The application should be running!

## Usage

### Contact Form

The contact form allows users to send messages which are stored in the database. The form includes:
- Name field
- Email field (with validation)
- Message textarea
- Client-side and server-side validation

### API Endpoints

- **POST** `/php/submit_form.php` - Submit contact form
- **GET** `/php/get_data.php` - Retrieve data from database
- **POST** `/php/save_data.php` - Save data to database

### Database Tables

- `users` - User accounts
- `contact_messages` - Contact form submissions
- `items` - Example data table
- `sessions` - User session management

## Development

### File Organization

- **HTML**: `index.html` contains the main structure
- **CSS**: `css/styles.css` contains all styling
- **JavaScript**: `js/script.js` contains client-side functionality
- **PHP**: `php/` directory contains backend scripts
- **Database**: `database/schema.sql` contains the database structure

### Adding New Features

1. Add HTML structure in `index.html`
2. Style it in `css/styles.css`
3. Add functionality in `js/script.js`
4. Create backend endpoints in `php/` directory
5. Update database schema in `database/schema.sql` if needed

## Security Notes

- Database credentials are stored in `php/config.php` (excluded from Git)
- PDO prepared statements are used to prevent SQL injection
- Input validation is performed on both client and server side
- CORS headers are configured in API endpoints

## License

This project is open source and available under the MIT License.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.