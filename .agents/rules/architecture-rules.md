# Laravel Architecture Rules

AI phải tuân thủ kiến trúc Laravel chuẩn.

## Controller

- Controller phải mỏng
- Không chứa business logic lớn
- Chỉ:
  - nhận request
  - authorize
  - gọi service/action
  - return response

## Service / Action

- Logic nghiệp vụ phải đưa vào:
  - Services
  - Actions
  - UseCases
- Không viết logic phức tạp trong controller

## Repository

- Chỉ dùng Repository khi:
  - query phức tạp
  - nhiều nguồn dữ liệu
  - cần abstraction
- Không abuse repository pattern

## DTO

- Dùng DTO khi dữ liệu truyền phức tạp
- Không truyền array lồng nhau vô tội vạ

## Event / Listener

- Dùng Event khi:
  - xử lý async
  - side effects
  - gửi mail
  - log activity
  - notification
- Không gọi side-effect trực tiếp trong controller

## Job / Queue

- Task nặng phải dùng queue
- Không xử lý lâu trong request lifecycle

## Policy / Gate

- Mọi action mutate data phải authorize
- Không check role inline trong controller

## Resource

- API phải dùng API Resource
- Không return raw model

## Enum

- Các giá trị cố định phải dùng PHP Enum
Ví dụ:
- status
- role
- type
- payment state

## Cast

- Dùng cast cho:
  - json
  - datetime
  - money
  - enum

## Observer

- Dùng observer cho lifecycle logic:
  - creating
  - updating
  - deleting

## Trait

- Chỉ dùng trait cho reusable behavior thật sự
- Không nhét business logic lớn vào trait
