@echo off
echo ========================================
echo   Setup Project BPF KLMPK4
echo ========================================
echo.

echo [1/7] Installing Composer dependencies...
call composer install
if errorlevel 1 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo.
echo [2/7] Installing NPM dependencies...
call npm install
if errorlevel 1 (
    echo ERROR: NPM install failed!
    pause
    exit /b 1
)

echo.
echo [3/7] Copying .env file...
if not exist .env (
    copy .env.example .env
    echo .env file created!
) else (
    echo .env file already exists, skipping...
)

echo.
echo [4/7] Generating application key...
call php artisan key:generate
if errorlevel 1 (
    echo ERROR: Key generation failed!
    pause
    exit /b 1
)

echo.
echo [5/7] Running migrations...
call php artisan migrate
if errorlevel 1 (
    echo ERROR: Migration failed! Please check your database configuration.
    pause
    exit /b 1
)

echo.
echo [6/7] Seeding database...
call php artisan db:seed --class=AdminSeeder
if errorlevel 1 (
    echo ERROR: Seeding failed!
    pause
    exit /b 1
)

echo.
echo [7/7] Creating storage link...
call php artisan storage:link
if errorlevel 1 (
    echo WARNING: Storage link creation failed, but continuing...
)

echo.
echo ========================================
echo   Setup Complete!
echo ========================================
echo.
echo Login Credentials:
echo   Username: superadmin
echo   Password: superadmin123
echo.
echo To start the server, run:
echo   php artisan serve
echo.
echo Then open: http://localhost:8000
echo.
pause

