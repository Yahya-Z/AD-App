<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&display=swap" rel="stylesheet">
        <title>محضر فتح مظاريف عرض السعر</title>

        <style>
        @font-face {
            font-family: 'NotoNaskhArabic'; direction: rtl; text-align: right;
            src: url("{{ public_path('fonts/NotoNaskhArabic-SemiBold.ttf') }}") format('truetype');
        }

        /* General Styles */
        body {
            font-family: 'NotoNaskhArabic', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
            max-width: 1400px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
        }

        h1 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .placeholder {
            color: #999;
        }

        .content {
            margin: 20px 0px 0px 0px;
        }

        span.bold {
            font-weight: bold;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 50px 0px 0px 0px;
            table-layout: fixed; /*Ensures the table fits within the container*/
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            font-size: 11px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 12px;
        }

        /* Committee Section */
        .committee {
            margin: 0px 10px 50px 0px;
        }

        .committee p {
            font-size: 13px;
        }

        .header {
            text-align: center;
        }

        .footer {
            margin-top: auto;
        }

        .header img, .footer img {
            max-width: 100%;
            height: auto;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="{{ public_path('images/Header.png') }}" alt="Header">
            </div>

            <div class="content">
                <div style="text-align: center;">
                    <h1>محضر فتح مظاريف عرض السعر رقم: 
                    <span>{{ $report->offer_number }}</span>
                    </h1>
                    <p>الخاص بشراء وتوريد <span class="bold">{{ $report->item }}</span> ضمن مشروع <span class="bold">{{ $report->project }}</span></p>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">اسم المتقدم لعروض الأسعار</th>
                        <th rowspan="2">عملة العطاء</th>
                        <th rowspan="2">المبلغ المقدم لعرض السعر</th>
                        <th rowspan="2">التخفيض (إن وجد)</th>
                        <th rowspan="2">المبلغ بعد التخفيض</th>
                        <th colspan="4">وثائق الشركة سارية المفعول</th>
                        <th rowspan="2">ملاحظات</th>
                    </tr>
                    <tr>
                        <th>السجل التجاري</th>
                        <th>البطاقة الضريبية</th>
                        <th>البطاقة الزكوية</th>
                        <th>ترخيص المحل</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($report->bidders as $index => $bidder)
                        <tr>
                            <td>{{ $index + 1 }}</td> <!-- Added row number -->
                            <td>{{ $bidder->name }}</td>
                            <td>{{ $bidder->currency }}</td>
                            <td>{{ $bidder->amount }}</td>
                            <td>{{ $bidder->discount }}</td>
                            <td>{{ $bidder->final_amount }}</td>
                            <td>{{ $bidder->commercial_register }}</td>
                            <td>{{ $bidder->tax_card }}</td>
                            <td>{{ $bidder->zakat_card }}</td>
                            <td>{{ $bidder->shop_license }}</td>
                            <td>{{ $bidder->notes }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

            <div class="footer">
                <div class="committee">
                    <p><strong>أعضاء اللجنة:</strong> <span>{{ $report->committees_members }}</span></p>
                    <p><strong>رئيس اللجنة:</strong> <span>{{ $report->committees_chairman }}</span></p>
                </div>

                <img src="{{ public_path('images/Footer.png') }}" alt="Footer">
            </div>
        </div>
    </body>
</html>