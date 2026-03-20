<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect without selecting a database first
$conn = new mysqli("localhost", "root", "0416");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "=== XAMPP Database Setup ===\n\n";

// 1. Check if database exists
echo "1. Checking if 'travel_adviser' database exists...\n";
$result = $conn->query("SHOW DATABASES LIKE 'travel_adviser'");
if ($result && $result->num_rows > 0) {
    echo "✓ Database 'travel_adviser' already exists\n\n";
} else {
    echo "✗ Database 'travel_adviser' does NOT exist\n";
    echo "   Creating database...\n";
    if ($conn->query("CREATE DATABASE travel_adviser")) {
        echo "   ✓ Database created successfully\n\n";
    } else {
        die("Error creating database: " . $conn->error);
    }
}

// 2. Select the database
if (!$conn->select_db("travel_adviser")) {
    die("Error selecting database: " . $conn->error);
}

// 3. Read and import the SQL file
echo "2. Importing database schema from database.sql...\n";
$sqlFile = 'c:\\xampp\\htdocs\\Travel_Adviser\\database.sql';

if (!file_exists($sqlFile)) {
    die("Error: database.sql not found at $sqlFile");
}

$sqlContent = file_get_contents($sqlFile);
$queries = array_filter(array_map('trim', explode(';', $sqlContent)));

$importedTables = 0;
foreach ($queries as $query) {
    if (!empty($query)) {
        if ($conn->query($query)) {
            $importedTables++;
        } else {
            echo "✗ Query error: " . $conn->error . "\n";
            echo "   Query: " . substr($query, 0, 100) . "...\n";
        }
    }
}

echo "   ✓ Imported $importedTables queries\n\n";

// 4. Verify tables were created
echo "3. Verifying tables in database...\n";
$tables = $conn->query("SHOW TABLES");
$tableCount = $tables->num_rows;
echo "   Found $tableCount tables:\n";

while ($row = $tables->fetch_array()) {
    echo "   - " . $row[0] . "\n";
}

// 5. Check table structures
echo "\n4. Table structures:\n";
$tableStructure = $conn->query("DESCRIBE users");
echo "   Users table:\n";
while ($row = $tableStructure->fetch_assoc()) {
    echo "     - " . $row['Field'] . " (" . $row['Type'] . ")\n";
}

echo "\n✓ Database setup complete!\n";
echo "✓ You can now use the Travel Adviser application with XAMPP MySQL.\n";

$conn->close();
?>
