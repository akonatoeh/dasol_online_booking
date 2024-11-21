<!DOCTYPE html>
<html>
<head>
    <title>Tourists Per Day</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 1em;
            font-size: 12px;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            color: gray;
        }

        .total {
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $business_name }}</h1>
        <p>Date: {{ $date }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Ticket Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Foreigners</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item['ticket'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['phone'] }}</td>
                <td>{{ $item['adults'] }}</td>
                <td>{{ $item['children'] }}</td>
                <td>{{ $item['foreigners'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="total">Total Tourists: {{ $total_tourists }}</p>
</body>
</html>
