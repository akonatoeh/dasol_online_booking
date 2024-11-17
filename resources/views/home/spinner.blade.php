<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exciting Spinner</title>
    <style>
        /* Prevent scrolling during loading */
        body {
            margin: 0;
            overflow: hidden;
            background-color: #f8f9fa; /* Main background color */
        }

        /* Spinner container */
        .spinner-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Rotating spinner */
        .spinner {
            border: 10px solid rgba(255, 255, 255, 0.2);
            border-top: 10px solid #00d4ff;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Glowing text */
        .spinner-text {
            margin-top: 20px;
            font-size: 1.8em;
            font-weight: bold;
            color: #00d4ff;
            text-align: center;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff;
            animation: glow 1.5s infinite alternate;
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff, 0 0 15px #00d4ff;
            }
            100% {
                text-shadow: 0 0 20px #00f7ff, 0 0 30px #00f7ff, 0 0 40px #00f7ff;
            }
        }

        /* Restore body styling */
        body.loaded {
            overflow: auto; /* Allow scrolling */
        }

        /* Main content hidden initially */
        #main-content {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Spinner -->
    <div id="spinner" class="spinner-container">
        <div class="spinner"></div>
        <div class="spinner-text">LOADING...</div>
    </div>

    <script>
        window.addEventListener('load', function () {
            const spinner = document.getElementById('spinner');
            const mainContent = document.getElementById('main-content');

            // Hide spinner after 0.2 seconds
            setTimeout(() => {
                spinner.style.display = 'none'; // Hide spinner
                document.body.classList.add('loaded'); // Allow scrolling
                if (mainContent) {
                    mainContent.style.opacity = 1; // Fade in main content
                }
            }, 200); // 0.2 seconds
        });
    </script>
</body>
</html>
