<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Travel Adviser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #0a1628; color: white; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .reset-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 2.5rem; width: 100%; max-width: 450px; }
        .f-input { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 10px; padding: 0.8rem; width: 100%; margin-bottom: 1rem; }
        .f-input:focus { background: rgba(255,255,255,0.1); border-color: #0dcaf0; color: white; outline: none; box-shadow: 0 0 10px rgba(13, 202, 240, 0.2); }
        .btn-reset { background: linear-gradient(135deg, #0dcaf0, #0aa2c0); border: none; color: white; font-weight: 700; width: 100%; padding: 0.8rem; border-radius: 10px; transition: 0.3s; }
        .btn-reset:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(13, 202, 240, 0.4); }
    </style>
</head>
<body>
    <div class="reset-card">
        <h3 class="fw-bold mb-3">Reset Password</h3>
        <p class="text-white-50 small mb-4">Enter your registered email and the new password below.</p>
        
        <div id="resetFeedback" class="alert d-none mb-3"></div>

        <form id="resetForm">
            <label class="small text-white-50 mb-1">Email Address</label>
            <input type="email" id="rEmail" class="f-input" placeholder="you@example.com" required>
            
            <label class="small text-white-50 mb-1">New Password</label>
            <input type="password" id="rPass" class="f-input" placeholder="Min. 6 characters" required>
            
            <button type="submit" class="btn-reset mt-2">Update Password</button>
            <div class="text-center mt-4">
                <a href="login.php" class="text-info small" style="text-decoration: none;"><i class="bi bi-arrow-left me-1"></i>Back to Login</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('rEmail').value.trim();
            const pass = document.getElementById('rPass').value;
            const feedback = document.getElementById('resetFeedback');

            if (pass.length < 6) {
                feedback.className = 'alert alert-danger';
                feedback.textContent = 'Password must be at least 6 characters.';
                feedback.classList.remove('d-none');
                return;
            }

            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', pass);

            fetch('reset_password_process.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    feedback.className = 'alert alert-success';
                    feedback.textContent = data.message;
                    feedback.classList.remove('d-none');
                    setTimeout(() => { window.location.href = 'login.php'; }, 2000);
                } else {
                    feedback.className = 'alert alert-danger';
                    feedback.textContent = data.message;
                    feedback.classList.remove('d-none');
                }
            });
        });
    </script>
</body>
</html>
