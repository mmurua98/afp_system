<!DOCTYPE html>
<html lang="en">

<head>
    <title>AFP - Purchase Order</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reporte.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <!--Logo-->
    <!-- <div class="logo">
        <img src="afpLogo.png" alt="">
    </div> -->

    <!--Titulos-->
    <div class="containerTitle">
        <div class="header">
            <img src="img/afpLogo.png" alt="" style="height: 70px;">
            <h2>ANDERSON FOREST PRODUCTS, INC.</h2>
        </div>

        <p class="location">NOGALES, MEXICO Plant</p>
        <p class="subtitle">ORDEN DE COMPRA LOCAL</p>
        <p class="telephone">Tel: (631) 319 0743, 314 4343</p>
    </div>

    <p class="nombreEmpresa">ANDERSON FORREST PRODUCTS DE NOGALES S DE RL DE CV</p>
    <p class="website">www.afpmexico.com</p>

     <!--Tabla Date-->
    <div class="containerDate">
        <table class="date" >
            <tr>
                <th class="noborders noBG">&nbsp;</th>
                <th class="text-center width40">Date</th>
                <th class="text-center width40">PO Number</th>
            </tr>
            @foreach ($dateNumber as $dn)
                <tr>
                    <td class="noborders noBG">&nbsp;</td>
                    <td class="height40 text-center">{{$dn->date}}</td>
                    <td class="text-center">{{$dn->po_number}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <table class="supplierShip">
        <thead>
            @foreach ($orders as $order)
            <tr>
                <th class="width25 addColor text-center borderT">To:</th>
                <td class="width50 text-left borderTop">{{$order->company}}</td>
                <th class="width60 noborders">&nbsp;</th>
                <th class="text-center width80 addColor borderT">Ship To:</th>
                <th class="width170 borderTop">&nbsp;</th>
            </tr>  
        </thead>
        <tbody>
            
            <tr>
                <th class="text-center borderL">Numero:</th>
                <td class="text-left borderR">{{$order->phone}}</td>
                <td class="noborders">&nbsp;</td>
                <td class="borderL">&nbsp;</td>
                <td class="borderR">&nbsp;</td>
            </tr>
            <tr>
                <th class="text-center borderL">Correo:</th>
                <td class="text-left borderR">{{$order->email}}</td>
                <td class="noborders">&nbsp;</td>
                <td class="borderL">&nbsp;</td>
                <td class="borderR">&nbsp;</td>
            </tr>
            <tr>
                <th class="borderLB">&nbsp;</th>
                <td class="text-center borderRB">{{$order->location}}</td>
                <td class="noborders">&nbsp;</td>
                <td class="borderLB">&nbsp;</td>
                <td class="borderRB">&nbsp;</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <!--Tabla Product-->
    <div class="containerProducts">
        <table class="products">
            <thead>
                <tr>
                    <th class="width40 text-center">Line</th>
                    <th class="width40">Packages</th>
                    <th>Description of Articles</th>
                    <th class="width40 text-center">Type</th>
                    <th class="width80 text-center">Unit Price</th>
                    <th class="width80 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderdetails as $od)
                    <tr>
                        <td>{{$od->line}}</td>
                        <td>{{$od->quantity}}</td>
                        <td class="text-left">{{$od->name}}</td>
                        <td>{{$od->type}}</td>
                        <td class="text-right">${{$od->price}}</td>
                        <td class="text-right">${{$od->totalSinIva}}</td>
                    </tr>
                @endforeach
                @foreach ($totales as $total)
                    <tr class="total">
                        <td colspan="4" class="noborders"></td>
                        <th class="text-left" scope="row">TOTAL</th>
                        <td class="text-right">${{$total->totalSinIva}}</td>
                    </tr>
                    @if ($total->tipo == '8%')
                        <tr class="iva8">
                            <td colspan="4" class="noborders"></td>
                            <th class="text-left noborders" scope="row">IVA 8%</th>
                            <td class="text-right">${{$total->iva}}</td>
                        </tr>
                    @elseif ($total->tipo == '16%')
                        <tr class="iva16">
                            <td colspan="4" class="noborders"></td>
                            <th class="text-left noborders" scope="row">IVA 16%</th>
                            <td class="text-right">${{$total->iva}}</td>
                        </tr>
                    @endif
                    <tr class="grandTotal">
                        <td colspan="5" class="noborders"></td>
                        <td class="text-right">${{$total->total}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!--Tabla Special Instructions-->
    <div class="containerInstruction">
        <table class="instruction">
            <tr class="instructionTitle">
                <th class="text-left" style="background-color: #c1e9d6;">Special Instructions:</th>
            </tr>
            @foreach ($instructions as $instruction)
                <tr>
                    <td class="text-center" style="font-weight: bold;">{{$instruction->description}}</td>
                </tr>
            @endforeach
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>

    <table class="invoiceRequire">
        <thead>
            <tr>
                <th class="width80 addColor">Invoice To</th>
                <th class="noborders">&nbsp;</th>
                <th class="noborders">&nbsp;</th>
                <th class="noborders">&nbsp;</th>
                <th class="noborders">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="borderRTL">Anderson Forrest Products de Nogales</td>
                    <td class="noborders">&nbsp;</td>
                    <td class="textRight noborders">Requerido por:</td>
                    <td class="borderBottom">{{$order->name}}</td>
                    <td class="noborders">&nbsp;</td>
                </tr>
            @endforeach
            <tr>
                <td class="borderRL">Blvd. Colosio #1, y Carrt Internacional</td>
                <td class="noborders">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
            </tr>
            <tr>
                <td class="borderRL">Parque Industrial Apolo</td>
                <td class="noborders">&nbsp;</td>
                <td class="textRight noborders">Cuenta:</td>
                <td class="borderBottom">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
            </tr>
            <tr>
                <td class="borderRL">Nogales, Sonora Mex 84090</td>
                <td class="noborders">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
                <td class="noborders">&nbsp;</td>
            </tr>
            <tr>
                <td class="borderRBL">AFP 070123 A71</td>
                <td class="noborders">&nbsp;</td>
                <td class="textRight noborders">Aprobada por:</td>
                <td class="borderBottom">Anahi Echeverria</td>
                <td class="noborders">&nbsp;</td>
            </tr>
        </tbody>
    </table>


    <!--Tabla Corres Electronicos-->
    <div class="containerEmails">
        <table class="footer">
            <tr>
                <th class="text-left txtform width80 noborders">form AFPM-002 rev. sep/10/11</th>
                <td class="text-right width90 noborders">Factura eléctronica al correo:</td>
                <td class="borderBottom text-center">anahie@afpmexico.com</td>
                <td class="noborders">&nbsp;</td>
            </tr>
            <tr>
                <th class="noborders">&nbsp;</th>
                <td class="noborders">&nbsp;</td>
                <td class="borderBottom text-center">hgonzalez@afpmexico.com</td>
                <td class="noborders">&nbsp;</td>
            </tr>
            <tr>
                <th class="noborders">&nbsp;</th>
                <td class="text-right txtcompras noborders">COMPRAS:</td>
                <td class="borderBottom text-center">compras2@afpmexico.com</td>
                <td class="noborders">&nbsp;</td>
            </tr>
        </table>
    </div>

    <div class="razsocial">
        @foreach ($orders as $order)
            <h4>{{$order->raz_social}}</h4>
        @endforeach
    </div>



</body>

</html>
