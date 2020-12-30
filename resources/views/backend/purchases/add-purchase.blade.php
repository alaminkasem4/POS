
@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mange Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Add Purchase
            <a class="btn btn-success float-right btn-sm" href="{{route('products.view')}}"><i class="fa fa-list">Purchase List</i></a> 
         </h3>
        </div>
        <div class="card-body">

            <div class="form-row">

              <div class="form-group col-md-4">
                <label for="date">Date</label>
                <input type="date" name="date" value="" id="date" class="form-control form-control-sm" min="2020-12-2" max="2040-12-12">
              </div>

              <div class="form-group col-md-4">
                <label for="purchase_no">Purchase No</label>
                <input type="text" name="purchase_no"  id="purchase_no" class="form-control form-control-sm">
              </div>   

              <div class="form-group col-md-4">
                <label for="supplier_id">Supplier Name</label>
                <select name="supplier_id" id="supplier_id" class="form-control select2">
                  <option value="">Select Supplier</option>
                  @foreach($suppliers as $supplier)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="category_id">Category Name</label>
                <select name="category_id" id="category_id" class="form-control select2">
                  <option value="">Select Category</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="product_id">Product Name</label>
                <select name="product_id" id="product_id" class="form-control select2">
                  <option value="">Select Product</option>
                </select>
              </div>

              <div class="form-group col-md-2" style="padding-top: 30px;">
                <a class="btn btn-success addeventmore">
                <i class="fa fa-plus-circle"> Add Item</i></a>
              </div>
            </div>
        </div>

       
        <div class="card-body">
          <form action="{{route('purchases.store')}}" method="post" id="From_id">
            @csrf
            <div class="form-row">
              <table class="table-sm table-bordered" width="100%">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th width="7%">Pcs/KG</th>
                    <th width="10%">Unit Price</th>
                    <th>Description</th>
                    <th width="10%">Total Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="addRow" class="addRow">
                </tbody>
                <tbody>
                  <tr>
                    <td colspan="5"></td>
                    <td>
                      <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #B8FDBA">
                    </td>
                    <td></td>
                  </tr>
                </tbody>
              </table>

              <br>
              <div class="form-group">
                <button id="store_button" type="submit" class="btn btn-primary">Purchase Store</button>
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
    <input type="hidden" name="date[]" value="@{{date}}">
    <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
    <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
    </td>
     <td>
      <input type="hidden" name="product_id[]" value="@{{product_id}}">@{{product_name}}
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    <td>
      <input class="form-control form-control-sm text-right" name="description[]">
    </td>
    <td>
      <input class="form-control form-control-sm text-left buying_price" name="buying_price[]" readonly value="0">
    </td>
    <td><i class="btn btn-danger btn-sm fa fa-window-close removeEvebtMore"></i></td>
  </tr>
</script>

<!-- add exit script -->
<script>
  $(document).ready(function(){
    $(document).on('click','.addeventmore',function(){
      var date          = $('#date').val();
      var purchase_no   = $('#purchase_no').val();
      var supplier_id   = $('#supplier_id').val();
      var category_id   = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var product_id    = $('#product_id').val();
      var product_name  = $('#product_id').find('option:selected').text();
      
      if(date==''){
        $.notify("date is required",{globalPosition: 'top right',className: 'error'});
        return false;
      }
       if(purchase_no==''){
        $.notify("purchase no is required",{globalPosition: 'top right',className: 'error'});
        return false;
      }
       if(supplier_id==''){
        $.notify("supplier id is required",{globalPosition: 'top right',className: 'error'});
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
          date:date,
          purchase_no   :purchase_no,
          supplier_id   :supplier_id,
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

    $(document).on('keyup click','.unit_price,.buying_qty',function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var qty  = $(this).closest("tr").find("input.buying_qty").val();
      var total = unit_price*qty;
      $(this).closest("tr").find("input.buying_price").val(total);
      totalAmountPrice();
    });

    //calulation total amount of sum
    function totalAmountPrice(){
      var sum = 0;
      $('.buying_price').each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
        }
      });
      $('#estimated_amount').val(sum);
    }

  });
</script>

<!-- using ajax categoryshow -->
<script type="text/javascript">
  $(function(){
    $(document).on('change', '#supplier_id',function(){
      var supplier_id = $(this).val();
      $.ajax({
        url:"{{route('get_category')}}",
        type:"GET",
        data:{supplier_id:supplier_id}, //first supplier id using controller and 2nd supplier id using to variavle/var
        success:function(data){
          var html = '<option value="">Select Category</option>';
          $.each(data,function(key,v){
            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
          });
          $('#category_id').html(html); // showing foreach this id
        }
      });
    });
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

<!-- validation -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#From_id').validate({
      rules:{
        supplier_id:{
          required:true,
        },
        unit_id:{
          required:true,
        },
         category_id:{
          required:true,
        },
         name:{
          required:true,
        },
      },

      messages:{
        
      },
      errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });
  });
</script>

@endsection
