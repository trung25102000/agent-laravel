# Restructure Root Tree Report

## Mục tiêu

- Dọn gọn root tree để chỉ còn 2 thư mục dự án chính, `tasks/`, `.agents/`, `.codex/`, và các file root cần thiết.
- Gom toàn bộ markdown hướng dẫn agent/code assistant vào `.agents/` hoặc `.codex/`.
- Không làm mất nội dung file và không ghi đè file khi move.

## Cấu trúc trước khi sửa

Root directories:

- `.agents/`
- `.codex/`
- `agents/`
- `context/`
- `memory/`
- `prompts/`
- `rules/`
- `seo-web-app/`
- `tasks/`
- `video-generator-app/`

Root markdown files:

- `AGENTS.md`
- `README.md`
- `seo-web-app/README.md`
- `tasks/000-ai-video-platform-master-plan.md`
- `video-generator-app/README.md`

## File đã move vào .agents

- `AGENTS.md` -> `.agents/AGENTS.md`
- `agents/api-contract-agent.md`
- `agents/database-agent.md`
- `agents/devops-agent.md`
- `agents/documentation-agent.md`
- `agents/refactor-agent.md`
- `agents/security-agent.md`
- `agents/testing-agent.md`
- `context/database-schema.md`
- `context/decisions.md`
- `context/project-context.md`
- `context/routes-map.md`
- `context/source-separation-plan.md`
- `memory/bugs.md`
- `memory/changelog.md`
- `memory/progress.md`
- `rules/agent-workflow.md`
- `rules/api-rules.md`
- `rules/architecture-rules.md`
- `rules/authorization-rules.md`
- `rules/database-rules.md`
- `rules/deployment-rules.md`
- `rules/documentation-rules.md`
- `rules/domain-design-rules.md`
- `rules/error-handling-rules.md`
- `rules/frontend-rules.md`
- `rules/git-workflow-rules.md`
- `rules/laravel-code-rules.md`
- `rules/laravel-structure-rules.md`
- `rules/logging-rules.md`
- `rules/naming-convention-rules.md`
- `rules/notification-mail-rules.md`
- `rules/performance-rules.md`
- `rules/platform-version-rules.md`
- `rules/queue-job-rules.md`
- `rules/security-rules.md`
- `rules/solid-principles-rules.md`
- `rules/testing-rules.md`

## File đã move vào .codex

- `prompts/continue.md` -> `.codex/prompts/continue.md`
- `prompts/review.md` -> `.codex/prompts/review.md`
- `prompts/start.md` -> `.codex/prompts/start.md`

## File đã move vào tasks

- Không có file markdown nghiệp vụ mới cần move vào `tasks/`.
- Report này được tạo mới tại `tasks/restructure-root-tree-report.md`.

## File giữ nguyên ở root

- `README.md`
- `seo-web-app/README.md`
- `video-generator-app/README.md`
- `tasks/000-ai-video-platform-master-plan.md`

## File chưa chắc chắn nên chưa move

- Không có file markdown mơ hồ nào còn lại ở root sau khi phân loại.

## Link/path đã cập nhật

- Cập nhật tham chiếu từ `AGENTS.md` sang `.agents/AGENTS.md`.
- Cập nhật các path `rules/`, `context/`, `memory/`, `agents/`, `prompts/` sang `.agents/...` hoặc `.codex/...` trong:
  - `README.md`
  - `.agents/AGENTS.md`
  - `.codex/prompts/*.md`
  - `.agents/agents/*.md`
  - `.agents/context/*.md`
  - `.agents/rules/*.md`
  - `tasks/**/*.md`

## Cấu trúc sau khi sửa

Root directories:

- `.agents/`
- `.codex/`
- `seo-web-app/`
- `tasks/`
- `video-generator-app/`

Root markdown files:

- `README.md`
- `seo-web-app/README.md`
- `tasks/000-ai-video-platform-master-plan.md`
- `tasks/restructure-root-tree-report.md`
- `video-generator-app/README.md`

## Ghi chú rủi ro nếu có

- Hai thư mục `.agents/` và `.codex/` trong môi trường hiện tại bị sandbox map thành read-only, nên việc move/copy vào đó phải thực hiện bằng lệnh escalated.
- Validation không phát hiện issue từ thay đổi tree ở `seo-web-app`; app pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test`.
- `video-generator-app` vẫn còn 2 vấn đề môi trường có sẵn, không do task này tạo ra:
  - `composer dump-autoload` thường fail vì PHP CLI hiện tại là `8.3.6` trong khi dependency yêu cầu `>= 8.4.0`; workaround là `--ignore-platform-req=php`.
  - `php artisan test` fail 3 test `XianxiaReviewDemoCommandTest` vì thiếu GD extension (`imagecreatetruecolor` không tồn tại).
