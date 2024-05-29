<?php

class InputProcessor {

    // Method to process and validate a string input
    public static function processString(string $string, int $max = 0): array {
        // Check if the string is empty
        if (empty($string)) {
            return self::returnInput("String is empty.", false);
        }

        // Sanitize the string to convert special characters to HTML entities
        $string = htmlspecialchars($string);

        // Set the maximum length for the string
        $max = $max == 0 ? strlen($string) : $max;
        
        // Validate the string length
        if (strlen($string) <= $max) {
            return self::returnInput($string, true);
        } else {
            return self::returnInput("String cannot be more than $max characters.", false);
        }
    }

    // Method to process and validate an email input
    public static function processEmail(string $email): array {
        // Check if the email is empty
        if (empty($email)) {
            return self::returnInput("Email is empty.", false);
        }

        // Sanitize the email address
        $value = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate the email address
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return self::returnInput($email, true);
        } else {
            return self::returnInput("Email is invalid.", false);
        }
    }

    // Method to process and validate a password input
    public static function processPassword(string $password, string $password_v = null) {
        // Check if password verification is provided and matches the password
        if (!empty($password_v)) {
            if ($password != $password_v) {
                return self::returnInput("Passwords do not match.", false);
            }
        }

        // Check if the password is empty
        if (empty($password)) {
            return self::returnInput("Password is empty.", false);
        }

        // Sanitize the password
        $password = htmlspecialchars($password);

        // Validate the password strength
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            return self::returnInput($password, true);
        } else {
            return self::returnInput('Password must have a minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character', false);
        }
    }

    // Method to process and validate a file input
    public static function processFile(array $file): array {
        // Check if the file is empty
        if (empty($file)) {
            return self::returnInput(false, "File is empty.");
        }

        // Return the file name if validation passes
        return self::returnInput(true, $file['name']);
    }

    // Private method to return the input processing result
    private static function returnInput(string $value, bool $isValid): array {
        return [
            'value' => $isValid ? $value : '',
            'error' => $isValid ? '' : $value,
            'valid' => $isValid
        ];
    }
}
?>
