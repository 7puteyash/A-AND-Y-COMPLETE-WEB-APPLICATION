<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎉 JSON Parsing Issue FIXED!</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; background: #0a0b0f; color: #fff; }
        .success { color: #28a745; } .error { color: #dc3545; } .info { color: #17a2b8; }
        .test-section { background: #101114; padding: 20px; margin: 20px 0; border-radius: 8px; border: 1px solid #d4af37; }
        button { background: linear-gradient(135deg, #d4af37, #b8941f); color: #000; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; margin: 5px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; background: #101114; color: #fff; border: 1px solid #d4af37; border-radius: 4px; }
        pre { background: #000; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🎉 JSON PARSING ISSUE FIXED!</h1>
    
    <div class="test-section">
        <h2 class="success">✅ Problem Resolved</h2>
        <p><strong>Issue:</strong> "Unexpected token '?', "?>{"status"... is not valid JSON"</p>
        <p><strong>Root Cause:</strong> PHP output buffering was not properly managed, causing stray content before JSON responses</p>
        <p><strong>Solution:</strong> Added <code>ob_start()</code> at the beginning and <code>ob_clean()</code> before all JSON responses</p>
    </div>

    <div class="test-section">
        <h2>🧪 API Response Test</h2>
        <button onclick="testApiResponse()">Test API JSON Response</button>
        <div id="api-result"></div>
    </div>

    <div class="test-section">
        <h2>🎯 CSRF Token Test</h2>
        <button onclick="testCsrfToken()">Test CSRF Token</button>
        <div id="csrf-result"></div>
    </div>

    <div class="test-section">
        <h2>📧 Full Contact Form Test</h2>
        <form id="testForm">
            <div>
                <label>Name:</label>
                <input type="text" name="name" value="Test User" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="email" value="test@example.com" required>
            </div>
            <div>
                <label>Phone:</label>
                <input type="tel" name="phone" value="+1234567890" required>
            </div>
            <div>
                <label>Message:</label>
                <textarea name="message" required>This is a comprehensive test to verify that the JSON parsing error has been completely resolved and the contact form is working perfectly with proper output buffer management.</textarea>
            </div>
            <button type="submit">🚀 Test Complete Contact Form</button>
        </form>
        <div id="form-result"></div>
    </div>

    <div class="test-section">
        <h2>🔗 Quick Links</h2>
        <ul>
            <li><a href="./?page=contact" style="color: #d4af37;">Main Contact Page</a></li>
            <li><a href="./contact-test.html" style="color: #d4af37;">Contact Test Page</a></li>
            <li><a href="./get-csrf-token.php" style="color: #d4af37;">CSRF Token API</a></li>
        </ul>
    </div>

    <script>
        // Test API response
        async function testApiResponse() {
            const resultDiv = document.getElementById('api-result');
            resultDiv.innerHTML = '<div class="info">Testing API response...</div>';
            
            try {
                const response = await fetch('./src/api/contact.php', {
                    method: 'GET'
                });
                
                const text = await response.text();
                
                // Check for ?> characters
                if (text.includes('?>')) {
                    resultDiv.innerHTML = '<div class="error">❌ Found ?> characters in response!</div>';
                    return;
                }
                
                // Try to parse as JSON
                const data = JSON.parse(text);
                
                resultDiv.innerHTML = `
                    <div class="success">✅ Perfect! API returns clean JSON</div>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                `;
            } catch (error) {
                resultDiv.innerHTML = `<div class="error">❌ Error: ${error.message}</div>`;
            }
        }

        // Test CSRF token
        async function testCsrfToken() {
            const resultDiv = document.getElementById('csrf-result');
            resultDiv.innerHTML = '<div class="info">Testing CSRF token...</div>';
            
            try {
                const response = await fetch('./get-csrf-token.php');
                const text = await response.text();
                
                // Check for ?> characters
                if (text.includes('?>')) {
                    resultDiv.innerHTML = '<div class="error">❌ Found ?> characters in CSRF response!</div>';
                    return;
                }
                
                const data = JSON.parse(text);
                
                if (data.status === 'success') {
                    resultDiv.innerHTML = `
                        <div class="success">✅ CSRF Token Generated Successfully!</div>
                        <pre>${JSON.stringify(data, null, 2)}</pre>
                    `;
                } else {
                    resultDiv.innerHTML = `<div class="error">❌ CSRF Error: ${data.message}</div>`;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="error">❌ JSON Parse Error: ${error.message}</div>`;
            }
        }

        // Test contact form submission
        document.getElementById('testForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const resultDiv = document.getElementById('form-result');
            resultDiv.innerHTML = '<div class="info">Testing contact form...</div>';

            try {
                // Get CSRF token first
                const tokenResponse = await fetch('./get-csrf-token.php');
                const tokenText = await tokenResponse.text();
                
                // Check for ?> in token response
                if (tokenText.includes('?>')) {
                    resultDiv.innerHTML = '<div class="error">❌ CSRF endpoint has ?> issue!</div>';
                    return;
                }
                
                const tokenData = JSON.parse(tokenText);
                
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

                const responseText = await response.text();
                
                // Check for ?> in form response
                if (responseText.includes('?>')) {
                    resultDiv.innerHTML = '<div class="error">❌ Contact API has ?> issue in response!</div>';
                    return;
                }

                const data = JSON.parse(responseText);

                if (response.ok && data.status === 'success') {
                    resultDiv.innerHTML = `
                        <div class="success">✅ ${data.message}</div>
                        <pre>${JSON.stringify(data, null, 2)}</pre>
                    `;
                } else {
                    resultDiv.innerHTML = `
                        <div class="error">❌ ${data.message}</div>
                        <pre>${JSON.stringify(data, null, 2)}</pre>
                    `;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="error">❌ Error: ${error.message}</div>`;
            }
        });

        // Auto-run tests on page load
        window.onload = function() {
            setTimeout(testApiResponse, 500);
            setTimeout(testCsrfToken, 1000);
        };
    </script>
</body>
</html>
