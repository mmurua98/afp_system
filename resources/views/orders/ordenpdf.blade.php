<!DOCTYPE html>
<html lang="en">

<head>
    <title>AFP - Purchase Order</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
</head>

<body>

    <!--Logo-->
    {{-- <div class="logo">
        <img src="img/afpLogo.png" alt="">
    </div> --}}

    <!--Titulos-->
    <div class="containerTitle">
        <div class="header">
            <img src="img/afpLogo.png" alt="">
            <h2>ANDERSON FOREST PRODUCTS, INC.</h2>
        </div>
        
        <p class="location">NOGALES, MEXICO Plant</p>
        <p class="subtitle">ORDEN DE COMPRA LOCAL</p>
        <p class="telephone">Tel: (631) 319 0743, 314 4343</p>
    </div>

    <p class="nombreEmpresa">ANDERSON FORREST PRODUCTS DE NOGALES S DE RL DE CV</p>
    <p class="webiste">www.afpmexico.com</p>

    <!--Tabla Date-->
    <div class="containerDate">
        <table class="date">
            <tr>
                <th>Date</th>
                <th>PO Number</th>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>

    <div>
        <div class="td-80">

        </div>

        <div class="td-20">
            <table class="date">
                <tr>
                    <th>Date</th>
                    <th>PO Number</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- <div class="tablesSupShip">
        <!--Tabla Supplier-->
        <div class="containerSupplier">
            <table class="suppliers">
                <tr>
                    <th style="background-color: #c1e9d6;">To:</th>
                    <td>Bill Gates</td>
                </tr>
                <tr>
                    <th>Numero:</th>
                    <td>555 77 854</td>
                </tr>
                <tr>
                    <th>Correo:</th>
                    <td>555 77 855</td>
                </tr>
                <tr>
                    <th></th>
                    <td>555 77 855</td>
                </tr>
            </table>
        </div> 

        <!--Tabla Ship To-->
        <div class="containerShip">
            <table class="ship">
                <tr>
                    <th style="background-color: #c1e9d6;">Ship To:</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div> --}}

    <div>
        <div class="td-50 test">
            <table class="suppliers">
                <tr>
                    <th style="background-color: #c1e9d6;">To:</th>
                    <td>Bill Gates</td>
                </tr>
                <tr>
                    <th>Numero:</th>
                    <td>555 77 854</td>
                </tr>
                <tr>
                    <th>Correo:</th>
                    <td>555 77 855</td>
                </tr>
                <tr>
                    <th></th>
                    <td>555 77 855</td>
                </tr>
            </table>
        </div>

        <div class="td-15 test">
        </div>
    
        <div class="td-35 test" >
            <table class="ship" >
                <tr>
                    <th style="background-color: #c1e9d6;">Ship To:</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
    



    <!--Tabla Product-->
    {{-- <div class="containerProducts">
        <table class="products">
            <thead>
                <tr>
                    <th>Line</th>
                    <th>Packages</th>
                    <th>Description of Articles</th>
                    <th>Type</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td class="text-left">LAMPARA LED 51661</td>
                    <td>PZA</td>
                    <td>$909.00</td>
                    <td>$1818.00</td>
                </tr>
                <tr class="total">
                    <td colspan="4" class="noborders"></td>
                    <th class="text-left" scope="row">TOTAL</th>
                    <td class="text-right">$100.50</td>
                </tr>
                <tr class="iva8">
                    <td colspan="4" class="noborders"></td>
                    <th class="text-left" scope="row">IVA 8%</th>
                    <td class="text-right">$540.00</td>
                </tr>
                <tr class="iva16">
                    <td colspan="4" class="noborders"></td>
                    <th class="text-left" scope="row">IVA 16%</th>
                    <td class="text-right">$540.00</td>
                </tr>
                <tr class="grandTotal">
                    <td colspan="5" class="noborders"></td>
                    <td class="text-right">$540.00</td>
                </tr>
                <tr class="instructionTitle">
                    <td class="text-left" style="background-color: #c1e9d6;">Special Instructions:</td>
                    <td colspan="5" class="noborders"></td> 
                </tr>
            </tbody>

        </table>
    </div> --}}

    <!--Tabla Special Instructions-->
    {{-- <div class="containerInstruction">
        <table class="instruction">
            <tr>
                <td class="text-center" style="font-weight: bold;">Hola</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div> --}}

    <!--Tabla Invoice TO-->
    {{-- <div class="containerInvoice">
        <table class="invoice floated">
            <tr class="primero">
                <th class="text-center" style="font-weight: bold; background-color: #c1e9d6;">Invoice To:</th>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight: bold;">Anderson Forrest Products de Nogales</td>
            </tr>
            <tr>
                <td colspan="2">Blvd. Colosio #1, y Carrt Internacional</td>
            </tr>
            <tr>
                <td colspan="2">Parque Industrial Apolo</td>
            </tr>
            <tr>
                <td colspan="2">Nogales, Sonora, Mex 84094</td>
            </tr>
            <tr class="ultimo">
                <td colspan="2" style="font-weight: bold;">AFP 070123 A71</td>
            </tr>
        </table>    
    </div> --}}

    <!--Tabla Requerido y Firma-->
    {{-- <div class="containerinfoOrder">
        <table>
            <tr>
                <th class="text-right">Requerido por:</th>
                <td>Julio Quiñonez</td>
            </tr>
            <tr>
                <th class="text-right">Cuenta:</th>
                <td></td>
            </tr>
            <tr>
                <th class="text-right">Aprobada por:</th>
                <td>Anahi Echeverria</td>
            </tr>
        </table>
    </div> --}}

    <!--Tabla Corres Electronicos-->
    {{-- <div class="containerEmails">
        <table>
            <tr>
                <th class="text-right txtform">form AFPM-002 rev. sep/10/11</th>
                <td class="text-right">Factura eléctronica al correo:</td>
                <td>anahie@afpmexico.com</td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td>&nbsp;</td>
                <td>hgonzalez@afpmexico.com</td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td class="text-right txtcompras">COMPRAS:</td>
                <td>compras2@afpmexico.com</td>
            </tr>
        </table>
    </div> --}}


</body>

</html>
