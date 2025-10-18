@php
$events = [
['slug' => 'slamet', 'name' => 'Slamet'],
['slug' => 'bios25', 'name' => 'Biosfer 2025'],
];
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .dashboard {
            text-align: center;
        }

        .title {
            font-weight: 600;
            font-size: 1rem;
            color: #555;
            margin-bottom: 25px;
        }

        .event-container {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .event-btn {
            min-width: 130px;
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .event-btn:hover {
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }
    </style>
</head>

<body>

    <div class="dashboard">
        <div class="title">🏁 Pilih Event Racetec</div>
        <div class="event-container">
            @foreach($events as $event)
            <a href="{{ route('event.page', $event['slug']) }}" class="event-btn">
                {{ $event['name'] }}
            </a>
            @endforeach
        </div>
    </div>

</body>

</html>