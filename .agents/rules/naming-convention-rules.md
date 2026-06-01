# Naming Convention Rules

## Class

- PascalCase
- Danh từ rõ nghĩa

Ví dụ:
- UserService
- CreateOrderAction
- OrderRepository

## Model

- Danh từ số ít

Ví dụ:
- User
- Product
- Order

## Table

- snake_case số nhiều

Ví dụ:
- users
- products
- order_items

## Controller

- Tên số nhiều nếu resource controller

Ví dụ:
- UsersController
- OrdersController

## Route

- RESTful naming

Ví dụ:
GET /users
POST /users
GET /users/{user}
PUT /users/{user}
DELETE /users/{user}

## Migration

- Đúng convention Laravel

Ví dụ:
create_users_table
add_status_to_orders_table

## Enum

- Kết thúc bằng Enum

Ví dụ:
- OrderStatusEnum
- UserRoleEnum

## Event

- Past tense

Ví dụ:
- OrderCreated
- UserRegistered

## Listener

- Action verb

Ví dụ:
- SendWelcomeEmail
- UpdateInventory

## Job

- Action name

Ví dụ:
- ProcessPaymentJob

## Policy

- Singular model name + Policy

Ví dụ:
- UserPolicy
- OrderPolicy

## FormRequest

- Action + Model + Request

Ví dụ:
- StoreUserRequest
- UpdateProductRequest
