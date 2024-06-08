# Polling Unit Results Application

This Laravel application provides functionalities to view and manage election results for polling units under various local government areas (LGAs) within Delta State. The application includes the following features:
1. View results for individual polling units.
2. View summarized total results for all polling units under a particular LGA.
3. Enter results for new polling units.

## Prerequisites

- PHP >= 7.3
- Composer
- MySQL or MariaDB

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/youngyusuff6/polls.git
    cd polling-unit-results
    ```

2. **Install dependencies:**
    ```sh
    composer install

    ```

3. **Configure environment:**
    Copy the `.env.example` to `.env` and update the database configuration.
    ```sh
    cp .env.example .env
    ```
    Update the `.env` file with your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

4. **Import the database:**
    Download the database file and import it into your MySQL database.
    ```sh
    mysql -u your_database_user -p your_database_name < path/to/bincom_test.sql
    ```

5. **Generate application key:**
    ```sh
    php artisan key:generate
    ```

6. **Run migrations:**
    ```sh
    php artisan migrate
    ```

7. **Serve the application:**
    ```sh
    php artisan serve
    ```

## Usage

### Viewing Polling Unit Results
1. Navigate to `http://localhost:8000` or `https://bincomtests.000webhostapp.com`.
2. Use the navigation bar to select "View Polling Unit Results".
3. Select a Local Government Area (LGA), then a Ward, and finally a Polling Unit to view the results.

### Viewing LGA Summary Results
1. Use the navigation bar to select "View LGA Summary Results".
2. Select a Local Government Area (LGA) to view the summarized total results for all polling units under that LGA.

### Entering New Polling Unit Results
1. Use the navigation bar to select "Enter New Polling Unit Results".
2. Fill in the form with the necessary details and submit to save the new results.

## Project Structure

- **app/Models**: Contains the Eloquent models for the application.
- **app/Http/Controllers**: Contains the controllers for handling HTTP requests.
- **resources/views**: Contains the Blade templates for the application.
- **routes/web.php**: Contains the web routes for the application.

## Key Files

- **PollingUnitController.php**: Handles fetching and summarizing polling unit results.
- **lga-summary.blade.php**: View for displaying summarized total results for an LGA.
- **polling-unit-results.blade.php**: View for displaying individual polling unit results.
- **new-result.blade.php**: View for entering new polling unit results.

## Endpoints

- `GET /wards/{lga_id}`: Fetches wards under a specific LGA.
- `GET /polling-units/{ward_id}/units`: Fetches polling units under a specific ward.
- `GET /polling-units/{polling_unit_id}/results`: Fetches results for a specific polling unit.
- `GET /lga-summary/{lga_id}`: Fetches summarized total results for an LGA.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Create a new Pull Request.
