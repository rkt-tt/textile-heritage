<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/header.php";
?>

<style>
/* =============================
CLEAN INSTITUTIONAL UI
============================= */

.identify-page {
    max-width: 1000px;
    margin: 30px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

/* HEADER SECTION */
.identify-hero {
    background: #f5efe6;
    padding: 25px;
    border-radius: 6px;
    text-align: center;
    margin-bottom: 25px;
    border: 1px solid #ddd;
}

.identify-hero h2 {
    margin: 0;
    font-size: 24px;
    color: #222;
}

.identify-hero p {
    margin-top: 8px;
    color: #555;
}

/* GRID */
.identify-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

/* CARDS */
.upload-card,
.results-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 20px;
}

/* TITLES */
.upload-card h3,
.results-card h3 {
    margin-bottom: 15px;
    font-size: 18px;
    color: #222;
}

/* DROP ZONE */
.drop-zone {
    border: 2px dashed #ccc;
    padding: 40px;
    text-align: center;
    cursor: pointer;
    background: #fafafa;
}

.drop-zone:hover {
    border-color: #b38b59;
}

/* PREVIEW */
.preview-img {
    width: 100%;
    max-height: 300px;
    object-fit: contain;
    margin-top: 15px;
}

/* BUTTON */
.identify-btn {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    background: #b38b59;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.identify-btn:hover {
    background: #8b6a3e;
}

/* RESULTS */
.prediction-header {
    padding: 15px;
    background: #f5efe6;
    border-radius: 6px;
    text-align: center;
    margin-bottom: 15px;
}

.prediction-name {
    font-size: 22px;
    font-weight: bold;
}

.prediction-confidence {
    color: #b38b59;
    font-weight: 600;
}

/* SCORE BARS */
.score-bar-item {
    margin-bottom: 10px;
}

.score-bar-track {
    height: 8px;
    background: #eee;
}

.score-bar-fill {
    height: 8px;
    background: #b38b59;
}

/* SECONDARY BUTTON (CLEAR) */
.secondary-btn {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background: transparent;
    color: #666;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    font-size: 13px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.secondary-btn:hover {
    background: #f9f9f9;
    border-color: #b38b59;
    color: #b38b59;
}

/* ERROR */
.error-msg {
    color: #d93025;
    margin-top: 10px;
    font-size: 13px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .identify-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="identify-page">

    <!-- HEADER -->
    <div class="identify-hero">
        <h2>Identify Your Textile Design</h2>
        <p>Upload an image to identify the textile.</p>
    </div>

    <div class="identify-grid">

        <!-- LEFT -->
        <div class="upload-card">
            <h3>Upload Image</h3>

            <input type="file" id="fileInput" accept="image/*" style="display:none;">

            <div class="drop-zone" id="dropZone" onclick="fileInput.click();">
                Click or drag image here
            </div>

            <img id="previewImg" class="preview-img" style="display:none;">
            <button id="clearBtn" class="secondary-btn" style="display:none;">
                <i class="fas fa-trash-alt"></i> Clear / Upload New
            </button>

            <button class="identify-btn" id="identifyBtn" onclick="runIdentification()">
                Identify
            </button>

            <div class="error-msg" id="errorMsg"></div>
        </div>

        <!-- RIGHT -->
        <div class="results-card">

            <h3>Classification Results</h3>

            <div class="prediction-header">
                <div id="predName">—</div>
                <div id="predConfidence">—</div>
            </div>

            <div id="scoreBars"></div>

        </div>

    </div>
</div>

<script>
const API_URL = window.location.protocol + '//' + window.location.hostname + ':8081/api/identify';

const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const previewImg = document.getElementById('previewImg');
const identifyBtn = document.getElementById('identifyBtn');
const errorMsg = document.getElementById('errorMsg');

let selectedFile = null;

/* FILE SELECT */
fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) handleFile(e.target.files[0]);
});

/* DRAG DROP */
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
});
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    handleFile(e.dataTransfer.files[0]);
});

function handleFile(file) {
    if (!file.type.startsWith('image/')) {
    showError('Upload image only');
    return;
}

selectedFile = file;

const reader = new FileReader();
reader.onload = (e) => {
    previewImg.src = e.target.result;
    previewImg.style.display = "block";
    dropZone.style.display = "none";

    document.getElementById('clearBtn').style.display = "block";  // 🔥 ADD THIS
};
reader.readAsDataURL(file);
}

/* API CALL */
async function runIdentification() {
    if (!selectedFile) return;

    identifyBtn.disabled = true;

    const formData = new FormData();
    formData.append('file', selectedFile);

    try {
        const res = await fetch(API_URL, {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.success) displayResults(data);
        else showError('Failed');
    } catch {
        showError('Server error');
    }

    identifyBtn.disabled = false;
}

function displayResults(data) {
    document.getElementById('predName').textContent = data.predicted_class;
    document.getElementById('predConfidence').textContent = data.confidence.toFixed(1) + '%';

    const container = document.getElementById('scoreBars');
    container.innerHTML = '';

    for (let cls in data.class_scores) {
        const score = data.class_scores[cls].ensemble;

        const div = document.createElement('div');
        div.className = 'score-bar-item';
        div.innerHTML = `
            <div>${cls} (${score.toFixed(1)}%)</div>
            <div class="score-bar-track">
                <div class="score-bar-fill" style="width:${score}%"></div>
            </div>
        `;
        container.appendChild(div);
    }
}

function showError(msg) {
    errorMsg.textContent = msg;
}

function clearImage() {
    selectedFile = null;

    previewImg.src = "";
    previewImg.style.display = "none";

    dropZone.style.display = "block";

    fileInput.value = "";

    document.getElementById('clearBtn').style.display = "none";

    document.getElementById('predName').textContent = "—";
    document.getElementById('predConfidence').textContent = "—";
    document.getElementById('scoreBars').innerHTML = "";

    errorMsg.textContent = "";
}
document.getElementById('clearBtn').addEventListener('click', clearImage);

</script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>