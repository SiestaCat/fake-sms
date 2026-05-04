#!/bin/bash
# Script de ejemplo para enviar mensajes de prueba

curl -X POST http://localhost:25400/api.php \
  -H "Content-Type: application/json" \
  -d '{
    "recipients": ["555-1234", "555-5678"],
    "body": "Hello, this is a test message"
  }'
echo ""
