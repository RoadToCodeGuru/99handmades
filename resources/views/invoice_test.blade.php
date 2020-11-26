<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
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
    
    .invoice-box table tr td:nth-child(3) {
        text-align: right;
    }
    .invoice-box table tr td:nth-child(4) {
        text-align: right;
    }
    .invoice-box table tr td:nth-child(5) {
        text-align: right;
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
    
    .invoice-box table tr.total td:nth-child(5) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
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
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{URL('theme/assets/images/users/99handmade.png')}}" style="width:100%; max-width:200px;">
                            </td>
                            <td>
                                Invoice of 99handmades<br>
                                Created: Today<br>
                                Due: Today
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Thank You<br>
                                Customers<br>
                                For Your Purchese
                            </td>
                            <!-- <td>
                                Acme Corp.<br>
                                John Doe<br>
                                john@example.com
                            </td> -->
                        </tr>
                    </table>
                </td>
            </tr>
            
            <!-- <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr> -->
            
            <!-- <tr class="details">
                <td>
                    Check
                </td>
                
                <td>
                    1000
                </td>
            </tr> -->
            
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Image
                </td>
                <td>
                    Amount
                </td>
                <td>
                    Price
                </td>
                <td>
                    Total
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Dream Catcher
                </td>
                <td>
                    <img src="{{URL('theme/assets/images/users/99handmade.png')}}" style="width:100%; max-width:100px;">
                </td>
                <td>
                    10
                </td>
                <td>
                    3000 MMK
                </td>
                <td>
                    30000 MMK
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Dream Catcher
                </td>
                <td>
                    <img src="{{URL('theme/assets/images/users/99handmade.png')}}" style="width:100%; max-width:100px;">
                </td>
                <td>
                    10
                </td>
                <td>
                    3000 MMK
                </td>
                <td>
                    30000 MMK
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                   Total: 60000 MMK
                </td>
            </tr>
        </table>
    </div>
</body>
</html>