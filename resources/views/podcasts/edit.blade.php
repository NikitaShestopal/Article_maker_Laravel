<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагування: {{ $podcast['title'] }}</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 40px auto; padding: 0 20px; background-color: #f4f7f6; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #111; font-size: 1.8em; text-align: center; }
        label { display: block; margin-top: 15px; font-weight: bold; font-size: 0.9em; color: #666; }
        input, textarea { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 1em; }
        textarea { height: 150px; resize: vertical; }
        .btn-group { margin-top: 25px; display: flex; gap: 10px; }
        .submit-btn { flex: 2; background: #27ae60; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .back-btn { flex: 1; background: #95a5a6; color: white; padding: 12px; text-decoration: none; text-align: center; border-radius: 6px; font-weight: bold; }
        .submit-btn:hover { background: #219150; }
    </style>
</head>
<body>

<div class="card">
    <h1>📝 Редагувати публікацію</h1>

    <form action="/podcast/{{ $podcast['id'] }}/edit" method="POST">
        @csrf

        <label>Назва статті</label>
        <input type="text" name="title" value="{{ $podcast['title'] }}" required>

        <label>Автор</label>
        <input type="text" name="author" value="{{ $podcast['author'] }}" required>

        <label>Категорія</label>
        <input type="text" name="category" value="{{ $podcast['category'] ?? '' }}" required>

        <label>Текст статті / Опис</label>
        <textarea name="description">{{ $podcast['text'] ?? $podcast['description'] ?? '' }}</textarea>

        <div class="btn-group">
            <a href="/" class="back-btn">Скасувати</a>
            <button type="submit" class="submit-btn">Зберегти зміни</button>
        </div>
    </form>
</div>

</body>
</html>
