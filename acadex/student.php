<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header("Location: index.php");
    exit();
}

$classes = [
    'db' => ['id'=>'class-db', 'name'=>'Database Admin', 'subtitle'=>'BSIT 3-1', 'teacher'=>'Ed Sheeran', 'color'=>'bg-gray', 'avatar_color'=>'avatar-photo', 'avatar_text'=>'', 'banner'=>'https://gstatic.com/classroom/themes/img_breakfast.jpg', 'posts'=>[]],
    'art' => ['id'=>'class-art', 'name'=>'Art Appreciation', 'subtitle'=>'BSIT 3-1', 'teacher'=>'Archie Arevalo', 'color'=>'bg-gray', 'avatar_color'=>'avatar-photo', 'avatar_text'=>'', 'banner'=>'https://gstatic.com/classroom/themes/img_read.jpg', 'posts'=>[['author'=>'Archie Arevalo', 'action'=>'posted material', 'date'=>'Yesterday', 'icon'=>'fa-book-bookmark']]],
    'web' => ['id'=>'class-web', 'name'=>'Web Development', 'subtitle'=>'BSIT 3-1', 'teacher'=>'Prof. Jhomari', 'color'=>'bg-green', 'avatar_color'=>'avatar-purple', 'avatar_text'=>'Ed', 'banner'=>'https://gstatic.com/classroom/themes/img_code.jpg', 'posts'=>[['author'=>'Prof. Jhomari', 'action'=>'posted material', 'date'=>'10:45 AM', 'icon'=>'fa-code']]]
];
$page = $_GET['page'] ?? 'home';
$subject_key = $_GET['subject'] ?? '';
$current_class = $classes[$subject_key] ?? null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub - Student</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- GLOBAL STYLES --- */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        body { background-color: #ffffff; color: #333; min-height: 100vh; display: flex; flex-direction: column; }

        /* --- HEADER --- */
        header { height: 65px; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e0e0e0; background: white; position: fixed; top: 0; width: 100%; z-index: 1000; }
        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-icon { font-size: 28px; color: #1a73e8; }
        .logo-text { font-size: 22px; font-weight: 600; color: #202124; }
        .profile-pic { width: 35px; height: 35px; border-radius: 50%; background-image: url('https://ui-avatars.com/api/?name=Student+User&background=00C060&color=fff'); background-size: cover; cursor: pointer; }

        /* --- LAYOUT --- */
        .app-container { display: flex; margin-top: 65px; height: calc(100vh - 65px); }
        .sidebar { width: 280px; padding: 24px 0; flex-shrink: 0; overflow-y: auto; border-right: 1px solid transparent; }
        .main-content { flex-grow: 1; padding: 24px; overflow-y: auto; }

        /* --- SIDEBAR ITEMS --- */
        .sidebar-item { display: flex; align-items: center; padding: 12px 24px; font-size: 16px; font-weight: 500; color: #3c4043; cursor: pointer; border-radius: 0 24px 24px 0; margin-bottom: 4px; transition: background 0.2s; text-decoration: none; }
        .sidebar-item:hover { background-color: #f5f5f5; }
        .sidebar-item.active { background-color: #e8f0fe; color: #1967d2; }
        .sidebar-item i { margin-right: 15px; width: 24px; text-align: center; }
        
        /* Dropdown Styles */
        .dropdown-toggle { justify-content: space-between; }
        .toggle-content { display: flex; align-items: center; gap: 18px; } 
        .toggle-content i { margin-right: 0; } 
        .chevron-icon { font-size: 12px !important; transition: transform 0.3s ease; margin-left: auto; width: auto !important; }
        .submenu-container { display: block; overflow: hidden; }
        .sub-item { padding-left: 64px; font-size: 14px; }
        .sub-item.active-sub { color: #1967d2; background-color: #e8f0fe; font-weight: 600; }

        /* --- CARD GRID --- */
        .card-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; }
        .class-card { background: white; border: 1px solid #dadce0; border-radius: 8px; overflow: visible; display: flex; flex-direction: column; position: relative; height: 280px; transition: box-shadow 0.2s; cursor: pointer; }
        .class-card:hover { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        
        .card-header-bg { height: 100px; padding: 16px; color: white; position: relative; border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .bg-orange { background: linear-gradient(135deg, #ff7e5f, #feb47b); }
        .bg-gray { background: linear-gradient(135deg, #bdc3c7, #2c3e50); }
        .bg-green { background: linear-gradient(135deg, #11998e, #38ef7d); }
        
        .class-title { font-size: 20px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .class-subtitle { font-size: 14px; margin-top: 4px; opacity: 0.9; }
        .teacher-name { font-size: 12px; margin-top: 4px; opacity: 0.8; }
        
        .card-avatar { width: 70px; height: 70px; border-radius: 50%; position: absolute; top: 65px; right: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: white; border: 2px solid white; }
        .avatar-orange { background-color: #d35400; }
        .avatar-purple { background-color: #4a148c; }
        .avatar-photo { background-image: url('https://i.pravatar.cc/150?img=5'); background-size: cover; }
        
        .card-body { flex-grow: 1; padding: 16px; }
        .card-footer { height: 50px; border-top: 1px solid #dadce0; display: flex; align-items: center; justify-content: flex-end; padding: 0 16px; gap: 10px; }
        .footer-icon { color: #5f6368; padding: 8px; border-radius: 50%; cursor: pointer; }
        .footer-icon:hover { background-color: #eee; }

        /* --- STREAM VIEW STYLES --- */
        .content-container { max-width: 1000px; margin: 0 auto; }
        .class-nav-tabs { display: flex; border-bottom: 1px solid #e0e0e0; margin-bottom: 20px; }
        .nav-tab { padding: 16px 24px; text-decoration: none; color: #5f6368; font-weight: 500; border-bottom: 4px solid transparent; }
        .nav-tab.active-tab { color: #1967d2; border-bottom-color: #1967d2; }
        .banner { height: 240px; background-size: cover; background-position: center; border-radius: 8px; padding: 24px; display: flex; flex-direction: column; justify-content: flex-end; color: white; margin-bottom: 24px; }
        .banner h1 { font-size: 32px; font-weight: 600; }
        .stream-layout { display: grid; grid-template-columns: 200px 1fr; gap: 24px; }
        .upcoming-box { border: 1px solid #dadce0; border-radius: 8px; padding: 16px; background: white; }
        .stream-item { border: 1px solid #dadce0; border-radius: 8px; background: white; padding: 16px; display: flex; align-items: center; gap: 16px; margin-bottom: 16px; }
        .item-icon { width: 36px; height: 36px; border-radius: 50%; background-color: #1967d2; color: white; display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body>

    <header>
        <div class="logo-area">
            <i class="fa-solid fa-bars" style="margin-right:15px; font-size: 20px; color: #5f6368; cursor: pointer;"></i>
            <i class="fa-solid fa-book-open logo-icon"></i>
            <span class="logo-text">TechHub</span>
        </div>
        <div class="profile-pic"></div>
    </header>

    <div class="app-container">
        
        <aside class="sidebar">
            <a href="student.php?page=home" class="sidebar-item <?php echo ($page == 'home') ? 'active' : ''; ?>">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <div class="sidebar-item dropdown-toggle" onclick="toggleEnrolled()">
                <div class="toggle-content">
                    <i class="fa-solid fa-graduation-cap"></i> Enrolled
                </div>
                <i class="fa-solid fa-chevron-down chevron-icon" id="enrolled-chevron"></i>
            </div>

            <div class="submenu-container" id="enrolled-submenu">
                <?php foreach($classes as $key => $class): ?>
                    <a href="student.php?page=stream&subject=<?php echo $key; ?>" 
                       id="link-<?php echo $class['id']; ?>"
                       class="sidebar-item sub-item <?php echo ($subject_key == $key) ? 'active-sub' : ''; ?>">
                        <?php echo $class['name']; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <a href="student.php?page=unenrolled" class="sidebar-item <?php echo ($page == 'unenrolled') ? 'active' : ''; ?>">
                <i class="fa-solid fa-box-archive"></i> Unenroll Classes
            </a>
        </aside>

        <main class="main-content">
            
            <?php if ($page == 'home'): ?>
                <div class="card-grid">
                    <?php foreach($classes as $key => $class): ?>
                        <div class="class-card" id="<?php echo $class['id']; ?>" onclick="window.location.href='student.php?page=stream&subject=<?php echo $key; ?>';">
                            <div class="card-header-bg <?php echo $class['color']; ?>">
                                <div class="class-title"><?php echo $class['name']; ?></div>
                                <div class="class-subtitle"><?php echo $class['subtitle']; ?></div>
                                <div class="teacher-name"><?php echo $class['teacher']; ?></div>
                            </div>
                            <div class="card-avatar <?php echo $class['avatar_color']; ?>">
                                <?php echo $class['avatar_text']; ?>
                            </div>
                            <div class="card-body"></div>
                            <div class="card-footer">
                                <i class="fa-regular fa-folder footer-icon"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <?php if ($page == 'unenrolled'): ?>
                <h2 style="margin-bottom: 20px; font-weight: 400; color: #5f6368;">Unenrolled Classes</h2>
                <div class="card-grid" id="unenroll-grid">
                    <?php foreach($classes as $key => $class): ?>
                        <div class="class-card" id="restore-<?php echo $class['id']; ?>" style="display: none; cursor: default;">
                            <div class="card-header-bg <?php echo $class['color']; ?>" style="filter: grayscale(1);">
                                <div class="class-title"><?php echo $class['name']; ?></div>
                                <div class="class-subtitle"><?php echo $class['subtitle']; ?></div>
                            </div>
                            <div class="card-body" style="display:flex; align-items:center; justify-content:center; color:#777;">Unenrolled</div>
                            <div class="card-footer">
                                <button onclick="restoreClass('<?php echo $class['id']; ?>')" style="border:none; background:none; color:#1a73e8; cursor:pointer; font-weight:600;">RESTORE</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div id="empty-msg" style="display:none; text-align:center; margin-top:50px; color:#999;">No unenrolled classes.</div>
            <?php endif; ?>


            <?php if ($page == 'stream' && $current_class): ?>
                <div class="content-container">
                    <nav class="class-nav-tabs">
                        <a href="#" class="nav-tab active-tab">Stream</a>
                        <a href="#" class="nav-tab">Classwork</a>
                        <a href="#" class="nav-tab">People</a>
                    </nav>
                    <div class="banner" style="background-image: url('<?php echo $current_class['banner']; ?>');">
                        <h1><?php echo $current_class['name']; ?></h1>
                        <p><?php echo $current_class['subtitle']; ?></p>
                    </div>
                    <div class="stream-layout">
                        <div class="upcoming-box">
                            <h4>Upcoming</h4><p style="font-size:12px; color:#5f6368;">No work due soon!</p>
                        </div>
                        <div class="stream-feed">
                            <div class="stream-item" style="box-shadow: 0 1px 2px rgba(0,0,0,0.1); cursor: text;">
                                <div class="profile-pic"></div>
                                <span style="font-size:13px; color:#5f6368;">Announce something to your class</span>
                            </div>
                            <?php foreach ($current_class['posts'] as $post): ?>
                                <div class="stream-item">
                                    <div class="item-icon"><i class="fa-solid <?php echo $post['icon']; ?>"></i></div>
                                    <div>
                                        <h4 style="font-size:14px; font-weight:500; color:#3c4043;"><?php echo $post['author'] . ' ' . $post['action']; ?></h4>
                                        <div style="font-size:12px; color:#5f6368;"><?php echo $post['date']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('enrolled-submenu').style.display = "block";
            document.getElementById('enrolled-chevron').style.transform = "rotate(-180deg)";

            // Handle Unenroll Logic
            if (window.location.search.includes('page=home') || window.location.search === '') {
                document.querySelectorAll('.class-card').forEach(card => {
                    if (localStorage.getItem(card.id) === 'unenrolled') card.style.display = 'none';
                });
                document.querySelectorAll('.sub-item').forEach(link => {
                    const id = link.id.replace('link-', '');
                    if (localStorage.getItem(id) === 'unenrolled') link.style.display = 'none';
                });
            }

            if (window.location.search.includes('page=unenrolled')) {
                let hasItems = false;
                document.querySelectorAll('.class-card').forEach(card => {
                    const originalId = card.id.replace('restore-', '');
                    if (localStorage.getItem(originalId) === 'unenrolled') {
                        card.style.display = 'flex';
                        hasItems = true;
                    }
                });
                if (!hasItems) document.getElementById('empty-msg').style.display = 'block';
            }
        });

        function restoreClass(classId) {
            localStorage.removeItem(classId);
            document.getElementById('restore-' + classId).style.display = 'none';
            const remaining = document.querySelectorAll('.class-card[style="display: flex;"]');
            if (remaining.length === 0) document.getElementById('empty-msg').style.display = 'block';
        }
    </script>
</body>
</html>