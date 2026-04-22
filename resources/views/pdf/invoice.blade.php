<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* TABLE */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #740e26;
            color: #fff;
            padding: 8px;
            text-align: left;
        }

        .table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        /* Zebra row */
        .table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .right {
            text-align: right;
        }

        .invoice-title {
            font-size: 28px;
            letter-spacing: 4px;
            color: #740e26;
            font-weight: bold;
        }

        /* Divider */
        .divider {
            border-bottom: 2px solid #740e26;
            margin: 10px 0 20px;
        }

        /* Small text */
        .small {
            font-size: 11px;
            color: #777;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <table width="100%">
        <tr>
            <td width="60%">
                <strong style="font-size:16px;">Dapur Mama Kita</strong><br>
                <span class="small">Catering Harian & Acara</span><br><br>

                @dapur_mama_kita<br>
                08115003561
            </td>

            <td width="40%" class="right">
                <img src="{{ public_path('images/logo.jpeg') }}" width="90">
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <br>

    <!-- INFO -->
    <table width="100%">
        <tr>

            <td width="50%">
                <span class="small">Bill To</span><br><br>

                <strong>{{ $name }}</strong><br>
                {{ $address }}<br>
                {{ $phone }}
            </td>

            <td width="50%" class="right">
                <div class="invoice-title">INVOICE</div>

                <table style="margin-top:10px; margin-left:auto;">
                    <tr>
                        <td class="small">Invoice #</td>
                        <td>{{ $invoice_number }}</td>
                    </tr>
                    <tr>
                        <td class="small">Tanggal</td>
                        <td>{{ $date }}</td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>

    <br>

    <br>

    <!-- ITEMS -->
    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="right">Qty</th>
                <th class="right">Harga</th>
                <th class="right">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td class="right">{{ $item['qty'] }}</td>
                <td class="right">{{ number_format($item['price'], 0, ',', '.') }}</td>
                <td class="right">{{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <!-- SUMMARY -->
    <table class="table">
        <tr>
            <td width="60%"></td>
            <td width="40%">
                <table width="100%">
                    <tr>
                        <td><strong>Total (IDR)</strong></td>
                        <td class="right">
                            <strong>{{ number_format($total_price, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br>

    <table style="width:100%; margin-top:40px; font-size:11px;">
        <tr>

            <!-- KIRI: REKENING -->
            <td width="60%" valign="top">
                <strong>Pembayaran</strong><br><br>

                Bank: BCA<br>
                No. Rekening: 1234567890<br>
                Atas Nama: Dapur Mama Kita
            </td>

            <!-- KANAN: TTD + MATERAI -->
            <td width="40%" valign="top" style="text-align:center;">

                Hormat Kami,<br><br><br>

                <!-- SLOT MATERAI -->
                <div style="
        width:100px;
        height:120px;
        margin:0 auto;
        font-size:10px;
        display:flex;
        align-items:center;
        justify-content:center;
    ">
                    Materai 10.000
                </div>

                <br><br>

                <strong>Dapur Mama Kita</strong>

            </td>

        </tr>
    </table>

    <div style="margin-top:40px; font-size:11px; border-top:1px solid #eee; padding-top:10px;">
    Terima kasih telah mempercayakan kebutuhan catering Anda kepada kami<br>
    Konfirmasi pembayaran: 08115003561<br><br>

    <span class="small">
        Invoice ini dicetak pada {{ now()->format('d-m-Y H:i') }}
    </span>
</div>

</body>

</html>