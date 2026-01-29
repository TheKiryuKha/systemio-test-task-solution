# Symfony REST-приложение для расчета цены продукта и проведения оплаты

Решение тестового задания от компании systemio 

## Установка
  
Скопируйте этот репозиторий. Для установки выполните `make init-dev`

чтобы запустить тесты выполните `make test`,
для запуска линтеров: `make fix`

## Примеры эндпоинтов

Для расчёта цены:

http://127.0.0.1:8337/calculate-price

```
{
  "product": 1,
  "couponCode": "D20",
  "taxNumber": "IT12345678901",
}
```

Ответ:

```
{
    "totalPrice": 97.60,
    "currency": "EUR"
}
```

Для платежа:

http://127.0.0.1:8337/purchase

```
{
  "product": 1,
  "couponCode": "P25",
  "taxNumber": "DE309876543",
  "paymentProcessor": "paypal",
}
```

Ответ:

```
{
  "message": "Payment was successful!"
}
```