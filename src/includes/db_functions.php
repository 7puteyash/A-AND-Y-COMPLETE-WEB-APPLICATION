function insertLead($name, $email, $phone, $message, $conn) {
    $stmt = $conn->prepare("INSERT INTO leads (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error inserting lead: " . $stmt->error, 3, __DIR__ . '/../logs/error.log');
        return false;
    }
    
    $stmt->close();
}