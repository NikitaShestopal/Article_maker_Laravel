<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>{{ $podcast['title'] }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 40px auto; padding: 0 20px; background-color: #f4f7f6; }
        .card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .category { display: inline-block; background: #3490dc; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8em; text-transform: uppercase; margin-bottom: 20px; }
        h1 { margin-top: 0; color: #111; font-size: 2.5em; }
        .meta { color: #777; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; }
        .content { font-size: 1.1em; color: #444; }

        /* Стилі для нижньої панелі з кнопками */
        .actions { display: flex; justify-content: space-between; align-items: center; margin-top: 30px; }
        .back-link { text-decoration: none; color: #3490dc; font-weight: bold; }
        .edit-btn {
            background: #f39c12;
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .edit-btn:hover { background: #e67e22; }
    </style>
</head>
<body>

<div class="card">
    <span class="category">{{ $podcast['category'] ?? 'Загальне' }}</span>

    <h1>{{ $podcast['title'] }}</h1>

    <div class="meta">
        <span>👤 <strong>Автор:</strong> {{ $podcast['author'] }}</span>
        <span>📅 <strong>Дата:</strong> {{ $podcast['date'] ?? 'Не вказана' }}</span>
    </div>

    <div class="content">
        <p>{{ $podcast['text'] ?? $podcast['description'] ?? '' }}</p>
    </div>

    <hr style="margin-top: 30px; border: 0; border-top: 1px solid #eee;">
    <small style="color: #999;">Внутрішній ID: {{ $podcast['id'] }}</small>
</div>

<div class="actions">
    <a href="/" class="back-link">← Назад до списку</a>
    <a href="/podcast/{{ $podcast['id'] }}/edit" class="edit-btn">📝 Редагувати статтю</a>
</div>

</body>
</html>
