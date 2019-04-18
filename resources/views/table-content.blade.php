
<?php

for ($i=0; $i < $viewData; $i++) { 
    # code...
?>   

   <tr>

                                    <td>{{ $viewData[$i]->name }}</td>
                                    <td>{{ $viewData[$i]->quantity_in_stock }}</td>
                                    <td>{{ $viewData[$i]->price_per_viewData }}</td>
                                    <td><a class="btn btn-info" href="{{ route('product.store',$viewData[$i]->id) }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a></td>
                                    <td>


                                    </td>
                                </tr>                             
<?php
}
?>                                