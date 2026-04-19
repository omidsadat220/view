<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <title>محصول - {{ $product->name }} {{ $product->lastname }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Tahoma', sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #2c3e50;
        }
        .header p {
            margin: 5px 0 0;
            color: #7f8c8d;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: right;
        }
        .info-table th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .section-title {
            background-color: #3498db;
            color: white;
            padding: 8px;
            margin-top: 20px;
            margin-bottom: 15px;
            font-size: 18px;
            border-radius: 5px;
        }
        .badge {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 3px 8px;
            margin: 2px;
            border-radius: 3px;
            font-size: 12px;
        }
        .financial-cards {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .card {
            width: 32%;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .card h3 {
            margin: 0 0 10px;
            font-size: 16px;
        }
        .card .amount {
            font-size: 20px;
            font-weight: bold;
        }
        .text-primary { color: #2980b9; }
        .text-success { color: #27ae60; }
        .text-danger { color: #e74c3c; }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>محصول / قرارداد</h1>
    <p>اطلاعات کامل محصول</p>
</div>

<table class="info-table">
    <tr>
        <th>مسلسل بل</th>
        <td>{{ $product->bellnumber }}</td>
        <th>اسم</th>
        <td>{{ $product->name }}</td>
    </tr>
    <tr>
        <th>تخصل</th>
        <td>{{ $product->lastname }}</td>
        <th>هوتل</th>
        <td>{{ $product->hall }}</td>
    </tr>
    <tr>
        <th>صالون</th>
        <td>{{ $product->room }}</td>
        <th>تاریخ محفل</th>
        <td>{{ \Carbon\Carbon::parse($product->date)->format('Y-m-d') }}</td>
    </tr>
    <tr>
        <th>خدمات و کرایه</th>
        <td colspan="3">
            @if($product->categories && count($product->categories) > 0)
                @foreach($product->categories as $category)
                    <span class="badge">{{ $category->name }}</span>
                @endforeach
            @else
                -
            @endif
        </td>
    </tr>
</table>

<div class="section-title">اطلاعات مالی</div>

<div class="financial-cards">
    <div class="card">
        <h3>مجموع مبلغ</h3>
        <div class="amount text-primary">{{ number_format($product->price) }} AFN</div>
    </div>
    <div class="card">
        <h3>مبلغ پرداخت شده</h3>
        <div class="amount text-success">{{ number_format($product->paied) }} AFN</div>
    </div>
    <div class="card">
        <h3>مبلغ باقی مانده</h3>
        <div class="amount text-danger">{{ number_format($product->remaining) }} AFN</div>
    </div>
</div>

<div class="footer">
    <p>تاریخ چاپ: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
    <p>این سند به صورت الکترونیکی تولید شده است و نیاز به امضا ندارد</p>
</div>

</body>
</html>