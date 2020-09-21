@extends('admin.layouts.common')

@section('content')
@include('templates.headerTop')

@include('admin.templates.header')
<style>
    .mt-10
    {
        margin-top: 10px;
    }
</style>
<div class="container">
    <div class="col-lg-12">
        <form action="" class="">
            <div class="row">
                <div class="col-lg-1">
                    <h3 class="mt-10">Soti</h3>
                </div>
                <div class="col-lg-3">
                    <select name="search[start_month]" id="search_start_month" class="form-control" >
                        <option value="">Tout ane a</option>
                        <?php
                        if ($months)
                        {
                            foreach ($months as $m => $month)
                            {
                                ?>
                                <option value="{{$m+1}}" <?php echo (array_get($search, 'start_month') == $m + 1) ? 'selected="selected"' : NULL; ?> >{{$month}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <select name="search[start_year]" id="search_start_year" class="form-control" >
                        <?php
                        if ($years)
                        {
                            foreach ($years as $year)
                            {
                                ?>
                                <option value="{{$year}}" <?php echo (array_get($search, 'start_year') == $year) ? 'selected="selected"' : NULL; ?> >{{$year}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-1">
                    <h3 class="mt-10">Rive</h3>
                </div>
                <div class="col-lg-3">
                    <select name="search[end_month]" id="search_end_month" class="form-control" >
                        <option value="">Tout ane a</option>
                        <?php
                        if ($months)
                        {
                            foreach ($months as $m => $month)
                            {
                                ?>
                                <option value="{{$m+1}}" <?php echo (array_get($search, 'end_month') == $m + 1) ? 'selected="selected"' : NULL; ?>>{{$month}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <select name="search[end_year]" id="search_end_year" class="form-control" >
                        <?php
                        if ($years)
                        {
                            foreach ($years as $year)
                            {
                                ?>
                                <option value="{{$year}}" <?php echo (array_get($search, 'end_year') == $year) ? 'selected="selected"' : NULL; ?> >{{$year}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <select name="search[department]" id="search_department" class="form-control">
                        <option value="">Tout peyi a</option>
                        <?php
                        foreach ($departments as $dept)
                        {
                            ?>
                            <option value="<?php echo array_get($dept, 'id'); ?>" <?php echo (array_get($search, 'department') == array_get($dept, 'id')) ? 'selected="selected"' : NULL; ?> ><?php echo array_get($dept, 'name'); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="search[city]" id="search_city" class="form-control" >
                        <option value="">Chwazi komin...</option>
                        <?php
                        if (isset($cities))
                        {
                            foreach ($cities as $city)
                            {
                                ?>
                                <option value="{{array_get($city, 'id')}}" <?php echo (array_get($search, 'city') == array_get($city, 'id')) ? 'selected="selected"' : NULL; ?>>{{array_get($city, 'name')}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <select name="search[cSection]" id="search_cSection" class="form-control" >
                        <option value="">Chwazi Seksyon...</option>
                        <?php
                        if (isset($sections))
                        {
                            foreach ($sections as $section)
                            {
                                ?>
                                <option value="{{array_get($section, 'id')}}" <?php echo (array_get($search, 'cSection') == array_get($section, 'id')) ? 'selected="selected"' : NULL; ?>>{{array_get($section, 'name')}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="search[type]" id="search_type_animal" value="animal" checked/>
                            Bèf
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="search[type]" id="search_type_agent" value="agent" <?php echo (array_get($search, 'type') == 'agent') ? 'checked' : NULL; ?> />
                            Ajan 
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="search[type]" id="search_type_eleveur" value="eleveur" <?php echo (array_get($search, 'type') == 'eleveur') ? 'checked' : NULL; ?> />
                            Elvè 
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="search[type]" id="search_type_abattoir" value="abattoir" <?php echo (array_get($search, 'type') == 'abattoir') ? 'checked' : NULL; ?> />
                            Labatwa
                        </label>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="loader" hidden><img src="/frontapp/img/ajax-loader.gif" width="50" class="img-responsive pull-right" /></div>
                    <button type="submit" id="search-btn" class="btn btn-primary pull-right">Chache</button>
                </div>
            </div>
        </form>
        <div class="col-lg-12">
            <hr>
            <div class="row">
                <?php
                if (!empty($animals))
                {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bèf</th>
                                <th>Total</th>
                                <th>Mal</th>
                                <th>Femèl</th>
                                <th>Pa ekri</th>
                                <?php
                                if (isset($filterYears) && !empty($filterYears))
                                {
                                    foreach ($filterYears as $year)
                                    {
                                        ?>
                                        <th>{{$year}}</th>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($animals as $row)
                            {
                                ?>
                                <tr>
                                    <td>{{array_get($row,'title')}}</td>
                                    <td>{{array_get($row,'total')}}</td>
                                    <td>{{array_get($row,'male')}}</td>
                                    <td>{{array_get($row,'female')}}</td>
                                    <td>{{array_get($row,'unknow')}}</td>
                                    <?php
                                    if (isset($filterYears) && !empty($filterYears))
                                    {
                                        foreach ($filterYears as $year)
                                        {
                                            ?>
                                            <td>{{array_get($row,$year)}}</td>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else if (!empty($agents) || !empty($eleveurs))
                {
                    $list = (!empty($agents)) ? $agents : $eleveurs;
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{(!empty($agents))? 'Ajan' : 'Elvè'}}</th>
                                <th>Total</th>
                                <th>Gason</th>
                                <th>Fi</th>
                                <?php
                                if (isset($filterYears) && !empty($filterYears))
                                {
                                    foreach ($filterYears as $year)
                                    {
                                        ?>
                                        <th>{{$year}}</th>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list as $row)
                            {
                                ?>
                                <tr>
                                    <td>{{array_get($row,'title')}}</td>
                                    <td>{{array_get($row,'total')}}</td>
                                    <td>{{array_get($row,'male')}}</td>
                                    <td>{{array_get($row,'female')}}</td>
                                    <?php
                                    if (isset($filterYears) && !empty($filterYears))
                                    {
                                        foreach ($filterYears as $year)
                                        {
                                            ?>
                                            <td>{{array_get($row,$year)}}</td>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else if (!empty($abattoirs))
                {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estimasyon sou Abataj chak Semenn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($abattoirs as $row)
                            {
                                ?>
                                <tr>
                                    <td>{{array_get($row,'title')}}</td>
                                    <td>{{array_get($row,'value')}}</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var departments = <?php echo (!empty($departments)) ? json_encode($departments) : "{}"; ?>;
    $(document).ready(function () {
        $('#search_department').change(function () {
            $("#search_city").empty();
            $("#search_cSection").empty();
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
                    var option = $('<option></option>').attr({
                        value: ''
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

        $('#search_city').change(function () {
            var city_id = $('#search_city').val();
            var dept = $('#search_department').val();
            if (typeof city_id != 'undefined' && typeof dept != 'undefined')
            {
                var cities = [];
                var sections = [];
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
                    for (var k = 0; k < cities.length; k++)
                    {
                        if (cities[k].id == city_id)
                        {
                            sections = cities[k].sections;
                            break;
                        }
                    }
                }
                if (sections.length != 0)
                {
                    $("#search_cSection").empty();
                    var option = $('<option></option>').attr({
                        value: ''
                    })
                            .text('Chwazi Seksyon...');
                    $("#search_cSection").append(option);
                    for (var i = 0; i < sections.length; i++)
                    {
                        var value = sections[i].id;
                        var text = sections[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value: value
                        })
                                .text(text);

                        //add the option to the select
                        $("#search_cSection").append(option);
                    }
                }
            }
        });

        $('#search-btn').click(function () {
            $(this).fadeOut();
            $('#loader').fadeIn();
        });
    });
</script>
@include('templates.footer')
@endsection