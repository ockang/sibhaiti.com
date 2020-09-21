@extends('admin.layouts.common')

@section('content')
@include('templates.headerTop')

@include('admin.templates.header')
@include('admin.eleveurs.tab_top')
<div class="tab-pane <?php echo $active_tab == 'eleveurs_index' ? 'active' : NULL; ?>" id="tab_eleveurs_index">
    <?php
    if (isset($list))
    {
        ?>
        <form action="" method="post" name="eleveurs_list" id="eleveurs_list">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?php echo Lang::get('Non'); ?></th>
						<th><?php echo Lang::get('Cheptèl'); ?></th>
                        <th><?php echo Lang::get('Telefòn'); ?></th>
                        <th><?php echo Lang::get('CIN'); ?></th>
                        
                        <th><?php echo Lang::get('User'); ?></th>
                        <th><?php echo Lang::get('Depatman'); ?></th>
                        <th><?php echo Lang::get('komin'); ?></th>
                        <th><?php echo Lang::get('seksyon'); ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                if (!empty($list))
                {
                    foreach ($list as $row)
                    {
                        ?>
                        <tr>
                            <td><?php echo $row->fName . " " . $row->lName; ?></td>
							<td><?php echo $row->heritage('admin'); ?></td>

                           <td><?php echo $row->phone; ?></td>
                            <td><?php echo $row->cin; ?></td>
                                <td><a href="<?php echo URL::route('adminedituser', $row->desc); ?>"><?php echo $row->creator(); ?></a></td>
                            <td><?php echo User::getDepartment($row->department); ?></td>
                            <td><?php echo User::getCity($row->department, $row->city); ?></td>
                            <td><?php echo User::getSection($row->department, $row->city, $row->cSection); ?></td>
                            <td>
                                <a class="btn btn-success" type="button" value="Create" href="<?php echo URL::route('admincreateanimal', $row->id); ?>"><span class="glyphicon glyphicon-plus"></span></a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" type="button" value="Edit" href="<?php echo URL::route('adminediteleveur', $row->id); ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php echo $list->links(); ?>
            <?php /*
              <div class="form-actions">
              <?php echo 'With selected items'; ?> :
              <input name="list[activate]" type="submit" class="btn" value="<?php echo 'Activate'; ?>" onclick="if (confirm('Are you sure?'))
              return true;
              else
              return false;" />
              <input name="list[deactivate]" type="submit" class="btn" value="<?php echo 'Deactivate'; ?>" onclick="if (confirm('Are you sure?'))
              return true;
              else
              return false;" />
              <input name="list[delete]" type="submit" class="btn btn-danger" value="<?php echo 'Delete'; ?>" onclick="if (confirm('Are you sure?'))
              return true;
              else
              return false;" />
              </div>
             * 
             */ ?>
        </form>
        <?php
    }
    ?>
</div>
<!-- eo list tab -->
@include('templates.footer')
@endsection