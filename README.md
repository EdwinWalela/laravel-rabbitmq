# RabbitMQ Demo

Message brokering demo using [RabbitMQ](https://www.rabbitmq.com/)

The project consists of a Producer ~~and Consumer~~

## Setup

Run `docker-compose up`



## RabbitMQ Dashboard

Accessed on `localhost:15672/#/queues/payments`

### If queue doesn't exist
Create queue `payments` and bind it to `amq.direct` exchange

## Producer

Implemented as a REST API 

### Producing messages
POST `localhost:8000/api/payments`

#### Request body

Contains JSON string of data to be queued

```json
{
    "data":"{\"amount\":300,\"created_at\":\"14-02-2022 20:10:57\",\"account_no\":39023093,\"user_no\":239391}"
}   
```


