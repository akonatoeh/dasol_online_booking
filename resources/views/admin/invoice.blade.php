<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        @page {
            size: 8.5in 14in; /* Long bond paper */
            margin: 0.5in;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0.5in; /* Consistent padding */
            line-height: 1.4;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .header p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed; /* Uniform column widths */
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px; /* Smaller font for compact table */
            text-align: left;
            word-wrap: break-word; /* Prevent overflow */
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
            text-align: center; /* Center-align headers */
        }

        .numeric {
            text-align: right; /* Right-align numerical data */
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .total span {
            color: #333;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #666;
        }

        .amount-cell {
            font-weight: bold;
            color: #008000;
        }

        .price-cell {
            color: #0000FF;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: blue">Room Bookings</h1>
        <h1>{{ $business_name }}</h1>
        <p>Date: {{ $date }}</p>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Ticket#</th>
                    <th>Room Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th class="numeric">Price per Room</th>
                    <th class="numeric">Occupied</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th class="numeric">Duration</th>
                    <th class="numeric">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['ticket'] }}</td>
                    <td>{{ $item['room_name'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['phone'] }}</td>
                    <td class="numeric">{{ number_format($item['price'], 2) }} PHP</td>
                    <td class="numeric">Rooms {{ $item['rooms'] }}</td>
                    <td>{{ $item['checkin_date'] }}</td>
                    <td>{{ $item['checkout_date'] }}</td>
                    <td class="numeric">{{ $item['duration'] }}</td>
                    <td class="numeric">{{ number_format($item['amount'], 2) }}PHP</td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>
</body>
</html>
