# UX Writing Review Report

## Tổng quan

Website đã có nhiều nội dung hỗ trợ bán dịch vụ, nhưng text hiển thị cho người dùng vẫn còn pha trộn giữa ngôn ngữ bán hàng, ngôn ngữ kỹ thuật và ngôn ngữ nội bộ. Vấn đề lớn nhất là khách mới có thể hiểu "có nhiều thứ để làm", nhưng chưa luôn thấy rõ "mình sẽ nhận được gì" và "nên bấm vào đâu tiếp theo".

Ưu tiên chỉnh sửa là:

- giảm từ ngữ developer như `technical support`, `scope`, `API`, `DB`, `outcome`, `delivery board`
- đổi CTA chung chung sang CTA nêu rõ hành động và lợi ích
- rút gọn các đoạn mô tả quá dài
- đồng nhất giọng văn thân thiện, chuyên nghiệp, dễ hiểu

## Text chưa phù hợp

| Vị trí | Text hiện tại | Vấn đề |
|---------|---------------|---------|
| Home Hero | `Website, SEO và support kỹ thuật cho nhu cầu cần chốt nhanh` | Pha tiếng Anh, khó gần, thiên nội bộ |
| Home Hero | `Làm website, sửa web và xử lý task kỹ thuật với scope rõ ràng.` | Có từ `task kỹ thuật`, `scope` mang tính developer |
| Home visual | `Agency Delivery Board`, `Delivery snapshot`, `Live composition`, `Conversion pulse` | Không tạo giá trị cho khách hàng mới |
| Home visual | `$ web: ...`, `$ fix: ...`, `$ support: seo, api, db...` | Quá kỹ thuật, giống dashboard nội bộ |
| Header/Footer | `task code`, `scope`, `brief`, `Source + support` | Không tự nhiên với khách hàng phổ thông |
| Services page | `Dịch vụ web, code, app, SEO và hỗ trợ kỹ thuật theo nhu cầu.` | Quá rộng, chưa nhấn mạnh lợi ích |
| Portfolio | `giải pháp kỹ thuật`, `Role + outcome + demo`, `Outcome đạt được` | Pha tiếng Anh, nặng thuật ngữ |
| Blog | `technical support`, `brief kỹ thuật`, `internal link`, `UI`, `CTA` | Mang ngôn ngữ triển khai nội bộ |
| Source code page | `Xem source`, `Admin có thể đính kèm source...` | Câu chữ thiên quản trị, chưa hướng khách hàng |
| Template/Source form | `Tên sinh viên`, `Yêu cầu chỉnh sửa`, `Đặt làm đồ án` | Có chỗ chưa đủ rõ lợi ích hoặc ngữ cảnh |
| Login page | `Đăng nhập để quản lý khách hàng và đơn dịch vụ.` | Giọng admin, không thân thiện với người dùng thường |
| Validation/Auth | `These credentials do not match our records.` | Sai ngôn ngữ website |

## Đề xuất thay thế

| Text cũ | Text mới | Lý do |
|----------|-----------|--------|
| `support kỹ thuật` | `hỗ trợ xử lý phần việc khó` | Dễ hiểu hơn với khách hàng |
| `scope rõ ràng` | `phạm vi công việc rõ ràng` | Thuần Việt, ít nội bộ hơn |
| `task code` | `phần việc lập trình` | Gần ngôn ngữ khách hàng hơn |
| `technical support` | `hỗ trợ triển khai` hoặc `hỗ trợ xử lý website` | Giảm chất developer |
| `Outcome đạt được` | `Kết quả nhận được` | Thuần Việt, rõ nghĩa |
| `Xem source` | `Xem chi tiết` | Ít kỹ thuật hơn |
| `Submit`/`Learn more` kiểu chung chung | `Nhận tư vấn miễn phí`, `Xem dự án tương tự`, `Gửi yêu cầu tư vấn` | CTA rõ hành động |
| `brief` | `mô tả nhu cầu` | Khách hàng dễ hiểu hơn |
| `Chốt scope` | `Thống nhất công việc` | Tự nhiên hơn |
| `support` | `hỗ trợ` | Đồng nhất tiếng Việt |

## CTA cần thay đổi

- `Nhận tư vấn` -> `Nhận tư vấn miễn phí`
- `Xem source` -> `Xem chi tiết`
- `Đặt làm đồ án` -> `Nhận tư vấn cho đề tài này`
- `Gửi brief qua Facebook` -> `Nhắn Facebook để trao đổi nhu cầu`
- `Gửi scope dài qua Email` -> `Gửi yêu cầu chi tiết qua email`

## Hero Section cần thay đổi

- Nói rõ ngay website giúp ai: shop nhỏ, cá nhân, sinh viên, khách cần sửa web hoặc SEO
- Giảm buzzword kỹ thuật trong hero
- Hero chỉ nên trả lời 3 câu hỏi:
  - Website này làm gì?
  - Dành cho ai?
  - Tôi nên bấm vào đâu tiếp theo?

## Form cần thay đổi

- `Tên của bạn` -> `Họ và tên`
- `Công nghệ liên quan nếu có...` -> `Website đang dùng nền tảng nào?`
- `Mô tả ngắn vấn đề chính...` -> `Mô tả nhu cầu của bạn`
- Hiển thị loại nhu cầu đang chọn bằng nhãn dễ hiểu thay vì key hệ thống

## Message cần thay đổi

- Toàn bộ success message nên ngắn, rõ bước tiếp theo
- Auth error và validation message cần đổi sang tiếng Việt tự nhiên

## Empty State cần thay đổi

- `Admin có thể đính kèm...` -> `Tài liệu mẫu sẽ được gửi kèm khi dự án có sẵn`
- Các trạng thái trống cần viết theo góc nhìn người dùng, không phải admin
