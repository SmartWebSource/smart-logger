
# API Request Logger for Laravel

---

## 📖 About

**API Request Logger** is a simple Laravel package that logs incoming API requests into your database automatically.  
Perfect for debugging, auditing, and monitoring API traffic.

---

## 🚀 Installation

Install the package via Composer:

```bash
composer require smartwebsource/apirequestlogger
```

## 📦 Publishing Configuration and Views
To customize the package's configuration or views, publish them using:
```bash
php artisan vendor:publish --provider="Smartwebsource\ApiRequestLogger\ApiRequestLoggerServiceProvider"
```

This will publish:

Configuration file to:
config/api_request_logs.php

Views to:
resources/views/vendor/api_request_logs/

## 🛠️ Run Migrations
Run the migrations to create the api_request_logs table:
```bash
php artisan migrate
```

## ⚙️ Configuration
After publishing, you can modify the configuration file at:
```bash
config/api_request_logs.php
```
Available settings may include enabling/disabling logging, excluding certain routes, etc.

## 🔥 Usage
Once installed, the package automatically logs all incoming API requests (api middleware group).
No additional setup is required.

You can view or manage the logs through your database or build a simple dashboard using the published views.

## 🛡 License
This package is open-source software licensed under the MIT license.

## 👨‍💻 Author
Developed and maintained by Smartwebsource.

For any queries or support, contact:
📧 test@smartwebsource.com

## 🎯 Quick Commands Cheat Sheet
Action | Command
Install package | composer require smartwebsource/apirequestlogger
Publish config and views | php artisan vendor:publish --provider="Smartwebsource\ApiRequestLogger\ApiRequestLoggerServiceProvider"
Run migrations | php artisan migrate

