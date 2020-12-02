<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>99handmades Invoice</title>
    
    <style>
    .invoice-box {
        max-width: 1230px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        position: relative;
        background: url('/theme/assets/images/users/background.jpg') ;
        background-size: cover;
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
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    .invoice-box table tr td:nth-child(3) {
        text-align: right;
    }
    .invoice-box table tr td:nth-child(4) {
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
        background: #C1C1C1;
        border-bottom: 1px solid black;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid black;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(4) {
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
    .back-button{
        margin-left: 50%;
    }

    .invoice-box table tr.top table td:nth-child(2){
        text-align: left !important;
    }
    </style>
</head>

<body>
    <a href="/makeset" class="back-button">back</a>
    <div id="exDom" class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{URL('theme/assets/images/users/99handmade.png')}}" style="width:100%; max-width:150px;">
                            </td>
                            <td>
                                Name : {{$customer_name}}<br>
                                Ph No : {{$phone_number}}<br>
                                Date : {{$date}} <br>
                                Address : {{$address}}
                            </td>
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
                <!-- <td>
                    Image
                </td> -->
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
            @foreach($items as $item)
            <tr class="item">
                <td>
                    {{ $item->item->item_name }}
                </td>
                <!-- <td>
                    <img src="{{URL('images/'. $item->item->item_image)}}" style="width:100%; max-width:100px;">
                </td> -->
                <td>
                    {{ $item->amount }}
                </td>
                <td>
                    {{ $item->item->sale_price }} MMK
                </td>
                <td>
                    {{ $item->total_price }} MMK
                </td>
            </tr>
            @endforeach

            <tr class="total">
                <td></td>
                <!-- <td></td> -->
                <td></td>
                <td></td>
                <td>
                   Sub Total: {{$subtotal}} MMK
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <!-- <td></td> -->
                <td></td>
                <td></td>
                <td>
                   Delivery: {{$delivery}} MMK
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <!-- <td></td> -->
                <td></td>
                <td></td>
                <td>
                   Total: {{$subtotal - $delivery}} MMK
                </td>
            </tr>
        </table>
    </div>
    <a href="/makeset" class="back-button">back</a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.2/dist/FileSaver.min.js"></script>

    <script>
        $(document).ready(function(){
            domtoimage.toBlob(document.getElementById('exDom')).then(function(blob){
            window.saveAs(blob, "vocher.png")
        
            // location.href = '/';
        })
        });
    </script>
</body>
</html>