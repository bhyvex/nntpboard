{include file=header.html.tpl}
<h1>{$board.name}</h1>

<ul class="breadcrumb">{include file=board_breadcrumb.html.tpl board=$board}</ul>

<p>Dein Post wird moderiert. Sobald er freigeschaltet wurde, wird er allen
 Benutzern angezeigt werden.</p>

<a href="viewboard.php?boardid={$board.boardid|escape:url}">Zur&uuml;ck zum Forum</a>
{include file=footer.html.tpl}
