# Contributing to Laravel Portfolio CMS

Thank you for your interest in contributing! This project is open source under the MIT license, and contributions of all sizes are welcome.

## Ways to Contribute

- Reporting bugs and security issues
- Suggesting new features or improvements
- Improving documentation
- Submitting pull requests with bug fixes or features

## How to Report a Bug

Open a GitHub Issue and include:

1. A clear, descriptive title
2. The steps to reproduce the problem
3. What you expected to happen and what actually happened
4. Your environment (PHP version, Laravel version, database, browser)

**Never report security vulnerabilities in public issues.** Email [sultanbayezidai@gmail.com](mailto:sultanbayezidai@gmail.com) instead.

## Development Setup

```bash
git clone https://github.com/SultanBayezid/Laravel-Portfolio-CMS.git
cd Laravel-Portfolio-CMS
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=PortfolioSeeder
php artisan serve
```

## Pull Request Process

1. Fork the repository and create a feature branch from `main`:
   `git checkout -b feature/my-feature`
2. Keep changes focused — one feature or fix per pull request.
3. Follow the existing code style (PSR-12 for PHP, Laravel conventions for Blade).
4. Make sure the application still installs and migrates cleanly from scratch (`composer install`, `php artisan migrate`, seed).
5. Do not commit `.env`, database dumps, `vendor/` or `node_modules/`.
6. Open a pull request with a clear description of what changed and why.

## Code Style

- PHP: PSR-12, Laravel framework conventions.
- Blade: keep templates readable; reuse the existing partial structure under `resources/views/partials/`.
- Commit messages: short imperative summary line, e.g. `Add dark mode default to settings`.

## License

By contributing, you agree that your contributions will be licensed under the MIT License of this repository.
