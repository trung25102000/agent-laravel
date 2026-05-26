# Notification Mail Rules

## Mục Tiêu

- Chuẩn hóa cách gửi mail, notification, và side effect giao tiếp với user.

## Quy Tắc

- Gửi mail hoặc notification nên đi qua Event, Listener, Job, Notification hoặc service phù hợp.
- Không nhét logic gửi mail trực tiếp vào controller nếu không thật sự nhỏ và đồng bộ là chấp nhận được.
- Nội dung mail/notification phải tách khỏi business flow chính.
- Các action gửi mail quan trọng nên có logging hoặc audit nếu phù hợp.
- Với tác vụ gửi hàng loạt hoặc chậm, ưu tiên queue.

## Checklist

- [ ] Mail/notification không bị nhét vào controller
- [ ] Side effect đã được tách riêng
- [ ] Gửi chậm hoặc hàng loạt đã cân nhắc queue
- [ ] Có log/audit khi cần
