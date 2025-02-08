<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $selectedReports->name }}</title>

        <style>
            /* General Styles */
        body {
            font-family: 'IBMPlexSansArabic', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 50PX auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        h1 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .placeholder {
            color: #999;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Committee Section */
        .committee {
            margin-top: 20px;
        }

        .committee p {
            margin: 5px 0;
        }
        </style>
    </head>
    <body>
        <div class="container">

            <div class="header" style="text-align: center;">
                <img src="Header.png" alt="Header" style="max-width: 100%; height: auto;">
            </div>

            <div style="text-align: center;">
                <h1>محضر فتح مظاريف عرض السعر رقم: 
                <span>{{ $report->offer_number }}</span>
                </h1>
                <p>الخاص بشراء وتوريد <span>{{ $report->item }}</span> ضمن مشروع <span>{{ $report->project }}</span></p>
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
                <tr>
                    <td>1</td>
                    <td></td>
                    <td>ريال سعودي</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td>ريال سعودي</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td>ريال سعودي</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>

            <div class="committee">
                <p>عضو اللجنة: <span>{{ $report->bidders->first()->committees_members }}</span></p>
                <p>عضو اللجنة: <span>{{ $report->bidders->first()->committees_members }}</span></p>
                <p>رئيس اللجنة: <span>{{ $report->bidders->first()->committees_chairman }}</span></p>
            </div>

            <div class="footer" style="text-align: center;">
                <img src="Footer.png" alt="Footer" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </body>
</html>