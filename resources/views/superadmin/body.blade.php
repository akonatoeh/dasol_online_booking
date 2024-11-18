<!DOCTYPE html>
<html lang="en">
<head>
    

  <base href="/public">
    
    <style>
         .dashboard-container {
            max-width: 1500px;
            padding-left: 350px;
            padding-top: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .top-bar .office-selector {
            font-size: 16px;
        }

        .top-bar .export-button {
    background-color: #5864f5;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-left: auto; /* Push the button to the right */
    display: inline-block; /* Ensure it aligns properly */
}

        .dashboard-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            padding-right: 100px;
        }

        .card {
    flex: 2; /* Increase the flex value to make the card wider */
    background: #fff;
    border-radius: 8px; /* Add border-radius if needed */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 5px 15px; 
    margin-right: 50px; /* Reduce the margin to give more space for width */
    width: calc(100% - 20px); /* Optional: Ensure it takes up available space */
}

        .card .icon {
            font-size: 36px;
            color: #5864f5;
            margin-bottom: 10px;
        }

        .card h4 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .card p {
            font-size: 14px;
            color: #666;
        }

        .card .value {
            font-size: 32px;
            color: #333;
            margin-top: 10px;
        }

        .analytics {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 12px 14px rgba(0, 0, 0, 0.1);
            padding: 20px;
            
        }

        .analytics h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            width: 1000px;
        }

        .chart {
            height: 300px;
            background: #f4f7fc;
            display: flex;
            padding-left: 100px;
            justify-content: center;
            border: 2px dashed #ccc;
            color: #999;
            font-size: 16px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Top Bar -->
        <div class="top-bar">
            <button class="export-button" onclick="window.location.href='{{ route('export-bookings') }}'">
                Export Data
            </button>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <div class="icon">&#128197;</div>
                <h4>Total Tourists</h4>
                <p>as of {{ date('F d, Y') }}</p>
                <div class="value">{{ $totalTourists }}</div>
            </div>
            <div class="card">
                <div class="icon">&#128197;</div>
                <h4>Total Tourist Room Bookings</h4>
                <p>as of {{ date('F d, Y') }}</p>
                <div class="value">{{ $totalBooking }}</div>
            </div>
            <div class="card">
                <div class="icon">&#128197;</div>
                <h4>Total Tourist Other Services Bookings</h4>
                <p>as of {{ date('F d, Y') }}</p>
                <div class="value">{{ $totalBookingOthers }}</div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="analytics">
            <h3>Total Bookings per Month and Year</h3>
            <canvas id="bookingChart"></canvas>
        </div>
    </div>

    <script>
        // All months of the year
        const allMonths = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
    
        // Fetch the booking data from the backend
        const bookingData = @json($bookingData ?? []);
    
        // Create a mapping of month-year to total bookings
        const bookingMap = bookingData.reduce((map, data) => {
            map[data.month_year] = data.total;
            return map;
        }, {});
    
        // Get all unique months and years from the data
        const bookingYears = bookingData.map(data => {
            const [month, year] = data.month_year.split(" ");
            return { month, year: parseInt(year) };
        });
    
        // Determine the range of years to display
        const years = [...new Set(bookingYears.map(entry => entry.year))];
        const minYear = Math.min(...years);
        const maxYear = Math.max(...years);
    
        // Generate all months between the minYear and maxYear
        const labels = [];
        for (let year = minYear; year <= maxYear; year++) {
            allMonths.forEach(month => {
                labels.push(`${month} ${year}`);
            });
        }
    
        // Generate totals for all months, defaulting to 0 if no data exists
        const totals = labels.map(label => bookingMap[label] || 0);
    
        // Initialize the chart
        const ctx = document.getElementById('bookingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Bookings',
                    data: totals,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month and Year'
                        },
                        ticks: {
                            autoSkip: false, // Show all labels
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Bookings'
                        }
                    }
                }
            }
        });
    </script>
    
</body>
</html>
