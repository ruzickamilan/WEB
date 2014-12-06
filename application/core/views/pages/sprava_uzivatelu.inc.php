<h1 class="page-header">Správa uživatelů</h1>
<div>
    <form class="form-horizontal" role="form" method="post" action="?page=sprava_uzivatelu">
        <table class="diskuze table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Jméno</td>
                    <td>Email</td>
                    <td>Telefon</td>
                    <td>Hodnost</td>
                    <td>Ověřen</td>
                    <td>Blokován</td>
                    <td><button type="submit" class="btn btn-primary" name="povysit">Povýšit</button></td>
                    <td><button type="submit" class="btn btn-primary" name="ban">Zablokovat</button></td>
                    <td><button type="submit" class="btn btn-primary" name="unban">Odblokovat</button></td>
                </tr>
            </thead>
            <tbody>
                {% for uzivatel in uzivatele %}
                <tr>
                    <td>{{ uzivatel['id'] }}</td>
                    <td>{{ uzivatel['jmeno'] }}</td>
                    <td style="text-align: center; font-weight: bold; color: darkblue; font-size: 18px;"><span class="features simptip-position-left simptip-fade" data-tooltip="{{ uzivatel['email'] }}">@</span></td>
                    <td style="text-align: center;">
                        {% if uzivatel['telefon'] == 0 %}
                            <span style='color: red;' class='glyphicon glyphicon-remove'></span>
                        {% endif %} 
                        {% if uzivatel['telefon'] != 0 %}
                            {{ uzivatel['telefon'] }}
                        {% endif %}
                    </td>
                    <td>{{ uzivatel['typ_uctu'] }}</td>
                    <td style="text-align: center;">
                        {% if uzivatel['autorizace'] == 1 %}
                            <span style='color: green;' class='glyphicon glyphicon-ok'></span>
                        {% endif %} 
                        {% if uzivatel['autorizace'] != 1 %}
                            <span style='color: red;' class='glyphicon glyphicon-remove'></span>
                        {% endif %}
                    </td>
                    <td style="text-align: center;">
                        {% if uzivatel['ban'] == 1 %}
                            <span style='color: green;' class='glyphicon glyphicon-ok'></span>
                        {% endif %} 
                        {% if uzivatel['ban'] == 0 %}
                            <span style='color: red;' class='glyphicon glyphicon-remove'></span>
                        {% endif %}
                    </td>
                    <td style="text-align: center;"><input type="radio" name="prava[]" value="{{ uzivatel['id'] }}"></td>
                    <td style="text-align: center;"><input type="radio" name="ban[]" value="{{ uzivatel['id'] }}"></td>
                    <td style="text-align: center;"><input type="radio" name="unban[]" value="{{ uzivatel['id'] }}"></td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
        <br />
        <span style="text-align: center; font-weight: bold; color: darkblue; font-size: 18px;">@</span> - pro zobrazení najeďte myší<br /><br />
        <a href="?page=muj_ucet">Zpět do mého účtu</a>
    </form>
</div>
               