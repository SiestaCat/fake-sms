FROM php:8.2-cli

WORKDIR /app

# Install SQLite3 extension (already included in php:cli)
RUN apt-get update && apt-get install -y \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY . .

# Create data directory for SQLite
RUN mkdir -p /app/data && chmod 777 /app/data

EXPOSE 25400

CMD ["php", "-d", "memory_limit=512M", "-S", "0.0.0.0:25400", "-t", "/app"]
