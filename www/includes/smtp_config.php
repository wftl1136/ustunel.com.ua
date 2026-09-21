<?php
// includes/smtp_config.php
// ─────────────────────────────────────────────────────────
//  SMTP credentials — edit this file to switch providers
// ─────────────────────────────────────────────────────────
//
//  HOW TO GET MAILTRAP CREDENTIALS:
//  1. Register at https://mailtrap.io (free)
//  2. Inbox → SMTP Settings → PHP → PHPMailer
//  3. Copy Host / Port / Username / Password below
//
//  FOR PRODUCTION (Gmail):
//  1. Enable 2-Step Verification on your Google Account
//  2. Go to https://myaccount.google.com/apppasswords
//  3. Create App Password for "Mail"
//  4. Set SMTP_HOST='smtp.gmail.com', PORT=587, TLS
//     SMTP_USER='your@gmail.com', SMTP_PASS='xxxx xxxx xxxx xxxx'
// ─────────────────────────────────────────────────────────

define('SMTP_HOST',       'sandbox.smtp.mailtrap.io');  // Mailtrap sandbox host
define('SMTP_PORT',       2525);                         // Mailtrap port
define('SMTP_USER',       '25de2adf119f9c');                   // <- вставь Username из Mailtrap
define('SMTP_PASS',       '338951d97cdd1f');                // <- вставь Password из Mailtrap
define('SMTP_ENCRYPTION', 'tls');                        // tls или ssl
define('SMTP_FROM_EMAIL', 'noreply@ustunel.com.ua');
define('SMTP_FROM_NAME',  'Вигідні покупки');
