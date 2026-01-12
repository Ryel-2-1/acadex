<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TechHub - Classwork</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://meet.jit.si/external_api.js"></script>

<style>
    /* Jitsi Modal Specific */
    #jitsi-container { width: 100%; height: 500px; background: #000; border-radius: 4px; overflow: hidden; }
    .modal-content.large { width: 95%; max-width: 1100px; }
    
    /* --- GENERAL RESET --- */
    body { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7fa; color: #333; height: 100vh; display: flex; flex-direction: column; }
    * { box-sizing: border-box; }

    /* --- HEADER --- */
    header { background-color: white; padding: 0 40px; height: 70px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); flex-shrink: 0; z-index: 100; position: relative; }
    .logo-section { display: flex; align-items: center; gap: 10px; width: 250px; }
    .logo-icon { font-size: 32px; color: #1a73e8; }
    .logo-text { font-size: 24px; font-weight: 700; color: #000; }
    .nav-links { display: flex; gap: 30px; height: 100%; }
    .nav-item { display: flex; align-items: center; gap: 8px; text-decoration: none; color: #5f6368; font-weight: 500; font-size: 16px; padding: 0 5px; position: relative; height: 100%; cursor: pointer; }
    .nav-item:hover, .nav-item.active { color: #1a73e8; }
    .nav-item.active::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 3px; background-color: #1a73e8; }
    .profile-section { display: flex; align-items: center; gap: 12px; text-align: right; width: 250px; justify-content: flex-end; }
    .profile-info h4 { margin: 0; font-size: 15px; font-weight: 600; color: #333; }
    .profile-info span { font-size: 13px; color: #777; display: block; }
    .avatar { width: 40px; height: 40px; background-color: #ddd; border-radius: 50%; background-image: url('https://ui-avatars.com/api/?name=Jhomari+Gandionco&background=0D8ABC&color=fff'); background-size: cover; }

    /* --- LAYOUT --- */
    .app-layout { display: flex; flex: 1; overflow: hidden; }
    .sidebar { width: 300px; background-color: white; display: flex; flex-direction: column; padding: 24px 0; flex-shrink: 0; border-right: 1px solid #e0e0e0; }
    .sidebar-item { display: flex; align-items: center; gap: 18px; padding: 12px 30px; text-decoration: none; color: #5f6368; font-size: 15px; font-weight: 500; border-top-right-radius: 50px; border-bottom-right-radius: 50px; margin-right: 10px; transition: background 0.15s; cursor: pointer; }
    .sidebar-item:hover { background-color: #f5f5f5; color: #202124; }
    .sidebar-item.active { background-color: #e8f0fe; color: #1a73e8; font-weight: 600; }
    .sidebar-item.active i { color: #1a73e8; }
    .sidebar-item i { width: 24px; text-align: center; font-size: 20px; color: #5f6368; }

    .main-content { flex: 1; padding: 30px 50px; overflow-y: auto; background-color: white; position: relative; }
    .section-view { display: none; animation: fadeIn 0.3s; }
    .section-view.active-section { display: block; }

    /* STREAM STYLES */
    .class-banner { height: 200px; border-radius: 8px; background-image: url('https://images.unsplash.com/photo-1557683316-973673baf926?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'); background-size: cover; background-position: center; position: relative; margin-bottom: 25px; }
    .class-banner-content { position: absolute; bottom: 20px; left: 25px; right: 25px; color: white; display: flex; justify-content: space-between; align-items: flex-end; }
    .class-banner-content h1 { margin: 0; font-size: 2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    
    .announce-box { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.12); padding: 15px 20px; display: flex; align-items: center; gap: 15px; cursor: pointer; border: 1px solid #dadce0; }
    .stream-item { background: white; border: 1px solid #dadce0; border-radius: 8px; padding: 20px; margin-bottom: 15px; cursor: pointer; display: flex; align-items: center; gap: 20px; }
    .stream-item:hover { background-color: #f8f9fa; box-shadow: 0 1px 3px rgba(0,0,0,0.12); }
    .item-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; flex-shrink: 0; }
    .icon-quiz { background-color: #1a73e8; }
    .icon-assign { background-color: #e37400; }
    .icon-quest { background-color: #a142f4; }

    /* QUIZ CARD STYLES */
    .quiz-question-card { border: 1px solid #eee; padding: 20px; border-radius: 8px; position: relative; margin-bottom: 20px; }
    .q-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 15px; width: 85%; }
    .q-options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .q-opt { background: #fafafa; padding: 10px 15px; border-radius: 6px; border: 1px solid #eee; }
    .q-ans { margin-top: 15px; color: #27ae60; font-weight: 600; background: #e8f5e9; display: inline-block; padding: 5px 10px; border-radius: 4px; }
    .q-actions { display: flex; gap: 5px; position: absolute; top: 20px; right: 20px; }
    .action-btn { background: white; border: 1px solid #ddd; padding: 6px 10px; cursor: pointer; border-radius: 4px; color: #666; transition: 0.2s; }
    .action-btn:hover { color: #1a73e8; border-color: #1a73e8; }
    .btn-del:hover { color: #d32f2f; border-color: #d32f2f; }

    /* EDITING STYLES */
    .edit-input { width: 100%; padding: 8px; border: 1px solid #1a73e8; border-radius: 4px; margin-bottom: 10px; font-family: inherit; }
    .edit-label { font-size: 0.8rem; font-weight: bold; color: #1a73e8; display: block; margin-bottom: 4px; }

    /* --- MODALS --- */
    .modal-overlay { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); align-items: center; justify-content: center; }
    .modal-content { background: white; border-radius: 8px; width: 550px; box-shadow: 0 24px 38px 3px rgba(0,0,0,0.14); display: flex; flex-direction: column; max-height: 90vh; animation: fadeIn 0.2s; }
    .modal-header { padding: 15px 24px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; }
    .modal-body { padding: 24px; overflow-y: auto; }
    .modal-footer { padding: 16px 24px; display: flex; justify-content: flex-end; gap: 10px; }
    .input-group { margin-bottom: 20px; }
    .input-group label { display: block; font-weight: 500; font-size: 0.9rem; margin-bottom: 8px; color: #5f6368; }
    .input-group input, .input-group textarea { width: 100%; padding: 12px; border: 1px solid #dadce0; border-radius: 4px; font-family: inherit; }
    
    .create-wrapper { position: relative; margin-bottom: 40px; }
    .create-btn { background-color: #1a73e8; color: white; border: none; padding: 12px 24px; border-radius: 28px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.3); }
    .dropdown-menu { display: none; position: absolute; top: 55px; left: 0; width: 280px; background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); padding: 8px 0; z-index: 1000; }
    .dropdown-item { display: flex; align-items: center; gap: 20px; padding: 12px 24px; color: #3c4043; cursor: pointer; }
    .dropdown-item:hover { background-color: #f5f5f5; }

    .btn { padding: 8px 24px; border-radius: 4px; border: none; cursor: pointer; font-weight: 500; }
    .btn-cancel { background: white; color: #1a73e8; }
    .btn-go { background: #1a73e8; color: white; }
    .virtual-btn { background-color: rgba(255, 255, 255, 0.2); color: white; border: 1px solid white; padding: 10px 20px; border-radius: 4px; font-weight: 500; display: flex; align-items: center; gap: 10px; backdrop-filter: blur(5px); cursor: pointer; }
    .virtual-btn:hover { background-color: white; color: #1a73e8; }

    #detailView { display: none; }
    .back-btn { background: transparent; border: none; color: #666; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 8px; margin-bottom: 20px; font-weight: 600; }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
</head>
<body>

    <header>
        <div class="logo-section"><i class="fa-solid fa-book-open logo-icon"></i><span class="logo-text">TechHub</span></div>
        <nav class="nav-links">
            <a href="Dashboard.php" class="nav-item">Dashboard</a>
            <a href="Classwork.php" class="nav-item active">Classes</a>
            <a href="gradebook.php" class="nav-item">Gradebook</a>
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
            <div id="streamSection" class="section-view"></div>

            <div id="classworkSection" class="section-view active-section">
                <div class="create-wrapper">
                    <button class="create-btn" onclick="toggleDropdown()"><i class="fa-solid fa-plus"></i> Create</button>
                    <div id="createDropdown" class="dropdown-menu">
                        <div class="dropdown-item" onclick="openModal('aiModal')"><i class="fa-solid fa-robot"></i> AI Quiz Generator</div>
                        <div class="dropdown-item" onclick="openModal('assignModal')"><i class="fa-solid fa-file-pen"></i> Assignment</div>
                        <div class="dropdown-item" onclick="openModal('questModal')"><i class="fa-solid fa-question"></i> Question</div>
                    </div>
                </div>
                <div id="streamView">
                    <div id="emptyState"><i class="fa-solid fa-box-open"></i><p>Your classwork is empty.</p></div>
                    <div id="streamItemsArea"></div>
                </div>

                <div id="detailView">
                    <button class="back-btn" onclick="closeDetail()"><i class="fa-solid fa-arrow-left"></i> Back to List</button>
                    <div class="detail-header"><h1 id="detTitle" style="margin:0; color:#1a73e8;"></h1></div>
                    <div id="detBody" style="background:white; padding:30px; border:1px solid #e0e0e0; border-radius:8px;"></div>
                </div>
            </div>
        </main>
    </div>

    <div id="aiModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header"><h2>AI Quiz Generator</h2><span style="cursor:pointer;" onclick="closeAllModals()">&times;</span></div>
            <div class="modal-body">
                <div class="input-group">
                    <label>Upload PDF for Reference</label>
                    <input type="file" id="aiFile" accept="application/pdf">
                </div>
                <div class="input-group">
                    <label>Instructions</label>
                    <textarea id="aiPrompt" placeholder="e.g., Generate 5 multiple choice questions..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeAllModals()">Cancel</button>
                <button class="btn btn-go" id="aiBtn" onclick="generateQuiz()">Generate</button>
            </div>
        </div>
    </div>

    <div id="jitsiModal" class="modal-overlay">
        <div class="modal-content large">
            <div class="modal-header">
                <h2><i class="fa-solid fa-video"></i> Virtual Class</h2>
                <span style="cursor:pointer;" onclick="closeMeeting()">&times;</span>
            </div>
            <div class="modal-body" style="padding: 10px;">
                <div id="jitsi-container"></div>
            </div>
        </div>
    </div>

    <div id="assignModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header"><h2>New Assignment</h2><span style="cursor:pointer;" onclick="closeAllModals()">&times;</span></div>
            <div class="modal-body">
                <div class="input-group"><label>Title</label><input type="text" id="asTitle"></div>
                <div class="input-group"><label>Instructions</label><textarea id="asInstr"></textarea></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeAllModals()">Cancel</button>
                <button class="btn btn-go" onclick="createAssign()">Create</button>
            </div>
        </div>
    </div>

    <div id="questModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header"><h2>New Question</h2><span style="cursor:pointer;" onclick="closeAllModals()">&times;</span></div>
            <div class="modal-body">
                <div class="input-group"><label>Question</label><textarea id="qText"></textarea></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeAllModals()">Cancel</button>
                <button class="btn btn-go" onclick="createQuest()">Ask</button>
            </div>
        </div>
    </div>

    <script>
        let items = [];
        let jitsiApi = null;

        // --- AI GENERATOR ---
        async function generateQuiz() {
            const file = document.getElementById('aiFile').files[0];
            const prompt = document.getElementById('aiPrompt').value;
            const btn = document.getElementById('aiBtn');
            if (!file) return alert("Please upload a PDF first.");

            btn.innerText = "Generating...";
            btn.disabled = true;

            const formData = new FormData();
            formData.append('pdf_file', file);
            formData.append('custom_prompt', prompt);

            try {
                const res = await fetch('api/generate_quiz_api.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    items.push({ 
                        type: 'Quiz', 
                        title: 'AI Quiz: ' + file.name, 
                        data: data.questions, 
                        icon: 'fa-solid fa-robot', 
                        colorClass: 'icon-quiz' 
                    });
                    renderStream();
                    closeAllModals();
                } else { alert("AI Error: " + data.message); }
            } catch (err) {
                console.error(err);
                alert("Error connecting to server.");
            } finally {
                btn.innerText = "Generate";
                btn.disabled = false;
            }
        }

        // --- UI FUNCTIONS ---
        function switchTab(tabName) {
            document.querySelectorAll('.sidebar-item').forEach(el => el.classList.remove('active'));
            const tab = document.getElementById('tab-' + tabName);
            if(tab) tab.classList.add('active');
            document.querySelectorAll('.section-view').forEach(el => el.classList.remove('active-section'));
            const section = document.getElementById(tabName + 'Section');
            if(section) section.classList.add('active-section');
        }

        function toggleDropdown() { 
            const el = document.getElementById('createDropdown'); 
            el.style.display = (el.style.display === 'block') ? 'none' : 'block'; 
        }

        function openModal(id) { 
            closeAllModals();
            document.getElementById(id).style.display = 'flex'; 
            document.getElementById('createDropdown').style.display = 'none';
        }

        function closeAllModals() { 
            document.querySelectorAll('.modal-overlay').forEach(el => el.style.display = 'none'); 
        }

        function createAssign() {
            const title = document.getElementById('asTitle').value;
            const content = document.getElementById('asInstr').value;
            if(!title) return alert("Title required");
            items.push({ type: 'Assignment', title: title, content: content, icon: 'fa-solid fa-file-pen', colorClass: 'icon-assign' });
            renderStream();
            closeAllModals();
        }

        function createQuest() {
            const title = document.getElementById('qText').value;
            if(!title) return alert("Question required");
            items.push({ type: 'Question', title: title, content: title, icon: 'fa-solid fa-question', colorClass: 'icon-quest' });
            renderStream();
            closeAllModals();
        }

        // --- RENDER DETAIL ---
        function showDetail(index) {
            const item = items[index];
            document.getElementById('streamView').style.display = 'none';
            document.querySelector('.create-wrapper').style.display = 'none';
            document.getElementById('detailView').style.display = 'block';
            document.getElementById('detTitle').innerText = item.title;
            
            renderBodyContent(index);
        }

        function renderBodyContent(itemIndex) {
            const item = items[itemIndex];
            const body = document.getElementById('detBody');
            body.innerHTML = '';

            if (item.type === 'Quiz') {
                renderQuizDetail(itemIndex);
            } else {
                body.innerHTML = `<p>${item.content}</p>`;
            }
        }

        function renderQuizDetail(itemIndex) {
            const body = document.getElementById('detBody');
            body.innerHTML = ''; 
            const questions = items[itemIndex].data;

            if (questions.length === 0) {
                body.innerHTML = '<p>No questions in this quiz.</p>';
                return;
            }

            questions.forEach((q, qIndex) => {
                const div = document.createElement('div');
                div.className = 'quiz-question-card';
                div.id = `q-card-${qIndex}`;
                div.innerHTML = `
                    <div class="q-title">${qIndex + 1}. ${q.question}</div>
                    <div class="q-options-grid">${q.options.map(opt => `<div class="q-opt">${opt}</div>`).join('')}</div>
                    <div class="q-ans"><i class="fa-solid fa-check"></i> Answer: ${q.answer}</div>
                    <div class="q-actions">
                        <button class="action-btn" onclick="enableEdit(${itemIndex}, ${qIndex})"><i class="fa-solid fa-pen"></i> Edit</button>
                        <button class="action-btn btn-del" onclick="deleteQuestion(${itemIndex}, ${qIndex})"><i class="fa-solid fa-trash"></i> Delete</button>
                    </div>
                `;
                body.appendChild(div);
            });
        }

        // --- MODIFY / DELETE FUNCTIONS ---
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
                <label class="edit-label">Question:</label>
                <textarea class="edit-input" id="edit-q-${qIndex}" rows="2">${q.question}</textarea>
                
                <label class="edit-label">Options (one per line):</label>
                <textarea class="edit-input" id="edit-opts-${qIndex}" rows="4">${q.options.join('\n')}</textarea>
                
                <label class="edit-label">Correct Answer:</label>
                <input type="text" class="edit-input" id="edit-ans-${qIndex}" value="${q.answer}">
                
                <div class="q-actions">
                    <button class="btn btn-go" onclick="saveQuestion(${itemIndex}, ${qIndex})">Save</button>
                    <button class="btn btn-cancel" onclick="renderQuizDetail(${itemIndex})">Cancel</button>
                </div>
            `;
        }

        function saveQuestion(itemIndex, qIndex) {
            const newQ = document.getElementById(`edit-q-${qIndex}`).value;
            const newOpts = document.getElementById(`edit-opts-${qIndex}`).value.split('\n').filter(o => o.trim() !== "");
            const newAns = document.getElementById(`edit-ans-${qIndex}`).value;

            items[itemIndex].data[qIndex] = {
                question: newQ,
                options: newOpts,
                answer: newAns
            };

            renderQuizDetail(itemIndex);
        }

        function closeDetail() {
            document.getElementById('detailView').style.display = 'none';
            document.getElementById('streamView').style.display = 'block';
            document.querySelector('.create-wrapper').style.display = 'block';
        }

        // --- JITSI (APPLIED UPDATES FOR ANYTIME CLOSING/LONG DURATION) ---
 function startMeeting() {
    document.getElementById('jitsiModal').style.display = 'flex';
    
    // Change domain from meet.jit.si to meet.ffmuc.net to remove 5-min limit
    const domain = "meet.ffmuc.net"; 
    
    const options = {
        roomName: "TechHub_BSIT41_Programming_Room_2026",
        width: "100%", 
        height: 500,
        parentNode: document.querySelector('#jitsi-container'),
        userInfo: { displayName: 'Prof. Jhomari Gandionco' },
        configOverwrite: {
            prejoinPageEnabled: false,
            startWithAudioMuted: false,
            startWithVideoMuted: false,
            disableDeepLinking: true // Best for keeping it inside the modal
        }
    };
    
    document.querySelector('#jitsi-container').innerHTML = "";
    jitsiApi = new JitsiMeetExternalAPI(domain, options);
}

        function closeMeeting() {
            if (jitsiApi) {
                // Properly disconnects before closing modal
                jitsiApi.executeCommand('hangup');
                jitsiApi.dispose();
                jitsiApi = null;
            }
            document.getElementById('jitsiModal').style.display = 'none';
            document.querySelector('#jitsi-container').innerHTML = "";
        }

        function renderStream() {
            const streamSection = document.getElementById('streamSection');
            const bannerHTML = `
                <div class="class-banner">
                    <div class="class-banner-content">
                        <div><h1>BSIT 4-1 Programming</h1><p>Advanced Web Development</p></div>
                        <button onclick="startMeeting()" class="virtual-btn"><i class="fa-solid fa-video"></i> Virtual Class</button>
                    </div>
                </div>`;
            const announceBoxHTML = `<div class="announce-box"><div class="avatar" style="width:35px; height:35px;"></div><span class="announce-text">Announce something to your class...</span></div>`;
            
            let postsHTML = '';
            const listArea = document.getElementById('streamItemsArea');
            const emptyState = document.getElementById('emptyState');
            listArea.innerHTML = '';

            if (items.length === 0) {
                emptyState.style.display = 'block';
                postsHTML = `<div style="color: #5f6368; font-size: 0.9rem; text-align: center; margin-top:20px;"><p>No announcements yet.</p></div>`;
            } else {
                emptyState.style.display = 'none';
                items.slice().reverse().forEach((item, index) => {
                    const revIdx = items.length - 1 - index;
                    const div = document.createElement('div');
                    div.className = 'stream-item';
                    div.onclick = () => showDetail(revIdx);
                    div.innerHTML = `
                        <div class="item-icon ${item.colorClass}"><i class="${item.icon}"></i></div>
                        <div class="item-content">
                            <div class="item-title">${item.title}</div>
                            <div class="item-meta">New ${item.type} • Posted just now</div>
                        </div>`;
                    listArea.appendChild(div);

                    postsHTML += `
                        <div class="stream-item" style="margin-top:15px;" onclick="switchTab('classwork'); showDetail(${revIdx})">
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

        window.onload = renderStream;
        window.onclick = function(e) {
            if (e.target.classList.contains('modal-overlay')) {
                if(e.target.id === 'jitsiModal') closeMeeting();
                else closeAllModals();
            }
        }
    </script>
</body>
</html>