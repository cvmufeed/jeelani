<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
        
    @yield('header')
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .error {
            color:red;
        }
        .break { page-break-before: always; }
    </style>
</head>
<body>
	<div class="row">
        <div class="col-md-6 col-md-offset-3">
        	<?php
        	$months = ['null','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
			for($i = 0 ; $i < count($address); $i++) {
				echo 'END '.$months[$address[$i]->end_month].'-'.$address[$i]->end_year.'<br/>';
				echo $address[$i]->name.'    #'.$address[$i]->id.'<br/>';
				echo nl2br($address[$i]->address).'<br/>';
				echo $address[$i]->city.'<br/>';
				echo $address[$i]->district->name.'<br/>';
				echo $address[$i]->state->name.'<br/>';
				echo 'PIN:'.$address[$i]->pin.'<br/>';
				echo 'Phone:'.$address[$i]->phone.'<br/>';

			}
			?>
        </div>
    </div>
</body>
</html>