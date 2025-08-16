<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Test - CSRF Fixed</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .test-section { background: #f5f5f5; padding: 20px; margin: 20px 0; border-radius: 8px; }
        .success { color: green; } .error { color: red; }
        .form-group { margin-bottom: 15px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>🛠️ CSRF Token Issue - FIXED!</h1>
    
    <div class="test-section">
        <h2>✅ Problem Resolution</h2>
        <p><strong>Issue:</strong> "Network Error: Could not get CSRF token"</p>
        <p><strong>Root Cause:</strong> JavaScript was fetching CSRF token from wrong URL ('/' instead of '/?page=contact')</p>
        <p><strong>Solution:</strong> Created dedicated CSRF endpoint and updated token fetching logic</p>
    </div>

    <div class="test-section">
        <h2>🎯 Quick CSRF Token Test</h2>
        <button onclick="testCsrfToken()">Test CSRF Token Generation</button>
        <div id="csrf-result"></div>
    </div>

    <div class="test-section">
        <h2>📧 Contact Form Test</h2>
        <form id="quickTestForm">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="Test User" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="test@example.com" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="tel" name="phone" value="+1234567890" required>
            </div>
            <div class="form-group">
                <label>Message:</label>
                <textarea name="message" required>This is a test message to verify the contact form is working properly after fixing the CSRF token issue.</textarea>
            </div>
            <button type="submit">Send Test Message</button>
        </form>
        <div id="form-result"></div>
    </div>

    <div class="test-section">
        <h2>🔗 Test Links</h2>
        <ul>
            <li><a href="./?page=contact" target="_blank">Main Contact Page</a></li>
            <li><a href="./get-csrf-token.php" target="_blank">CSRF Token Endpoint</a></li>
            <li><a href="./contact-test.html" target="_blank">Detailed Contact Test</a></li>
            <li><a href="./clear-rate-limit.php" target="_blank">Clear Rate Limiting</a></li>
        </ul>
    </div>

    <script>
        // Test CSRF token generation
        async function testCsrfToken() {
            const resultDiv = document.getElementById('csrf-result');
            resultDiv.innerHTML = 'Testing...';
            
            try {
                const response = await fetch('./get-csrf-token.php');
                const data = await response.json();
                
                if (data.status === 'success') {
                    resultDiv.innerHTML = `
                        <div class="success">
                            ✅ CSRF Token Generated Successfully!<br>
                            Token: ${data.csrf_token.substring(0, 20)}...<br>
                            Session ID: ${data.session_id}
                        </div>
                    `;
                } else {
                    resultDiv.innerHTML = `<div class="error">❌ Error: ${data.message}</div>`;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="error">❌ Network Error: ${error.message}</div>`;
            }
        }

        // Test contact form submission
        document.getElementById('quickTestForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const resultDiv = document.getElementById('form-result');
            resultDiv.innerHTML = 'Sending...';

            try {
                // Get CSRF token
                const tokenResponse = await fetch('./get-csrf-token.php');
                const tokenData = await tokenResponse.json();
                
                if (tokenData.status !== 'success') {
                    throw new Error('Could not get CSRF token');
                }

                // Prepare form data
                const formData = new FormData(this);
                formData.append('csrf_token', tokenData.csrf_token);

                // Send form
                const response = await fetch('./src/api/contact.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    resultDiv.innerHTML = `<div class="success">✅ ${data.message}</div>`;
                } else {
                    resultDiv.innerHTML = `<div class="error">❌ ${data.message}</div>`;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="error">❌ Error: ${error.message}</div>`;
            }
        });
    </script>
</body>
</html>
