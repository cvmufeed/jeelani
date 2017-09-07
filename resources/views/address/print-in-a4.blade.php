<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print View A4</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/print_a4.css">
</head>
<body>
    <script>
    window.onafterprint = function() {
        //window.location.reload();
    }
    function erase_nonprintig_area() {
        /*document.getElementById('dont_print').innerHTML = "";
        
        for(i=0;i<{{count($address)}};i++) {
            document.getElementById('page'+i).className="";
        }*/
    }
    function print_now() {
        /*erase_nonprintig_area();
        //function to call after printed/cancelled
        var onPrintFinished=function(printed){window.location.reload();}

        //print command
        onPrintFinished(window.print());
        //window.location.replace('/print/all/now');*/
         
    }
    function download_now() {

    }
    </script>
    <!-- <div id="dont_print">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        </div>
    </div>
    <button onclick="print_now()" class="btn btn-primary">Print</button>
    <a href="\home">Go Home</a><hr/>
    Number of pages: {{$address->count()}}<hr/>
    All values are in mm
    <form action="/print/options/edit" method="post">
        {{csrf_field()}}
        page-width:{{ Form::selectRange('page_width', 400,0,$options->where('name','page_width')->first()->value) }}&emsp;page-height:{{ Form::selectRange('page_height', 400,0,$options->where('name','page_height')->first()->value) }}<br/>
        address-width:{{ Form::selectRange('address_width', 400,0,$options->where('name','address_width')->first()->value) }}&emsp;address-margin-top:{{ Form::selectRange('address_margin_top', 400,0,$options->where('name','address_margin_top')->first()->value) }}
        font-size:{{Form::selectRange('address_font_size',10,1,$options->where('name','address_font_size')->first()->value)}}<br/>
        <input type="submit" value="submit" class="btn btn-primary">
    </form>
    <hr/> -->
    </div>
    <div id="print">
            <?php
            $months = ['null','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            $i=0;
            
            foreach ($address as $value) {
                if ($i%24 == 0) {
                    echo '<div class="page" id="page'.$i.'">';
                }
                echo '<div class="address">';
                echo 'END '.$months[$value->end_month].'-'.$value->end_year.'<br/>';
                echo $value->name.'    #'.$value->id.'<br/>';
                echo nl2br(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $value->address)).'<br/>';
                if ($value->city != '') {
                    echo 'P.O: '.$value->city.'<br/>';
                }
                echo $value->district->name.'<br/>';
                echo $value->state->name.'<br/>';
                echo 'PIN:'.$value->pin.'<br/>';
                if ($value->phone != "") {
                    echo 'Phone:'.$value->phone.'<br/>';    
                }
                echo '</div>';
                
                $i++;
                if ($i%24 == 0) {
                    echo '</div>';
                }
            }
            
            ?>
    </div>
    </body>