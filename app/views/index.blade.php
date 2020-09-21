@extends('layouts.common')
@section('content')
<div class="container">

    <div id="intro"> 
		 {{HTML::image('/frontapp/img/logoSib2.png')}}
    </div>
	
    <div id="header">
        <div class="connect">
            <div class="col-lg-4">
                <form action="{{URL::route('login')}}" method="post" name="users_login" id="users_login" class="form-horizontal">
                    <p class="titre_top">Konektew nan Sib</p>
						<?php
							if (isset($errors))
							{
								foreach ($errors as $error)
								{
									?> 
									<div class="text-danger"> <?php echo array_get($error, 0); ?> </div> 
									<?php
								}
							}
						?>

                        <div class="col-lg-12"> 
                            <input name="username"  id="username" maxlength="50" type="email" placeholder="Imèl" class="form-control input-medium" /> 
                        </div> 
                    
                        <div class="col-lg-12"> 
                            <input name="password" id="password" maxlength="10" type="password" placeholder="Modpas" class="form-control input-medium" /> 
                        </div>
                    
                    
                        <div class="col-lg-12"><button type="submit" class="btn btn-primary" onClick="return cnt();" >koneksyon</button>
                        </div>
                        
                
				</form>
            </div>
        </div>
    </div>

<!--    MODAL   -->
<!-- /.modal -->
<!-- FIN -->

</div>

@include('templates.footer')
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $.mask.definitions['~'] = "[+-]";


            $("#create_user_phone").mask("99999999");

            $("input").blur(function() {
                $("#info").html("Unmasked value: " + $(this).mask());
            }).dblclick(function() {
                $(this).unmask();
            }
            );
        }
        );
    }
    );
</script>







