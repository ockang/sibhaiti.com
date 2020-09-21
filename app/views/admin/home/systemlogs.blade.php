@extends('admin.layouts.common')

@section('content')
@include('templates.headerTop')

@include('admin.templates.header')
<div class="container">
     <p class="titre_top"><?php echo 'sib / lòg sistèm nan'; ?></p>
    
        <div class="col-lg-12">
         <div id="search_admin">
        <form action="" class="">
                   

                <div class="col-lg-3">
                    <select name="search[type]" class="form-control">
                        <option value="">Chwazy Yon Tip</option>
                        <option value="Animal">Bèf</option>
                        <option value="agent">Ajan</option>
                        <option value="Abattoir">Labatwa</option>
                        <option value="Eleveur">Elvè</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select name="search[month]" class="form-control">
                        <option value="">Chwazi Yon Mwa</option>
                        <?php
                        if ($months)
                        {
                            foreach ($months as $m => $month)
                            {
                                ?>
                                <option value="{{$m+1}}" <?php echo (array_get($search, 'month') == $m + 1) ? 'selected="selected"' : NULL; ?> >{{$month}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
<div class="col-lg-3">
                    <select name="search[year]" class="form-control">
                        <?php
                        if ($years)
                        {
                            $years = array_reverse($years);
                            foreach ($years as $year)
                            {
                                ?>
                                <option value="{{$year}}" <?php echo (array_get($search, 'year') == $m + 1) ? 'selected="selected"' : NULL; ?> >{{$year}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
           
             
               </div>
            <div class="row">
                <div class="col-lg-12">
                   
                    <button type="submit" id="search-btn" class="btn btn-success pull-right">Expote Done Yo</button>
                </div>
                </div>
            
             </form></div></div>
            <?php
            if (isset($list))
            {
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Dat</th>
                            <th>Itilizatè</th>
                            <th>Tip Chanjman</th>
                            <th>Deskripsyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($list))
                        {
                            foreach ($list as $row)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $row->created_at; //substr(array_get($row, 'created_at'), 0, strrpos(array_get($row, 'created_at'), ' '))       ?></td>
                                    <td><?php echo $row->user->getFullNameAttribute(); ?></td>
                                    <td><?php echo $row->rOb; ?></td>
                                    <td><?php echo $row->text; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php echo $list->links(); ?>
                <input name="list" type="hidden" class="btn" value="TRUE" />
                <?php
            }
            ?>
        </form>
    </div>
</div>
@include('templates.footer')
@endsection