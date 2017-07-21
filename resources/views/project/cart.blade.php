@extends('project.layout.master')
@section('content')



<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2> <span> Cart </span> </h2>
    </div>
  </div>
</div>


<div class="cart">
   <div class="container">
      <div class="col-md-12 no-padding">
         <div class="cart-sec">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-condensed cf ">
        		<thead class="cf">
        			<tr>
        				<th>Product</th>
        				<th>Price</th>
        				<th>Quantity</th>
                        <th>Total Price</th>
                        <th>&nbsp;</th>
        			</tr>
        		</thead>
        		<tbody>
            @if(!$cart->isEmpty())
                @foreach($cart as $item)
        			<tr id="cart-{{$item->id}}">
                <td data-title="Product" width="40%">
                  <div class="crt-im">
                    <img src="{{$item->attributes->image}}"/>
                  </div>
                  <div class="crtp">
                    <h4>{{$item->name}}</h4>
                  </div>
                </td>
                <td data-title="Price" width="15%"><h5>{{$item->price}} {{$item->attributes->currency}}</h5></td>
                <td data-title="Quantity" width="20%">
                            <div class="input-group quantity">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-minus btn-number" data-type="minus" data-field="quant[{{$item->id}}]"><span class="fa fa-minus"></span></button>
                                </span>
                                <input id="quantity-{{$item->id}}" type="text" name="quant[{{$item->id}}]" data-price="{{$item->price}}" data-id="{{$item->id}}" class="input-number number"  value="{{$item->quantity}}" min="1" max="100">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-plus btn-number" data-type="plus"  data-field="quant[{{$item->id}}]"><span class="fa fa-plus"></span></button>
                                </span>
                            </div>
                         </td>
            <td data-title="Total Price" width="15%"><h5><label id="total-{{$item->id}}">{{$item->quantity * $item->price}}</label> {{$item->attributes->currency}}</h5></td>
            <td data-title="" width="10%"><a href="" class="btn btn-xs close-btn" onclick="cart.removeFromCart({{$item->id}})"><i class="fa fa-close"></i></a></td>
              </tr>
              @endforeach
              @else
              <tr><th colspan="6"><h3>Cart Empty</h3></th></tr>
              @endif

              <tr class="ttl">
                  <th scope="row" width="100%" colspan="6"> <div class="cost h3"><span>Total Cost:</span><label id="cartTotalPrice">{{$cartTotalPrice}}</label></div> </th>
              </tr>
        		
        		</tbody>
        	</table>
            </div>


            <div class="col-md-12 no-padding">
             <a href="{{url('/')}}"  class="cart-links">CONTINUE WITH SHOPPING</a>
             <a href="#"  class="cart-links" onclick="popupCheckoutForm()">Check Out</a>
              <a style="display: none" href=""  class="cart-links">Update cart</a>
            </div>



         </div>
      </div>
   </div>
</div>






<div id="mail_status_dialog" class="dialog">
    <div class="dialog__overlay"></div>
    <div class="dialog__content">
        <button class="action pop-btn" data-dialog-close><i class="fa fa-close"></i></button>
        <h3 class="message" style="color:#FFF"></h3>
    </div>
</div> 

<div id="checkoutdialog" class="dialog">
    <div class="dialog__overlay"></div>
    <div class="dialog__content">
        <button class="action pop-btn" data-dialog-close><i class="fa fa-close"></i></button>
        <h2>Place Your Order</h2>
        <p>Fill below form and place your order</p>
        <form id="CheckoutForm" class="margin-top-40">
            <div class="form-group">
                <div class="col-md-12 margin-bottom-20"><input type="text" name="name" class="pop-input" placeholder="Name" required></div>
            </div>
            <div class="form-group">
                <div class="col-md-12 margin-bottom-20"><input type="email" name="email" class="pop-input" placeholder="Email" required></div>
            </div>
            <div class="form-group">
                <div class="col-md-12 margin-bottom-20"><input type="number" name="phone" class="pop-input" placeholder="Phone" ></div>
            </div>
            <div class="form-group">
                <div class="col-md-12 margin-bottom-40"><textarea name="address" class="pop-text" placeholder="Address" required></textarea></div>
            </div>
            <div class="form-group">
                <p id="MailStatus" style="padding: 1em;"></p>
                <div class="col-md-12"><button id="checkoutSubmitBtn" type="submit" class="pop-sub">Send</button></div>
            </div>
        </form>
    </div>
</div> 






@endsection

@section('scripts')
@parent


<script src="{{url('project/js/classie.js')}}"></script>
<script src="{{url('project/js/dialogFx.js')}}"></script>

<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    //Change Total value
    id = $(this).attr('data-id');
    unitPrice = parseInt($(this).attr('data-price')); 
    totalPrice = valueCurrent * unitPrice;
    $("#total-"+id).html(totalPrice);
    cart.updateCart(id);
    
});

$('.cart-comments').change(function() {
    id = $(this).attr('data-id');
    cart.updateCart(id);
});
</script>



<script>
  var cart = {};
  cart.updateCart = function (id){
    comments= $("#comments-"+id).val();
    quantity= $("#quantity-"+id).val();
    $.ajax({
        url: "{{ url('product/updatecart')}}",
        type: 'POST',
        data:{id:id,comments:comments,quantity:quantity},
        success: function(data){
          $('#cartCount').html(data.cartCount);
          if(data.cartCount > 0){
            $('#cartCount').addClass('badge');
          }else{
            $('#cartCount').removeClass('badge');
          }
          $('#cartTotalPrice').html(data.cartTotalPrice);
        },
        error: function(){
          console.log('Adding to cart failed');
        }
    });
  }
  cart.removeFromCart = function(id){
    event.preventDefault();
    $.ajax({
        url: "{{ url('product/removefromcart')}}",
        type: 'DELETE',
        data:{id:id},
        success: function(data){
          $('#cart-'+id).remove();
          $('#cartCount').html(data.cartCount);
          if(data.cartCount > 0){
            $('#cartCount').addClass('badge');
          }else{
            $('#cartCount').removeClass('badge');
          }
          $('#cartTotalPrice').html(data.cartTotalPrice);
        },
        error: function(){
          alert('Failed to remove from cart');
        }
    });
  }
</script>

<script type="text/javascript">
       var popupCheckoutForm = function(){
            var dialog =  document.getElementById('checkoutdialog');
            var dlg = new DialogFx(dialog);
             if({{$cart->isEmpty()?'0':'1'}}){
                return dlg.toggle.bind(dlg)();
            }else{
                popupCheckoutForm("Cart is empty");
            }

        };

    $(document).ready(function() {

        var popup = function(message){
            var dialog =  document.getElementById('mail_status_dialog');
            $('#mail_status_dialog .message').html(message);
            var option = {onCloseDialog : function(){location.reload()}};
            var dlg = new DialogFx(dialog,option);
            return dlg.toggle.bind(dlg)();
        };

 

        $('#CheckoutForm').submit(function(event) {
            event.preventDefault();

            $('#checkoutSubmitBtn').text('Sending...');
            $('#checkoutSubmitBtn').prop('disabled', true);
            var formData = {
                'name'       : $('input[name=name]').val(),
                'email'      : $('input[name=email]').val(),
                'phone'      : $('input[name=phone]').val(),
                'address'    : $('textarea[name=address]').val()
            };

            var message;
            $.ajax({
                type        : 'POST', 
                url         : '{{url('product/checkout')}}', 
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true,
                success: function(data){
                  message = "<strong>Thank you!</strong> We will contact you soon."; 
                },
                error: function(){
                  message = "<strong>Sorry! </strong> Couldnot send mail.";
                },
                complete: function(){
                    //Close the popup form
                    $('#checkoutdialog .pop-btn').click();
                    popup(message);
                    $('#checkoutSubmitBtn').prop('disabled', false);
                    $('#checkoutSubmitBtn').text('SEND');
                }
            })
        });
    });

</script>

<script type="text/javascript">
//Used for all Ajax posts
// CSRF protection
  $.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>


@endsection