## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/rodrigo-wong/vehikl_oil_change_app.git
   cd vehikl_oil_change_app
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Create SQLite database**
   ```bash
   touch database/database.sqlite
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the application**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   
   Open your browser and navigate to: `http://localhost:8000`

## Running Tests

```bash
php artisan test
```