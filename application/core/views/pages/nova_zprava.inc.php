<h1 class="page-header">Nová zpráva</h1>
<form id="mojePravidla" class="form-horizontal" role="form" method="post" action="?page=nova_zprava">
    <div class="form-group">
        <span class="col-sm-2 control-label">Příjemce:</span>
        <div class="col-sm-10">
            <select name="prijemce" class="form-control">
                {% if admin == true %}
                    <option>Poslat všem uživatelům</option>
                    <option>Poslat všem adminům</option>
                    <optgroup label="Poslat jednotlivě:">
                {% endif %}
                {% set vybrany_uzivatel = sel %}
                {% for prijemce in prijemci %}
                    {% if sel == prijemce['email'] %}
                        <option selected>{{ prijemce['jmeno'] }} ({{ prijemce['email'] }})</option>
                    {% endif %}
                    {% if sel != prijemce['email'] %}
                        <option>{{ prijemce['jmeno'] }} ({{ prijemce['email'] }})</option>
                    {% endif %}
                {% endfor %}
                {% if admin == true %}
                    </optgroup>
                {% endif %}
            </select>
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Předmět:</span>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Předmět" name="predmet">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Text zprávy:</span>
        <div class="col-sm-10">
            <textarea class="form-control text-diskuze" rows="6" cols="120" name="text_zpravy" placeholder="Text zprávy"></textarea> 
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Odeslat</button>
        </div>
    </div>
</form>