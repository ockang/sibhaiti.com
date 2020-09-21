@extends('layouts.common')

@section('content')
@include('templates.headerTop')

@include('templates.header')
@include('animals.tab_top')
<div class="tab-pane <?php echo $active_tab == 'animals_edit' ? 'active' : NULL; ?>" id="tab_animals_edit">
    <div class="user-form">
        <form action="" method="post" name="animals_edit" class="form-horizontal">
            <?php
            if (isset($errors)) {
                foreach ($errors as $error) {
                    ?>
                    <div class="text-danger"><?php echo array_get($error, 0); ?></div>
                    <?php
                }
            }
            ?>
            <legend>Remak ki gen sou bèf sa a</legend>	
            <!-- NOTIFICATIONS --> 
            <div class="col-lg-12">
                <div class="remak" style="overflow-x:scroll">
                    <table class="table">
                        <thead>
                            <tr>                           
                                <th><?php echo Lang::get('Depatman'); ?></th>
                                <th><?php echo Lang::get('#so'); ?></th>
                                <th><?php echo Lang::get('Vaksinasyon'); ?></th>
                                <th><?php echo Lang::get('Année'); ?></th>
                                <!--<th><?php echo Lang::get('#Cin ancien eleveur'); ?></th>
                                <th><?php echo Lang::get('#Cin nouveau Eleveur'); ?></th>-->
                                <th><?php echo Lang::get('#Tag'); ?></th>
                                <th><?php echo Lang::get('#Kanè'); ?></th>
                                <th><?php echo Lang::get('#Cin eleveur'); ?></th>
                               <!-- <th><?php echo Lang::get('#Ancien Tag'); ?></th>
                                <th><?php echo Lang::get('#Nouvo Tag'); ?></th>
                                <th><?php echo Lang::get('#Ancien Kanè'); ?></th>
                                <th><?php echo Lang::get('#Nouvo Kanè'); ?></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($notifications) && !empty($notifications)) {
                                foreach ($notifications as $key => $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo User::getDepartment($row->department); ?></td>
                                        <td><?php echo $row->so; ?></td>
                                        <td><?php echo $row->chabon; ?></td>
                                        <td><?php echo $row->year; ?></td>
                                        <!--<td><?php echo $row->old_cin; ?></td>
                                        <td><?php echo $row->new_cin; ?></td>-->
                                        <td><?php echo $row->tag; ?></td>
                                        <td><?php echo $row->kane; ?></td>
                                        <td><?php echo $row->cin_eleveur; ?></td>
                                        <!--<td><?php echo $row->old_tag; ?></td>
                                        <td><?php echo $row->new_tag; ?></td>
                                        <td><?php echo $row->old_kane; ?></td>
                                        <td><?php echo $row->new_kane; ?></td>-->
                                    </tr>
                                    <tr>
                                        <!--<td><?php echo Lang::get('Esplikasyon') . ":"; ?></td>-->
                                        <td colspan="15"><?php echo $row->text; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>  
                    <?php echo $notifications->links(); ?>
                </div>
                <?php
                if ($user->role != 'user') {
                    ?>
                    <p class = "information"><?php echo $user->finduser(array_get($edit_item, 'desc')); ?> kreye bèf saa nan dat kite: 

                        <?php echo substr(array_get($edit_item, 'created_at'), 0, strrpos(array_get($edit_item, 'created_at'), ' ')); ?>

                        . Denye dat enfòmasyon sou bèf sa a modifye se: 

                        <?php echo substr(array_get($edit_item, 'updated_at'), 0, strrpos(array_get($edit_item, 'updated_at'), ' ')); ?>
                    </p>
                    <?php
                }
                ?>
            </div>
            <legend>enfomasyon sou bèf la</legend>
            <?php
            if (array_get($edit_item, 'isDead')) {
                ?>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <img src="/frontapp/img/cow_head.png" class="img-responsive" title="Abattue" />
                        <h4>Yo abat bèf saa nan labatwa</h4>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_country"></label>
                <div class="col-lg-6">
                    <div class="radio">
                        <label>
                            <input type="radio" name="edit[animal][country]" id="edit_animal_country_0" value="<?php echo FALSE; ?>" <?php echo (array_get($edit_item, 'country') == FALSE) ? 'checked' : NULL; ?>>
                            Bèf  ayisyen
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="edit[animal][country]" id="edit_animal_country_1" value="<?php echo TRUE; ?>" <?php echo (array_get($edit_item, 'country') == TRUE) ? 'checked' : NULL; ?>>
                            Bèf dominiken
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="edit[animal][country]" id="edit_animal_country_2" value="<?php echo TRUE; ?>" <?php echo (array_get($edit_item, 'country') == TRUE) ? 'checked' : NULL; ?>>
                            Bèf lòt Peyi
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_fiche"><?php echo Lang::get('#Fich'); ?><span class="req">*</span></label>
                <div class="col-lg-6">
                    <input name="edit[animal][fiche]" id="edit_animal_fiche" class="form-control" maxlength="7" type="text" placeholder="<?php echo Lang::get('0000000000'); ?>" value="<?php echo array_get($edit_item, 'fiche'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_type"><?php echo Lang::get('Sèks'); ?><span class="req">*</span></label>
                <div class="col-lg-6">
                    <select name="edit[animal][type]" id="edit_animal_type" class="form-control" >
                        <option value="m" <?php echo (array_get($edit_item, 'type') == 'm') ? 'selected="selected"' : NULL; ?>><?php echo Lang::get('Mal'); ?></option>
                        <option value="f" <?php echo (array_get($edit_item, 'type') == 'f') ? 'selected="selected"' : NULL; ?>><?php echo Lang::get('Femèl'); ?></option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_birthday"><?php echo Lang::get('Dat nesans'); ?></label>
                <div class="col-lg-6">
                    <input name="edit[animal][birthday]" id="edit_animal_birthday" class="form-control" type="text" value="<?php echo array_get($edit_item, 'birthday'); ?>" maxlength="10" >
                    <span class="help-inline">jou / mwa / ane (00/00/0000)</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_isVaccinated"><?php echo Lang::get('Vaksinen?'); ?></label>
                <div class="col-lg-6">
                    <select name="edit[animal][isVaccinated]" id="edit_animal_isVaccinated" class="form-control">
                        <option value="o" <?php echo (array_get($edit_item, 'isVaccinated') == 'o') ? 'selected="selected"' : NULL; ?>><?php echo Lang::get('Wi'); ?></option>
                        <option value="n" <?php echo (array_get($edit_item, 'isVaccinated') == 'n') ? 'selected="selected"' : NULL; ?>><?php echo Lang::get('Non'); ?></option>                        
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_so"><?php echo Lang::get('#so'); ?><span class="req">*</span></label>
                <div class="col-lg-6">
                    <input name="edit[animal][so]" id="edit_animal_so" class="form-control" maxlength="8" type="text" value="<?php echo array_get($edit_item, 'so'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_mTag"><?php echo Lang::get('#Zanno Manman'); ?></label>
                <div class="col-lg-6">
                    <input name="edit[animal][mTag]" id="edit_animal_mTag" class="form-control" maxlength="11" type="text" value="<?php echo array_get($edit_item, 'mTag'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_fTag"><?php echo Lang::get('#Zanno Papa'); ?></label>
                <div class="col-lg-6">
                    <input name="edit[animal][fTag]" id="edit_animal_fTag" class="form-control" maxlength="11" type="text" value="<?php echo array_get($edit_item, 'fTag'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_idant"><?php echo Lang::get('Dat Idantifikasyon an fèt'); ?><span class="req">*</span></label>
                <div class="col-lg-6">
                    <input name="edit[animal][datIdant]" id="edit_animal_idant" class="form-control" type="text" value="<?php echo array_get($edit_item, 'datIdant'); ?>" maxlength="10"  >
                    <span class="help-inline">jou / mwa / ane (00/00/0000)</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_eleveur"><?php echo Lang::get('Elvè'); ?></label>
                <div class="col-lg-6">
                    <?php $elev = Animal::getobjEleveur(array_get($edit_item, 'eleveur')); ?>
                    <select name="edit[animal][eleveur]" id="edit_animal_eleveur" class="form-control" >
                        <?php
                        if (isset($elev)) {
                            ?>
                            <option value="<?php echo $elev->id; ?>" selected="selected"><?php echo $elev->getFullNameAttribute(), " (", $elev->idEleveur, ")"; ?></option>
                            <?php
                        }
                        if (isset($eleveurs)) {
                            foreach ($eleveurs as $eleveur) {
                                ?>
                                <option value="<?php echo $eleveur->id; ?>" <?php echo (array_get($edit_item, 'eleveur') == $eleveur->id) ? 'selected="selected"' : NULL; ?>><?php echo $eleveur->getFullNameAttribute(), " (", $eleveur->idEleveur, ")"; ?></option>
                                <?php
                            }
                        }
                        ?>                   
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <legend>ki kote yo gade bèf la </legend>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_department_1"><?php echo Lang::get('Depatman'); ?></label>
                <div class="col-lg-6">
                    <select name="edit[animal][department]" id="edit_animal_department_1" class="form-control">
                        <option value="">Chwazi depatman...</option>
                        <?php
                        foreach ($departments as $dept) {
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
                <label class="col-lg-3 control-label" for="edit_animal_city"><?php echo Lang::get('Komin'); ?></label>
                <div class="col-lg-6">
                    <select name="edit[animal][city]" id="edit_animal_city" class="form-control" >  
                        <option value="">Chwazi komin...</option>
                        <?php
                        if (array_get($edit_item, 'department')) {
                            $dept = array_get($edit_item, 'department');
                            for ($i = 0; $i < count($departments); $i++) {
                                if ($departments[$i]['id'] == $dept) {
                                    $cities = $departments[$i]['cities'];
                                    break;
                                }
                            }
                            if (isset($cities) && !empty($cities)) {
                                foreach ($cities as $city) {
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
                <label class="col-lg-3 control-label" for="edit_animal_cSection"><?php echo Lang::get('Seksyon'); ?></label>
                <div class="col-lg-6">
                    <select name="edit[animal][cSection]" id="edit_animal_cSection" class="form-control" >  
                        <option value="">Seksyon...</option>
                        <?php
                        if (array_get($edit_item, 'department') && array_get($edit_item, 'city') && isset($cities)) {
                            foreach ($cities as $city) {
                                if (array_get($edit_item, 'city') == array_get($city, 'id')) {
                                    $sections = array_get($city, 'sections');
                                    break;
                                }
                            }
                            if (isset($sections) && !empty($sections)) {
                                foreach ($sections as $section) {
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
            <legend>verifikasyon #Zanno ak #Kanè</legend>
            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_tag"><?php echo Lang::get('#Zanno'); ?><span class="req">*</span></label>
                <div class="col-lg-6">
                    <input name="edit[animal][tag]" id="edit_animal_tag1" class="form-control"  type="text" 
                           placeholder="<?php echo Lang::get('0123456789'); ?>" value="<?php echo array_get($edit_item, 'tag'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="edit_animal_carnet"><?php echo Lang::get('#Kanè'); ?><span class="req">*</span></label>
                <div class="col-lg-6">
                    <input name="edit[animal][carnet]" id="edit_animal_carnet" class="form-control"  type="text" 
                           placeholder="<?php echo Lang::get('0123456789'); ?>" value="<?php echo array_get($edit_item, 'carnet'); ?>">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <a href="{{URL::route('eleveurs')}}"class="btn btn-danger">Sòti</a>
                    <?php
                    if (  !array_get($edit_item, 'isDead') && $user->id == array_get($edit_item, 'desc') && $user->role != 'user') {
                        ?>
                        <button type="submit" class="btn btn-primary" name="edit[submit]"><?php echo Lang::get('Modifye Bèf'); ?></button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationLabel" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="form-group">
                    <a class="btn btn-success" href="<?php echo URL::route('createanimal', array_get($edit_item, 'eleveur')); ?>">
                        <span class="glyphicon glyphicon-plus"></span> Ajoute yon Bèf ak Menm Elvè a</a>
                </div>
                <div class="form-group">
                    <a class="btn btn-info" href="<?php echo URL::route('remarke', array_get($edit_item, 'id')); ?>"> Ajoute yon Remak sou bèf la</a>  

                </div>
                <div class="form-group">
                    <a href="{{URL::route('eleveurs')}}"class="btn btn-danger">Soti</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var departments = <?php echo (!empty($departments)) ? json_encode($departments) : "{}"; ?>;
    $(document).ready(function () {
        var confirmation = '<?php echo isset($added) ? $added : NULL; ?>';
        if (confirmation == 1)
        {

            //$('#confirmationModal').modal({backdrop: 'static', keyboard: false});
            $('#confirmationModal').modal('show');
        }
        $(function () {
            $.mask.definitions['~'] = "[+-]";
            $("#edit_animal_tag1").mask("9999999999");
            $("#edit_animal_carnet").mask("9999999999");

            $("#edit_animal_birthday").mask("99/99/9999");
            $("#edit_animal_idant").mask("99/99/9999");

            $("#edit_animal_fTag").mask("9999999999");
            $("#edit_animal_mTag").mask("9999999999");
            $("#edit_animal_tag").mask("9999999999");
            $("#edit_animal_fiche").mask("9999999");
            $("#notification-date").mask("99/99/9999");

            $("input").blur(function () {
                $("#info").html("Unmasked value: " + $(this).mask());
            }
            ).dblclick(function () {
                $(this).unmask();
            });
        });
        $('#edit_animal_department_1').change(function () {
            var dept = $('#edit_animal_department_1').val();
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
                    $("#edit_animal_city").empty();
                    var option = $('<option></option>').attr({
                        value: null
                    })
                            .text('Chwazi komin...');

                    //add the option to the select
                    $("#edit_animal_city").append(option);
                    for (var i = 0; i < cities.length; i++) {
                        var value = cities[i].id;
                        var text = cities[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value: value
                        })
                                .text(text);

                        //add the option to the select
                        $("#edit_animal_city").append(option);
                    }
                }
            }
        });

        $('#edit_animal_city').change(function () {
            var city_id = $('#edit_animal_city').val();
            var dept = $('#edit_animal_department_1').val();
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
                    //console.log(dept);
                    //console.log(cities);
                    // clear the select
                    $("#edit_animal_cSection").empty();
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
                        $("#edit_animal_cSection").append(option);
                    }
                }
            }
        });

        $("#verification_tag").mask("9999999999");
        $('#create-notification').click(function () {

            var rId = '<?php echo Array_get($edit_item, 'id'); ?>';
            var vtag = '<?php echo Array_get($edit_item, 'tag'); ?>';

            if ($('#notification-desc').val() != ""
                    && $('#notification-type').val() != ""
                    && $('#notification-date').val() != ""
                    && $('#notification-so').val() != ""
                    && $('#verification_tag').val() != ""
                    && $('#verification_tag').val() == vtag)
            {
                var type = $('#notification-type').val();
                var text = $('#notification-desc').val();
                var date = $('#notification-date').val();
                var department = $('#notification-department-1').val();
                var city = $('#notification-city').val();
                var section = $('#notification-cSection').val();
                var abbatoire = $('#notification-abbatoire').val();
                var so = $('#notification-so').val();

                var data = {text: text, type: type, date: date, rId: rId, department: department, city: city, section: section, abbatoire: abbatoire, so: so};

                $.ajax({
                    'url': '<?php echo URL::route('createnotification'); ?>',
                    'type': 'POST',
                    'data': data,
                    'success': function (data) {
                        $('#notificationModal').modal('hide');
                        alert('Notifikasyon ajoute avec succes.');
                    }
                });
            } else {
                alert('Oups!!! Verifye #TAG la ak chan obligatwa yo.');
            }
        });

        $('#notification-department-1').change(function () {
            var dept = $('#notification-department-1').val();
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
                    // console.log(cities);
                    // clear the select
                    $("#notification-city").empty();
                    var option = $('<option>aaaa</option>').attr({
                        value: null
                    })
                            .text('Chwazi komin...');

                    //add the option to the select
                    $("#notification-city").append(option);
                    for (var i = 0; i < cities.length; i++) {
                        var value = cities[i].id;
                        var text = cities[i].name;
                        // create an option with attributes 
                        var option = $('<option></option>').attr({
                            value: value
                        })
                                .text(text);

                        //add the option to the select
                        $("#notification-city").append(option);
                    }
                }
            }
        });

        $('#notification-city').change(function () {
            var city_id = $('#notification-city').val();
            var dept = $('#notification-department-1').val();
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
                    //console.log(dept);
                    //console.log(cities);
                    // clear the select
                    $("#notification-cSection").empty();
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
                        $("#notification-cSection").append(option);
                    }
                }
            }
        });

    });
</script>  

@include('templates.footer')

@endsection