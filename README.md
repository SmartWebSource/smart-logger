
# API Request Logger for Laravel

---

## 📖 About

**API Request Logger** is a simple Laravel package that logs incoming API requests into your database automatically.  
Perfect for debugging, auditing, and monitoring API traffic in your applications.

---

## 🚀 Installation

Follow these steps to install and set up the package:

### 1. Install via Composer

```bash
composer require smartwebsource/apirequestlogger
```

## 📦 2. (Optional) Publishing Configuration and Views
To customize the package's configuration or views, publish them using:
```bash
php artisan vendor:publish --provider="Smartwebsource\ApiRequestLogger\ApiRequestLoggerServiceProvider"
```

This will publish:

Configuration file to:
config/api_request_logs.php

Views to:
resources/views/vendor/api_request_logs/
Note: Publishing is optional. The package works with default settings out of the box.

## 🛠️ 3. Run Migrations
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

## 🛠 Local Development Setup

If you're developing or testing this package locally:

### Prerequisites
1. Place the `ApiRequestLogger` package inside your project's `packages/` directory
2. Or adjust the path in your `composer.json` if using a different location

### Configuration
Add this to your project's `composer.json`:

```json
{
  "require": {
    "smartwebsource/apirequestlogger": "^1.0"
  },
  "repositories": [
    {
      "type": "path",
      "url": "packages/ApiRequestLogger"
    }
  ]
}
```

## 🔥 Usage

Once installed, the package automatically logs all incoming API requests (api middleware group).  
No additional setup is required.

You can view or manage the logs by hitting the `/api-request-logs` route.


## 🛡 License
This package is open-source software licensed under the MIT license.

## 👨‍💻 Author
Developed and maintained by Smartwebsource.

For any queries or support, contact:
📧 test@smartwebsource.com

## 🎯 Command Reference

| Action | Command | Optional |
|--------|---------|----------|
| **Install package** | `composer require smartwebsource/apirequestlogger` | No |
| **Publish configuration & views** | `php artisan vendor:publish --provider="Smartwebsource\ApiRequestLogger\ApiRequestLoggerServiceProvider"` | Yes |
| **Run migrations** | `php artisan migrate` | No |

