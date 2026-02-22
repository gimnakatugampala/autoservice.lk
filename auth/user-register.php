<?php include_once '../includes/header.php';?>

<?php
require_once '../includes/db_config.php';

if (!isset($_SESSION["station_id"]) || $_SESSION["station_id"] == null) {
    header('Location: ../auth/station-login.php');
    exit(); 
} else {
    $sql = "SELECT * FROM employee WHERE service_station_id = '{$_SESSION["station_id"]}' AND user_type_id = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header('Location: ../auth/station-login.php');
        exit(); 
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue:        #007bff;
        --blue-dark:   #0056b3;
        --blue-light:  #e8f2ff;
        --blue-mid:    #c5deff;
        --blue-glow:   rgba(0,123,255,0.18);
        --white:       #ffffff;
        --surface:     #f4f7fb;
        --border:      #e2e8f0;
        --text-1:      #0f1c2e;
        --text-2:      #4a5a72;
        --text-3:      #8a9bb5;
        --danger:      #e53e3e;
        --success:     #38a169;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body.register-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--surface);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        /* overflow: hidden; */
    }

    /* Soft background blobs */
    body.register-page::before {
        content: '';
        position: fixed;
        top: -120px; left: -120px;
        width: 480px; height: 480px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }
    body.register-page::after {
        content: '';
        position: fixed;
        bottom: -100px; right: -100px;
        width: 380px; height: 380px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* ── CARD ── */
    .reg-card {
        position: relative;
        z-index: 1;
        width: 420px;
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 8px 48px rgba(0,0,0,0.10), 0 1.5px 0 var(--border);
        padding: 40px 44px 36px;
        animation: slideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    /* Top blue accent bar */
    .reg-card::before {
        content: '';
        position: absolute;
        top: 0; left: 44px; right: 44px;
        height: 3px;
        background: linear-gradient(90deg, var(--blue), #0062d6);
        border-radius: 0 0 4px 4px;
    }

    /* ── STATION BRANDING ── */
    .station-brand {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border);
    }

    .station-logo-wrap {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        /* overflow: hidden; */
        border: 2.5px solid var(--border);
        box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        margin-bottom: 12px;
        flex-shrink: 0;
    }
    .station-logo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .station-name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.4px;
        text-align: center;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .station-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--blue-light);
        color: var(--blue);
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 100px;
    }
    .station-badge .dot {
        width: 5px; height: 5px;
        background: var(--blue);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    /* ── HEADING ── */
    .reg-heading {
        margin-bottom: 22px;
    }
    .reg-heading h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.5px;
        margin: 0 0 4px;
        line-height: 1.2;
    }
    .reg-heading p {
        font-size: 13px;
        color: var(--text-2);
        font-weight: 400;
        margin: 0;
    }

    /* ── FIELDS ── */
    .field-block { margin-bottom: 14px; }

    .field-block label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-1);
        margin-bottom: 6px;
    }

    .field-wrap { position: relative; }

    .field-wrap input {
        width: 100%;
        padding: 11px 40px 11px 14px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-1);
        background: var(--white);
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        -webkit-appearance: none;
        box-sizing: border-box;
    }
    .field-wrap input::placeholder { color: var(--text-3); }
    .field-wrap input:focus {
        outline: none;
        border-color: var(--blue);
        background: #fafcff;
        box-shadow: 0 0 0 3px var(--blue-glow);
    }

    .field-icon {
        position: absolute;
        right: 13px; top: 50%;
        transform: translateY(-50%);
        color: var(--text-3);
        font-size: 13px;
        pointer-events: none;
    }

    .toggle-password {
        position: absolute;
        right: 13px; top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-3);
        font-size: 13px;
        transition: color 0.2s;
    }
    .toggle-password:hover { color: var(--blue); }

    /* ── PASSWORD STRENGTH ── */
    .strength-bar-wrap {
        margin-top: 8px;
        display: flex;
        gap: 4px;
    }
    .strength-seg {
        flex: 1;
        height: 3px;
        border-radius: 100px;
        background: var(--border);
        transition: background 0.3s;
    }
    .strength-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-3);
        margin-top: 5px;
        min-height: 14px;
    }

    /* ── SUBMIT BUTTON ── */
    .btn-submit {
        position: relative;
        width: 100%;
        padding: 12px 18px;
        background: linear-gradient(135deg, var(--blue) 0%, #0062d6 100%);
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        overflow: hidden;
        transition: transform 0.18s, box-shadow 0.18s;
        box-shadow: 0 4px 16px rgba(0,102,255,0.28);
        margin-top: 6px;
        letter-spacing: 0.3px;
    }
    .btn-submit::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s;
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,102,255,0.38); }
    .btn-submit:hover::after { left: 160%; }
    .btn-submit:active { transform: translateY(0); }

    .btn-loading-state {
        display: none;
        width: 100%;
        padding: 12px 18px;
        background: var(--blue-light);
        color: var(--blue);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        border: 1.5px solid var(--blue-mid);
        border-radius: 10px;
        cursor: not-allowed;
        margin-top: 6px;
        text-align: center;
        box-sizing: border-box;
    }

    /* ── FOOTER LINK ── */
    .reg-footer {
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid var(--border);
        text-align: center;
    }
    .reg-footer p {
        font-size: 12.5px;
        color: var(--text-3);
        margin: 0;
    }
    .reg-footer a {
        font-size: 13px;
        font-weight: 600;
        color: var(--blue);
        text-decoration: none;
        transition: color 0.2s;
    }
    .reg-footer a:hover { color: var(--blue-dark); text-decoration: underline; }

    /* ── SECURITY NOTE ── */
    .security-note {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        background: var(--blue-light);
        border: 1px solid var(--blue-mid);
        border-radius: 10px;
        padding: 10px 13px;
        margin-bottom: 18px;
    }
    .security-note i {
        color: var(--blue);
        font-size: 13px;
        margin-top: 1px;
        flex-shrink: 0;
    }
    .security-note span {
        font-size: 12px;
        color: var(--text-2);
        line-height: 1.55;
    }

    /* ── ANIMATIONS ── */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.6; transform: scale(0.88); }
    }

    @media (max-width: 480px) {
        .reg-card { width: 100%; margin: 16px; padding: 28px 24px 24px; box-sizing: border-box; }
    }
</style>

<body class="hold-transition register-page">

<div class="reg-card">

    <!-- Station Branding -->
    <div class="station-brand">
        <div class="station-logo-wrap">
            <img src="<?php echo (isset($_SESSION["station_img"])) ? '../uploads/stations/' . $_SESSION["station_img"] : '../assets/img/no-image.png'; ?>" 
                 alt="Station Logo">
        </div>
        <div class="station-name"><?php echo htmlspecialchars($_SESSION["station_name"] ?? 'Service Station'); ?></div>
        <div class="station-badge">
            <span class="dot"></span>
            Setup Mode
        </div>
    </div>

    <!-- Heading -->
    <div class="reg-heading">
        <h3>Create Admin Account</h3>
        <p>Register the primary administrator for this station</p>
    </div>

    <!-- Security Note -->
    <div class="security-note">
        <i class="fas fa-shield-alt"></i>
        <span>This account will have full administrative access. Use a strong, unique password.</span>
    </div>

    <!-- Form -->
    <form id="adminRegisterForm" autocomplete="off">

        <div class="field-block">
            <label for="email">Email Address</label>
            <div class="field-wrap">
                <input id="email" type="email" placeholder="admin@station.com" required autocomplete="email">
                <span class="field-icon"><i class="fas fa-envelope"></i></span>
            </div>
        </div>

        <div class="field-block">
            <label for="pass">Create Password</label>
            <div class="field-wrap">
                <input id="pass" type="password" placeholder="Create a strong password" required autocomplete="new-password" oninput="checkStrength(this.value)">
                <span class="toggle-password" onclick="togglePass('pass', 'icon-pass')">
                    <i class="fas fa-eye" id="icon-pass"></i>
                </span>
            </div>
            <div class="strength-bar-wrap">
                <div class="strength-seg" id="seg1"></div>
                <div class="strength-seg" id="seg2"></div>
                <div class="strength-seg" id="seg3"></div>
                <div class="strength-seg" id="seg4"></div>
            </div>
            <div class="strength-label" id="strength-label"></div>
        </div>

        <div class="field-block">
            <label for="con_pass">Confirm Password</label>
            <div class="field-wrap">
                <input id="con_pass" type="password" placeholder="Re-enter your password" required autocomplete="new-password">
                <span class="toggle-password" onclick="togglePass('con_pass', 'icon-con_pass')">
                    <i class="fas fa-eye" id="icon-con_pass"></i>
                </span>
            </div>
        </div>

        <button id="btn-user-reg" type="button" class="btn-submit" onclick="showLoading()">
            <i class="fas fa-user-plus" style="margin-right:7px;"></i>Complete Registration
        </button>

        <div id="btn-loading" class="btn-loading-state">
            <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
            Creating Account…
        </div>

    </form>

    <!-- Footer -->
    <div class="reg-footer">
        <p>Wrong station? <a href="../auth/station-login.php"><i class="fas fa-sign-out-alt" style="font-size:11px;margin-right:3px;"></i>Sign Out</a></p>
    </div>

</div>

<script>
    /* ── Password Visibility ── */
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    /* ── Password Strength ── */
    function checkStrength(val) {
        const segs   = ['seg1','seg2','seg3','seg4'];
        const label  = document.getElementById('strength-label');
        const colors = ['#e53e3e','#dd6b20','#d69e2e','#38a169'];
        const labels = ['Weak','Fair','Good','Strong'];

        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))     score++;

        segs.forEach((id, i) => {
            document.getElementById(id).style.background =
                (val.length === 0) ? 'var(--border)' :
                (i < score)        ? colors[score - 1] : 'var(--border)';
        });

        label.textContent     = val.length ? labels[score - 1] || '' : '';
        label.style.color     = val.length ? colors[score - 1] : 'var(--text-3)';
    }

    /* ── Loading State ── */
    function showLoading() {
        document.getElementById('btn-user-reg').style.display  = 'none';
        document.getElementById('btn-loading').style.display   = 'block';
    }

    /* ── Enter Key ── */
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('#adminRegisterForm input').forEach(input => {
            input.addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    document.getElementById("btn-user-reg").click();
                }
            });
        });
    });
</script>

<?php include_once '../includes/footer.php';?>
</body>
</html>