# Fake SMS

Simple fake SMS system for testing environments. Receives messages via HTTP API and stores them in SQLite.

## Features

- HTTP API without authentication to send messages
- SQLite storage
- Minimalist web dashboard with Bootstrap
- Dockerized with PHP built-in server

## Database Structure

Table `messages`:
- `id`: INTEGER PRIMARY KEY AUTOINCREMENT
- `message_id`: TEXT (unique message identifier)
- `datetime`: TEXT (message date and time)
- `recipient`: TEXT (recipient)
- `body`: TEXT (message body)

## API Endpoint

### POST /api.php

Send an SMS message to multiple recipients.

**Request Body:**
```json
{
  "recipients": ["555-0001", "555-0002"],
  "body": "This is a test message"
}
```

**Response (201 Created):**
```json
{
  "success": true,
  "message_id": "msg_663f1a2b3c4d5e",
  "recipients_count": 2
}
```

## Dashboard

Access `http://localhost:25400` to see all messages in a responsive table.

## Docker Usage

### Docker Run

```bash
docker build -t fake-sms .

docker run --rm -it -p 25400:25400 fake-sms
```

### Docker Compose

```yaml
services:
  fake-sms:
    build: .
    ports:
      - "25400:25400"
```

Start:
```bash
docker-compose up
```

Stop:
```bash
docker-compose down
```

## Docker Registry Workflow

### Login to Docker Hub

```bash
docker login
```

### Build and Tag Image

```bash
docker build -t siestacat/fake-sms:latest .
```

With version tag:
```bash
docker build -t siestacat/fake-sms:1.0.0 .
```

### Push to Registry

```bash
docker push siestacat/fake-sms:latest
```

Push specific version:
```bash
docker push siestacat/fake-sms:1.0.0
```

### Pull from Registry

```bash
docker pull siestacat/fake-sms:latest
```

### Run from Registry

```bash
docker run --rm -it -p 25400:25400 siestacat/fake-sms:latest
```

### Docker Compose with Registry Image

```yaml
services:
  fake-sms:
    image: siestacat/fake-sms:latest
    ports:
      - "25400:25400"
```

## Usage Examples

### Send message to single recipient:

```bash
curl -X POST http://localhost:25400/api.php \
  -H "Content-Type: application/json" \
  -d '{
    "recipients": ["555-1234"],
    "body": "Hello, this is a test message"
  }'
```

Response:
```json
{
  "success": true,
  "message_id": "msg_663f1a2b3c4d5e",
  "recipients_count": 1
}
```

### Send message to multiple recipients:

```bash
curl -X POST http://localhost:25400/api.php \
  -H "Content-Type: application/json" \
  -d '{
    "recipients": ["555-1234", "555-5678", "555-9012"],
    "body": "Hello everyone, this is a broadcast message"
  }'
```

Response:
```json
{
  "success": true,
  "message_id": "msg_663f1a2b3c4d5e",
  "recipients_count": 3
}
```

**Note:** All recipients will share the same `message_id` in the database.

### View the dashboard:

Open your browser at `http://localhost:25400`

## Technologies

- PHP 8.2 with built-in server
- SQLite3
- Bootstrap 5.3
- Docker
