#!/bin/sh
set -e

echo "🚀 Starting Laravel application..."

# Wait for database to be ready
echo "⏳ Waiting for database..."
until php artisan db:show 2>/dev/null; do
    echo "Database is unavailable - sleeping"
    sleep 2
done

echo "✅ Database is ready!"

# Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force --no-interaction

# Clear and cache config
echo "⚙️ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Create storage link if not exists
if [ ! -L /var/www/public/storage ]; then
    echo "🔗 Creating storage link..."
    php artisan storage:link
fi

echo "✅ Application ready!"

# Execute the main command
exec "$@"
