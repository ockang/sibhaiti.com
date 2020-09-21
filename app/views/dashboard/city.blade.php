@extends('layouts.common')

@section('content')
@include('templates.headerTop')

@include('templates.header')
<div class="container">
    <p class="titre_top"><a href=""><?php echo 'Depatman ' . array_get($department, 'name'); ?></a></p>

    <div id="search_admin">				
        <div class="row">
            <?php
            if (isset($department) && !empty($department) && isset($city) && !empty($city)) {
                $sections = array_get($city, 'sections');
                ?>
                <legend><a href="{{URL::route('city', array(array_get($department, 'id'), array_get($city, 'id')))}}"><?php echo 'Ville ' . array_get($city, 'name'); ?></a></legend>
                <?php
                foreach ($sections as $section) {
                    ?>					 
                    <legend><?php echo array_get($section, 'name'); ?></legend>
                    <ul>
                        <li><a href="<?php echo URL::route('animalscitysection', array(array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id'))); ?>"><?php echo 'Bèf yo' . " (" . User::sectionCounter('animal', array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id')) . ")"; ?></a></li>
                        <li><a href="<?php echo URL::route('agentscitysection', array(array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id'))); ?>"><?php echo 'Ajan Yo' . " (" . User::sectionCounter('agent', array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id')) . ")"; ?></a></li>
                        <li><a href="<?php echo URL::route('eleveurscitysection', array(array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id'))); ?>"><?php echo 'Elvè Yo' . " (" . User::sectionCounter('eleveur', array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id')) . ")"; ?></a></li>                    					
                        <li><a href="<?php echo URL::route('abattoirscitysection', array(array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id'))); ?>"><?php echo 'Labatwa Yo' . " (" . User::sectionCounter('abattoir', array_get($department, 'id'), array_get($city, 'id'), array_get($section, 'id')) . ")"; ?></a></li>
                    </ul>
                    <?php
                }
            }
            ?>
        </div>		
    </div>
</div>
@include('templates.footer')

@endsection