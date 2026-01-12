<?php
session_start();
// Security Check
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'teacher') {
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- General Reset --- */
        body { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f5f7fa; color: #333; }
        * { box-sizing: border-box; }

        /* --- HEADER STYLES --- */
        header {
            background-color: white;
            padding: 0 40px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            position: sticky; top: 0; z-index: 100;
        }

        .logo-section { display: flex; align-items: center; gap: 10px; width: 250px; }
        .logo-icon { font-size: 32px; color: #1a73e8; }
        .logo-text { font-size: 24px; font-weight: 700; color: #000; }

        .nav-links { display: flex; gap: 30px; height: 100%; }
        
        .nav-item {
            display: flex; align-items: center; gap: 8px;
            text-decoration: none; color: #666;
            font-weight: 500; font-size: 16px;
            padding: 0 5px; position: relative; height: 100%;
            cursor: pointer;
        }

        .nav-item:hover { color: #1a73e8; }
        .nav-item.active { color: #1a73e8; }
        .nav-item.active::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 100%; height: 3px; background-color: #1a73e8;
        }

        .profile-section { display: flex; align-items: center; gap: 12px; text-align: right; width: 250px; justify-content: flex-end; }
        .profile-info h4 { margin: 0; font-size: 15px; font-weight: 600; color: #333; }
        .profile-info span { font-size: 13px; color: #777; display: block; }
        .avatar {
            width: 40px; height: 40px; background-color: #ddd;
            border-radius: 50%;
            background-image: url('https://ui-avatars.com/api/?name=Jhomari+Gandionco&background=0D8ABC&color=fff');
            background-size: cover;
        }

        /* --- DASHBOARD LAYOUT --- */
        main { max-width: 1200px; margin: 30px auto; padding: 0 20px; }

        .class-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .class-card { background: transparent; cursor: pointer; transition: transform 0.2s; }
        .class-card:hover { transform: translateY(-3px); }
        .class-image { width: 100%; height: 160px; background-color: #ddd; border-radius: 20px; overflow: hidden; margin-bottom: 8px; }
        .class-image img { width: 100%; height: 100%; object-fit: cover; }
        .class-title { font-size: 13px; font-weight: 700; text-transform: uppercase; color: #000; padding-left: 5px; }

        .widgets-container { display: grid; grid-template-columns: 1.5fr 0.8fr 1fr; gap: 20px; align-items: start; }
        
        .widget-card { background: white; border-radius: 12px; padding: 20px; border: 1px solid #e0e0e0; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .widget-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .widget-header h3 { margin: 0; font-size: 18px; font-weight: 500; }
        .widget-header a { font-size: 13px; color: #999; text-decoration: none; }

        .activity-list { list-style: none; padding: 0; margin: 0; }
        .activity-item { display: flex; gap: 15px; margin-bottom: 20px; }
        .activity-avatar { width: 35px; height: 35px; border-radius: 50%; background-color: #eee; }
        .activity-details p { margin: 0 0 5px 0; font-size: 14px; color: #333; }
        .activity-details span { color: #27ae60; font-weight: 600; }
        .activity-meta { font-size: 12px; color: #999; }

        .stats-column { display: flex; flex-direction: column; gap: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid #e0e0e0; display: flex; flex-direction: column; justify-content: center; }
        .stat-icon { font-size: 24px; color: #555; margin-bottom: 10px; }
        .stat-label { font-size: 12px; color: #666; margin-bottom: 5px; }
        .stat-number { font-size: 32px; font-weight: 700; color: #333; }

        /* --- UPDATED CALENDAR STYLES --- */
        .calendar-card { background: white; border-radius: 1px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .calendar-header { background-color: #000; color: white; padding: 15px; display: flex; justify-content: space-between; align-items: center; }
        .calendar-header h3 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; padding: 15px; background: white; }
        .day-name { font-size: 10px; color: #888; margin-bottom: 10px; font-weight: 700; }
        
        .date { 
            font-size: 14px; padding: 8px; color: #333; 
            border-radius: 50%; width: 35px; height: 35px; 
            display: flex; align-items: center; justify-content: center; margin: 2px auto;
        }
        
        /* Highlight for Today */
        .date.today {
            background-color: #1a73e8;
            color: white;
            font-weight: bold;
        }
        .date.empty { pointer-events: none; }
    </style>
</head>
<body>

    <header>
        <div class="logo-section">
            <i class="fa-solid fa-book-open logo-icon"></i>
            <span class="logo-text">TechHub</span>
        </div>
        <nav class="nav-links">
            <a href="dashboard.php" class="nav-item active"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="classwork.php" class="nav-item"><i class="fa-solid fa-book"></i> Classes</a>
            <a href="gradebook.php" class="nav-item"><i class="fa-solid fa-graduation-cap"></i> Gradebook</a>
        </nav>
        <div class="profile-section">
            <div class="profile-info">
                <h4>Prof. Jhomari Gandionco</h4>
                <span>Teacher</span>
            </div>
            <div class="avatar"></div>
        </div>
    </header>

    <main>
        <div class="class-grid">
            <div class="class-card" onclick="window.location.href='classwork.php'">
                <div class="class-image"><img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Classroom"></div>
                <div class="class-title">CLASS BSIT 4-1 PROGRAMMING</div>
            </div>
            <div class="class-card">
                <div class="class-image"><img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Classroom"></div>
                <div class="class-title">CLASS BSIT 3-1 PROGRAMMING</div>
            </div>
            <div class="class-card">
                <div class="class-image"><img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Classroom"></div>
                <div class="class-title">CLASS BSIT 2-1 PROGRAMMING</div>
            </div>
        </div>

        <div class="widgets-container">
            <div class="widget-card">
                <div class="widget-header"><h3>Recent Student Activity</h3><a href="#">View All</a></div>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-avatar"></div>
                        <div class="activity-details"><p><strong>Jho</strong> submitted <span>Lab Report</span></p><div class="activity-meta">BSIT 3-1 Programming Dec 4, 2025 11:50 PM</div></div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-avatar"></div>
                        <div class="activity-details"><p><strong>Jho</strong> submitted <span>Lab Report</span></p><div class="activity-meta">BSIT 3-1 Programming Dec 4, 2025 11:45 PM</div></div>
                    </li>
                </ul>
            </div>

            <div class="stats-column">
                <div class="stat-card">
                    <i class="fa-regular fa-clock stat-icon"></i>
                    <div class="stat-label">Number of Upcoming</div>
                    <div class="stat-number">6</div>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-user-graduate stat-icon"></i>
                    <div class="stat-label">Number of Students</div>
                    <div class="stat-number">109</div>
                </div>
            </div>

            <div class="calendar-card">
                <div class="calendar-header">
                    <h3 id="calMonth">MONTH</h3>
                    <span id="calYear">YEAR</span>
                </div>
                <div class="calendar-grid" id="calGrid">
                    <div class="day-name">S</div><div class="day-name">M</div><div class="day-name">T</div><div class="day-name">W</div><div class="day-name">T</div><div class="day-name">F</div><div class="day-name">S</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const date = new Date();
        const currYear = date.getFullYear();
        const currMonth = date.getMonth(); // 0-11

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        // 1. Update Header
        document.getElementById('calMonth').innerText = months[currMonth];
        document.getElementById('calYear').innerText = currYear;

        // 2. Render Days
        const grid = document.getElementById('calGrid');
        
        // Get first day of month (0 = Sun, 1 = Mon...)
        const firstDay = new Date(currYear, currMonth, 1).getDay();
        // Get last date of month (28, 30, 31)
        const lastDate = new Date(currYear, currMonth + 1, 0).getDate();
        // Today's date for highlighting
        const today = date.getDate();

        // Create empty slots for days before the 1st
        for(let i = 0; i < firstDay; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'date empty';
            grid.appendChild(emptyDiv);
        }

        // Create actual days
        for(let i = 1; i <= lastDate; i++) {
            const dateDiv = document.createElement('div');
            dateDiv.className = 'date';
            dateDiv.innerText = i;

            // Highlight today
            if(i === today) {
                dateDiv.classList.add('today');
            }

            grid.appendChild(dateDiv);
        }
    </script>
</body>
</html>