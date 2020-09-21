@extends('layouts.common')
@section('content')
@include('templates.headerTop')
@include('templates.header')

<div class="container">
    
	<?php
    if ($page_id == 'dashboard' && $user->role == 'user')
    {
        ?>
        <div id="search_admin">
            <form role="search">
                <div class="col-lg-6">
                    <input name="search[text]" type="text" class="form-control" placeholder="Non, Siyati, #So, #Tag, #Cin,..." value="<?php echo (isset($search)) ? array_get($search, 'text') : NULL ?>">
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-3">
                    <select name="search[obj]" id="search_type" class="form-control" >
                        <option value="">Non oswa Siyati</option>
                        <option value="so"># So</option>
                        <option value="tag"># Tag</option>
                        <option value="kane"># Kanè</option>
                        <option value="cin"># Cin</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select name="search[type]" id="search_type" class="form-control" >
                        <option value="eleveur">Elvè</option>
                        <option value="agent">Ajan</option>
                        <option value="animal">Bèf</option>
                        <option value="abattoir">Labatwa</option>
                    </select>

                </div>
                <div class="col-lg-3">
                    <select name="search[department]" id="search_department" class="form-control">
                        <option value="">Tout peyi a</option>
                        <?php
                        foreach ($departments as $dept)
                        {
                            ?>
                            <option value="<?php echo array_get($dept, 'id'); ?>"><?php echo array_get($dept, 'name'); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline"></span>
                </div>
                <div class="col-lg-3">
                    <select name="search[city]" id="search_city" class="form-control" >
                        <option value="">Tout Komin yo</option>
                    </select>
                </div>
                <div class="col-lg-1">
                    <button type="submit" class="btn btn-info">CHACHE</button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <div id="search_admin">
            <form name="filter">
                <div class="col-lg-3">
                    <select name="filter[department]" id="filter_department" class="form-control" required="">
                        <option value="">Chwazi yon Depatman </option>
                        <?php
                        foreach ($departments as $dept)
                        {
                            ?>
                            <option value="<?php echo array_get($dept, 'id'); ?>" <?php echo (isset($filters) && array_get($filters,'department') == array_get($dept, 'id'))? 'selected="selected"': NULL?>><?php echo array_get($dept, 'name'); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline"></span>
                </div>
                <div class="col-lg-3">
                    <select name="filter[city]" id="filter_city" class="form-control" >  
                        <option value="">Chwazi yon Komin...</option>
                        <?php
                        if (isset($city) && isset($department))
                        {
                            ?>
                            <option value="<?php echo $city; ?>" selected="selected"><?php echo User::getCity(array_get($department, 'id'), $city); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-3">
                    <button type="submit" class="btn btn-info">CHACHE</button>
                </div>

            </form>
        </div>
        <?php
    }
    ?>
    <div id="row">
        <?php
        if (isset($department))
        {
            $dept = $department;
            if (array_get($dept, 'id'))
            {
                ?>
                <!--<div class="col-lg-3 dept-box">-->
                <legend>
                    <a href="<?php echo URL::route('department', array_get($dept, 'id')); ?>"><?php echo array_get($dept, 'name'); ?></a>
                </legend>           
                <ul>
                    <li><a href="<?php echo URL::route('animals', array(array_get($dept, 'id'), $city)); ?>"><?php echo 'Bèf' . " (" . User::deptCounter('animal', array_get($dept, 'id'), $city) . ")"; ?></a></li>
                    <li><a href="<?php echo URL::route('agents', array(array_get($dept, 'id'), $city)); ?>"><?php echo 'Ajan' . " (" . User::deptCounter('agent', array_get($dept, 'id'), $city) . ")"; ?></a></li>
                    <li><a href="<?php echo URL::route('eleveurs', array(array_get($dept, 'id'), $city)); ?>"><?php echo 'Elvè' . " (" . User::deptCounter('eleveur', array_get($dept, 'id'), $city) . ")"; ?></a></li>
                    <li><a href="<?php echo URL::route('abbatages', array(array_get($dept, 'id'), $city)); ?>"><?php echo 'Abatwa ' . " (" . User::deptCounter('abbatage', array_get($dept, 'id'), $city) . ")"; ?></a></li>
                    <ul>
                        <li class="dlist" ><?php echo 'Kabrit' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'kabri', $city) . ")"; ?></li>
                        <li class="dlist"><?php echo 'Mouton' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'mouton', $city) . ")"; ?></li>
                        <li class="dlist" ><?php echo 'Kochon' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'kochon', $city) . ")"; ?></li>
                        <li class="dlist" ><?php echo 'Bèf' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'bef', $city) . ")"; ?></li>
                        <li class="dlist" ><?php echo 'Total Bèf' . " (" . Abattoir::notificationDeptCounter(array_get($dept, 'id'), $city) . ")"; ?></li>
                    </ul>
                </ul>
                <?php
            }
        } else
        {
            ?>
            <legend>rezime sib</legend>
            <ul>
                <li><?php echo 'Bèf' . " (" . number_format(Animal::count()) . ")"; ?></li>
                <li><?php echo 'Bèf yo touye nan abatwa' . " (" . number_format(Notification::where('type', 'a')->where('rOb', 'animal')->count()) . ")"; ?></li>
                <li><?php echo 'Ajan' . " (" . number_format(Agent::count()) . ")"; ?></li>
                <ul>
                    <li><?php echo 'Ajan Veterinè' . " (" . number_format(Agent::where('type', 'ev')->count()) . ")"; ?></li>
                    <li><?php echo 'Ajan Idantifikatè' . " (" . number_format(Agent::where('type', 'ai')->count()) . ")"; ?></li>
                    <li><?php echo 'Ajan ki alafwa Veterinè e Idantifikatè' . " (" . number_format(Agent::where('type', 'aiev')->count()) . ")"; ?></li>
                </ul>
                <li><?php echo 'Elvè' . " (" . number_format(Eleveur::count()) . ")"; ?></li>
                <li><?php echo 'Abatwa' . " (" . number_format(Abattoir::count()) . ")"; ?></li>
            </ul>
            <?php
        }


        /*
          if (isset($departments) && !empty($departments) && $user->role == 'user')
          {
          foreach ($departments as $dept)
          {
          if (array_get($dept, 'id'))
          {
          ?>
          <!--<div class="col-lg-3 dept-box">-->
          <legend>
          <a href="<?php echo URL::route('department', array_get($dept, 'id')); ?>"><?php echo array_get($dept, 'name'); ?></a>
          </legend>
          <ul>
          <li><a href="<?php echo URL::route('animals', array_get($dept, 'id')); ?>"><?php echo 'Bèf' . " (" . User::deptCounter('animal', array_get($dept, 'id')) . ")"; ?></a></li>
          <li><a href="<?php echo URL::route('agents', array_get($dept, 'id')); ?>"><?php echo 'Ajan' . " (" . User::deptCounter('agent', array_get($dept, 'id')) . ")"; ?></a></li>
          <li><a href="<?php echo URL::route('eleveurs', array_get($dept, 'id')); ?>"><?php echo 'Elvè' . " (" . User::deptCounter('eleveur', array_get($dept, 'id')) . ")"; ?></a></li>
          <li><a href="<?php echo URL::route('abbatages', array_get($dept, 'id')); ?>"><?php echo 'Abataj ' . " (" . User::deptCounter('abbatage', array_get($dept, 'id')) . ")"; ?></a></li>
          <ul>
          <li class="dlist" ><?php echo 'Kabrit' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'kabri') . ")"; ?></li>
          <li class="dlist"><?php echo 'Mouton' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'mouton') . ")"; ?></li>
          <li class="dlist" ><?php echo 'Kochon' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'kochon') . ")"; ?></li>
          <li class="dlist" ><?php echo 'Bèf' . " (" . Abattoir::betDeptCounter(array_get($dept, 'id'), 'bef') . ")"; ?></li>
          <li class="dlist" ><?php echo 'Total Bèf' . " (" . Abattoir::notificationDeptCounter(array_get($dept, 'id')) . ")"; ?></li>
          </ul>
          </ul>
          <?php
          }
          }
          } */
        ?>
    </div>    

</div>

<script type="text/javascript">
    var departments = <?php echo (!empty($departments)) ? json_encode($departments) : "{}"; ?>;
    $(document).ready(function() {
        $('#search_department').change(function() {
            var dept = $('#search_department').val();
            var cities = [];

            if (typeof dept != 'undefined') {

                for (var j = 0; j < departments.length; j++)
                {
                    if (departments[j].id == dept)
                    {
                        cities = departments[j].cities;
                        break;
                    }
                }
                if (cities.length != 0)
                {
                    //console.log(dept);
                    //console.log(cities);
                    // clear the select
                    $("#search_city").empty();
                    var option = $('<option></option>').attr({
                        value: null
                    })
                            .text('Chwazi komin...');

                    //add the option to the select
                    $("#search_city").append(option);
                    for (var i = 0; i < cities.length; i++) {
                        var value = cities[i].id;
                        var text = cities[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value: value
                        })
                                .text(text);

                        //add the option to the select
                        $("#search_city").append(option);
                    }
                }
            }
        });

$('#filter_department').change(function() {
            var dept = $('#filter_department').val();
            var cities = [];

            if (typeof dept != 'undefined') {

                for (var j = 0; j < departments.length; j++)
                {
                    if (departments[j].id == dept)
                    {
                        cities = departments[j].cities;
                        break;
                    }
                }
                if (cities.length != 0)
                {
                    //console.log(dept);
                    //console.log(cities);
                    // clear the select
                    $("#filter_city").empty();
                    var option = $('<option></option>').attr({
                        value: ""
                    })
                            .text('Chwazi komin...');

                    //add the option to the select
                    $("#filter_city").append(option);
                    for (var i = 0; i < cities.length; i++) {
                        var value = cities[i].id;
                        var text = cities[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value: value
                        })
                                .text(text);

                        //add the option to the select
                        $("#filter_city").append(option);
                    }
                }
            }
        });
    });
</script>
@include('templates.footer')
@endsection