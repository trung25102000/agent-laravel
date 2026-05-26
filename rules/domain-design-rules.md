# Domain Design Rules

## Domain-first

- Code theo domain business
- Không code theo database trước

## Rich Domain

- Logic gần domain model
- Không tạo God Service

## Module Isolation

- Module độc lập tối đa

## Validation

- Validation tại request layer
- Business rule validation tại service/action

## Transaction

- Multi-write operation phải transaction

## Error Handling

- Custom exception rõ ràng
- Không throw exception chung chung

## Logging

- Action quan trọng phải log

## Security

- Validate toàn bộ input
- Escape output nếu cần
- Không trust client data
