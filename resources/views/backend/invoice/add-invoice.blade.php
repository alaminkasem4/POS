
@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mange Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Add Invoice
            <a class="btn btn-success float-right btn-sm" href="{{route('invoice.view')}}"><i class="fa fa-list">Invoice List</i></a> 
         </h3>
        </div>
        <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-1">
                <label for="invoice_no">Invoice No</label>
                <input type="text" name="invoice_no"  id="Invoice_No" class="form-control form-control-sm Invoice_No" value="{{$invoice_no}}" readonly style="background-color: #B8FDBA">
              </div>   

              <div class="form-group col-md-2">
                <label for="date">Date</label>
                <input type="date" name="date" value="{{$date}}" id="date" class="form-control form-control-sm"  min="2020-12-2" max="2040-12-12">
              </div>

              <div class="form-group col-md-3">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control select2">
                  <option value="">Select Category</option>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-3">
                <label for="product_id">Product Name</label>
                <select name="product_id" id="product_id" class="form-control select2">
                  <option value="">Select Product</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="">Stock(kg/pcs)</label>
                <input type="text" name="current_stock_qty"  id="current_stock_qty" class="form-control form-control-sm" readonly style="background-color: #B8FDBA">
              </div>  
    
              <div class="form-group form-control-sm col-md-1" style="padding-top: 30px;">
                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle">Add</i></a>
              </div>
            </div>
        </div>

        <div class="card-body">
          <form action="{{route('invoice.store')}}" method="post" id="From_id">
            @csrf
            <div class="form-row">
              <table class="table-sm table-bordered" width="100%">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th width="7%">Pcs/KG</th>
                    <th width="15%">Unit Price</th>
                    <th width="15%">Total Price</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody id="addRow" class="addRow">

                </tbody>
                <tbody>
                  <tr>
                    <td colspan="4" class="text-right">Discount</td>
                    <td><input type="text" name="discount_amount" id="discount_amount" class="discount_amount form-control form-control-sm text-right" placeholder="discount amount"></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right">Grand Total</td>
                    <td>
                      <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm estimated_amount text-right" readonly style="background-color: #B8FDBA" null>
                    </td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <br>
              <div class="form-group col-md-12">
                <textarea name="description" class="form-control" id="description" placeholder="write description hear"></textarea>
              </div>

               <div class="form-group col-md-3">
                <label style="display: block;">Paid Status</label>
                <select name="paid_status" id="paid_status" class="paid_status form-control form-control-sm">
                  <option value="">Select Paid Statusu</option>
                  <option value="full_paid">Full Paid</option>
                  <option value="full_deu">Full deu</option>
                  <option value="partical_payment">Partical Payment</option>
                </select>
                <input type="text" name="paid_amount" id="paid_amount" class="paid_amount form-control form-control-sm" placeholder="Enter Partical payment" style="display: none">
              </div>


              <div class="form-group col-md-9">
                <label style="display: block;">Customer Status</label>
                <select name="customer_id" id="customer_id" class="customer_id form-control select2">
                  <option value="">Select Customer</option>
                  <option value="0">New Customer</option>
                  @foreach($customers as $customer)
                  <option value="{{$customer->id}}">{{$customer->mobile}} (- {{$customer->name}} - {{$customer->address}})</option>
                  @endforeach
                </select>
              </div>
               
              <div class="form-row col-md-12 new_customer" id="new_customer" style="display: none;">
                <div class="form-group col-md-4">
                  <label >Customer Name</label>
                  <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Write Customer Name">               
                </div>
                <div class="form-group col-md-4">
                  <label >Mobile Number</label>
                  <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" placeholder="Write Mobile Number">               
                </div>
                <div class="form-group col-md-4">
                  <label >Address</label>
                  <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Address">               
                </div>
              </div>

              <div class="form-group form-control-sm col-md-2">
                <button id="store_button" type="submit" class="btn btn-primary">Invoice Store</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </section> 
</div>
<!-- end html -->


<script id="document-template" class="document-template" type="text/x-handlebars-template">
  <tr class="delete_and_more_item" id="delete_and_more_item">
    <input type="hidden" name="date" value="@{{date}}">
    <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
    </td>
     <td>
      <input type="hidden" name="product_id[]" value="@{{product_id}}">@{{product_name}}
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    <td>
      <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" readonly value="0">
    </td>
    <td><i class="btn btn-danger btn-sm fa fa-window-close removeEvebtMore"></i></td>
  </tr>
</script>

<!-- add exit script -->
<script>
  $(document).ready(function(){
    $(document).on('click','.addeventmore',function(){
      var date          = $('#date').val();
      var invoice_no   = $('#Invoice_No').val();
      var category_id   = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var product_id    = $('#product_id').val();
      var product_name  = $('#product_id').find('option:selected').text();
      
      if(date==''){
        $.notify("date is required",{globalPosition: 'top right',className: 'error'});
        return false;
      }
       if(invoice_no==''){
        $.notify("Invoice no is required",{globalPosition: 'top right',className: 'error'});
        return false;
      }
       if(category_id==''){
        $.notify("category id is required",{globalPosition: 'top right',className: 'error'});
        return false;
      }
       if(product_id==''){
        $.notify("product id is required",{globalPosition: 'top right',className: 'error'});
        return false;
      }

      var source = $('.document-template').html();
      var template = Handlebars.compile(source);
      var data={
          date          :date,
          invoice_no    :invoice_no,
          category_id   :category_id,
          category_name :category_name,
          product_id    :product_id,
          product_name  :product_name
      }
      var html = template(data);
      $('.addRow').append(html);
    });
    
    $(document).on('click','.removeEvebtMore',function(event){
      $(this).closest('.delete_and_more_item').remove();
      totalAmountPrice();
    });

    $(document).on('keyup click','.unit_price,.selling_qty',function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var qty  = $(this).closest("tr").find("input.selling_qty").val();
      var total = unit_price*qty;
      $(this).closest("tr").find("input.selling_price").val(total);
       totalAmountPrice();
       $('#discount_amount').trigger('keyup');
    });

    $(document).on('keyup','#discount_amount',function(){
      totalAmountPrice();
    });

    //calulation total amount of sum
    function totalAmountPrice(){
      var sum = 0;
      $('.selling_price').each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
        }
      });

      var discount_amount  = parseFloat($('#discount_amount').val());
      if(!isNaN(discount_amount) && discount_amount.length != 0){
        sum -= parseFloat(discount_amount);
      }

      $('#estimated_amount').val(sum);
    }

  });
</script>

<!-- using ajax Productshow -->
<script type="text/javascript">
  $(function(){
    $(document).on('change', '#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{route('get_product')}}",
        type:"GET",
        data:{category_id:category_id}, //first category id using controller and 2nd category_id using to variavle/var
        success:function(data){
          var html = '<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html += '<option value="'+v.id+'">'+v.name+'</option>';
          });
          $('#product_id').html(html); // showing foreach this id
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(function(){
    $(document).on('change','#product_id',function(){
      var product_id = $(this).val();
      $.ajax({
        url:"{{route('check-product-stock')}}",
        type:"GET",
        data:{product_id:product_id},
        success:function(data){
          $('#current_stock_qty').val(data);
        }
      });
    });
  });  
</script>

<script type="text/javascript">
  // paid status
  $(document).on('change','#paid_status',function(){
    var paid_status = $(this).val();
    if(paid_status == 'partical_payment'){
      $('#paid_amount').show()
    }else{
      $('#paid_amount').hide();
    }
  });
  // new customer status
  $(document).on('change','#customer_id',function(){
    var customerReg = $(this).val();
    if(customerReg == '0'){
      $('#new_customer').show()
    }else{
      $('#new_customer').hide();
    }
  });
</script>



@endsection
