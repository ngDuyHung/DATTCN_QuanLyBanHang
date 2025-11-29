#!/bin/sh
set -e

echo "🚀 Starting Laravel application..."

# Start services immediately in background
echo "🔄 Starting Nginx and PHP-FPM..."

# Execute the main command in background
"$@" &
MAIN_PID=$!

# Wait a bit for services to start
sleep 5

# Now do setup tasks
echo "⏳ Running setup tasks..."

# Wait for database to be ready (with timeout)
echo "⏳ Waiting for database..."
MAX_TRIES=15
COUNTER=0
until php artisan db:show 2>/dev/null || [ $COUNTER -eq $MAX_TRIES ]; do
    echo "Database is unavailable - sleeping ($COUNTER/$MAX_TRIES)"
    COUNTER=$((COUNTER+1))
    sleep 2
done

if [ $COUNTER -eq $MAX_TRIES ]; then
    echo "⚠️ Database not ready, skipping migrations..."
else
    echo "✅ Database is ready!"
    # Run migrations
    echo "🔄 Running migrations..."
    php artisan migrate --force --no-interaction || echo "⚠️ Migration failed"
fi

# Optimize application
echo "⚙️ Optimizing application..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Create storage link if not exists
if [ ! -L /var/www/public/storage ]; then
    echo "🔗 Creating storage link..."
    php artisan storage:link 2>/dev/null || true
fi

echo "✅ Application ready!"

# Wait for the main process
wait $MAIN_PID
