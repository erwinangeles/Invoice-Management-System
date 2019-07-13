<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }


        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table td:nth-child(3) {
            text-align: right;
        }
        .invoice-box table td:nth-child(4) {
            text-align: right;
        }
        .invoice-box table td:nth-child(5) {
            text-align: right;
        }
        .invoice-box table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
        }
        .invoice-box table tr.total td:nth-child(5) {
            border-top: 2px solid #eee;
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="5">
                <table>
                    <tr>
                        <td class="title">
                                <img src="{{url('/images')}}/{{ $profile->business_logo }}" style="width:100%; max-width:300px;">
                        </td>

                        <td style="text-align: right">
                            Invoice #: {{$invoice->invoice_number}}<br>
                            <?php if ($invoice->invoice_date ==! null) echo "Created: ". date("F d, Y", strtotime($invoice->invoice_date)) . "<br>";?>
                            <?php if ($invoice->due_date ==! null) echo "Due: ". date("F d, Y", strtotime($invoice->due_date)) . "<br>";?>
                            Balance Due: ${{number_format($invoice->balance, 2)}}<br>
                            <?php if ($invoice->deposit_amount > 0 && $invoice->payments->sum('payment_amount') < $invoice->deposit_amount)echo "Partial Due: $". number_format($invoice->deposit_amount, 2);?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            {{$profile->business_name}}<br>
                            {{$profile->business_address_street}} {{$profile->business_address_street2}},<br>
                            {{$profile->business_address_city}}, {{$profile->business_address_state}} {{$profile->business_address_zipcode}}<br>
                            {{$profile->business_email}}<br>
                            {{$profile->business_phone_number}}<br>
                            {{$profile->business_website}}
                        </td>

                        <td style="text-align: right">
                            {{$invoice->client->business_name}}<br>
                            {{$invoice->client->first_name}} {{$invoice->client->last_name}}<br>
                            {{$invoice->client->email_address}}<br>
                            {{$invoice->client->address_street}} {{$invoice->client->address_street2}}<br>
                            {{$invoice->client->address_city}}, {{$invoice->client->address_state}}, {{$invoice->client->address_zipcode}}<br>
                            {{$invoice->client->phone_number}}
                        </td>

                    </tr>
                </table>
                <strong><small>{{$profile->header_notes}}</small></strong>
            </td>
        </tr>
        <tr class="heading">
            <td>
                Item
            </td>
            <td>
                Description
            </td>
            <td>
                Unit Price
            </td>
            <td>
                Quantity
            </td>
            <td>
                Line Total
            </td>
        </tr>

        @foreach($invoice->products as $product)
            @if($loop->last)
                <tr class="item last">
                    <td>
                        <strong>{{$product->item_name}}</strong>
                    </td>
                    <td>
                        {{$product->item_description}}
                    </td>
                    <td>
                        ${{number_format($product->unit_cost, 2)}}
                    </td>
                    <td>
                        x{{$product->quantity}}
                    </td>

                    <td>
                        ${{number_format($product->unit_cost * $product->quantity,2) }}
                    </td>
                </tr>
            @else
                <tr class="item">
                    <td>
                        <strong>{{$product->item_name}}</strong>
                    </td>
                    <td>
                        {{$product->item_description}}
                    </td>
                    <td>
                        ${{number_format($product->unit_cost,2)}}
                    </td>
                    <td>
                        x{{$product->quantity}}
                    </td>

                    <td>
                        ${{number_format($product->unit_cost * $product->quantity, 2)}}
                    </td>
                </tr>
            @endif
        @endforeach
        <tr class="total" style="text-align: left">
            <td></td>
            <td></td>
            <td></td>
            <td>Subtotal<br>
                <?php if ($invoice->client->tax_rate > 0 ) echo "Sales Tax (". number_format($invoice->client->tax_rate, 2) . "%)<br>"; ?>
                <?php if ($invoice->discount > 0 && $invoice->discount_type  == 'Amount') echo 'Discount<br>'; ?>
                <?php if ($invoice->discount > 0 && $invoice->discount_type  == 'Percent') echo "Discount ($invoice->discount%)<br>"; ?>
                Paid to Date<br>
                <strong>Balance</strong><br>
                <?php if ($invoice->deposit_amount > 0 && $invoice->payments->sum('payment_amount') < $invoice->deposit_amount) echo"<strong>Partial Due</strong>";?>
            </td>
            <td style="text-align: right">
                ${{number_format($invoice->products->sum('line_total'),2)}}<br>
                <?php if ($invoice->client->tax_rate >0) echo "$" . number_format($invoice->products->sum('line_total')  * ((100+$invoice->client->tax_rate) / 100)-$invoice->products->sum('line_total'), 2) . "<br>";?>
                <?php if ($invoice->discount > 0 && $invoice->discount_type  == 'Amount') echo "($" . number_format($invoice->discount, 2).")<br>"; ?>
                <?php if ($invoice->discount > 0 && $invoice->discount_type  == 'Percent') echo "($".number_format($invoice->products->sum('line_total') * (($invoice->discount) / 100), 2).")<br>"; ?>
                (${{number_format($invoice->payments->sum('payment_amount'), 2)}})<br>
                ${{number_format($invoice->balance, 2)}}<br>
                <?php if ($invoice->deposit_amount > 0 && $invoice->payments->sum('payment_amount') < $invoice->deposit_amount) echo "$". number_format($invoice->deposit_amount, 2);?>
            </td>
        </tr>
    </table>
    <hr>
    <style>
        .first, .second { width:300px; font-size: small }
    </style>
    <table style="width: 100%;">
        <tr>
            <td class="first">{{$profile->footer_notes_left}}</td>
            <td class="second">{{$profile->footer_notes_right}}</td>
        </tr>
    </table>

</div>
</body>
</html>
