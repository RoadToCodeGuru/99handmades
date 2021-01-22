<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>99handmades Invoice</title>

    <link rel="stylesheet" href="{{asset('customer/css/bootstrap.min.css')}}" type="text/css">
    
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
    
    .invoice-box table tr.total td:nth-child(5) {
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
    
    .rtl table tr td:nth-child(3) {
        text-align: left;
    }
    .back-button{
        margin-left: 50%;
    }

    .invoice-box table tr.top table td:nth-child(3){
        text-align: left !important;
    }

    /* #flex_box{
        display : flex;
        flex-wrap: wrap
    } */
    </style>
</head>

<body>
    <a href="/order" class="back-button">back</a>
    <div id="exDom" class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                   <h1>Available Phone Cover List</h1>
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
                    Phone Cover List
                </td>
                
            </tr>
           
            <tr class="item">
                <td>
                    <div class="row">
                        @foreach($covers as $cover)
                        <div class="col-4">
                            <div style="margin: 20px">{{$cover->item_name}}</div>
                        </div>
                        @endforeach
                    </div>
                </td>
            </tr>
            
        </table>
        <p>*** လက်ရှိပြသထားသော phone cover များမှာ တစ်ပတ်တာ စရင်း ဖြစ်သောကြောင့် အချို့သော phone cover များမှာ ပစ်ည်း ကုန်သွားမှု နှင့် ကြုံနိုင် ပါကြောင်း အသိပေးအပ်ပါသည်</p>
        <p>*** Phone cover များ တွင် အလားတူ အမျိုးစား များ ကို မျဉ်းစောင်းလေး များခံ၍ ရေးပေးထါးကြောင်း သတိပြုစေလိုပါသည်</p>
    </div>
    <a href="/order" class="back-button">back</a>
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