    
    <!DOCTYPE html>
    <html lang="bg">
    <head>
    <meta charset="UTF-8">
    <title>Интерактивен календар</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        margin-top: 20px;
        }
        .day {
        padding: 15px;
        text-align: center;
        border: 1px solid #ccc;
        cursor: pointer;
        border-radius: 6px;
        transition: 0.2s;
        }
        .day:hover {
        background-color: #f1f1f1;
        }
        .day.selected {
        background-color: #3498db;
        color: white;
        }
        .day.booked {
        background-color: #e74c3c;
        color: white;
        cursor: not-allowed;
        }
    </style>
    </head>
    <body class="container mt-4">
    <h2>Интерактивен календар</h2>
    <p>Избери свободни дни и натисни „Потвърди“:</p>
    
    <div id="calendar" class="calendar"></div>
    
    <button id="confirmBtn" class="btn btn-success mt-3">Потвърди резервация</button>
    
    <script>
        const calendarEl = document.getElementById("calendar");
        const confirmBtn = document.getElementById("confirmBtn");
    
        let bookedDays = [5, 6, 15]; 
        let selectedDays = [];
        
    
        for (let d = 1; d <= 30; d++) {
        const day = document.createElement("div");
        day.classList.add("day");
        day.textContent = d;
        
        if (bookedDays.includes(d)) {
            day.classList.add("booked");
        } else {
            day.addEventListener("click", () => {
            if (day.classList.contains("selected")) {
                day.classList.remove("selected");
                selectedDays = selectedDays.filter(num => num !== d);
            } else {
                day.classList.add("selected");
                selectedDays.push(d);
            }
            });
        }
        calendarEl.appendChild(day);
        }
        
        confirmBtn.addEventListener("click", () => {
        if (selectedDays.length === 0) {
            alert(" Не си избрал дати!");
        } else {

            let dates = selectedDays.join(",");
            window.location.href = "index.php?dates=" + encodeURIComponent(dates);
        }
        });
    </script>
    </body>
    </html>
