# Yomi - AI-Powered Language Learning Platform

Yomi is an AI-powered text generator designed specifically for language learning. This application helps users improve their language skills through AI-generated content, interactive vocabulary tools, and engaging learning games.

## Features

### AI Text Generation
- Generate custom reading passages tailored to your language level
- Adjust content by topic, length, and difficulty
- Content available in multiple languages

### Interactive Dictionary
- Click on any word to see its definition, translation, and usage examples
- Pronunciation support
- Part of speech identification

### Personal Vocabulary Collection
- Save words to your personal collection for later review
- Add custom translations and notes
- Track learning progress with spaced repetition system

### Vocabulary Games
- Challenge friends to vocabulary contests
- Practice through various game modes
- Track your progress and scores

### Multi-Language Support
- Learn multiple languages simultaneously
- Native language names and translations
- Language-specific learning paths

## Tech Stack

### Backend
- Laravel 12
- PHP 8.2+
- PostgreSQL database
- Inertia.js for server-client communication

### Frontend
- Svelte 5
- TypeScript
- TailwindCSS
- Svelte-i18n for internationalization

## Project Structure

- `app/` - Laravel application code
  - `Models/` - Database models (User, Language, Passage, Vocabulary, etc.)
  - `Http/Controllers/` - Request handlers
  - `Enums/` - PHP enums for language levels (CEFR, JLPT, etc.)
- `resources/` - Frontend resources
  - `svelte/` - Svelte components and pages
  - `js/` - JavaScript/TypeScript utilities
  - `css/` - Stylesheets
- `database/` - Database migrations and seeders
- `routes/` - Application routes

## Getting Started

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- PostgreSQL

### Installation

1. Clone the repository
   ```bash
   git clone https://github.com/yourusername/yomi.git
   cd yomi
   ```

2. Install PHP dependencies
   ```bash
   composer install
   ```

3. Install JavaScript dependencies
   ```bash
   npm install
   ```

4. Copy the environment file and configure your database
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

5. Generate application key
   ```bash
   php artisan key:generate
   ```

6. Run database migrations
   ```bash
   php artisan migrate
   ```

7. Seed the database with initial data
   ```bash
   php artisan db:seed
   ```

### Development

Run the development server:
```bash
composer dev
```

This will start:
- Laravel server
- Queue worker
- Log watcher
- Vite development server

## Database Schema

The application uses several interconnected models:

- **User**: Application users
- **Language**: Supported languages with codes and native names
- **Passage**: AI-generated text passages with metadata
- **Vocabulary**: Words with translations, examples, and language information
- **UserVocabulary**: Junction table for users' saved vocabulary items
- **Challenge**: Vocabulary games between users

## Contributing

Contributions are welcome! This project is currently in active development as it's being ported from SvelteKit to Laravel/Inertia/Svelte5.

## License

[MIT License](LICENSE)
