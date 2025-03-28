# ApptikaTest

## Installation
1. copy .env file ```cp .env.example .env``` and configure your app settings
2. run ```php artisan migrate``` to set up database
3. enjoy

## Usage

### API quick reference

#### app_top_category

**Request:** `http://{{your_app_host}}/api/app_top_category?date=YYYY-MM-DD`

**Response:**

Success:
```json
{
    "success": true,
    "message": "success",
    "data": {
        "2": 63,
        "23": 3
    },
    "status": 200
}
```

Validation Error:
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "date": [
            "The date field must be a date before or equal to today."
        ]
    },
    "status": 422
}
```

Rate limit error:
```json
{
    "success": false,
    "message": "Too Many Attempts.",
    "errors": [],
    "status": 429
}
```

### Console tools

+ run `php artisan apptika:load_top_app_history --date_from=2000-01-01 --days=1` history manually
+ Cron set-up for daily run: ` * * * * * cd /path-to-your-app && php artisan schedule:run >> /dev/null`
