<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body>
    <br>
    <br>
    <div class="container">
        <div class="card card-info">
            <div class="card-header with-border">
                <h3 class="card-title">Add New Product</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'product.store', 'class' => 'js-add-products-fm' ]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Product Name') !!} {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> 'eg: Product 1', 'required' => '']) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('quantity_in_stock', 'Quantity in stock') !!} {!! Form::text('quantity_in_stock', null, ['class' => 'form-control',
                    'placeholder'=> 'eg: 100', 'required' => '']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label('price_per_item', 'Price per Item') !!} {!! Form::text('price_per_item', null, ['class' => 'form-control',
                    'placeholder'=> 'eg: 460', 'required' => '']) !!}

                </div>
                <hr>
                <div class="">
                    {!! Form::submit('Add', ['class' => 'btn btn-info js-add-product']) !!} {!! Form::button('Cancel', ['class' => 'btn js-fm-reset',
                    'type' => 'reset']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <br>
        <br>
        <br> {{-- all view --}}
        <?php

        ?>
            <div class="card card-success">
                <div class="card-header with-border">
                    <h3 class="card-title">All Products</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity in Stock</th>
                                    <th>Price per Item</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody class="js-table-body">
                                @foreach ($viewData as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity_in_stock }}</td>
                                    <td>{!! $item->price_per_item !!}</td>
                                    <td>
                                        {{-- destroy --}} {!! Form::open(['method' => 'delete', 'class'=>'js-destroy-products-fm', 'route' => ['product.destroy', $item->id]]) !!} {!! Form::submit('Delete',
                                        ['class' => 'btn btn-danger']) !!} {!! Form::close() !!}

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>


                <!-- Optional JavaScript -->
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script>
                    // form 
                    
                    
                   let $formAdd = $('.js-add-products-fm');
                    

                    $formAdd.on('submit', function (e) {
                        e.preventDefault();
                        let fmData = $formAdd.serialize();
                        console.log(fmData);
                        $.ajax({
                        type: "POST",
                        url: "/product/store",
                        data: fmData,
                        success: function(data) {
                            setTableUi(data);
                            $formAdd[0].reset();
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                        // return false;
                    });
                    setformDestroy();
                    
                    function setformDestroy() {
                        let $formDestroy = $('.js-destroy-products-fm');
                        $formDestroy.off('submit');
                       $formDestroy.on('submit', function (e) {
                                    e.preventDefault();
                                    $.ajax({
                                    type: "get",
                                    url:$formDestroy.attr('action'),
                                    success: function(data) {
                                        setTableUi(data);
                                    },
                                    error: function() {
                                        alert('error');
                                    }
                                });
                            // return false;
                        });
                    }
                    
                    
                    function setTableUi(data) {
                        let allHtml = '';
                        let $tableBod = $('.js-table-body');
                        let dataArr = data;

                        dataArr.forEach(function(product){
                            console.log(product);
                        let trHtml = `<tr data-prod-id="${product.id}">
                                                        <td>${product.name}</td>
                                                        <td>${product.quantity_in_stock}</td>
                                                        <td>${product.price_per_item}</td>
                                                        <td>
    <form method="POST" action="/product/destroy/${product.id}" accept-charset="UTF-8" class="js-destroy-products-fm"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="f91Lt88CtSoLyuEfKaXYjgDMN54jZjVIbWxVe6n3"> <input class="btn btn-danger" type="submit" value="Delete"> </form>

</td>`;
                                                    allHtml = allHtml + trHtml;
                        });
                        $tableBod.empty().append(allHtml);
                        setformDestroy();
                    }
                </script>

</body>

</html>