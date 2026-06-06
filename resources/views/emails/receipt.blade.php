<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Receipt</title>
</head>

<body style="background:#f2f2f2;font-family:Arial,Helvetica,sans-serif;padding:20px;">

    <table align="center" width="360" cellpadding="0" cellspacing="0"
        style="background:#ffffff;padding:20px;border-radius:6px;">

        <tr>
            <td align="center" style="font-size:18px;font-weight:bold;">
                {{ $company->company_name }}
            </td>
        </tr>

        <tr>
            <td>
                <hr style="border:none;border-top:1px dashed #ccc;margin:15px 0;">
            </td>
        </tr>

        <tr>
            <td align="center">
                <div style="font-size:36px;font-weight:bold;">
                    RM{{ number_format($total, 2) }}
                </div>
                <div style="color:#777;font-size:13px;">
                    Total
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <hr style="border:none;border-top:1px dashed #ccc;margin:15px 0;">
            </td>
        </tr>

        <tr>
            <td style="font-size:13px;color:#555;">
                Receipt #: {{ $saleId }}<br>
                Date: {{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y H:i') }}<br>
                Cashier: {{ Auth::user()->name }}<br>
                POS: {{ $branch_name }}
            </td>
        </tr>

        <tr>
            <td>
                <hr style="border:none;border-top:1px dashed #ccc;margin:15px 0;">
            </td>
        </tr>

        @foreach ($items as $item)
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td align="right">
                                RM{{ number_format($item->price * $item->qty, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="font-size:12px;color:#777;">
                                {{ $item->qty }} x RM {{ number_format($item->price, 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endforeach

        <tr>
            <td>
                <hr style="border:none;border-top:1px dashed #ccc;margin:15px 0;">
            </td>
        </tr>

        <tr>
            <td>
                <table width="100%" style="font-size:14px;">
                    <tr>
                        <td><b>Total</b></td>
                        <td align="right"><b>RM{{ number_format($total, 2) }}</b></td>
                    </tr>

                    <tr>
                        <td>Cash</td>
                        <td align="right">RM{{ number_format($paid, 2) }}</td>
                    </tr>

                    <tr>
                        <td>Card</td>
                        <td align="right">
                            RM{{ number_format($card, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td>Change</td>
                        <td align="right">RM{{ number_format($change, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <hr style="border:none;border-top:1px dashed #ccc;margin:15px 0;">
            </td>
        </tr>

        <tr>
            <td align="center" style="font-size:12px;color:#999;">
                © {{ date('Y') }} Yujo
            </td>
        </tr>

    </table>

</body>

</html>
