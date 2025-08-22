# CLAUDE-PHP.md

This file provides comprehensive guidance to Claude Code when working with PHP applications, specifically for the WebSys project.

## Core Development Philosophy

### KISS (Keep It Simple, Stupid)
Simplicity should be a key goal in design. Choose straightforward solutions over complex ones whenever possible. Simple solutions are easier to understand, maintain, and debug.

### YAGNI (You Aren't Gonna Need It)
Avoid building functionality on speculation. Implement features only when they are needed, not when you anticipate they might be useful in the future.

### Design Principles
- **Modular Architecture**: Build with small, focused modules that do one thing well
- **Separation of Concerns**: Keep business logic, presentation, and data access separate
- **Error Handling**: Always handle errors gracefully with proper logging
- **Fail Fast**: Validate inputs early and throw meaningful errors immediately
- **Security First**: Never trust user input, always validate and sanitize

## 🤖 AI Assistant Guidelines

### Context Awareness
- When implementing features, always check existing patterns first
- Prefer composition over inheritance in all designs
- Use existing utilities before creating new ones
- Check for similar functionality in other domains/features
- Respect the existing PHP infrastructure without adding new dependencies

### Common Pitfalls to Avoid
- Creating duplicate functionality
- Overwriting existing tests
- Modifying core frameworks without explicit instruction
- Adding external dependencies (project constraint)
- Using deprecated PHP functions
- Mixing HTML and PHP logic

### Workflow Patterns
- Preferably create tests BEFORE implementation (TDD)
- Use "think hard" for architecture decisions
- Break complex tasks into smaller, testable units
- Validate understanding before implementation
- Follow existing file naming conventions

### Search Command Requirements
**CRITICAL**: Always use `rg` (ripgrep) instead of traditional `grep` and `find` commands:

```bash
# ❌ Don't use grep
grep -r "pattern" .

# ✅ Use rg instead
rg "pattern"

# ❌ Don't use find with name
find . -name "*.php"

# ✅ Use rg with file filtering
rg --files | rg "\.php$"
# or
rg --files -g "*.php"
```

**Enforcement Rules:**
```
(
    r"^grep\b(?!.*\|)",
    "Use 'rg' (ripgrep) instead of 'grep' for better performance and features",
),
(
    r"^find\s+\S+\s+-name\b",
    "Use 'rg --files | rg pattern' or 'rg --files -g pattern' instead of 'find -name' for better performance",
),
```

## 🚀 PHP Best Practices

### Modern PHP Features (PHP 8.0+)
- **Type Declarations**: Use strict typing with `declare(strict_types=1);`
- **Named Arguments**: Improve code readability
- **Constructor Property Promotion**: Reduce boilerplate
- **Match Expressions**: Use instead of switch when possible
- **Nullsafe Operator**: Safe property/method access
- **Attributes**: Use for metadata and annotations

### Performance Features
- **OPcache**: Enable for production performance
- **Memory Management**: Monitor memory usage and clean up resources
- **Database Connection Pooling**: Reuse connections efficiently
- **Caching**: Implement appropriate caching strategies
- **Lazy Loading**: Load resources only when needed

### Security Enhancements
- **Input Validation**: Always validate and sanitize user input
- **SQL Injection Prevention**: Use prepared statements
- **XSS Protection**: Escape output properly
- **CSRF Protection**: Implement token-based protection
- **File Upload Security**: Validate file types and sizes

## 🏗️ Project Structure (WebSys Specific)

```
webSyS/
├── assets/                 # Static assets (CSS, JS, images)
│   ├── css/
│   ├── js/
│   ├── img/
│   └── fonts/
├── config/                 # Configuration files
│   └── config.php
├── includes/               # PHP includes and components
│   ├── components/         # Reusable UI components
│   ├── functions.php       # Global functions
│   ├── head.php           # HTML head section
│   ├── nav.php            # Navigation component
│   ├── footer.php         # Footer component
│   └── script.php         # Script includes
├── templates/              # Page templates
├── index.php              # Main entry point
├── *.php                  # Individual page files
└── .htaccess              # Apache configuration
```

## 📦 PHP Configuration Best Practices

### php.ini Recommendations
```ini
; Error handling
display_errors = Off
log_errors = On
error_log = /path/to/error.log
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT

; Performance
opcache.enable = 1
opcache.memory_consumption = 128
opcache.max_accelerated_files = 4000
opcache.revalidate_freq = 2

; Security
expose_php = Off
allow_url_fopen = Off
allow_url_include = Off
session.cookie_httponly = 1
session.cookie_secure = 1
```

### .htaccess Configuration
```apache
# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"

# PHP settings
php_value upload_max_filesize 10M
php_value post_max_size 10M
php_value max_execution_time 30
php_value memory_limit 256M

# URL rewriting
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
```

## 🎯 Input Validation & Sanitization

### Form Validation
```php
<?php
declare(strict_types=1);

class FormValidator {
    private array $errors = [];
    
    public function validateEmail(string $email): bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Invalid email format';
            return false;
        }
        return true;
    }
    
    public function validateRequired(string $value, string $fieldName): bool {
        if (empty(trim($value))) {
            $this->errors[] = "$fieldName is required";
            return false;
        }
        return true;
    }
    
    public function sanitizeInput(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    public function getErrors(): array {
        return $this->errors;
    }
}

// Usage
$validator = new FormValidator();
$email = $_POST['email'] ?? '';
$name = $_POST['name'] ?? '';

if ($validator->validateEmail($email) && $validator->validateRequired($name, 'Name')) {
    $cleanEmail = $validator->sanitizeInput($email);
    $cleanName = $validator->sanitizeInput($name);
    // Process form
} else {
    $errors = $validator->getErrors();
    // Display errors
}
?>
```

## 🧪 Testing Strategy

### Simple Testing Framework
```php
<?php
class SimpleTest {
    private int $passed = 0;
    private int $failed = 0;
    
    public function assertEqual($expected, $actual, string $message = ''): void {
        if ($expected === $actual) {
            $this->passed++;
            echo "✓ PASS: $message\n";
        } else {
            $this->failed++;
            echo "✗ FAIL: $message (Expected: $expected, Got: $actual)\n";
        }
    }
    
    public function assertTrue($condition, string $message = ''): void {
        $this->assertEqual(true, $condition, $message);
    }
    
    public function assertFalse($condition, string $message = ''): void {
        $this->assertEqual(false, $condition, $message);
    }
    
    public function getResults(): array {
        return [
            'passed' => $this->passed,
            'failed' => $this->failed,
            'total' => $this->passed + $this->failed
        ];
    }
}

// Example test
$test = new SimpleTest();
$validator = new FormValidator();

$test->assertTrue($validator->validateEmail('test@example.com'), 'Valid email should pass');
$test->assertFalse($validator->validateEmail('invalid-email'), 'Invalid email should fail');

$results = $test->getResults();
echo "Tests completed: {$results['passed']} passed, {$results['failed']} failed\n";
?>
```

## 🚀 Performance Best Practices

### Database Optimization
```php
<?php
class Database {
    private PDO $pdo;
    
    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=websys;charset=utf8mb4',
            'username',
            'password',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]
        );
    }
    
    public function query(string $sql, array $params = []): PDOStatement {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetchAll(string $sql, array $params = []): array {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function fetchOne(string $sql, array $params = []): ?array {
        $result = $this->query($sql, $params)->fetch();
        return $result ?: null;
    }
}

// Usage with prepared statements
$db = new Database();
$users = $db->fetchAll(
    'SELECT * FROM users WHERE status = ? AND created_at > ?',
    ['active', date('Y-m-d', strtotime('-30 days'))]
);
?>
```

### Caching Strategy
```php
<?php
class SimpleCache {
    private string $cacheDir;
    
    public function __construct(string $cacheDir = 'cache/') {
        $this->cacheDir = $cacheDir;
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
    }
    
    public function get(string $key) {
        $filename = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($filename) && (time() - filemtime($filename)) < 3600) {
            return unserialize(file_get_contents($filename));
        }
        return null;
    }
    
    public function set(string $key, $value, int $ttl = 3600): void {
        $filename = $this->cacheDir . md5($key) . '.cache';
        file_put_contents($filename, serialize($value));
        touch($filename, time() + $ttl);
    }
    
    public function delete(string $key): void {
        $filename = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($filename)) {
            unlink($filename);
        }
    }
}

// Usage
$cache = new SimpleCache();
$data = $cache->get('expensive_operation');
if ($data === null) {
    $data = performExpensiveOperation();
    $cache->set('expensive_operation', $data, 1800); // 30 minutes
}
?>
```

## 🔐 Security Requirements

### Session Security
```php
<?php
// Secure session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Strict');

session_start();

// Regenerate session ID periodically
if (!isset($_SESSION['last_regeneration'])) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} elseif (time() - $_SESSION['last_regeneration'] > 300) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

// CSRF protection
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('CSRF token validation failed');
    }
}
?>
```

### File Upload Security
```php
<?php
class SecureFileUpload {
    private array $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    private int $maxSize = 5242880; // 5MB
    
    public function upload(array $file): array {
        $errors = [];
        
        // Check file size
        if ($file['size'] > $this->maxSize) {
            $errors[] = 'File size exceeds limit';
        }
        
        // Check file type
        if (!in_array($file['type'], $this->allowedTypes)) {
            $errors[] = 'File type not allowed';
        }
        
        // Validate file content
        if (!$this->isValidFile($file['tmp_name'])) {
            $errors[] = 'Invalid file content';
        }
        
        if (empty($errors)) {
            $filename = $this->generateSafeFilename($file['name']);
            $destination = 'uploads/' . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                return ['success' => true, 'filename' => $filename];
            } else {
                $errors[] = 'Failed to move uploaded file';
            }
        }
        
        return ['success' => false, 'errors' => $errors];
    }
    
    private function isValidFile(string $tmpName): bool {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmpName);
        finfo_close($finfo);
        
        return in_array($mimeType, $this->allowedTypes);
    }
    
    private function generateSafeFilename(string $originalName): string {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        return uniqid() . '_' . time() . '.' . $extension;
    }
}
?>
```

## 📊 Logging & Error Handling

### Structured Logging
```php
<?php
class Logger {
    private string $logFile;
    
    public function __construct(string $logFile = 'logs/app.log') {
        $this->logFile = $logFile;
        $logDir = dirname($logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
    }
    
    public function log(string $level, string $message, array $context = []): void {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' ' . json_encode($context) : '';
        $logEntry = "[$timestamp] [$level] $message$contextStr" . PHP_EOL;
        
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    public function info(string $message, array $context = []): void {
        $this->log('INFO', $message, $context);
    }
    
    public function error(string $message, array $context = []): void {
        $this->log('ERROR', $message, $context);
    }
    
    public function warning(string $message, array $context = []): void {
        $this->log('WARNING', $message, $context);
    }
}

// Usage
$logger = new Logger();
$logger->info('User logged in', ['user_id' => 123, 'ip' => $_SERVER['REMOTE_ADDR']]);
?>
```

### Error Handling
```php
<?php
// Custom error handler
function customErrorHandler(int $errno, string $errstr, string $errfile, int $errline): bool {
    $logger = new Logger();
    $logger->error("PHP Error: $errstr", [
        'file' => $errfile,
        'line' => $errline,
        'type' => $errno
    ]);
    
    if (ini_get('display_errors')) {
        echo "<div style='color: red;'>Error: $errstr in $errfile on line $errline</div>";
    }
    
    return true;
}

set_error_handler('customErrorHandler');

// Exception handler
function customExceptionHandler(Throwable $exception): void {
    $logger = new Logger();
    $logger->error("Uncaught Exception: " . $exception->getMessage(), [
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString()
    ]);
    
    if (ini_get('display_errors')) {
        echo "<div style='color: red;'>Fatal Error: " . $exception->getMessage() . "</div>";
    } else {
        http_response_code(500);
        echo "An error occurred. Please try again later.";
    }
}

set_exception_handler('customExceptionHandler');
?>
```

## 🔄 Database Best Practices

### Connection Management
```php
<?php
class DatabaseConnection {
    private static ?PDO $instance = null;
    
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=localhost;dbname=websys;charset=utf8mb4',
                    'username',
                    'password',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                    ]
                );
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                throw new Exception('Database connection failed');
            }
        }
        return self::$instance;
    }
    
    public static function close(): void {
        self::$instance = null;
    }
}

// Usage
try {
    $pdo = DatabaseConnection::getInstance();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
} catch (Exception $e) {
    // Handle error
}
?>
```

## ⚠️ Critical Guidelines

1. **NEVER trust user input** - Always validate and sanitize
2. **ALWAYS use prepared statements** - Prevent SQL injection
3. **NEVER store secrets in code** - Use environment variables
4. **ALWAYS handle errors** - No silent failures
5. **MINIMUM input validation** - Validate all external data
6. **ALWAYS use structured logging** - Log important events
7. **NEVER use deprecated functions** - Use modern PHP features
8. **ALWAYS set proper headers** - Security and performance headers
9. **NEVER mix HTML and PHP** - Separate concerns
10. **ALWAYS use HTTPS in production** - Secure all communications
11. **MONITOR performance** - Track execution time and memory usage
12. **USE existing infrastructure** - Don't add new dependencies

## 📋 Pre-commit Checklist

- [ ] All functions have proper error handling
- [ ] Input validation implemented for all forms
- [ ] SQL queries use prepared statements
- [ ] Output is properly escaped
- [ ] Session security configured
- [ ] File uploads are secure
- [ ] Error logging implemented
- [ ] Performance impact assessed
- [ ] Security headers set
- [ ] Documentation updated

## 🔧 Useful Commands

```bash
# Development
php -S localhost:8000          # Built-in development server
php -l file.php                # Syntax check
php -m                         # List loaded modules

# Debugging
php -d display_errors=1 file.php  # Show errors
php -d error_reporting=E_ALL file.php  # Report all errors

# Performance
php -d opcache.enable=1 file.php  # Enable OPcache
php -d memory_limit=512M file.php  # Set memory limit

# Security
php -d allow_url_fopen=Off file.php  # Disable URL fopen
php -d expose_php=Off file.php       # Hide PHP version
```

## 🌐 WebSys Specific Guidelines

### Template Structure
```php
<?php
// Always start with strict types
declare(strict_types=1);

// Include necessary files
require_once 'includes/functions.php';
require_once 'includes/head.php';

// Validate and sanitize inputs
$page = $_GET['page'] ?? 'home';
$page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');

// Set page title
$pageTitle = getPageTitle($page);

// Include header
include 'includes/nav.php';
?>

<!-- Page content -->
<main>
    <?php include "templates/$page.php"; ?>
</main>

<?php
// Include footer and scripts
include 'includes/footer.php';
include 'includes/script.php';
?>
```

### Component Pattern
```php
<?php
// includes/components/card.php
function renderCard(string $title, string $content, array $attributes = []): string {
    $class = $attributes['class'] ?? 'card';
    $id = $attributes['id'] ?? '';
    
    return "
    <div class='$class'" . ($id ? " id='$id'" : '') . ">
        <h3>$title</h3>
        <div class='card-content'>$content</div>
    </div>";
}

// Usage in templates
echo renderCard('Product Title', 'Product description', ['class' => 'product-card']);
?>
```

---

*Keep this guide updated as PHP patterns evolve. Security and performance over convenience, always.*
*Last updated: December 2024*
   