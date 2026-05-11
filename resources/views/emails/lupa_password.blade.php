<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px;">
    <div style="background: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <h2 style="color: #1e40af; text-align: center;">Halo!</h2>
        
        <p style="color: #333; line-height: 1.6;">Kami menerima permintaan untuk mereset password akun <strong>SortLearn</strong> Anda.</p>
        <p style="color: #333; line-height: 1.6;">Silakan klik tombol di bawah ini untuk membuat password baru:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/reset-password/'.$token.'?email='.$email) }}" 
               style="background-color: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">
               Reset Password Sekarang
            </a>
        </div>

        <p style="color: #666; font-size: 14px; line-height: 1.5;">Jika tombol di atas tidak berfungsi, Anda juga bisa menyalin dan menempelkan link berikut di browser Anda:</p>
        <p style="background: #f1f5f9; padding: 10px; border-radius: 5px; font-size: 13px; color: #1e40af; word-break: break-all;">
            {{ url('/reset-password/'.$token.'?email='.$email) }}
        </p>

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;">

        <p style="color: #999; font-size: 12px; text-align: center;">Jika Anda tidak merasa meminta reset password, abaikan saja email ini. Akun Anda tetap aman.</p>
        <p style="color: #999; font-size: 12px; text-align: center;">Terima kasih,<br><strong>Tim SortLearn</strong></p>
    </div>
</body>
</html>