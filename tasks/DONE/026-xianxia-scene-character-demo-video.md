# Task: Xianxia Scene Character Demo Video

## Status
completed

## Priority
critical

## Objective
Fix bug demo video hien tai qua tinh va khong co cam giac tung short/scene rieng. Thay demo preview hien tai bang mot video review truyen tien hiep co nhan vat minh hoa rieng cho tung canh, render thanh MP4 doc 9:16 xem duoc tren giao dien.

## Requirements
- Tao duoc mot project demo review truyen tien hiep cho user demo.
- Project co nhieu scene ngan, moi scene co noi dung review rieng.
- Moi scene phai co image asset rieng, co nhan vat/bo cuc khac nhau de video khong chi la nen mau tinh.
- Render MP4 that qua FFmpeg provider, dung output 1080x1920.
- Preview page phai play duoc video moi qua route protected hien co.
- Co command/co che co the chay lai demo nay khi can, khong phu thuoc tinker thu cong.
- Neu moi truong test khong co FFmpeg, command phai co che skip render de test duoc phan tao project/assets.
- Khong expose storage absolute path ra UI/API.
- Khong them secret hoac hard-code credential ngoai muc demo local ro rang.

## Files Expected
- `video-generator-app/app/Console/Commands/GenerateXianxiaReviewDemoCommand.php`
- `video-generator-app/app/Services/XianxiaReviewDemoService.php`
- `video-generator-app/tests/Feature/XianxiaReviewDemoCommandTest.php`
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`
- `.agents/memory/bugs.md`
- `.agents/context/decisions.md`

## Done When
- Command tao/cap nhat demo project va cac scene/assets thanh cong.
- Command co option skip render cho test.
- Chay command render that tao ra MP4 playable tren project preview.
- Project preview hien metadata dung duration/resolution/size.
- `composer dump-autoload`, `php artisan migrate`, `php artisan test` pass.
- Review agents security/testing/refactor/documentation pass.
