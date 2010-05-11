<?php

function duree_appro($a1,$m1,$j1,$a2,$m2,$j2)
// Calcule le nombre de jours APPROXIMATIF entre deux dates
// Reste approximatif en particulier pour les changements d'annees...
{
return ($a2-$a1)*365+($m2-$m1)*30+($j2-$j1);
}

?>