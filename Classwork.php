<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub - Classwork</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- General Reset & Layout --- */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            height: 100vh; /* Full viewport height */
            display: flex;
            flex-direction: column; /* Stack header on top of body */
        }

        /* --- 1. Top Navigation Bar (Updated to match Dashboard.php) --- */
        header {
            background-color: white;
            padding: 0 40px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            flex-shrink: 0; /* Prevents header from shrinking */
            z-index: 10;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            font-size: 32px;
            color: #1a73e8; /* Blue color */
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #000;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            height: 100%;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #666;
            font-weight: 500;
            font-size: 16px;
            padding: 0 5px;
            position: relative;
            height: 100%;
        }

        .nav-item.active {
            color: #1a73e8;
        }

        /* Blue underline for active tab */
        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #1a73e8;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: right;
        }

        .profile-info h4 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-info span {
            font-size: 13px;
            color: #777;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background-color: #ddd;
            border-radius: 50%;
            background-image: url('https://i.pravatar.cc/150?img=11');
            background-size: cover;
        }

        /* --- 2. Main Layout (Sidebar + Content) --- */
        .app-layout {
            display: flex;
            flex: 1; /* Fills remaining height */
            overflow: hidden; /* Prevents double scrollbars */
        }

        /* --- Sidebar (Left Side) --- */
        .sidebar {
            width: 260px;
            background-color: white;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            padding: 24px 12px;
            flex-shrink: 0;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 24px;
            text-decoration: none;
            color: #5f6368;
            font-size: 15px;
            font-weight: 500;
            border-radius: 0 50px 50px 0; /* Rounded right side only */
            margin-bottom: 4px;
            transition: background 0.2s;
        }

        .sidebar-item:hover {
            background-color: #f5f5f5;
            color: #202124;
        }

        /* Active Sidebar Item Styling */
        .sidebar-item.active {
            background-color: #e8f0fe; /* Light blue background */
            color: #1a73e8; /* Blue text */
        }

        .sidebar-item i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        /* --- Content Area (Right Side) --- */
        .main-content {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto; /* Allows scrolling inside main area */
            background-color: #f5f7fa;
        }

        /* --- Create Button & Dropdown --- */
        .create-wrapper {
            width: fit-content;
            position: relative;
            margin-bottom: 30px;
        }

        summary.btn-create {
            list-style: none;
            background-color: #1a73e8;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
            width: fit-content;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        summary.btn-create:hover {
            background-color: #155db1;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        summary.btn-create::-webkit-details-marker { display: none; }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 8px;
            width: 220px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 8px 0;
            z-index: 1000;
            border: 1px solid #dadce0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            text-decoration: none;
            color: #3c4043;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.1s;
        }

        .dropdown-item:hover { background-color: #f5f5f5; }
        .dropdown-item i { color: #5f6368; width: 20px; text-align: center; }

    </style>
</head>
<body>

    <header>
        <div class="logo-section">
            <i class="fa-solid fa-book-open logo-icon"></i>
            <span class="logo-text">TechHub</span>
        </div>

        <nav class="nav-links">
            <a href="Dashboard.php" class="nav-item">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="Classwork.php" class="nav-item active">
                <i class="fa-solid fa-book"></i> Classwork
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-graduation-cap"></i> Gradebook
            </a>
        </nav>

        <div class="profile-section">
            <div class="profile-info">
                <h4>Prof. Jhomari Gandionco</h4>
                <span>Teacher</span>
            </div>
            <div class="avatar"></div>
        </div>
    </header>

   <div class="app-layout">
       
        <aside class="sidebar">
            <a href="#" class="sidebar-item">
                <i class="fa-regular fa-comment-dots"></i> Stream
            </a>
            <a href="#" class="sidebar-item active"> 
                <i class="fa-solid fa-clipboard-list"></i> Classwork
            </a>
            <a href="#" class="sidebar-item">
                <i class="fa-solid fa-user-group"></i> People
            </a>
            <a href="#" class="sidebar-item">
                <i class="fa-solid fa-chart-simple"></i> Marks
            </a>
        </aside>

        <main class="main-content">
            
            <div class="create-wrapper">
                <details>
                    <summary class="btn-create">
                        <i class="fa-solid fa-plus"></i> Create
                    </summary>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-file-pen"></i> Assignment</a>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-clipboard-question"></i> Quiz Assignment</a>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-question"></i> Question</a>
                        <div style="height: 1px; background: #dadce0; margin: 4px 0;"></div> 
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-book-open"></i> Material</a>
                        <a href="#" class="dropdown-item"><i class="fa-solid fa-repeat"></i> Reuse Post</a>
                    </div>
                </details>
            </div>

            <h2 style="color: #333; font-weight: 500;">Classwork Content</h2>
            <p style="color: #666;">This is where your assignment list will go.</p>

        </main>
   </div>

</body>
</html>