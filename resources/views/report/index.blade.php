<!DOCTYPE html>
<html>

<head>
    <title>Business Report</title>

    <!-- VIEWPORT - PENTING UNTUK MOBILE RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* BASE STYLES - DESKTOP (DIKECILKAN) */
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .report-container {
            max-width: 550px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 2px solid #000;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .logo {
            width: 60px;
        }

        .company-info {
            text-align: right;
        }

        .company-info h2 {
            margin: 0;
            font-size: 18px;
        }

        .meta {
            text-align: center;
            margin-bottom: 15px;
        }

        .meta p {
            margin: 2px 0;
            font-size: 12px;
        }

        h3 {
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 14px;
            padding-left: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            font-size: 12px;
        }

        th {
            background: #f1f1f1;
        }

        td:nth-child(2) {
            text-align: right;
        }

        /* SUMMARY BOX */
        .summary {
            background: #f8f9fc;
            padding: 12px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        /* SIGNATURE */
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .sign-box {
            width: 45%;
            text-align: center;
            font-size: 12px;
        }

        .sign-line {
            margin-top: 35px;
            border-top: 1px solid #000;
        }

        /* BUTTON STYLES */
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .btn-yujo {
            background: #644d3c;
            color: #dfdac4;
            border: none;
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex: 1;
            text-align: center;
            white-space: nowrap;
        }

        .btn-yujo:hover {
            background: #4a3629;
            transform: translateY(-2px);
        }

        .btn-back {
            background: #c9c2ae;
            color: #644d3c;
        }

        .btn-back:hover {
            background: #b5ad96;
        }

        .summary table {
            width: 100%;
            border: none;
        }

        .summary td {
            border: none;
            padding: 4px 0;
            font-size: 12px;
        }

        .summary td:first-child {
            width: 60%;
        }

        /* PRINT STYLES */
        @media print {
            body {
                background: none;
                padding: 0;
                margin: 0;
            }

            @page {
                size: A4;
                margin: 1.5cm;
            }

            .report-container {
                border: none;
                margin: 0;
                padding: 20px;
                width: 100%;
                max-width: 100%;
                box-shadow: none;
                border: 1px solid #000;
                box-sizing: border-box;
            }

            .button-group {
                display: none;
            }
        }

        /* MOBILE RESPONSIVE - BUTTON SIDE BY SIDE */
@media (max-width: 500px) {
    body {
        padding: 10px;
    }

    .report-container {
        max-width: 100%;
        padding: 15px;
        margin: 0;
    }

    /* Button Group - kekal row */
    .button-group {
        display: flex;
        flex-direction: row;
        gap: 8px;
        margin-bottom: 10px;
    }

    .btn-yujo {
        flex: 1;
        justify-content: center;
        padding: 8px 4px;
        font-size: 11px;
        border-radius: 40px;
        white-space: nowrap;
    }

    .btn-yujo i {
        font-size: 11px;
        margin-right: 3px;
    }

    /* Header */
    .header {
        flex-direction: column;
        text-align: center;
        gap: 8px;
        padding-bottom: 8px;
        margin-bottom: 12px;
        border-bottom-width: 2px;
    }

    .logo {
        width: 60px;
    }

    .company-info h2 {
        font-size: 18px;
        margin: 0;
    }

    /* Meta info */
    .meta {
        margin-bottom: 12px;
    }

    .meta p {
        font-size: 12px;
        margin: 3px 0;
    }

    .meta b {
        font-size: 12px;
    }

    /* Summary box */
    .summary {
        padding: 10px;
        margin-bottom: 12px;
        border-radius: 8px;
    }

    .summary td {
        padding: 5px 0;
        font-size: 13px;
    }

    .summary b {
        font-size: 13px;
    }

    /* Headings */
    h3 {
        margin-top: 15px;
        margin-bottom: 6px;
        font-size: 15px;
        padding-left: 5px;
    }

    /* Table */
    table {
        width: 100%;
        font-size: 12px;
        table-layout: auto;
        margin-top: 5px;
    }

    th, td {
        padding: 5px 8px;
        font-size: 12px;
    }

    th {
        font-size: 12px;
        padding: 5px 8px;
    }

    /* Signature */
    .signature {
        margin-top: 20px;
        flex-direction: column;
        gap: 15px;
    }

    .sign-box {
        width: 100%;
        font-size: 12px;
    }

    .sign-line {
        margin-top: 20px;
        border-top-width: 1px;
    }
}
    </style>
</head>

<body>

    <div class="report-container">

        <!-- BUTTON GROUP -->
        <div class="button-group">
            <a href="{{ route('dashboard') }}" class="btn-yujo">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <button class="btn-yujo" onclick="window.print()">
                <i class="fas fa-print"></i> Print
            </button>
        </div>

        <!-- HEADER -->
        <div class="header">
            <div>
                <img src="{{ asset('assets/img/logo 2.png') }}" class="logo" alt="Logo">
            </div>

            <div class="company-info">
                <h2>{{ $companyName }}</h2>
            </div>
        </div>

        <!-- META INFO -->
        <div class="meta">
            <p><b>Branch:</b> {{ $branchName }}</p>
            <p><b>Report Date:</b> {{ $reportDate }}</p>
        </div>

        <!-- SUMMARY -->
        <div class="summary">
            <table>
                <tr>
                    <td><b>Monthly Sales:</b></td>
                    <td>RM{{ number_format($monthly_sales, 2) }}</td>
                </tr>
                <tr>
                    <td><b>Daily Sales:</b></td>
                    <td>RM{{ number_format($daily_sales, 2) }}</td>
                </tr>
                <tr>
                    <td><b>Today's Orders:</b></td>
                    <td>{{ $total_orders_today }}</td>
                </tr>
                <tr>
                    <td><b>Items Sold:</b></td>
                    <td>{{ $items_sold }}</td>
                </tr>
            </table>
        </div>

        <!-- SALES -->
        <h3>Sales (Last 7 Days)</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total (RM)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales_7_days as $s)
                <tr>
                    <td>{{ $s->date }}</td>
                    <td>{{ number_format($s->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOP ITEMS -->
        <h3>Top Selling Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($top_items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->total_qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- SIGNATURE -->
        <div class="signature">
            <div class="sign-box">
                <div class="sign-line"></div>
                Prepared By
            </div>

            <div class="sign-box">
                <div class="sign-line"></div>
                Approved By
            </div>
        </div>

    </div>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</body>

</html>
