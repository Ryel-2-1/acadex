<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TechHub - Classwork</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* --- GENERAL RESET --- */
    body { 
        margin: 0; padding: 0; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        background-color: #f5f7fa; color: #333; 
        height: 100vh; display: flex; flex-direction: column;
    }
    * { box-sizing: border-box; }

    /* --- HEADER --- */
    header {
        background-color: white; padding: 0 40px; height: 70px;
        display: flex; align-items: center; justify-content: space-between;
        border-bottom: 1px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        flex-shrink: 0; z-index: 100; position: relative;
    }
    .logo-section { display: flex; align-items: center; gap: 10px; width: 250px; }
    .logo-icon { font-size: 32px; color: #1a73e8; }
    .logo-text { font-size: 24px; font-weight: 700; color: #000; }
    .nav-links { display: flex; gap: 30px; height: 100%; }
    .nav-item {
        display: flex; align-items: center; gap: 8px; text-decoration: none; color: #5f6368;
        font-weight: 500; font-size: 16px; padding: 0 5px; position: relative; height: 100%; cursor: pointer;
    }
    .nav-item:hover, .nav-item.active { color: #1a73e8; }
    .nav-item.active::after {
        content: ''; position: absolute; bottom: 0; left: 0;
        width: 100%; height: 3px; background-color: #1a73e8;
    }
    .profile-section { display: flex; align-items: center; gap: 12px; text-align: right; width: 250px; justify-content: flex-end; }
    .profile-info h4 { margin: 0; font-size: 15px; font-weight: 600; color: #333; }
    .profile-info span { font-size: 13px; color: #777; display: block; }
    .avatar { width: 40px; height: 40px; background-color: #ddd; border-radius: 50%; background-image: url('https://ui-avatars.com/api/?name=Jhomari+Gandionco&background=0D8ABC&color=fff'); background-size: cover; }

    /* --- LAYOUT --- */
    .app-layout { display: flex; flex: 1; overflow: hidden; }

    /* SIDEBAR */
    .sidebar { width: 300px; background-color: white; display: flex; flex-direction: column; padding: 24px 0; flex-shrink: 0; border-right: 1px solid #e0e0e0; }
    .sidebar-item {
        display: flex; align-items: center; gap: 18px; padding: 12px 30px;
        text-decoration: none; color: #5f6368; font-size: 15px; font-weight: 500;
        border-top-right-radius: 50px; border-bottom-right-radius: 50px;
        margin-right: 10px; transition: background 0.15s; cursor: pointer;
    }
    .sidebar-item:hover { background-color: #f5f5f5; color: #202124; }
    .sidebar-item.active { background-color: #e8f0fe; color: #1a73e8; font-weight: 600; }
    .sidebar-item.active i { color: #1a73e8; }
    .sidebar-item i { width: 24px; text-align: center; font-size: 20px; color: #5f6368; }

    /* MAIN CONTENT */
    .main-content { flex: 1; padding: 30px 50px; overflow-y: auto; background-color: white; position: relative; }

    /* --- SECTIONS (TAB VIEWS) --- */
    .section-view { display: none; animation: fadeIn 0.3s; }
    .section-view.active-section { display: block; }

    /* STREAM STYLES */
    .class-banner {
        height: 200px; border-radius: 8px; background-image: url('https://images.unsplash.com/photo-1557683316-973673baf926?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
        background-size: cover; background-position: center; position: relative; margin-bottom: 25px;
    }
    .class-banner-content { position: absolute; bottom: 20px; left: 25px; color: white; }
    .class-banner-content h1 { margin: 0; font-size: 2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .class-banner-content p { margin: 5px 0 0; font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    
    .announce-box {
        background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        padding: 15px 20px; display: flex; align-items: center; gap: 15px; cursor: pointer; border: 1px solid #dadce0;
    }
    .announce-box:hover { background-color: #f8f9fa; }
    .announce-text { color: #5f6368; font-size: 0.9rem; }

    /* PEOPLE STYLES */
    .people-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #1967d2; padding-bottom: 15px; margin-bottom: 20px; color: #1967d2; margin-top: 20px; }
    .people-header h2 { margin: 0; font-size: 1.8rem; font-weight: 400; }
    .person-row { display: flex; align-items: center; gap: 15px; padding: 10px 15px; border-bottom: 1px solid #e0e0e0; }
    .person-name { font-weight: 500; color: #3c4043; }

    /* MARKS STYLES */
    .marks-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .marks-table th { text-align: left; padding: 12px; border-bottom: 2px solid #e0e0e0; color: #5f6368; font-size: 0.9rem; }
    .marks-table td { padding: 12px; border-bottom: 1px solid #e0e0e0; font-size: 0.95rem; }
    .grade-input { width: 50px; padding: 5px; border: 1px solid #dadce0; border-radius: 4px; text-align: center; }

    /* --- CLASSWORK CONTROLS --- */
    .create-wrapper { position: relative; margin-bottom: 40px; }
    .create-btn {
        background-color: #1a73e8; color: white; border: none; padding: 12px 24px;
        border-radius: 28px; font-weight: 500; font-size: 14px; cursor: pointer;
        display: flex; align-items: center; gap: 12px;
        box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
    }
    .dropdown-menu {
        display: none; position: absolute; top: 55px; left: 0; width: 280px;
        background-color: white; border-radius: 8px; box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 2px 6px 2px rgba(60,64,67,0.15);
        padding: 8px 0; z-index: 1000; animation: fadeIn 0.1s ease-out;
    }
    .dropdown-item { display: flex; align-items: center; gap: 20px; padding: 12px 24px; text-decoration: none; color: #3c4043; font-size: 14px; font-weight: 500; cursor: pointer; }
    .dropdown-item:hover { background-color: #f5f5f5; }
    
    /* Stream List Items */
    .stream-item { background: white; border: 1px solid #dadce0; border-radius: 8px; padding: 20px; margin-bottom: 15px; cursor: pointer; display: flex; align-items: center; gap: 20px; }
    .stream-item:hover { background-color: #f8f9fa; box-shadow: 0 1px 3px rgba(0,0,0,0.12); }
    .item-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; flex-shrink: 0; }
    .icon-quiz { background-color: #1a73e8; }
    .icon-assign { background-color: #e37400; }
    .icon-quest { background-color: #a142f4; }
    #emptyState { text-align: center; margin-top: 100px; color: #5f6368; }
    #emptyState i { font-size: 4rem; color: #dadce0; margin-bottom: 20px; display: block; }

    /* --- EDITABLE QUIZ CARDS --- */
    .quiz-question-card { border-bottom: 1px solid #eee; padding: 25px 0; position: relative; }
    .quiz-question-card:last-child { border-bottom: none; }
    .q-header-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
    .q-title { font-weight: 700; font-size: 1.1rem; width: 85%; color: #333; }
    .q-options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .q-opt { background: #fafafa; padding: 10px 15px; border-radius: 6px; border: 1px solid #eee; font-size: 0.95rem; }
    .q-ans { margin-top: 15px; color: #27ae60; font-weight: 600; background: #e8f5e9; display: inline-block; padding: 5px 10px; border-radius: 4px; }
    
    .q-actions { display: flex; gap: 5px; }
    .action-btn { background: white; border: 1px solid #ddd; border-radius: 4px; padding: 5px 10px; cursor: pointer; color: #666; font-size: 0.9rem; transition: 0.2s; }
    .action-btn:hover { background: #f5f5f5; color: #1a73e8; border-color: #1a73e8; }
    .btn-del:hover { color: #d32f2f; border-color: #d32f2f; background: #ffebee; }
    
    .edit-input { width: 100%; padding: 8px; border: 1px solid #1976D2; border-radius: 4px; margin-bottom: 5px; font-family: inherit; font-size: 0.95rem; }
    .edit-label { font-size: 0.8rem; font-weight: bold; color: #666; margin-bottom: 2px; display: block; }
    .save-row { margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end; }

    /* --- MODALS --- */
    .modal-overlay { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); align-items: center; justify-content: center; }
    .modal-content { background: white; border-radius: 8px; width: 550px; box-shadow: 0 24px 38px 3px rgba(0,0,0,0.14); display: flex; flex-direction: column; max-height: 90vh; animation: fadeIn 0.2s; }
    .modal-header { padding: 15px 24px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; }
    .modal-body { padding: 24px; overflow-y: auto; }
    .modal-footer { padding: 16px 24px; display: flex; justify-content: flex-end; gap: 10px; }
    .input-group { margin-bottom: 20px; }
    .input-group label { display: block; font-weight: 500; font-size: 0.9rem; margin-bottom: 8px; color: #5f6368; }
    .input-group input, .input-group textarea { width: 100%; padding: 12px; border: 1px solid #dadce0; border-radius: 4px; font-family: inherit; font-size: 14px; }
    .upload-area-small { border: 1px dashed #dadce0; border-radius: 6px; padding: 20px; text-align: center; background: #f8f9fa; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; }
    .btn { padding: 8px 24px; border-radius: 4px; border: none; cursor: pointer; font-weight: 500; font-size: 14px; }
    .btn-cancel { background: white; color: #1a73e8; }
    .btn-go { background: #1a73e8; color: white; }

    /* DETAIL VIEW */
    #detailView { display: none; }
    .detail-header { background: white; padding: 30px; border-radius: 12px; border-bottom: 1px solid #eee; margin-bottom: 30px; }
    .back-btn { background: transparent; border: none; color: #666; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 8px; margin-bottom: 20px; font-weight: 600; }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    /* --- VIRTUAL CLASS BUTTON --- */
    .class-banner-content { 
        position: absolute; bottom: 20px; left: 25px; right: 25px; /* Added right spacing */
        color: white; 
        display: flex; justify-content: space-between; align-items: flex-end; /* Layout for button */
    }
    .virtual-btn {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        backdrop-filter: blur(5px);
        transition: 0.3s;
        cursor: pointer;
    }
    .virtual-btn:hover {
        background-color: white;
        color: #1a73e8;
    }
</style>
</head>
<body>

    <header>
        <div class="logo-section"><i class="fa-solid fa-book-open logo-icon"></i><span class="logo-text">TechHub</span></div>
        <nav class="nav-links">
            <a href="dashboard.php" class="nav-item"><i class="fa-solid fa-border-all"></i> Dashboard</a>
            <a href="classwork.php" class="nav-item active"><i class="fa-solid fa-book"></i> Classes</a>
            <a href="gradebook.php" class="nav-item"><i class="fa-solid fa-graduation-cap"></i> Gradebook</a>
        </nav>
        <div class="profile-section"><div class="profile-info"><h4>Prof. Gandionco</h4><span>Teacher</span></div><div class="avatar"></div></div>
    </header>

    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-item" id="tab-stream" onclick="switchTab('stream')"><i class="fa-regular fa-comment-dots"></i> Stream</div>
            <div class="sidebar-item active" id="tab-classwork" onclick="switchTab('classwork')"><i class="fa-solid fa-clipboard-list"></i> Classwork</div>
            <div class="sidebar-item" id="tab-people" onclick="switchTab('people')"><i class="fa-solid fa-user-group"></i> People</div>
            <div class="sidebar-item" id="tab-marks" onclick="switchTab('marks')"><i class="fa-solid fa-chart-simple"></i> Marks</div>
        </aside>

        <main class="main-content">
            
            <div id="streamSection" class="section-view">
                <div class="class-banner">
                    <div class="class-banner-content">
                        <div>
                            <h1>BSIT 4-1 Programming</h1>
                            <p>Advanced Web Development</p>
                        </div>
                        <a href="#" class="virtual-btn">
                            <i class="fa-solid fa-video"></i> Virtual Class
                        </a>
                    </div>
                </div>
                <div class="announce-box"><div class="avatar" style="width:35px; height:35px;"></div><span class="announce-text">Announce something to your class...</span></div>
                <div id="streamPostsArea" style="margin-top: 20px;">
                    <div style="color: #5f6368; font-size: 0.9rem; text-align: center;"><p>No announcements yet.</p></div>
                </div>
            </div>

            <div id="classworkSection" class="section-view active-section">
                <div class="create-wrapper">
                    <button class="create-btn" onclick="toggleDropdown()"><i class="fa-solid fa-plus"></i> Create</button>
                    <div id="createDropdown" class="dropdown-menu">
                        <div class="dropdown-item" onclick="openModal('assignModal')"><i class="fa-solid fa-file-pen"></i> Assignment</div>
                        <div class="dropdown-item" onclick="openModal('aiModal')"><i class="fa-solid fa-robot"></i> AI Quiz Generator</div>
                        <div class="dropdown-item" onclick="openModal('questModal')"><i class="fa-solid fa-question"></i> Question</div>
                    </div>
                </div>

                <div id="streamView">
                    <div id="emptyState"><i class="fa-solid fa-box-open"></i><p>Your classwork is empty. Click "Create" to add content.</p></div>
                    <div id="streamItemsArea"></div>
                </div>

                <div id="detailView">
                    <button class="back-btn" onclick="closeDetail()"><i class="fa-solid fa-arrow-left"></i> Back to Stream</button>
                    <div class="detail-header"><h1 id="detTitle" style="margin:0; color:#1a73e8;"></h1><div id="detMeta" style="color:#666;"></div></div>
                    <div id="detBody" style="background:white; padding:30px; border:1px solid #e0e0e0; border-radius:8px;"></div>
                </div>
            </div>

            <div id="peopleSection" class="section-view">
                <div class="people-header"><h2>Teachers</h2><i class="fa-solid fa-user-plus" style="cursor:pointer;"></i></div>
                <div class="person-row"><div class="avatar" style="width:32px; height:32px;"></div><span class="person-name">Prof. Jhomari Gandionco</span></div>
                <div class="people-header"><h2>Students</h2><span>109 Students</span></div>
                <div class="person-row"><div class="avatar" style="background:#e3f2fd; width:32px; height:32px;"></div><span class="person-name">Abigail Johnson</span></div>
            </div>

            <div id="marksSection" class="section-view">
                <h2 style="color:#1a73e8; font-weight:400; margin-bottom:20px;">Class Gradebook</h2>
                <div style="overflow-x:auto;">
                    <table class="marks-table">
                        <thead><tr><th>Student Name</th><th>Quiz 1</th><th>Midterm</th><th>Project</th><th>Average</th></tr></thead>
                        <tbody><tr><td>Abigail Johnson</td><td><input class="grade-input" value="95"></td><td><input class="grade-input" value="88"></td><td><input class="grade-input" value="92"></td><td>91.6%</td></tr></tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div id="assignModal" class="modal-overlay">
        <div class="modal-content"><div class="modal-header"><h2>Assignment</h2><span style="cursor:pointer;" onclick="closeAllModals()">&times;</span></div>
        <div class="modal-body"><div class="input-group"><label>Title</label><input type="text" id="asTitle"></div><div class="input-group"><label>Instructions</label><textarea id="asInstr"></textarea></div><div class="upload-area-small" onclick="document.getElementById('asFile').click()"><input type="file" id="asFile" hidden onchange="showFile(this, 'asFileTxt')"><span id="asFileTxt"><i class="fa-solid fa-paperclip"></i> Attach</span></div></div>
        <div class="modal-footer"><button class="btn btn-cancel" onclick="closeAllModals()">Cancel</button><button class="btn btn-go" onclick="createAssign()">Assign</button></div></div>
    </div>

    <div id="aiModal" class="modal-overlay">
        <div class="modal-content"><div class="modal-header"><h2>Generate Quiz</h2><span style="cursor:pointer;" onclick="closeAllModals()">&times;</span></div>
        <div class="modal-body"><div class="upload-area-small" onclick="document.getElementById('aiFile').click()"><input type="file" id="aiFile" hidden accept="application/pdf" onchange="showFile(this, 'aiFileTxt')"><span id="aiFileTxt"><i class="fa-solid fa-cloud-arrow-up"></i> Click to Upload PDF</span></div><div class="input-group" style="margin-top:20px;"><label>Instructions</label><textarea id="aiPrompt" placeholder="e.g. Generate 5 multiple choice questions..."></textarea></div></div>
        <div class="modal-footer"><button class="btn btn-cancel" onclick="closeAllModals()">Cancel</button><button class="btn btn-go" id="aiBtn" onclick="generateQuiz()">Generate</button></div></div>
    </div>

    <div id="questModal" class="modal-overlay">
        <div class="modal-content"><div class="modal-header"><h2>Question</h2><span style="cursor:pointer;" onclick="closeAllModals()">&times;</span></div>
        <div class="modal-body"><div class="input-group"><label>Question</label><textarea id="qText"></textarea></div><div class="upload-area-small" onclick="document.getElementById('qFile').click()"><input type="file" id="qFile" hidden onchange="showFile(this, 'qFileTxt')"><span id="qFileTxt"><i class="fa-solid fa-paperclip"></i> Attach</span></div></div>
        <div class="modal-footer"><button class="btn btn-cancel" onclick="closeAllModals()">Cancel</button><button class="btn btn-go" onclick="createQuest()">Ask</button></div></div>
    </div>

    <script>
        let items = [];

        // --- TABS & UI ---
        function switchTab(tabName) {
            document.querySelectorAll('.sidebar-item').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabName).classList.add('active');
            document.querySelectorAll('.section-view').forEach(el => el.classList.remove('active-section'));
            if(tabName === 'stream') document.getElementById('streamSection').classList.add('active-section');
            if(tabName === 'classwork') document.getElementById('classworkSection').classList.add('active-section');
            if(tabName === 'people') document.getElementById('peopleSection').classList.add('active-section');
            if(tabName === 'marks') document.getElementById('marksSection').classList.add('active-section');
        }

        function toggleDropdown() { const el = document.getElementById('createDropdown'); el.style.display = (el.style.display === 'block') ? 'none' : 'block'; }
        function openModal(id) { document.getElementById('createDropdown').style.display = 'none'; document.getElementById(id).style.display = 'flex'; }
        function closeAllModals() { document.querySelectorAll('.modal-overlay').forEach(el => el.style.display = 'none'); }
        function showFile(input, txtId) { if(input.files[0]) { document.getElementById(txtId).innerHTML = `<b>${input.files[0].name}</b>`; document.getElementById(txtId).style.color = '#1a73e8'; } }

        // --- CREATION ---
        function createAssign() {
            const title = document.getElementById('asTitle').value;
            if(!title) return alert("Please enter a title");
            items.push({ type: 'assignment', title: title, icon: 'fa-solid fa-file-text', colorClass: 'icon-assign', file: document.getElementById('asFile').files[0], content: document.getElementById('asInstr').value });
            renderStream(); closeAllModals(); switchTab('classwork');
        }

        function createQuest() {
            const title = document.getElementById('qText').value;
            if(!title) return alert("Please enter a question");
            items.push({ type: 'question', title: title, icon: 'fa-solid fa-circle-question', colorClass: 'icon-quest', file: document.getElementById('qFile').files[0], content: title });
            renderStream(); closeAllModals(); switchTab('classwork');
        }

        async function generateQuiz() {
            const file = document.getElementById('aiFile').files[0];
            const prompt = document.getElementById('aiPrompt').value;
            const btn = document.getElementById('aiBtn');
            if (!file) return alert("Please upload a PDF.");
            btn.innerText = "Generating..."; btn.disabled = true;
            const formData = new FormData();
            formData.append('pdf_file', file);
            formData.append('custom_prompt', prompt);
            try {
                const res = await fetch('api/generate_quiz_api.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    items.push({ type: 'quiz', title: 'Quiz: ' + file.name, icon: 'fa-solid fa-robot', colorClass: 'icon-quiz', data: data.questions, file: file.name });
                    renderStream(); closeAllModals(); switchTab('classwork');
                } else { alert("Error: " + data.message); }
            } catch (err) { console.error(err); alert("Error connecting to AI."); } 
            finally { btn.innerText = "Generate"; btn.disabled = false; }
        }

        // --- RENDER STREAM & CLASSWORK ---
        function renderStream() {
            // Render to Classwork
            const list = document.getElementById('streamItemsArea');
            const empty = document.getElementById('emptyState');
            const streamSection = document.getElementById('streamSection');
            list.innerHTML = '';
            
            // Render to Stream Tab
            const streamList = document.getElementById('streamPostsArea');
            streamList.innerHTML = '';

            if (items.length === 0) { 
                empty.style.display = 'block'; 
                streamList.innerHTML = `<div style="color: #5f6368; font-size: 0.9rem; text-align: center;"><p>No announcements yet.</p></div>`;
            } else {
                empty.style.display = 'none';
                items.slice().reverse().forEach((item, index) => {
                    const originalIndex = items.length - 1 - index;
                    
                    // Add to Classwork View
                    const div = document.createElement('div');
                    div.className = 'stream-item';
                    div.onclick = () => showDetail(originalIndex);
                    div.innerHTML = `
                        <div class="item-icon ${item.colorClass}"><i class="${item.icon}"></i></div>
                        <div class="item-content">
                            <div class="item-title">${item.title}</div>
                            <div class="item-meta">Posted just now ${item.file ? '• Has attachment' : ''}</div>
                        </div>
                    `;
                    list.appendChild(div);

                    // Add to Stream Tab
                    const streamDiv = document.createElement('div');
                    streamDiv.className = 'stream-item';
                    streamDiv.onclick = () => { switchTab('classwork'); showDetail(originalIndex); };
                    streamDiv.innerHTML = `
                        <div class="item-icon ${item.colorClass}"><i class="${item.icon}"></i></div>
                        <div class="item-content">
                            <div class="item-title">Prof. Gandionco posted a new ${item.type}: ${item.title}</div>
                            <div class="item-meta">Just now</div>
                        </div>
                    `;
                    streamList.appendChild(streamDiv);
                });
            }
const bannerHTML = `
                <div class="class-banner">
                    <div class="class-banner-content">
                        <div>
                            <h1>BSIT 4-1 Programming</h1>
                            <p>Advanced Web Development</p>
                        </div>
                        <a href="#" class="virtual-btn">
                            <i class="fa-solid fa-video"></i> Virtual Class
                        </a>
                    </div>
                </div>`;
            
            const announceBoxHTML = `<div class="announce-box"><div class="avatar" style="width:35px; height:35px;"></div><span class="announce-text">Announce something to your class...</span></div>`;
            
            let postsHTML = '';
            if (items.length === 0) {
                postsHTML = `<div style="color: #5f6368; font-size: 0.9rem; text-align: center; margin-top:20px;"><p>No announcements yet.</p></div>`;
            } else {
                items.slice().reverse().forEach((item, index) => {
                    const originalIndex = items.length - 1 - index;
                    postsHTML += `
                        <div class="stream-item" style="margin-top:15px;" onclick="switchTab('classwork'); showDetail(${originalIndex})">
                            <div class="item-icon ${item.colorClass}"><i class="${item.icon}"></i></div>
                            <div class="item-content">
                                <div class="item-title">Prof. Gandionco posted a new ${item.type}: ${item.title}</div>
                                <div class="item-meta">Just now</div>
                            </div>
                        </div>`;
                });
            }
            
            streamSection.innerHTML = bannerHTML + announceBoxHTML + `<div id="streamPostsArea">${postsHTML}</div>`;
        }

        // --- DETAIL VIEW & EDITABLE QUIZ ---
        function showDetail(index) {
            const item = items[index];
            document.getElementById('streamView').style.display = 'none';
            document.querySelector('.create-wrapper').style.display = 'none';
            document.getElementById('detailView').style.display = 'block';
            document.getElementById('detTitle').innerText = item.title;
            document.getElementById('detMeta').innerHTML = `<span><i class="${item.icon}"></i> ${item.type}</span>`;
            
            const body = document.getElementById('detBody');
            body.innerHTML = '';

            if (item.type === 'quiz') { renderQuizDetail(index); } 
            else {
                body.innerHTML = `<p>${item.content || ''}</p>`;
                if(item.file) body.innerHTML += `<br><b>Attachment:</b> ${item.file.name}`;
            }
        }

        function renderQuizDetail(itemIndex) {
            const body = document.getElementById('detBody');
            body.innerHTML = ''; 
            const questions = items[itemIndex].data;
            if(questions.length === 0) { body.innerHTML = '<p style="color:#999; font-style:italic;">No questions remaining.</p>'; return; }

            questions.forEach((q, qIndex) => {
                const div = document.createElement('div');
                div.className = 'quiz-question-card';
                div.id = `q-card-${qIndex}`;
                div.innerHTML = `
                    <div class="q-header-row">
                        <div class="q-title">${qIndex + 1}. ${q.question}</div>
                        <div class="q-actions">
                            <button class="action-btn" onclick="enableEdit(${itemIndex}, ${qIndex})"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn btn-del" onclick="deleteQuestion(${itemIndex}, ${qIndex})"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="q-options-grid">${q.options.map(opt => `<div class="q-opt">${opt}</div>`).join('')}</div>
                    <div class="q-ans"><i class="fa-solid fa-check"></i> Answer: ${q.answer}</div>
                `;
                body.appendChild(div);
            });
        }

        function deleteQuestion(itemIndex, qIndex) {
            if(confirm("Delete this question?")) {
                items[itemIndex].data.splice(qIndex, 1);
                renderQuizDetail(itemIndex);
            }
        }

        function enableEdit(itemIndex, qIndex) {
            const q = items[itemIndex].data[qIndex];
            const card = document.getElementById(`q-card-${qIndex}`);
            card.innerHTML = `
                <label class="edit-label">Question:</label><textarea class="edit-input" id="edit-q-${qIndex}" rows="2">${q.question}</textarea>
                <label class="edit-label">Options:</label>
                <div class="q-options-grid">${q.options.map((opt, i) => `<input type="text" class="edit-input" id="edit-opt-${i}-${qIndex}" value="${opt}">`).join('')}</div>
                <label class="edit-label">Correct Answer:</label><input type="text" class="edit-input" id="edit-ans-${qIndex}" value="${q.answer}" style="border-color:#27ae60;">
                <div class="save-row"><button class="btn btn-cancel" onclick="renderQuizDetail(${itemIndex})">Cancel</button><button class="btn btn-go" onclick="saveQuestion(${itemIndex}, ${qIndex})">Save</button></div>
            `;
        }

        function saveQuestion(itemIndex, qIndex) {
            const newQ = document.getElementById(`edit-q-${qIndex}`).value;
            const newOpts = [0,1,2,3].map(i => document.getElementById(`edit-opt-${i}-${qIndex}`).value);
            const newAns = document.getElementById(`edit-ans-${qIndex}`).value;
            items[itemIndex].data[qIndex] = { question: newQ, options: newOpts, answer: newAns };
            renderQuizDetail(itemIndex);
        }

        function closeDetail() {
            document.getElementById('detailView').style.display = 'none';
            document.getElementById('streamView').style.display = 'block';
            document.querySelector('.create-wrapper').style.display = 'block';
        }

        window.onclick = function(e) {
            if (!e.target.matches('.create-btn') && !e.target.closest('.create-btn')) {
                const dd = document.getElementById('createDropdown');
                if(dd) dd.style.display = 'none';
            }
            if (e.target.classList.contains('modal-overlay')) closeAllModals();
        }
    </script>
</body>
</html>