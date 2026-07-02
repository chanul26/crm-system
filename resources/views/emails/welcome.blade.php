<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; }
        .header { background: #4f46e5; color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .button { background: #4f46e5; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to CRM System</h1>
        </div>
        <div style="padding: 20px;">
            <h2>Hello, {{ $name }}!</h2>
            <p>Thank you for registering with our CRM System. Your account has been created successfully.</p>
            <p>You can now login and start managing your customers, proposals and invoices.</p>
            <a href="{{ url('/dashboard') }}" class="button">Go to Dashboard</a>
            <p style="margin-top: 30px; color: #888; font-size: 12px;">If you did not create this account, please ignore this email.</p>
        </div>
    </div>
</body>
</html>