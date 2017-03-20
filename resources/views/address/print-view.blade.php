<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print View</title>
</head>
<body>
    <script>
    window.onafterprint = function() {
        window.location.reload();
    }
    function erase_nonprintig_area() {
        document.getElementById('dont_print').innerHTML = "";
        
        for(i=0;i<{{count($address)}};i++) {
            document.getElementById('page'+i).className="";
        }
    }
    function print_now() {
        erase_nonprintig_area();
        //function to call after printed/cancelled
        var onPrintFinished=function(printed){window.location.reload();}

        //print command
        onPrintFinished(window.print());
        //window.location.replace('/print/all/now');
         
    }
    function download_now() {
        
    }
    </script>
    <div id="dont_print">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        </div>
    </div>
    <button onclick="print_now()" class="btn btn-primary">Print</button>
    <a href="\home">Go Home</a><hr/>
    All values are in mm
    <form action="/print/options/edit" method="post">
        {{csrf_field()}}
        page-width:{{ Form::selectRange('page_width', 400,0,$options->where('name','page_width')->first()->value) }}&emsp;page-height:{{ Form::selectRange('page_height', 400,0,$options->where('name','page_height')->first()->value) }}<br/>
        address-width:{{ Form::selectRange('address_width', 400,0,$options->where('name','address_width')->first()->value) }}&emsp;address-margin-top:{{ Form::selectRange('address_margin_top', 400,0,$options->where('name','address_margin_top')->first()->value) }}
        font-size:{{Form::selectRange('address_font_size',10,1,$options->where('name','address_font_size')->first()->value)}}<br/>
        <input type="submit" value="submit" class="btn btn-primary">
    </form>
    <hr/>
    </div>
    <div id="print">
        <style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
        </style>
        <style>
        .page-break {
            page-break-after: always;
            width:100%;
        }
        .page {
            border:dashed;
            height:{{$options->where('name','page_height')->first()->value}}mm;
            width:{{$options->where('name','page_width')->first()->value}}mm;
            
        }
        .address {
            border:1px solid;
            margin:auto;
            page-break-after: always;
            font-size: {{$options->where('name','address_font_size')->first()->value}}mm;
            width:{{$options->where('name','address_width')->first()->value}}mm;
            margin-top: {{$options->where('name','address_margin_top')->first()->value}}mm;
            
        }
        .page-print {
            border:0px dotted;
            height:{{$options->where('name','page_height')->first()->value}}mm;
            width:{{$options->where('name','page_width')->first()->value}}mm;
        }
    </style>
            <?php
            $months = ['null','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            for($i = 0 ; $i < count($address); $i++) {
                echo '<div class="page" id="page'.$i.'"><div class="address">';
                echo 'END '.$months[$address[$i]->end_month].'-'.$address[$i]->end_year.'<br/>';
                echo $address[$i]->name.'    #'.$address[$i]->id.'<br/>';
                echo nl2br($address[$i]->address).'<br/>';
                echo $address[$i]->city.'<br/>';
                echo $address[$i]->district->name.'<br/>';
                echo $address[$i]->state->name.'<br/>';
                echo 'PIN:'.$address[$i]->pin.'<br/>';
                echo 'Phone:'.$address[$i]->phone.'<br/>';
                echo '</div></div>';

            }
            ?>
    </div>
    </body>