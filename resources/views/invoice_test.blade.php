
<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>99 Handmades & Accessories Invoice</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Invoicebus Invoice Template">
    <meta name="author" content="Invoicebus">

    <meta name="template-hash" content="ff0b4f896b757160074edefba8cfab3b">
  </head>
  <style>
    /*! Invoice Templates @author: Invoicebus @email: info@invoicebus.com @web: https://invoicebus.com @version: 1.0.0 @updated: 2015-02-27 16:02:57 @license: Invoicebus */
    /* Reset styles */
    @import url("https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700&subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese");
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font: inherit;
    font-size: 100%;
    vertical-align: baseline;
    }

    html {
    line-height: 1;
    }

    ol, ul {
    list-style: none;
    }

    table {
    border-collapse: collapse;
    border-spacing: 0;
    }

    caption, th, td {
    text-align: left;
    font-weight: normal;
    vertical-align: middle;
    }

    q, blockquote {
    quotes: none;
    }
    q:before, q:after, blockquote:before, blockquote:after {
    content: "";
    content: none;
    }

    a img {
    border: none;
    }

    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
    }

    /* Invoice styles */
    /**
    * DON'T override any styles for the <html> and <body> tags, as this may break the layout.
    * Instead wrap everything in one main <div id="container"> element where you may change
    * something like the font or the background of the invoice
    */
    html, body {
    /* MOVE ALONG, NOTHING TO CHANGE HERE! */
    }

    /** 
    * IMPORTANT NOTICE: DON'T USE '!important' otherwise this may lead to broken print layout.
    * Some browsers may require '!important' in oder to work properly but be careful with it.
    */
    .clearfix {
    display: block;
    clear: both;
    }

    .hidden {
    display: none;
    }

    b, strong, .bold {
    font-weight: bold;
    }

    .container {
        font: normal 13px/1.4em 'Open Sans', Sans-serif;
        margin: 0 auto;
        width: 100%;
        background-color: white;
    }

    .invoice-top {
    background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4gPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHJhZGlhbEdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iMTAwJSI+PHN0b3Agb2Zmc2V0PSIxMCUiIHN0b3AtY29sb3I9IiMzMzMzMzMiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiLz48L3JhZGlhbEdyYWRpZW50PjwvZGVmcz48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyYWQpIiAvPjwvc3ZnPiA=');
    background: -moz-radial-gradient(center center, circle farthest-corner, #333333 10%, #000000);
    background: -webkit-radial-gradient(center center, circle farthest-corner, #333333 10%, #000000);
    background: radial-gradient(circle farthest-corner at center center, #333333 10%, #000000);
    color: #fff;
    padding: 40px 40px 30px 40px;
    }

    .invoice-body {
    padding: 50px 40px 40px 40px;
    }

    #memo .logo {
    float: left;
    margin-right: 20px;
    }
    #memo .logo img {
    width: 150px;
    height: 150px;
    }
    #memo .company-info {
    float: right;
    text-align: right;
    }
    #memo .company-info .company-name {
    /* color: #F8ED31; */
    font-weight: bold;
    font-size: 32px;
    }
    #memo .company-info .spacer {
    height: 15px;
    display: block;
    }
    #memo .company-info div {
    font-size: 12px;
    float: right;
    margin: 0 3px 3px 0;
    }
    #memo:after {
    content: '';
    display: block;
    clear: both;
    }

    #invoice-info {
    float: left;
    margin-top: 50px;
    width: 100%;
    }
    #invoice-info > div {
    float: left;
    }
    #invoice-info > div > span {
    display: block;
    min-width: 100px;
    min-height: 18px;
    margin-bottom: 3px;
    }
    #invoice-info > div:last-of-type {
    width:100%;
    }
    #invoice-info:after {
    content: '';
    display: block;
    clear: both;
    }

    #client-info {
    float: right;
    margin-top: 50px;
    margin-right: 30px;
    min-width: 220px;
    }
    #client-info > div {
    margin-bottom: 3px;
    }
    #client-info span {
    display: block;
    }
    #client-info > span {
    margin-bottom: 3px;
    }

    #invoice-title-number {
    margin-top: 30px;
    }
    #invoice-title-number #title {
    margin-right: 5px;
    text-align: right;
    font-size: 35px;
    }
    #invoice-title-number #number {
    margin-left: 5px;
    text-align: left;
    font-size: 20px;
    }

    table {
    table-layout: fixed;
    }
    table th, table td {
    vertical-align: top;
    word-break: keep-all;
    word-wrap: break-word;
    }

    #items .first-cell, #items table th:first-child, #items table td:first-child {
    width: 18px;
    text-align: right;
    }
    #items table {
    border-collapse: separate;
    width: 100%;
    }
    #items table th {
    font-weight: bold;
    padding: 12px 10px;
    text-align: right;
    border-bottom: 1px solid #444;
    text-transform: uppercase;
    }
    #items table th:nth-child(2) {
    width: 30%;
    text-align: left;
    }
    #items table th:last-child {
    text-align: right;
    }
    #items table td {
    border-right: 1px solid #b6b6b6;
    padding: 15px 10px;
    text-align: right;
    }
    #items table td:first-child {
    text-align: left;
    border-right: none !important;
    }
    #items table td:nth-child(2) {
    text-align: left;
    }
    #items table td:last-child {
    border-right: none !important;
    }

    #sums {
    float: right;
    margin-top: 30px;
    }
    #sums table tr th, #sums table tr td {
    min-width: 100px;
    padding: 10px;
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    }
    #sums table tr th {
    text-align: left;
    padding-right: 25px;
    color: #707070;
    }
    #sums table tr td:last-child {
    min-width: 0 !important;
    max-width: 0 !important;
    width: 0 !important;
    padding: 0 !important;
    overflow: visible;
    }
    #sums table tr.amount-total th {
    color: black;
    }
    #sums table tr.amount-total th, #sums table tr.amount-total td {
    font-weight: bold;
    }
    #sums table tr.amount-total td:last-child {
    position: relative;
    }
    #sums table tr.amount-total td:last-child .currency {
    position: absolute;
    top: 3px;
    left: -740px;
    font-weight: normal;
    font-style: italic;
    font-size: 12px;
    color: #707070;
    }
    #sums table tr.amount-total td:last-child:before {
    display: block;
    content: '';
    border-top: 1px solid #444;
    position: absolute;
    top: 0;
    left: -305px;
    right: 0;
    }
    #sums table tr:last-child th, #sums table tr:last-child td {
    color: black;
    }

    #terms {
    margin: 30px 0 5px 0;
    }
    #terms > div {
    min-height: 20px;
    font-size: 16px;
    }

    .payment-info {
    color: #707070;
    font-size: 14px;
    }
    .payment-info div {
    display: inline-block;
    min-width: 10px;
    }

    .ib_drop_zone {
    color: #F8ED31 !important;
    border-color: #F8ED31 !important;
    }


    /* @media only screen and (max-width: 450px) {
        #memo .logo img {
            margin-left: 100%;
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        #memo .company-info {
            text-align: center;
        }
        #memo .company-info .company-name {
            color: #F8ED31;
            font-weight: bold;
            font-size: 20px;
        }


        #invoice-info > div:last-of-type {
            margin-left: 0px;
        }

        #sums {
            float: right;
        }
        #sums table tr th, #sums table tr td {
            min-width: 100px;
            padding: 10px;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
        }
        #sums table tr th {
            text-align: right;
            color: #707070;
        }
        #sums table tr.amount-total td:last-child:before {
            display: block;
            content: '';
            border-top: 1px solid #444;
            position: absolute;
            top: 0;
            left: -195px;
            right: 0;
        }}

        #items .first-cell, #items table th:first-child, #items table td:first-child {
        width: 12px;
        text-align: right;
        }

        .container {
            font: normal 12px/1.4em 'Open Sans', Sans-serif;
            margin: 0 auto;
        }
    } */

    /**
    * If the printed invoice is not looking as expected you may tune up
    * the print styles (you can use !important to override styles)
    */
    @media print {
    /* Here goes your print styles */
    }
    body {
        width: 900px;
    }

    .order_id{
        padding-top: 45px;
        font-size: 20px !important;
        font-weight: bold;
        /* color: #F8ED31 */
        /* float: left !important; */
    }

  </style>
  <body>
    <div  id="exDom" class="container">
      <div class="invoice-top">
        <section id="memo">
          <div class="logo">
          <img src="{{URL('theme/assets/images/users/99handmade.png')}}" >
          </div>
          
          <div class="company-info">
            <span class="company-name">99 Handmades & Accessories</span>

            <span class="spacer"></span>

            <div>No.50, 90th Street, Kandawgaly , Mingalar Taung Nyunt | Yangon</div>
            

            <span class="clearfix"></span>

            <div>shoonleyati2017@gmail.com |  +959 964-982-910 , +95 766-713-677</div>
            <span class="clearfix"></span>

            <div class="order_id">Invoice: #{{$order_list->order_id}}</div>
          </div>

          

        </section>
        
        <section id="invoice-info">
          <div>
            <span style="float: right;"><span style="margin-right:20px;">Date:</span> {{$date}}</span>
            <span style="margin-bottom:10px;"><span style="margin-right:30px;">Name:</span>{{$order_list->customer->customer_name}}</span>
            <span style="margin-bottom:10px;"><span style="margin-right:25px;">Phone:</span> +{{$order_list->customer->phone_number}}</span>
            <span><span style="margin-right:20px;">Address:</span> {{$order_list->customer->customer_address}}</span>
          </div>
        </section>
        

        <div class="clearfix"></div>
      </div>

      <div class="clearfix"></div>

      <div class="invoice-body">
        <section id="items">
          
          <table cellpadding="0" cellspacing="0">
          
            <tr>
              <th></th> <!-- Dummy cell for the row number and row commands -->
              <th>Item</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
            </tr>
            @foreach($i_datas as $data)
            <tr data-iterate="item">
              <td>{{ $data['no'] }}</td> <!-- Don't remove this column as it's needed for the row commands -->
              <td>{{ $data['item_name'] }}</td>
              <td>{{ ( $data['unit_price'] ) }}</td>
              <td>{{ $data['item_count'] }}</td>
              <td> {{ $data['final_price']}}</td>
            </tr>
            @endforeach
            
          </table>
          
        </section>
        <hr>
        <section id="sums">
        
          <table cellpadding="0" cellspacing="0">
            <tr>
              <th>Subtotal</th>
              <td>{{$sub_total}} MMK</td>
              <td></td>
            </tr>

            <tr data-iterate="tax">
              <th>Discount</th>
              <td>{{$order_list->total_discount}} MMK</td>
              <td></td>
            </tr>
            
            <tr data-iterate="tax">
              <th>Delivery</th>
              <td>{{$order_list->deli_price}} MMK</td>
              <td></td>
            </tr>
            
            <tr class="amount-total">
              <th>Total</th>
              <td>{{$total}} MMK</td>
              <td>
                <div class="currency">
                  <span></span> <span></span>
                </div>
              </td>
            </tr>
            
            <!-- You can use attribute data-hide-on-quote="true" to hide specific information on quotes.
                 For example Invoicebus doesn't need amount paid and amount due on quotes  -->
            <!-- <tr data-hide-on-quote="true">
              <th>Total</th>
              <td>4000 MMK</td>
              <td></td>
            </tr> -->
            
          </table>
          
        </section>

        <div class="clearfix"></div>
        
        <section id="terms">
          <span class="hidden">{terms_label}</span>
          <div>ဝယ်ယူအားပေးမှုကို အထူးကျေးဇူး တင်ပါသည်</div>
        </section>

        <div class="payment-info">
            <h6>Kbz Pay, Wave Money တို့မှ 09 964-982-910 သို့လွှဲ၍ပေးချေနိုင်ပါသည်</h6>
        </div>
      </div>
        
    </div>

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
