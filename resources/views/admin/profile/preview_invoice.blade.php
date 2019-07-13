<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PREVIEW INVOICE [EXAMPLE]</title>

    <style>
        body{
            overflow-x:hidden;
        }
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
<style>
    #background{
        position:absolute;
        z-index:0;
        background:white;
        display:block;
        min-height:50%;
        min-width:100%;
        color:yellow;
    }

    #content{
        position:relative;
        z-index:1;
    }

    #bg-text
    {
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        text-align: center;
        color:lightgrey;
        font-size:120px;
        transform:rotate(300deg);
        -webkit-transform:rotate(300deg);
    }
</style>
<body>
<div id="background">
    <p id="bg-text">PREVIEW ONLY</p>
</div>

<div id="content">
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
                                Invoice #: 03214<br>
                                Created: May 1, 2018 <br>
                                Due: July 15, 2018
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
                                Test Comp, Inc<br>
                                Johnny Doe<br>
                                john@example.com<br>
                                123 Main St, Suite 200<br>
                                Flushing, NY 11354<br>
                                (321)123-4567
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


            <tr class="item">
                <td>
                    <strong>Orange Shoes</strong>
                </td>
                <td>
                    E11-Test
                </td>
                <td>
                    $50.00
                </td>
                <td>
                    x2
                </td>

                <td>
                    $100.00
                </td>
            </tr>
            <tr class="item">
                <td>
                    <strong>Blue Umbrella</strong>
                </td>
                <td>
                    P15-Test
                </td>
                <td>
                    $25.00
                </td>
                <td>
                    x1
                </td>

                <td>
                    $25.00
                </td>
            </tr>

            <tr class="item last">
                <td>
                    <strong>Yellow Tie</strong>
                </td>
                <td>
                    U23-Test
                </td>
                <td>
                    $25.00
                </td>
                <td>
                    x1
                </td>

                <td>
                    $25.00
                </td>
            </tr>

            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td>Subtotal<br>
                    Sales Tax (8.25%)<br>
                    Paid to Date<br>
                    <strong>Balance</strong>
                </td>
                <td style="text-align: right">
                    $250.00<br>
                    $20.62<br>
                    $0.00<br>
                    <strong>$270.62</strong>
                </td>
            </tr>
        </table>
        <hr>
        <style>
            .first, .second { width:300px; font-size: small;  }
        </style>
        <table style="width: 100%;">
            <tr>
                <td class="first">{{$profile->footer_notes_left}}</td>
                <td class="second">{{$profile->footer_notes_right}}</td>
            </tr>
        </table>

    </div>

</div>

</body>


</html>



