   
    <?php
    if( 0  != $salesmen->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 100px">Salesman Name</th>
                <th style="width: 50px">Salesman Code</th>
                <th style="width: 100px">Salesman Parent</th>
                <th style="width: 20px">Lavel</th>
                <th style="width: 100px">Actions</th>
            </tr>
        </thead>
    <tbody>
        <?php
            $i = ($salesmen->perPage() * ($salesmen->currentPage() - 1)) + 1; ?>
            @foreach($salesmen as $salesmens)
            
            <?php if( $salesmens->level == 1 ){
                $lavel = 'Lavel 1'; 
            }else if( $salesmens->level == 2 ){
                $lavel = 'Lavel 2'; 
            }else if( $salesmens->level == 3 ){
                $lavel = 'Lavel 3'; 
            }else if( $salesmens->level == 4 ){
                $lavel = 'Lavel 4'; 
            }else if( $salesmens->level == 5 ){
                $lavel = 'Lavel 5';
            }else{
                 $lavel = '';
            }
            ?>
            <tr>
                <td >{{ $i++ }}</td>
                <td > {{ $salesmens->name }} </td>
                <td > {{ $salesmens->code }} </td>
                <td > {{ $salesmens->parent_name }} </td>
                <td > {{ $lavel }} </td>
                <td>
                
                    <a class="btn"  title="edit" href="{{ route('salesmen.edit', ['id' => $salesmens->id]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="{{ route('salesmen.show', ['id' => $salesmens->id]) }}" ><i class="fas fa-eye"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete plan {{ $salesmens->name }} ?')"  href="{{ route('salesmen.delete', ['id' => $salesmens->id]) }}" ><i class="fas fa-times"></i></a>
                </td>  
            </tr>
            @endforeach 
        </tbody> 
    </table>

<?php } else{?> 
<img src="{{url('/images/norecordfound.png')}}" class="no-data-found" style="width: 100%;" />
    <?php } ?>

<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        {!! $salesmen->links('pagination::bootstrap-4') !!}
    </ul>
</div>
</div>   