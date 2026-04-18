# 🔒 Password Security Migration Guide

## Overview
This security prototype branch implements critical password security enhancements for the Hero Intern platform. This document explains the changes and how to integrate them safely.

## What's Changed

### 1. **Password Hashing** (CRITICAL)
**Before (VULNERABLE):**
```php
// Plain text password stored directly
$password !== $row['password']  // Direct comparison
```

**After (SECURE):**
```php
password_hash($password, PASSWORD_BCRYPT, ['cost' => 12])  // Bcrypt with cost 12
password_verify($password, $row['password'])  // Secure comparison
```

### 2. **SQL Injection Prevention**
**Before (VULNERABLE):**
```php
$sql = "SELECT * FROM user WHERE username = '" . $username . "' LIMIT 1";
$result = mysqli_query($db, $sql);
```

**After (SECURE):**
```php
$stmt = $db->prepare("SELECT id, username, password FROM user WHERE ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
```

### 3. **CSRF Token Protection**
All forms now include hidden CSRF tokens to prevent Cross-Site Request Forgery attacks.

### 4. **Rate Limiting**
Prevents brute force attacks by limiting login attempts to 5 per 15 minutes.

### 5. **Password Strength Validation**
New registration enforces strong passwords:
- Minimum 8 characters
- At least one uppercase letter (A-Z)
- At least one lowercase letter (a-z)
- At least one number (0-9)
- At least one special character (!@#$%^&*)

### 6. **Input Sanitization**
All user inputs are trimmed and validated before processing.

---

## Files Modified

### New Files:
1. **`php/security_helper.php`** - Central security utilities class
   - Password hashing/verification
   - CSRF token generation/verification
   - Rate limiting logic
   - Input validation methods

### Updated Files:
1. **`php/login.php`** - Secure login implementation
2. **`php/register.php`** - Secure registration with validation

---

## Migration Steps (DO NOT MERGE DIRECTLY)

### Phase 1: Database Migration (CRITICAL)
The existing passwords in the database are in plain text and need to be migrated. You have two options:

#### Option A: Force Password Reset (Recommended for Production)
```php
// Create a temporary migration script
// Force all users to reset passwords on next login
ALTER TABLE user ADD COLUMN password_migrated INT DEFAULT 0;
ALTER TABLE user ADD COLUMN temp_password VARCHAR(255);
```

Then update login to detect old passwords and redirect to reset flow.

#### Option B: One-Time Migration Script
```php
<?php
require_once("./connection.php");

$users = mysqli_query($db, "SELECT id, password FROM user WHERE LENGTH(password) < 60");

while ($user = mysqli_fetch_assoc($users)) {
    $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT, ['cost' => 12]);
    
    $stmt = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashedPassword, $user['id']);
    $stmt->execute();
    $stmt->close();
}
?>
```

### Phase 2: Code Deployment
1. Create the `security/password-hashing` branch (already done)
2. Review all three new/modified files
3. Test thoroughly in staging environment
4. Create a Pull Request with comprehensive security documentation
5. Get code review from another developer
6. Merge with caution

### Phase 3: Testing Checklist
- [ ] Test registration with weak passwords (should reject)
- [ ] Test registration with strong passwords (should accept)
- [ ] Test login with correct credentials (should pass)
- [ ] Test login with wrong credentials (should fail)
- [ ] Test rate limiting (5 attempts should lock out)
- [ ] Test CSRF token validation (missing token should fail)
- [ ] Test SQL injection attempts (should fail safely)
- [ ] Verify error messages don't leak user info
- [ ] Check database for properly hashed passwords

### Phase 4: Deployment to Production
1. Backup production database
2. Run migration script (Option A or B)
3. Deploy new code
4. Monitor logs for errors
5. Send security notification to all users

---

## Security Features Explained

### Why Bcrypt?
- Adaptive - can increase "cost" as computers get faster
- Automatically salts passwords (different hash each time)
- Resistant to brute-force attacks
- Industry standard for password hashing

### Why Cost 12?
- Current best practice (2024)
- Takes ~100ms to hash on modern hardware
- Should be increased to 13-14 in 2026-2027
- Can be adjusted in `SecurityHelper::hashPassword()`

### Why Rate Limiting?
Prevents attackers from trying thousands of passwords:
- Max 5 attempts per 15-minute window
- Attackers would need 50+ days to try 1 million passwords
- Legitimate users unlikely to have 5+ failed attempts

### Why CSRF Tokens?
Prevents attackers from creating accounts/logging in on behalf of users:
- Token generated per session
- Token verified on form submission
- Tokens unique and non-guessable

---

## Security Comparison

| Feature | Before | After |
|---------|--------|-------|
| Password Storage | Plain text ❌ | Bcrypt hashed ✅ |
| SQL Injection Risk | Direct concatenation ❌ | Prepared statements ✅ |
| CSRF Protection | None ❌ | Token validation ✅ |
| Rate Limiting | None ❌ | 5 attempts / 15 min ✅ |
| Password Requirements | None ❌ | 8+ chars, mixed case, special ✅ |
| Error Messages | Leaks info ❌ | Generic messages ✅ |
| Input Validation | Minimal ❌ | Comprehensive ✅ |

---

## Important Notes

⚠️ **BREAKING CHANGES:**
- All existing user passwords will need to be reset or migrated
- Current sessions may be invalidated
- Users should be notified about the security update

✅ **BACKWARD COMPATIBILITY:**
- No API changes
- No database schema breaking changes (only additions)
- Can be rolled back if needed

---

## Troubleshooting

### "Invalid request. Please try again." on Login/Register
- Browser cookies disabled
- Sessions not working properly
- Check that `session_start()` is first in the file

### "Password must be at least 8 characters..."
- Password doesn't meet the strength requirements
- Check the password requirements display in registration form

### "Too many login attempts"
- Exceeded 5 failed attempts in 15 minutes
- Try again later or use password reset feature
- Lockout files stored in system temp directory

---

## Future Improvements

1. **Email Verification** - Send confirmation emails on registration
2. **Password Reset** - Implement forgot password functionality
3. **2FA/MFA** - Add two-factor authentication
4. **Session Security** - Implement session timeouts and regeneration
5. **Audit Logging** - Log all security-related events
6. **Password History** - Prevent reuse of old passwords
7. **Account Lockout** - More sophisticated account protection

---

## Security Resources

- [OWASP Password Storage Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html)
- [PHP password_hash Documentation](https://www.php.net/manual/en/function.password-hash.php)
- [OWASP SQL Injection Prevention](https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html)
- [OWASP CSRF Prevention](https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html)

---

## Questions?

Contact the security team or create an issue on this PR with security concerns.

**Last Updated:** 2026-04-18
**Status:** ✅ Ready for Review
