<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✅ JSON Parsing Error FIXED!</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 20px; 
            background: #0a0b0f; 
            color: #fff;
        }
        .section { 
            background: #1a1b1f; 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 8px; 
            border-left: 4px solid #d4af37;
        }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .fixed { color: #d4af37; font-weight: bold; }
        .code { 
            background: #000; 
            padding: 15px; 
            border-radius: 5px; 
            font-family: 'Courier New', monospace; 
            overflow-x: auto;
            white-space: pre-wrap;
        }
        button { 
            background: linear-gradient(135deg, #d4af37, #b8941f);
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin: 10px 5px;
        }
        button:hover { opacity: 0.9; }
        .form-group { margin: 15px 0; }
        input, textarea { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #d4af37; 
            border-radius: 5px; 
            background: #101114; 
            color: #fff;
            box-sizing: border-box;
        }
        #results { margin-top: 20px; }
        .response-box { 
            background: #000; 
            border: 1px solid #333; 
            padding: 15px; 
            border-radius: 5px; 
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>🎉 JSON Parsing Error COMPLETELY FIXED!</h1>

    <div class="section">
        <h2>✅ Problem Resolution Summary</h2>
        <p><strong class="error">Original Error:</strong> "Unexpected token '?', "?>{"status"... is not valid JSON"</p>
        <p><strong class="fixed">Root Cause:</strong> PHP closing tags `?>` in included files caused extra output before JSON</p>
        <p><strong class="success">Solution:</strong> Removed ALL closing PHP tags from included files (PHP best practice)</p>
        
        <h3>🔧 Files Fixed:</h3>
        <ul>
            <li class="fixed">✅ src/api/contact.php</li>
            <li class="fixed">✅ src/config/database.php</li>
            <li class="fixed">✅ src/includes/security.php</li>
            <li class="fixed">✅ src/config/config.php</li>
            <li class="fixed">✅ bootstrap.php</li>
        </ul>
    </div>

    <div class="section">
        <h2>🧪 Proof: API Returns Clean JSON</h2>
        <button onclick="testApiJson()">Test API JSON Response</button>
        <div id="api-test-result"></div>
    </div>

    <div class="section">
        <h2>🎯 CSRF Token Generation</h2>
        <button onclick="testCsrfToken()">Test CSRF Token</button>
        <div id="csrf-test-result"></div>
    </div>

    <div class="section">
        <h2>📧 Full Contact Form Test</h2>
        <p>This form uses the same session, so CSRF validation will work properly.</p>
        
        <form id="testForm">
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
                <textarea name="message" required>This is a test to verify that the JSON parsing error has been completely resolved!</textarea>
            </div>
            <button type="submit">🚀 Test Contact Form</button>
        </form>
        
        <div id="form-test-result"></div>
    </div>

    <div class="section">
        <h2>🔗 Production Links</h2>
        <ul>
            <li><a href="/?page=contact" target="_blank" style="color: #d4af37;">Main Contact Page</a></li>
            <li><a href="contact-test.html" target="_blank" style="color: #d4af37;">Updated Test Page</a></li>
            <li><a href="get-csrf-token.php" target="_blank" style="color: #d4af37;">CSRF Token Endpoint</a></li>
        </ul>
    </div>

    <div id="results"></div>

    <script>
        // Test API JSON response
        async function testApiJson() {
            const resultDiv = document.getElementById('api-test-result');
            resultDiv.innerHTML = '<div class="response-box">Testing API...</div>';
            
            try {
                const response = await fetch('./src/api/contact.php', {
                    method: 'GET'
                });
                
                const text = await response.text();
                
                try {
                    const json = JSON.parse(text);
                    resultDiv.innerHTML = `
                        <div class="response-box success">
                            ✅ SUCCESS: API returns valid JSON!<br>
                            Status: ${response.status}<br>
                            Response: <div class="code">${JSON.stringify(json, null, 2)}</div>
                        </div>
                    `;
                } catch (parseError) {
                    resultDiv.innerHTML = `
                        <div class="response-box error">
                            ❌ JSON Parse Error: ${parseError.message}<br>
                            Raw Response: <div class="code">${text}</div>
                        </div>
                    `;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="response-box error">❌ Network Error: ${error.message}</div>`;
            }
        }

        // Test CSRF token generation
        async function testCsrfToken() {
            const resultDiv = document.getElementById('csrf-test-result');
            resultDiv.innerHTML = '<div class="response-box">Testing CSRF token...</div>';
            
            try {
                const response = await fetch('./get-csrf-token.php');
                const text = await response.text();
                
                try {
                    const data = JSON.parse(text);
                    if (data.status === 'success') {
                        resultDiv.innerHTML = `
                            <div class="response-box success">
                                ✅ CSRF Token Generated Successfully!<br>
                                <div class="code">${JSON.stringify(data, null, 2)}</div>
                            </div>
                        `;
                    } else {
                        resultDiv.innerHTML = `<div class="response-box error">❌ CSRF Error: ${data.message}</div>`;
                    }
                } catch (parseError) {
                    resultDiv.innerHTML = `
                        <div class="response-box error">
                            ❌ CSRF JSON Parse Error: ${parseError.message}<br>
                            Raw Response: <div class="code">${text}</div>
                        </div>
                    `;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="response-box error">❌ Network Error: ${error.message}</div>`;
            }
        }

        // Test full contact form
        document.getElementById('testForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const resultDiv = document.getElementById('form-test-result');
            resultDiv.innerHTML = '<div class="response-box">Submitting form...</div>';

            try {
                // Get CSRF token
                const tokenResponse = await fetch('./get-csrf-token.php');
                const tokenText = await tokenResponse.text();
                
                let tokenData;
                try {
                    tokenData = JSON.parse(tokenText);
                } catch (parseError) {
                    throw new Error(`CSRF Token JSON Parse Error: ${parseError.message}. Response: ${tokenText}`);
                }
                
                if (tokenData.status !== 'success') {
                    throw new Error(`CSRF Token Error: ${tokenData.message}`);
                }

                // Prepare form data
                const formData = new FormData(this);
                formData.append('csrf_token', tokenData.csrf_token);

                // Submit form
                const response = await fetch('./src/api/contact.php', {
                    method: 'POST',
                    body: formData
                });

                const responseText = await response.text();
                
                try {
                    const result = JSON.parse(responseText);
                    
                    if (response.ok && result.status === 'success') {
                        resultDiv.innerHTML = `
                            <div class="response-box success">
                                ✅ SUCCESS: Contact form working perfectly!<br>
                                <div class="code">${JSON.stringify(result, null, 2)}</div>
                            </div>
                        `;
                    } else {
                        resultDiv.innerHTML = `
                            <div class="response-box error">
                                ❌ Form Error: ${result.message}<br>
                                <div class="code">${JSON.stringify(result, null, 2)}</div>
                            </div>
                        `;
                    }
                } catch (parseError) {
                    resultDiv.innerHTML = `
                        <div class="response-box error">
                            ❌ Response JSON Parse Error: ${parseError.message}<br>
                            Raw Response: <div class="code">${responseText}</div>
                        </div>
                    `;
                }
            } catch (error) {
                resultDiv.innerHTML = `<div class="response-box error">❌ Error: ${error.message}</div>`;
            }
        });

        // Auto-test on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(testApiJson, 1000);
            setTimeout(testCsrfToken, 2000);
        });
    </script>
</body>
</html>
