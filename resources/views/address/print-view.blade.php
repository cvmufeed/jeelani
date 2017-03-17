
    <script>
        function print_now() {
            for(i=0;i<{{count($address)}};i++) {
                document.getElementById('page'+i).className="page-print";
            }
            var prtContent = document.getElementById("print");
            var WinPrint = window.open('/print/template', '', '');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();   
        }
    </script>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        </div>
    </div>
    
    <div id="print">
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
            font-size: {{$options->where('name','address_font_size')->first()->value}}mm;
            width:{{$options->where('name','address_width')->first()->value}}mm;
            margin-top: {{$options->where('name','address_margin_top')->first()->value}}mm;
            
        }
        .page-print {
            border:none;
            height:{{$options->where('name','page_height')->first()->value}}mm;
            width:{{$options->where('name','page_width')->first()->value}}mm;
        }
    </style>
            <?php
            $months = ['null','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            for($i = 0 ; $i < count($address); $i++) {
                echo '<div class="page-break"><div class="page" id="page'.$i.'"><div class="address">';
                echo 'END '.$months[$address[$i]->end_month].'-'.$address[$i]->end_year.'<br/>';
                echo $address[$i]->name.'    #'.$address[$i]->id.'<br/>';
                echo nl2br($address[$i]->address).'<br/>';
                echo $address[$i]->city.'<br/>';
                echo $address[$i]->district->name.'<br/>';
                echo $address[$i]->state->name.'<br/>';
                echo 'PIN:'.$address[$i]->pin.'<br/>';
                echo 'Phone:'.$address[$i]->phone.'<br/>';
                echo '</div></div></div>';

            }
            ?>
    </div>