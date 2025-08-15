function validateRequiredFields($data, $fields) {
    $errors = [];
    foreach ($fields as $field) {
        if (empty($data[$field])) {
            $errors[$field] = "$field is required.";
        }
    }
    return $errors;
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateContactForm($data) {
    $requiredFields = ['name', 'email', 'phone', 'message'];
    $errors = validateRequiredFields($data, $requiredFields);
    
    if (empty($errors)) {
        $data['name'] = sanitizeInput($data['name']);
        $data['email'] = sanitizeInput($data['email']);
        $data['phone'] = sanitizeInput($data['phone']);
        $data['message'] = sanitizeInput($data['message']);
    }
    
    return ['data' => $data, 'errors' => $errors];
}