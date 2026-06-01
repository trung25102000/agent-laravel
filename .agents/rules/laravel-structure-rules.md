# Laravel Structure Rules

## Folder Structure

Source Laravel phải nằm trong thư mục ứng dụng riêng:

video-generator-app/
    composer.json
    app/
    bootstrap/
    config/
    database/
    public/
    resources/
    routes/
    storage/
    tests/

Trong thư mục ứng dụng Laravel:

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

- Không đặt source Laravel trực tiếp ở root repo agent.
- Nếu chưa có thư mục ứng dụng, task foundation phải tạo `video-generator-app/` trước rồi bootstrap Laravel bên trong đó.
- File phải đặt đúng thư mục
- Không đặt sai responsibility
- Tôn trọng skeleton Laravel 13 hiện có. Không ép tạo lại cấu trúc cũ như `app/Http/Kernel.php` nếu project dùng cấu hình qua `bootstrap/app.php`.
- Middleware, exception handling, route registration, schedule, và provider bootstrap phải đặt theo pattern framework hiện tại.

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
- Runtime config đọc qua `config()`, không gọi `env()` ngoài file config.
