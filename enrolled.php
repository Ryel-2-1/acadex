<?php
// --- 1. DEFINE YOUR CLASS DATA HERE ---
// This acts like a mini-database. You can add as many subjects as you want here.

$subject_id = $_GET['subject'] ?? 'art'; // Default to 'art' if nothing is clicked

$classes = [
    'art' => [
        'name' => 'Art Appreciation',
        'title' => 'Art Appreciation (BSIT 3-1)',
        'section' => 'BSIT 3-1',
        'banner_img' => 'https://gstatic.com/classroom/themes/img_read.jpg',
        'theme_color' => '#c5221f',
        'sidebar_bg' => '#fce8e6', // Light red background for sidebar active state
        'posts' => [
            [
                'author' => 'Prof. Jhomari Gandionco',
                'action' => 'posted a new material: Lecture 3 - Module',
                'date' => 'Yesterday',
                'icon' => 'fa-book-bookmark'
            ],
            [
                'author' => 'Prof. Jhomari Gandionco',
                'action' => 'posted a new assignment: Group Presentation',
                'date' => 'Dec 4, 2025',
                'icon' => 'fa-clipboard-list'
            ]
        ]
    ],
    'web' => [
        'name' => 'Web Development',
        'title' => 'Web Development (BSIT 3-1)',
        'section' => 'BSIT 3-1',
        'banner_img' => 'https://gstatic.com/classroom/themes/img_code.jpg',
        'theme_color' => '#00796b',
        'sidebar_bg' => '#e0f2f1', // Light teal background
        'posts' => [
            [
                'author' => 'Prof. Jhomari Gandionco',
                'action' => 'posted a new material: Github Repository Setup',
                'date' => '10:45 AM',
                'icon' => 'fa-code'
            ],
            [
                'author' => 'Prof. Jhomari Gandionco',
                'action' => 'posted a new assignment: Personal Portfolio',
                'date' => 'Yesterday',
                'icon' => 'fa-clipboard-list'
            ]
        ]
    ],
    'db' => [
        'name' => 'Database Admin',
        'title' => 'Database Administration (BSIT 3-1)',
        'section' => 'BSIT 3-1',
        'banner_img' => 'https://gstatic.com/classroom/themes/img_breakfast.jpg',
        'theme_color' => '#e65100',
        'sidebar_bg' => '#ffe0b2',
        'posts' => [] // No posts yet
    ]
];

// Get current class data, or default to Art if ID not found
$current = $classes[$subject_id] ?? $classes['art'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub - <?php echo $current['name']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- General CSS (Same as before) --- */
        body { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7fa; color: #333; height: 100vh; display: flex; flex-direction: column; }
        header { background-color: white; padding: 0 24px; height: 64px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e0e0e0; flex-shrink: 0; z-index: 10; }
        .header-left { display: flex; align-items: center; gap: 16px; }
        .hamburger-btn { font-size: 20px; color: #5f6368; cursor: pointer; padding: 8px; border-radius: 50%; }
        .hamburger-btn:hover { background-color: #f0f0f0; }
        .logo-section { display: flex; align-items: center; gap: 10px; }
        .logo-icon { font-size: 28px; color: #1a73e8; }
        .logo-text { font-size: 22px; font-weight: 500; color: #5f6368; }
        .header-right { display: flex; align-items: center; gap: 16px; }
        .icon-btn { font-size: 20px; color: #5f6368; cursor: pointer; padding: 8px; border-radius: 50%; }
        .icon-btn:hover { background-color: #f0f0f0; }
        .avatar { width: 32px; height: 32px; background-color: #ddd; border-radius: 50%; background-image: url('https://i.pravatar.cc/150?img=12'); background-size: cover; cursor: pointer; }
        .app-layout { display: flex; flex: 1; overflow: hidden; }
        .sidebar { width: 280px; background-color: white; display: flex; flex-direction: column; padding: 12px 0; flex-shrink: 0; overflow-y: auto; border-right: 1px solid transparent; }
        .sidebar-item { display: flex; align-items: center; gap: 18px; padding: 10px 24px; text-decoration: none; color: #3c4043; font-size: 14px; font-weight: 500; border-radius: 0 24px 24px 0; margin-right: 8px; margin-bottom: 2px; transition: background 0.2s; cursor: pointer; position: relative; }
        .sidebar-item:hover { background-color: #f5f5f5; }
        .sidebar-item.active { background-color: #e8f0fe; color: #1967d2; }
        .sidebar-item.active i { color: #1967d2; }
        .sidebar-item i { width: 20px; text-align: center; font-size: 18px; color: #5f6368; }
        .dropdown-toggle { justify-content: space-between; }
        .toggle-content { display: flex; align-items: center; gap: 18px; }
        .chevron-icon { font-size: 12px !important; transition: transform 0.3s ease; }
        .submenu-container { display: block; overflow: hidden; }
        
        /* Indented Sub Items */
        .sub-item { padding-left: 64px; font-size: 13px; }

        /* Dynamic Active Class for Sub Items */
        .sub-item.active-class {
            font-weight: 600;
        }

        .sidebar-divider { height: 1px; background-color: #e0e0e0; margin: 10px 0; }
        .main-content { flex: 1; padding: 24px; overflow-y: auto; background-color: white; }
        .content-container { max-width: 1000px; margin: 0 auto; }
        .class-nav-tabs { display: flex; border-bottom: 1px solid #e0e0e0; margin-bottom: 20px; }
        .nav-tab { padding: 16px 24px; text-decoration: none; color: #5f6368; font-weight: 500; font-size: 14px; position: relative; }
        .nav-tab:hover { background-color: #f5f5f5; color: #202124; }
        .nav-tab.active { color: #1967d2; }
        .nav-tab.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background-color: #1967d2; border-top-left-radius: 4px; border-top-right-radius: 4px; }
        
        /* Dynamic Banner Image */
        .banner { height: 240px; background-size: cover; background-position: center; border-radius: 8px; position: relative; margin-bottom: 24px; padding: 24px; display: flex; flex-direction: column; justify-content: flex-end; color: white; }
        .banner h1 { margin: 0; font-size: 36px; font-weight: 600; }
        .banner p { margin: 4px 0 0 0; font-size: 16px; font-weight: 500; }
        .info-btn { position: absolute; bottom: 16px; right: 16px; color: white; cursor: pointer; }
        
        .stream-layout { display: grid; grid-template-columns: 200px 1fr; gap: 24px; }
        .upcoming-box { border: 1px solid #dadce0; border-radius: 8px; padding: 16px; background: white; }
        .upcoming-box h4 { margin: 0 0 12px 0; font-size: 14px; color: #3c4043; font-weight: 500; }
        .no-work { font-size: 12px; color: #5f6368; margin-bottom: 20px; }
        .view-all { display: block; text-align: right; font-size: 13px; color: #1967d2; text-decoration: none; font-weight: 600; }
        .stream-feed { display: flex; flex-direction: column; gap: 16px; }
        .announce-input { background: white; border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15); padding: 16px; display: flex; align-items: center; gap: 16px; cursor: pointer; color: #5f6368; font-size: 13px; font-weight: 500; }
        .stream-item { border: 1px solid #dadce0; border-radius: 8px; background: white; padding: 16px; display: flex; align-items: center; gap: 16px; cursor: pointer; transition: background 0.1s; }
        .stream-item:hover { background-color: #f8f9fa; box-shadow: 0 1px 2px rgba(0,0,0,0.1); }
        .item-icon { width: 36px; height: 36px; border-radius: 50%; background-color: #1967d2; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0; }
        .item-icon.material { background-color: #5f6368; }
        .item-content { flex: 1; }
        .item-title { font-size: 14px; color: #3c4043; font-weight: 500; margin: 0; }
        .item-date { font-size: 12px; color: #5f6368; margin-top: 2px; }
        .item-menu { color: #5f6368; padding: 8px; border-radius: 50%; }
        .item-menu:hover { background-color: #f0f0f0; }
    </style>
</head>
<body>

    <header>
        <div class="header-left">
            <i class="fa-solid fa-bars hamburger-btn"></i>
            <div class="logo-section">
                <i class="fa-solid fa-book-open logo-icon"></i>
                <span class="logo-text">TechHub</span>
            </div>
        </div>
        <div class="header-right">
            <i class="fa-solid fa-plus icon-btn"></i>
            <div class="avatar"></div>
        </div>
    </header>

   <div class="app-layout">
        <aside class="sidebar">
            <a href="student.php" class="sidebar-item">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <div class="sidebar-item active dropdown-toggle" onclick="toggleEnrolled()">
                <div class="toggle-content"><i class="fa-solid fa-graduation-cap"></i> Enrolled</div>
                <i class="fa-solid fa-chevron-down chevron-icon" id="enrolled-chevron"></i>
            </div>

            <div class="submenu-container" id="enrolled-submenu">
                <a href="?subject=art" class="sidebar-item sub-item <?php if($subject_id == 'art') echo 'active-class'; ?>" 
                   style="<?php if($subject_id == 'art') echo 'color: ' . $classes['art']['theme_color'] . '; background-color: ' . $classes['art']['sidebar_bg'] . ';'; ?>">
                    Art Appreciation
                </a>

                <a href="?subject=web" class="sidebar-item sub-item <?php if($subject_id == 'web') echo 'active-class'; ?>" 
                   style="<?php if($subject_id == 'web') echo 'color: ' . $classes['web']['theme_color'] . '; background-color: ' . $classes['web']['sidebar_bg'] . ';'; ?>">
                    Web Development
                </a>

                <a href="?subject=db" class="sidebar-item sub-item <?php if($subject_id == 'db') echo 'active-class'; ?>" 
                   style="<?php if($subject_id == 'db') echo 'color: ' . $classes['db']['theme_color'] . '; background-color: ' . $classes['db']['sidebar_bg'] . ';'; ?>">
                    Database Admin
                </a>
            </div>

            <a href="#" class="sidebar-item">
                <i class="fa-solid fa-box-archive"></i>Unenroll Classes
            </a>
            <div class="sidebar-divider"></div>
        </aside>

        <main class="main-content">
            <div class="content-container">
                <nav class="class-nav-tabs">
                    <a href="#" class="nav-tab active">Stream</a>
                    <a href="#" class="nav-tab">Classwork</a>
                    <a href="#" class="nav-tab">People</a>
                </nav>

                <div class="banner" style="background-image: url('<?php echo $current['banner_img']; ?>');">
                    <h1><?php echo $current['title']; ?></h1>
                    <p><?php echo $current['section']; ?></p>
                    <i class="fa-solid fa-circle-info info-btn"></i>
                </div>

                <div class="stream-layout">
                    <div class="upcoming-column">
                        <div class="upcoming-box">
                            <h4>Upcoming</h4>
                            <p class="no-work">Woohoo, no work due soon!</p>
                            <a href="#" class="view-all">View all</a>
                        </div>
                    </div>

                    <div class="stream-feed">
                        <div class="announce-input">
                            <div class="avatar" style="width: 32px; height: 32px;"></div>
                            <span>Announce something to your class</span>
                        </div>

                        <?php if (empty($current['posts'])): ?>
                            <div style="text-align: center; padding: 40px; color: #777;">
                                <i class="fa-solid fa-mug-hot" style="font-size: 40px; margin-bottom: 10px;"></i>
                                <p>No posts yet. Check back later!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($current['posts'] as $post): ?>
                                <div class="stream-item">
                                    <div class="item-icon material">
                                        <i class="fa-solid <?php echo $post['icon']; ?>"></i>
                                    </div>
                                    <div class="item-content">
                                        <h4 class="item-title"><?php echo $post['author'] . ' ' . $post['action']; ?></h4>
                                        <div class="item-date"><?php echo $post['date']; ?></div>
                                    </div>
                                    <i class="fa-solid fa-ellipsis-vertical item-menu"></i>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
       function toggleEnrolled() {
           const submenu = document.getElementById('enrolled-submenu');
           const chevron = document.getElementById('enrolled-chevron');
           if (submenu.style.display === "none") {
               submenu.style.display = "block";
               chevron.style.transform = "rotate(-180deg)";
           } else {
               submenu.style.display = "none";
               chevron.style.transform = "rotate(0deg)";
           }
       }
       // Keep dropdown open
       document.addEventListener("DOMContentLoaded", function() {
           document.getElementById('enrolled-submenu').style.display = "block";
           document.getElementById('enrolled-chevron').style.transform = "rotate(-180deg)";
       });
    </script>
</body>
</html>