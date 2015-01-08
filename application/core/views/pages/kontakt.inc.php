<script type="text/javascript" src="http://api4.mapy.cz/loader.js"></script>
<script type="text/javascript">Loader.load()</script>
<h1 class="page-header">Kontakt</h1>
<div class="col-md-8">
    <div id="mapa"></div>
    <script type="text/javascript">
        var stred = SMap.Coords.fromWGS84(13.4110211, 49.7283244);
        var m = new SMap(JAK.gel("mapa"), stred, 15);
        m.addDefaultLayer(SMap.DEF_BASE).enable();
        m.addDefaultControls();

        var layer = new SMap.Layer.Marker();
        m.addLayer(layer);
        layer.enable();

        var card = new SMap.Card();
        card.setSize(190, 135);
        card.getHeader().innerHTML = "<strong>QUATRO FIN s.r.o.</strong>";
        card.getBody().innerHTML = "Slovanská alej 2445/41<br />326 00 Plzeň";

        var options = {title: ""};

        var marker = new SMap.Marker(stred, "myMarker", options);
        marker.decorate(SMap.Marker.Feature.Card, card);
        layer.addMarker(marker);
    </script>
</div>
<!-- Contact Details Column -->
<div class="col-md-4" id="infoKontakt">
    <h3>QUATRO FIN s.r.o.</h3>
    <p style="font-size: 12px;">
        náměstí 14. října 1307/2<br />150 00 Praha 5, Smíchov
    </p>
    <p>
        <b>Kancelář a adresa pro doručování:</b><br />
        Slovanská alej 2445/41<br />326 00 Plzeň
    </p>
    <p>
        <b>IČ:</b> 6004573664<br />
        <b>DIČ:</b> CZ6004573664
    </p>
    <p> 
        <span class="glyphicon glyphicon-phone-alt"></span> &nbsp;377 421 126<br />
        <span class="glyphicon glyphicon-phone-alt"></span> &nbsp;776 291 047
    </p>
    <p> 
        <span class="glyphicon glyphicon-envelope"></span> &nbsp;<a href="mailto:info@quatrofin.cz">info@quatrofin.cz</a>
    </p>
    <p> 
        <b>datová schránka:</b> 3ze3at8
    </p>
    <p> 
        <span class="glyphicon glyphicon-time"></span> &nbsp;Po - Pá: 9:00 - 17:00<br />(osobní návštěvy po dohodě)
    </p>
</div>