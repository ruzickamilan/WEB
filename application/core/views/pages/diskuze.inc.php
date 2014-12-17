<script src='https://www.google.com/recaptcha/api.js'></script>
<h1 class="page-header">Diskuze <span style="font-size: 14px;"><a class="scroll" href="#">Položit nový dotaz</a></span></h1>
<div>
    {% set zadny_dotaz = 'true' %}
    {% for dotaz in diskuze %}
    <table class="diskuze table-striped">
        <thead>
            <tr>
                <td style="size: 150px; font-size: 20px;">
                    {% if mazani == true %}
                        <a title="Smazat" href="?page=diskuze&amp;delDotaz={{ dotaz['id'] }}">{{ mazani | raw }}</a>
                    {% endif %}
                    {% if email_edit == dotaz['email'] %}
                    <a title="Upravit" href="?page=diskuze&amp;editDotaz={{ dotaz['id'] }}"><span style="color: blue;" class="glyphicon glyphicon-pencil"></span></a>
                    {% endif %}
                    <b>{{ dotaz['jmeno'] }}</b>
                </td>
                <td style="text-align: right;">{{ dotaz['cas'] }}<br /><a href="?page=diskuze&amp;reakce={{ dotaz['id'] }}">reagovat</a></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    {{ dotaz['text'] }}
                </td>
            </tr>
            <tr>
                <td class="odpovedi" colspan="2">
                    {% set zadna_odpoved = 'true' %}
                    {% for odpoved in odpovedi %}
                        {% if dotaz['id'] == odpoved['diskuze_id'] %}
                            <p>
                                <span class="features simptip-position-left simptip-fade" data-tooltip="{{ odpoved['cely_cas'] }}">
                                {% if mazani == true %}
                                    <a href="?page=diskuze&amp;delOdpoved={{ odpoved['id'] }}">{{ mazani | raw }}</a>
                                {% endif %}
                                <span class="glyphicon glyphicon-share-alt"></span>
                                <b> {{ odpoved['cas'] }} {{ odpoved['jmeno'] }}:</b>
                                </span>
                                {{ odpoved['text'] }}
                            </p>
                            {% set zadna_odpoved = 'false' %}
                        {% endif %}
                    {% endfor %}
                    {% if zadna_odpoved == 'true' %}
                    <p><i>Na tento dotaz zatím nikdo nereagoval!</i></p>
                    {% endif %}
                </td>
            </tr>
            {% if id_diskuze == dotaz['id'] %}
            <tr>
                <td colspan="2">
                    <h4>Nová reakce:</h4>
                    <form id="reakce" style="margin-left: 30px;" class="form-horizontal" role="form" method="post" action="?page=diskuze">
                        <div class="form-group">
                            <div class="col-sm-offset-0 col-sm-10">
                                <textarea class="form-control text-diskuze" autofocus="autofocus" rows="6" cols="120" name="text_reakce" placeholder="Text reakce"></textarea> 
                                <input type="hidden" name="id_diskuze" value="{{ id_diskuze | raw }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-0 col-sm-10">
                                <button type="submit" class="btn btn-primary">Přidat reakci</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            {% endif %}
            {% if email_edit == dotaz['email'] %}
                {% if id_upravy == dotaz['id'] %}
                <tr>
                    <td colspan="2">
                        <h4>Upravit dotaz:</h4>
                        <form id="reakce" style="margin-left: 30px;" class="form-horizontal" role="form" method="post" action="?page=diskuze">
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-10">
                                    <textarea class="form-control text-diskuze" autofocus="autofocus" rows="6" cols="120" name="text_upravy">{{ dotaz['text'] }}</textarea> 
                                    <input type="hidden" name="id_diskuze" value="{{ dotaz['id'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Upravit</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                {% endif %}
            {% endif %}
        </tbody>
    </table>
    <br />
    {% set zadny_dotaz = 'false' %}
    {% endfor %}
    {% if zadny_dotaz == 'true' %}
        <i>Zatím nebyl vložen žádný dotaz!</i>
    {% endif %}
</div>
<hr>
<div id="novyDotaz">
<h4 class="header">Položit nový dotaz:</h4><br />
<form id="mojePravidla" class="form-horizontal" role="form" method="post" action="?page=diskuze">
    <div class="form-group">
        <span class="col-sm-2 control-label">Jméno uživatele: </span>
        <div class="col-sm-10">
            {{ jmeno | raw }}
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Váš email: </span>
        <div class="col-sm-10">
            {{ email | raw }}
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Text dotazu:</span>
        <div class="col-sm-10">
            <textarea class="form-control text-diskuze" rows="6" cols="120" name="text" placeholder="Text dotazu"></textarea> 
        </div>
    </div>
    <div class="form-group">
        {{ captcha | raw }}
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Přidat k ostatním</button>
        </div>
    </div>
</form>
</div>