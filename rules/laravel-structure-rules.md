# Laravel Structure Rules

## Folder Structure

app/
    Actions/
    Services/
    DTOs/
    Enums/
    Events/
    Exceptions/
    Http/
        Controllers/
        Requests/
        Resources/
    Jobs/
    Listeners/
    Models/
    Observers/
    Policies/
    Repositories/

## Rule

- File phải đặt đúng thư mục
- Không đặt sai responsibility

Ví dụ:
- Enum không được đặt trong Models
- Service không đặt trong Helpers
- Business logic không nằm trong routes

## Helpers

- Hạn chế dùng helper global
- Ưu tiên service class

## Facade

- Không abuse facade
- Ưu tiên dependency injection

## Config

- Không hardcode
- Config nằm trong config/
