# Frontend Rules

## Mục Tiêu

- Giữ giao diện nhất quán, an toàn, dễ maintain khi task đụng tới Blade, Livewire, Inertia, Vue, React hoặc asset frontend.

## Quy Tắc

- Không trộn business logic backend vào view.
- Escape output mặc định khi render dữ liệu user-generated.
- Reuse component hoặc partial thay vì lặp UI.
- Form phải hiển thị validation error rõ ràng.
- Route/action từ frontend phải bám contract backend hiện có.
- Không hard-code URL, token, secret vào asset frontend.
- Tối ưu bundle, asset, và request khi thay đổi frontend lớn.
- Dùng Vite cho asset build trong Laravel 13; không thêm Laravel Mix cho code mới.
- Nếu dùng starter kit, ưu tiên starter kit chính thức tương thích Laravel 13 và giữ UI phù hợp MVP.

## Checklist

- [ ] View không chứa business logic lớn
- [ ] Output đã escape an toàn
- [ ] Validation error hiển thị rõ
- [ ] Không hard-code secret/url nhạy cảm
- [ ] Component được tái sử dụng hợp lý
