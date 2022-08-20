<html>
    <head>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="{{public_path('asset/css/cssconstancia.css') }}">
        {{-- {!!Html::style("asset/bootstrap/bootstrap.min.css") !!} --}}
        <style>

            @page {
                margin: 0cm 0cm;
                font-family: Arial;
            }

            body {
                margin: 3cm 2cm 2cm;
            }

            .watermark {
                position: fixed;

                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   8cm;
                left:     6cm;

                /** Change image dimensions**/
                width:    10cm;
                height:   13cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }

            header {
                position: fixed;
                top: 1cm;
                left: 0cm;
                right: 0cm;
                height: 0cm;
                font-family: Arial, Helvetica, sans-serif;
                font-size:8pt;            
                color: black;
                text-align: center;
                line-height: 0.5cm;
            }

            .position{position: absolute; 

                    right: 170px; 
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 8pt
            }

            .position1{position: absolute; 
                    
                    left: 05px; 
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 10pt
            }

            .position2{position: absolute; 
                    right: 0px; 
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 10pt
            }

            .position5{
                    text-align: center;
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 14pt
            }   

            .position6{
                
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10pt;
                margin: 0cm 0.5cm 0.5cm;
                line-height: 0.8cm;
                text-align:justify
            } 
            .positiontable{
                margin: -0.6cm 3cm 0cm;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10pt;
                line-height: 0.3cm;
                width: 450px;
                left: 80px;
                /* left: 10cm; */
            }   
            .position7{position: absolute; 
                    margin: 0cm 0.5cm 0.5cm;
                    right: 0px; 
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 12pt;
                    font-weight: bold;
                    font-style: italic;
            }
            .position8{position: absolute; 
                    margin: 0cm -1cm 0cm;
                    top: 15cm;
            }
            .position9{position: absolute; 
                    top: 17.2cm;
                    left: 6cm; 
            }
            .positionqr{position: absolute; 
                    top: 18.2cm;
                    left: 14.5cm; 
            }
            .position10{position: absolute;           
                    top: 20cm;
                    left: 5cm;
                    text-align: center;
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    line-height: 0.5cm;
                    font-size: 8pt
            }
            .position11{position: absolute;           
                    top: 21.3cm;
                    right: 4.5cm;
                    left: 4cm;
                    text-align: center;
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    line-height: 0.3cm;
                    font-size: 6pt
            } 
            .position12{position: absolute;  
                    top: 21cm;
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 8pt;
                    line-height: 0.3cm;
            }  
            
            .position13{position: absolute;           
                    top: 22.5cm;
                    left: 2cm;
                    text-align: center;
                    color: black; 
                    font-family: Arial, Helvetica, sans-serif;
                    line-height: 0.5cm;
                    font-size: 6pt
            }  

            footer {
                position: absolute; 
                bottom: 0cm;
                top: 22.4cm;
                height: 0cm;
                left: 1cm;
                right: 1.1cm;
                height: 2cm;
                color: black;
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
                font-size: 6pt;
                /* line-height: 0.3cm; */
            }
        </style>
        
    </head>
    <body>
        <div class="positiontable">
            <div class="row justify-content-md-center">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                    <tr>
                        <td align="center">CONCEPTOS:</td>
                        <td align="center">MONTOS:</td>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach ($conceptos as $concepto) --}}
                    <tr>
                    {{-- <td >{{ $concepto->conceptos }}</td>
                    <td align="center">{{ $concepto->total }}</td>     --}}
                    <td >Prueba 1</td>
                    <td align="center">Prueba 1</td>  
                    </tr>
                    {{-- @endforeach --}}
                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <td align="center">TOTAL REMUNERACIÓN MENSUAL:</td>
                            <td align="center">Prueba 2</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br>
            <div class="row justify-content-md-center">
                <table class="table table-bordered table-sm">
                    <thead class="table-dark">
                    <tr>
                        <td align="center">OTROS INGRESOS MENSUAL:</td>
                        <td align="center">MONTOS:</td>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach ($o_ingreso as $o_ingresos) --}}
                    <tr>
                    <td >Prueba 13</td>
                    <td align="center">Prueba 13</td>    
                    </tr>
                    {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
    </body>
</html>