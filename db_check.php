<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '', [PDO::ATTR_TIMEOUT => 3]);
    echo "Connected.\n";

    // Check processes
    $stmt = $pdo->query("SHOW PROCESSLIST");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['Command'] !== 'Sleep') {
            echo "Process: {$row['Id']} - {$row['User']} - {$row['Command']} - {$row['State']} - {$row['Info']}\n";
        }
    }

    // Check if mommas_bakeshop exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'mommas_bakeshop'");
    if ($stmt->fetch()) {
        echo "DB mommas_bakeshop EXISTS\n";
    } else {
        echo "DB mommas_bakeshop MISSING\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
