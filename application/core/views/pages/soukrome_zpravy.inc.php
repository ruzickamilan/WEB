<h1 class="page-header">Soukromé zprávy</h1>
<div>
    <a href="?page=nova_zprava">Poslat novou zprávu</a><br /><br />
    <form class="form-horizontal" role="form" method="post" action="?page=soukrome_zpravy">
        <table class="diskuze table-bordered">
            <thead>
                <tr>
                    <td style="text-align: center;" rowspan="3"><button type="submit" class="btn btn-primary" name="smazat">Smazat</button></td>
                </tr>
                <tr>
                    <td>Odesílatel</td>
                    <td>Předmět</td>
                    <td>Čas</td>
                </tr>
                <tr>
                    <td colspan="2">Text</td>
                    <td>Reakce</td>
                </tr>
            </thead>
            <tbody>
                {% set zadna_zprava = 'true' %}
                {% for zprava in zpravy %}
                <tr style="border-top: 2px solid grey;"></tr>
                <tr>
                    <td rowspan="3" style="text-align: center;"><input type = 'checkbox' name = 'smaz[]' value = '{{ zprava['id'] }}'></td>
                </tr>
                <tr>
                    <td><b>{{ zprava['jmeno'] }} ({{ zprava['email'] }})</b></td>
                    <td>{{ zprava['predmet'] }}</td>
                    <td><b><span class="features simptip-position-left simptip-fade" data-tooltip="{{ zprava['cely_cas'] }}">{{ zprava['cas'] }}</span></b></td>
                </tr>
                <tr>
                    <td colspan="2">{{ zprava['text'] }}</td>
                    <td><a href="?page=nova_zprava&amp;reakce={{ zprava['email'] }}">Odpovědět</a></td>
                </tr>
                {% set zadna_zprava = 'false' %}
                {% endfor %}
                {% if zadna_zprava == 'true' %}
                <tr><td colspan="6"><i>Nemáte žádné přijaté zprávy!</i></td></tr>
                {% endif %}
            </tbody>
        </table>
    </form>
</div>
               