#!/bin/sh
set -e

echo "🚀 Starting Laravel application..."

# Wait for database to be ready (with timeout)
echo "⏳ Waiting for database..."
MAX_TRIES=30
COUNTER=0
until php artisan db:show 2>/dev/null || [ $COUNTER -eq $MAX_TRIES ]; do
    echo "Database is unavailable - sleeping ($COUNTER/$MAX_TRIES)"
    COUNTER=$((COUNTER+1))
    sleep 2
done

if [ $COUNTER -eq $MAX_TRIES ]; then
    echo "⚠️ Database not ready after 60s, continuing anyway..."
else
    echo "✅ Database is ready!"
    # Run migrations
    echo "🔄 Running migrations..."
    php artisan migrate --force --no-interaction || echo "⚠️ Migration failed, continuing..."
fi

# Clear and cache config
echo "⚙️ Optimizing application..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Create storage link if not exists
if [ ! -L /var/www/public/storage ]; then
    echo "🔗 Creating storage link..."
    php artisan storage:link || true
fi

echo "✅ Application ready!"

# Execute the main command
exec "$@"
