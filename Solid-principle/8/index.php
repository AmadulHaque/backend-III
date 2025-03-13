<?php

// Background: A payment processing system handles different types of transactions. 
// Credit card payments require additional verification, such as CVV and expiry 
// date checks, while bank transfers need account number validation. 
// Digital wallets only need an email or phone number for verification.
// The payment interface should not impose methods that are irrelevant to each
// payment type.

// Question: How would you design interfaces?


interface PaymentProcessor {
    public function processPayment();
}


interface CreditCardVerification {
    public function verifyCVV();
    public function verifyExpiryDate();
}

interface BankTransferVerification {
    public function verifyAccountNumber();
}

interface DigitalWalletVerification {
    public function verifyEmail();
    public function verifyPhoneNumber();
}

class CreditCardPaymentProcessor  implements PaymentProcessor, CreditCardVerification {
    public function processPayment() {
        // Process credit card payment
    }

    public function verifyCVV() {
        // Verify CVV
    }

    public function verifyExpiryDate() {
        // Verify expiry date
    }
}

class BankTransferPaymentProcessor implements PaymentProcessor, BankTransferVerification {
    public function processPayment() {
        // Process bank transfer payment
    }

    public function verifyAccountNumber() {
        // Verify account number
    }
}

class DigitalWalletPaymentProcessor implements PaymentProcessor, DigitalWalletVerification {
    public function processPayment() {
        // Process digital wallet payment
    }

    public function verifyEmail() {
        // Verify email
    }

    public function verifyPhoneNumber() {
        // Verify phone number
    }
}





// usages principles:
// 1. SRP (Single Responsibility Principle)
// 2. OCP (Open/Closed Principle)
// 3. ISP (Interface Segregation Principle)