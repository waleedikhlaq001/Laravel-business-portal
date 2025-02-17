<style>
    .mImg {
        height: 50px !important;
        width: 50px !important;
        padding: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 2px solid #6f3c96 !important;
        border-radius: 50% !important
    }
    .mImg img {
        width: 30px;
        height: 25px;
    }
</style>
@component('mail::message')
# Hi, {{$details['user']}}
<br>
*************************************************************
<br>
Thank you for making a purchase on vicomma. You are more than appreciated. Now,
we need you to confirm a few details:
<ol>
<li>I have my order number</li>
<li>I received details for my order</li>
<li>My customer has reached out to me</li>
<li>I know what to do next</li>
  </ol>
<br>
If YOUR response is YES to any of the 4 options above please respond to this email as
follows:
Thank you vicomma, I agree with number x. Please continue to send me messages
regarding the update of my order(s).
<!-- {{$details['message']}}</a> -->
<!-- forward -->
<br>
<h2>THE INFORMATION BELOW

SHOULD RELAY THE PURCHASE
MADE ON THE VICOMMA
PLATFORM</h2>
<table style="max-width:100%;width: 100%;margin: 5px auto 5px;background-color:#fff;padding:0;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);">
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="display: flex;justify-content:space-between!important; font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Subject</span><b style="color:green;font-weight:normal;margin:0">Order Confirmation</b></p>
          <p style="display: flex;justify-content:space-between!important; font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order ID</span> #{{$details['order_id']}}</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td style="width:50%;padding:0;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Customer's Name</span> {{$details['name']}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Number of Items</span> {{count($details['products'])}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> {{$details['address']}}</p>
        </td>
        <td style="width:50%;padding:0;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Shipping Cost</span> ${{$details['shipping']}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Subtotal</span> ${{$details['sub']}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Total</span> ${{$details['total']}}</p>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:20px;padding:10px 0;">Items Bought:</td>
      </tr>
      <tr>
        @foreach($details['products'] as $product)
        <td colspan="2" style="padding:0;">
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
            <span style="display:block;font-size:13px;font-weight:normal;"><b>Name:</b> {{$product->name}}</span> ${{number_format($product->price, 2)}} <b style="font-size:12px;font-weight:300;"> Quantity: {{$product->qty}}</b>
          </p>
              </td>
          @endforeach
      </tr>
    </tbody>
  </table>
<br>
You can manage and track your purchases from your Vicomma Dashboard. Thank you,<br>
{{ config('app.name') }} Team
@endcomponent 