<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Публікації та Дровер</title>
    @livewireStyles
    <style>
        /* Основні стилі */
        body { background-color: #f8fafc; margin: 0; padding-bottom: 50px; font-family: 'Segoe UI', sans-serif; }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 0.95em;
        }
        input:focus, textarea:focus {
            border-color: #3490dc;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 144, 220, 0.2);
        }
        button.submit-btn {
            width: 100%;
            background: #222;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        button.submit-btn:hover { background: #444; }

        /* Стилі Дровера */
        .drawer-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            z-index: 1000;
            backdrop-filter: blur(2px);
        }
        .drawer {
            position: fixed;
            top: 0;
            right: -450px; /* Початково схований */
            width: 400px;
            max-width: 90%;
            height: 100%;
            background: white;
            box-shadow: -5px 0 25px rgba(0,0,0,0.15);
            transition: right 0.4s cubic-bezier(0.05, 0.74, 0.2, 0.99);
            padding: 30px;
            z-index: 1001;
            box-sizing: border-box;
            overflow-y: auto;
        }
        .drawer.open { right: 0; }
        .drawer-overlay.show { display: block; }

        .close-drawer {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #888;
        }

        /* Плаваюча кнопка + */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #3490dc;
            color: white;
            border-radius: 50%;
            border: none;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(52, 144, 220, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            transition: transform 0.2s, background 0.2s;
        }
        .fab:hover { transform: scale(1.1); background: #2779bd; }
    </style>
</head>
<body>

<div class="articles-container">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">

        <h1 style="text-align: center; color: #222; margin: 40px 0;">Останні публікації</h1>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($allArticles as $article)
                <div style="border: 1px solid #eee; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); background: #fff; display: flex; flex-direction: column;">
                    <span style="align-self: flex-start; font-size: 0.7em; background: #e0f2f1; color: #00796b; padding: 3px 8px; border-radius: 10px; text-transform: uppercase; font-weight: bold;">
                        {{ $article['category'] }}
                    </span>

                    <h2 style="font-size: 1.25em; margin: 15px 0 10px 0; color: #111;">{{ $article['title'] }}</h2>

                    <p style="color: #555; line-height: 1.5; font-size: 0.95em; flex-grow: 1;">
                        {{ Str::limit($article['text'] ?? $article['description'], 100) }}
                    </p>

                    <div style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 10px; display: flex; justify-content: space-between; align-items: center; font-size: 0.8em; color: #888;">
                        <span>✍️ {{ $article['author'] }}</span>
                        <span>📅 {{ $article['date'] ?? date('d.m.Y') }}</span>
                    </div>

                    <div style="display: flex; gap: 10px; margin-top: 15px;">
                        <a href="/podcast/{{ $article['id'] }}"
                           style="flex: 2; text-align: center; background: #3490dc; color: white; padding: 10px; text-decoration: none; border-radius: 5px; font-weight: 500;">
                            Читати далі
                        </a>

                        <a href="/podcast/{{ $article['id'] }}/edit"
                           style="flex: 1; text-align: center; background: #f39c12; color: white; padding: 10px; text-decoration: none; border-radius: 5px; font-weight: 500;">
                            ⚙️
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<button class="fab" onclick="openDrawer()">+</button>

<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawerContent">
    <button class="close-drawer" onclick="closeDrawer()">&times;</button>

    <h3 style="margin-top: 0; color: #333; margin-bottom: 5px;">🆕 Нова публікація</h3>
    <p style="color: #777; font-size: 0.9em; margin-bottom: 25px;">Заповніть форму, щоб додати статтю до списку.</p>

    <form action="/newproduct" method="POST">
        @csrf
        <label style="font-size: 0.85em; color: #666; font-weight: bold;">Назва продукту</label>
        <input type="text" name="title" placeholder="Наприклад: Основи Laravel" required>

        <label style="font-size: 0.85em; color: #666; font-weight: bold;">Автор</label>
        <input type="text" name="author" placeholder="Ваше ім'я" required>

        <label style="font-size: 0.85em; color: #666; font-weight: bold;">Категорія</label>
        <input type="text" name="category" placeholder="Backend, Поради тощо" required>

        <label style="font-size: 0.85em; color: #666; font-weight: bold;">Опис / Текст</label>
        <textarea name="description" rows="6" placeholder="Про що цей пост?" style="font-family: inherit;"></textarea>

        <button type="submit" class="submit-btn">Опублікувати статтю</button>
    </form>
</div>

<script>
    function openDrawer() {
        document.getElementById('drawerContent').classList.add('open');
        document.getElementById('drawerOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        document.getElementById('drawerContent').classList.remove('open');
        document.getElementById('drawerOverlay').classList.remove('show');
        document.body.style.overflow = 'auto';
    }
</script>

@livewireScripts
</body>
</html>
