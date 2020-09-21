@extends('layouts.common')



@section('content')

@include('templates.headerTop')



@include('templates.header')

@include('animals.tab_top')

<div class="tab-pane <?php echo $active_tab == 'animals_index' ? 'active' : NULL; ?>" id="tab_animals_index">

    <?php

    if (isset($list))

    {

        ?>

        <form action="" method="post" name="animals_list" id="animals_list">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th><?php echo Lang::get('Elvè'); ?></th>

                        <th><?php echo Lang::get('#Kanè'); ?></th>

                        <th><?php echo Lang::get('#Tag'); ?></th>

                        <!--<th><?php echo Lang::get('Bèf'); ?></th>-->

                        <th><?php echo Lang::get('#Ajan'); ?></th>

                        <!--<th><?php echo Lang::get('Depatman'); ?></th>-->

                        <th><?php echo Lang::get('komin'); ?></th>

                        <th><?php echo Lang::get('seksyon'); ?></th>

                        <?php

                        if ($user->role != 'user')

                        {

                            ?>

                            <th></th>

                            <?php

                        }

                        ?>

                        <th></th>

                    </tr>

                </thead>

                <?php

                if (!empty($list))

                {

                    foreach ($list as $key => $row)

                    {

                        ?>

                        <tr>

                            <td><?php echo $row->getEleveur(); ?></td>

                            <td><?php echo ucfirst($row->carnet); ?></td>

                            <td><?php echo $row->tag; ?></td>

                        <!--<td><?php echo ucfirst($row->type); ?></td>-->

                        <!--<td><?php echo $row->noSoAgent(); ?></td> -->

                            <td><?php echo $row->so; ?></td>

                        <!--<td><?php echo User::getDepartment($row->department); ?></td>-->

                            <td><?php echo User::getCity($row->department, $row->city); ?></td>

                            <td><?php echo User::getSection($row->department, $row->city, $row->cSection); ?></td>
<td>
                            <?php

                            if ($user->role != 'user' && $row->isDead != 1)

                            {

                                ?>

                                <a class="btn btn-danger" href="<?php echo URL::route('remarke', $row->id); ?>" title="METE YON REMAK SOU BEF SA A"><span class="glyphicon glyphicon-plus"></span></a>                           

                                <?php

                            }

                            ?>
</td>
                            <td>

                                <div class="btn-group">

                                    <a class="btn btn-info" type="button" value="Edit" href="<?php echo URL::route('editanimal', $row->id); ?>" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>

                                </div>

                            </td>

                        </tr>

                        <?php

                    }

                }

                ?>

            </table>

            <?php echo $list->links(); ?>

        </form>

        <?php

    }

    ?>

</div>


@include('templates.footer')

@endsection