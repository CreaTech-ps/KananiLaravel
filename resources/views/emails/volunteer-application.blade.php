<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب تطوع</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h1 style="color: #2563eb; margin-top: 0;">طلب تطوع جديد</h1>
    </div>

    <div style="background-color: #ffffff; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px;">
        <h2 style="color: #1f2937; border-bottom: 2px solid #2563eb; padding-bottom: 10px;">معلومات المتطوع</h2>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="padding: 10px; font-weight: bold; color: #4b5563; width: 150px;">الاسم:</td>
                <td style="padding: 10px; color: #1f2937;">{{ $application->name }}</td>
            </tr>
            <tr style="background-color: #f9fafb;">
                <td style="padding: 10px; font-weight: bold; color: #4b5563;">البريد الإلكتروني:</td>
                <td style="padding: 10px; color: #1f2937;">{{ $application->email }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: bold; color: #4b5563;">رقم التواصل:</td>
                <td style="padding: 10px; color: #1f2937;">{{ $application->phone }}</td>
            </tr>
            <tr style="background-color: #f9fafb;">
                <td style="padding: 10px; font-weight: bold; color: #4b5563;">القسم:</td>
                <td style="padding: 10px; color: #1f2937;">{{ $application->department->name_ar }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: bold; color: #4b5563;">تاريخ التقديم:</td>
                <td style="padding: 10px; color: #1f2937;">{{ $application->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        </table>

        <div style="margin-top: 20px; padding: 15px; background-color: #eff6ff; border-right: 4px solid #2563eb; border-radius: 4px;">
            <p style="margin: 0; color: #1e40af;">
                <strong>ملاحظة:</strong> تم إرفاق السيرة الذاتية مع هذا الإيميل.
            </p>
        </div>
    </div>

    <div style="margin-top: 20px; padding: 15px; background-color: #f3f4f6; border-radius: 8px; text-align: center; color: #6b7280; font-size: 12px;">
        <p style="margin: 0;">هذا إيميل تلقائي من موقع جمعية أصدقاء جامعة بيرزيت</p>
    </div>
</body>
</html>
