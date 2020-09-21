@extends('admin.layouts.common')

@section('content')
@include('templates.headerTop')

@include('admin.templates.header')
@include('admin.eleveurs.tab_top')
<div class="tab-pane <?php echo $active_tab == 'eleveurs_edit' ? 'active' : NULL; ?>" id="tab_eleveurs_edit">
     <form action="" method="post" name="eleveurs_edit" class="form-horizontal">
        <div class="user-form">
            <?php
            if (isset($errors))
            {
                foreach ($errors as $error)
                {
                    ?>
                    <div class="text-danger">
                        <?php echo array_get($error, 0); ?>
                    </div>
                    <?php
                }
            }
            ?>
            <legend>Enfòmasyon sou moun nan</legend>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_lName">
                    <?php echo Lang::get('Siyati'); ?><span class="req">*</span>
                </label>
                <div class="col-lg-5">
                    <input name="edit[eleveur][lName]" id="edit_eleveur_lName" class="form-control" maxlength="20" type="text" placeholder="<?php echo Lang::get('Siyati'); ?>" value="<?php echo array_get($edit_item, 'lName'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_fName">
                    <?php echo Lang::get('Non'); ?><span class="req">*</span>
                </label>
                <div class="col-lg-5">
                    <input name="edit[eleveur][fName]" id="edit_eleveur_fName" class="form-control" maxlength="20" type="text" placeholder="<?php echo Lang::get('Non'); ?>" value="<?php echo array_get($edit_item, 'fName'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_sex"><?php echo Lang::get('Sèks'); ?><span class="req">*</span></label>                
                <div class="col-lg-5">
                    <select name="edit[eleveur][sex]" id="edit_eleveur_sex" class="form-control" >
                        <option value=""><?php echo Lang::get('---'); ?></option>
                        <option value="m" <?php echo (array_get($edit_item, 'sex') == "m") ? 'selected="selected"' : NULL; ?>><?php echo Lang::get('Gason'); ?></option>
                        <option value="f" <?php echo (array_get($edit_item, 'sex') == "f") ? 'selected="selected"' : NULL; ?>><?php echo Lang::get('Fi'); ?></option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_phone">
                    <?php echo Lang::get('Telefòn'); ?>
                </label>
                <div class="col-lg-5">
                    <input name="edit[eleveur][phone]" id="edit_eleveur_phone" class="form-control" maxlength="8" type="text" placeholder="<?php echo Lang::get('Telefòn'); ?>" value="<?php echo array_get($edit_item, 'phone'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_fiche">
                    <?php echo Lang::get('#Fich'); ?><span class="req">*</span>
                </label>
                <div class="col-lg-5">
                    <input name="edit[eleveur][fiche]" id="edit_eleveur_fiche" class="form-control" maxlength="7" type="text" placeholder="<?php echo Lang::get('0000000'); ?>" value="<?php echo array_get($edit_item, 'fiche'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <legend>ADRÈS</legend>
          


            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_department_1"><?php echo Lang::get('Depatman'); ?></label>
                <div class="col-lg-5">
                    <select name="edit[eleveur][department]" id="edit_eleveur_department_1" class="form-control">
                        <option value="">Chwazi depatman...</option>
                        <?php
                        foreach ($departments as $dept)
                        {
                            ?>
                            <option value="<?php echo array_get($dept, 'id'); ?>" <?php echo (array_get($edit_item, 'department') == array_get($dept, 'id')) ? 'selected="selected"' : NULL; ?>><?php echo array_get($dept, 'name'); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_city"><?php echo Lang::get('Komin'); ?></label>
                <div class="col-lg-5">
                    <select name="edit[eleveur][city]" id="edit_eleveur_city" class="form-control" >  
                        <option value="">Chwazi komin...</option>
                        <?php
                        if (array_get($edit_item, 'department'))
                        {
                            $dept = array_get($edit_item, 'department');
                            for ($i = 0; $i < count($departments); $i++)
                            {
                                if ($departments[$i]['id'] == $dept)
                                {
                                    $cities = $departments[$i]['cities'];
                                    break;
                                }
                            }
                            if (isset($cities) && !empty($cities))
                            {
                                foreach ($cities as $city)
                                {
                                    ?>
                                    <option value="<?php echo array_get($city, 'id'); ?>" <?php echo (array_get($edit_item, 'city') == array_get($city, 'id')) ? 'selected="selected"' : NULL; ?>><?php echo array_get($city, 'name'); ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_cSection"><?php echo Lang::get('Seksyon'); ?></label>
                <div class="col-lg-5">
                    <select name="edit[eleveur][cSection]" id="edit_eleveur_cSection" class="form-control" >  
                        <option value="">Seksyon...</option>
                        <?php
                        if (array_get($edit_item, 'department') && array_get($edit_item, 'city') && isset($cities))
                        {
                            foreach ($cities as $city)
                            {
                                if (array_get($edit_item, 'city') == array_get($city, 'id'))
                                {
                                    $sections = array_get($city, 'sections');
                                    break;
                                }
                            }
                            if (isset($sections) && !empty($sections))
                            {
                                foreach ($sections as $section)
                                {
                                    ?>
                                    <option value="<?php echo array_get($section, 'id'); ?>" <?php echo (array_get($edit_item, 'cSection') == array_get($section, 'id')) ? 'selected="selected"' : NULL; ?>><?php echo array_get($section, 'name'); ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <legend>Nimewo MATRIKIL YO</legend>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_cin">
                    <?php echo Lang::get('CIN'); ?><span class="req">*</span>
                </label>
                <div class="col-lg-5">
                    <input name="edit[eleveur][cin]" id="edit_eleveur_cin" class="form-control" type="text" placeholder="<?php echo "__-__-__-____-__-_____"; ?>" value="<?php echo array_get($edit_item, 'cin'); ?>" >
                    <span class="help-inline"></span>
                </div>
            </div>
           <!-- <div class="form-group">
                <label class="col-lg-2 control-label" for="edit_eleveur_idEleveur">
                    <?php echo Lang::get('#Elvè'); ?>
                </label>
                <div class="col-lg-5">
                    <?php echo array_get($edit_item, 'idEleveur'); ?>
                    <span class="help-inline">
                    </span>
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">					<a href="{{URL::route('admineleveurs')}}"class="btn btn-danger">Sòti</a>
                    <button type="submit" class="btn btn-primary" name="edit[submit]">
                        <?php echo Lang::get('Modifye Elvè'); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- eo list tab -->
<script type="text/javascript">   
    var departments = <?php echo (!empty($departments)) ? json_encode($departments) : "{}"; ?>;
    $(document).ready(function(){
        $(function() {
            $.mask.definitions['~'] = "[+-]";
            $("#edit_eleveur_cin").mask("99-99-99-9999-99-99999");
            $("#edit_eleveur_phone").mask("9999-9999");
            $("#edit_eleveur_fiche").mask("9999999");
            //$("#edit_eleveur_nif").mask("999-999-999-9");
            $("input").blur(function() {
                $("#info").html("Unmasked value: " + $(this).mask());
            }
        ).dblclick(function() {
                $(this).unmask();
            });
        });
        
        $('#edit_eleveur_department_1').change(function(){
            var dept = $('#edit_eleveur_department_1').val();         
            var  cities = [];
            
            if(typeof dept != 'undefined'){
                
                for(var j =0 ; j<departments.length;j++ )
                {
                    if(departments[j].id == dept)
                    {
                        cities = departments[j].cities;
                        break;
                    }
                }
                if(cities.length != 0)
                {
                    //console.log(dept);
                    //console.log(cities);
                    // clear the select
                    $("#edit_eleveur_city").empty();
                    var option = $('<option></option>').attr({
                        value : null
                    })
                    .text('Chwazi komin...');
                        
                    //add the option to the select
                    $("#edit_eleveur_city").append(option);
                    for(var i = 0; i<cities.length; i++){
                        var value = cities[i].id;
                        var text = cities[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value : value
                        })
                        .text(text);
                        
                        //add the option to the select
                        $("#edit_eleveur_city").append(option);
                    }
                }
            }
        });
        
        $('#edit_eleveur_city').change(function(){
            var city_id = $('#edit_eleveur_city').val();
            var dept = $('#edit_eleveur_department_1').val();
            if(typeof city_id != 'undefined' && typeof dept != 'undefined')
            {
                var cities = [];
                var sections = [];
                for(var j =0 ; j<departments.length;j++ )
                {
                    if(departments[j].id == dept)
                    {
                        cities = departments[j].cities;
                        break;
                    }
                }
                if(cities.length != 0)
                {
                    for(var k =0 ; k<cities.length;k++ )
                    {
                        if(cities[k].id == city_id)
                        {
                            sections = cities[k].sections;
                            break;
                        }
                    }
                }
                if (sections.length != 0)
                {
                    //console.log(dept);
                    //console.log(cities);
                    // clear the select
                    $("#edit_eleveur_cSection").empty();
                    for(var i = 0; i<sections.length; i++)
                    {
                        var value = sections[i].id;
                        var text = sections[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value : value
                        })
                        .text(text);
                        
                        //add the option to the select
                        $("#edit_eleveur_cSection").append(option);
                    }
                }
            }
        });
    });
</script>

@include('templates.footer')

@endsection